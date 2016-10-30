<?php
class Invoice extends MY_Controller {
	var $gallery_path;
	var $gallery_path_url;
	var $data = array();
	var $flag = '';
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('invoice_model');
	    $this->load->model('location/location_model', 'lm');
	    $this->load->library('email');
	    $this->load->helper('common');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$this->data['userData'] = $this->login->getUserProfile($userId);
		$this->data['table_header_date'] = 'Date';
		$this->data['table_header_amount'] = 'Amount';
		$this->data['table_header_description'] = 'Description';
		$this->data['table_header_action'] = 'Action';
		$this->flag = $this->uri->segment(2);
	}
	public function overdue_bills(){
		authenticate(array('ut4','ut11'));
		$data = $this->data;
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'List Overdue Bills';
			$data['invoice'] = $this->invoice_model->getInvoice($data['userData']['company_id'],$this->flag);
			$this->load->view("list_overdue_bills",$data);
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function current_bill(){
		authenticate(array('ut4','ut11'));
		$data = $this->data;
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'Current Bill';
			$data['invoice'] = $this->invoice_model->getInvoice($data['userData']['company_id'],$this->flag);
			if(!empty($data['invoice'])){
			$data['discount'] = $this->invoice_model->getDiscountById($data['invoice'][0]['id']);	
			}
			$this->load->view("current_bill",$data);
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function old_bills(){
		authenticate(array('ut4','ut11'));
		$data = $this->data;
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'List Old Bills';
			$data['invoice'] = $this->invoice_model->getInvoice($data['userData']['company_id'],$this->flag);
			$this->load->view("list_old_bills",$data);
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function all_bills(){
		authenticate(array('ut4','ut11'));
		$data = $this->data;
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'Invoices';
			$data['invoice'] = $this->invoice_model->getInvoice($data['userData']['company_id'],$this->flag);
			$this->load->view("all_bills",$data);
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function account_statements(){
		authenticate(array('ut4','ut11'));
		$data = $this->data;
		$data['acc_statement'] = array();
		if($data['userData']['can_view_bill'] == 1){
			if ($this->input->post()){
				$data['start_date'] = $this->input->post('start_date');
				$temp_start_date 	= explode('-', $data['start_date']);
				$data['end_date']	= $this->input->post('end_date');
				$temp_end_date 		= explode('-', $data['end_date']);
				//-------------------------------------------------------
				$starting_balance = $this->invoice_model->get_starting_balance($data['userData']['company_id'],$temp_start_date);
				$starting_balance = ($starting_balance!= '') ? $starting_balance : 0;
				$data['acc_statement']['staring_balance'] 		= $starting_balance;
				//------------------------------------------------------
				$record_invoices 		= $this->invoice_model->get_invoices($data['userData']['company_id'],$temp_start_date,$temp_end_date);
				$record_payment_online 	= array();
				$record_payment_offline = array();
				$record_credit_notes 	= array();

				$sub_invoice_array 		= array();
				$sub_onpay_array 		= array();
				$sub_offpay_array 		= array();
				$sub_credit_note_array 	= array();
				foreach ($record_invoices as $key => $value) {
					$return_data_online = $this->invoice_model->get_payments_online($value['id'],$temp_start_date,$temp_end_date);
					if(count($return_data_online) != 0 && !empty($return_data_online)){
						$record_payment_online[] = $return_data_online;
					}

					$return_data_offline = $this->invoice_model->get_payments_offline($temp_start_date,$temp_end_date);
					if(count($return_data_offline) != 0 && !empty($return_data_offline)){
						$record_payment_offline = $return_data_offline;
					}

					$return_data_credit_notes = $this->invoice_model->get_credit_notes($temp_start_date,$temp_end_date);
					if(count($return_data_credit_notes) != 0 && !empty($return_data_credit_notes)){
						$record_credit_notes = $return_data_credit_notes;
					}
				}
				foreach ($record_invoices as $key => $value) {
					$sub_invoice_array[] = array('p_date'=>$value['publish_date'],'t_type'=>'Invoice','t_number'=>$value['invoice_number'],'t_status'=>'debit','t_amount'=>$value['total_amount']); 
				}
				foreach ($record_payment_online as $row) {
					foreach ($row as $key => $value) {
						$sub_onpay_array[] = array('p_date'=>$value['niceDate'],'t_type'=>'Online Payment','t_number'=>$value['Transaction_Reference_No'],'t_status'=>'paid','t_amount'=>($value['Amount']/100)); 
					}
				}
				foreach ($record_payment_offline as $key => $value) {
					$sub_offpay_array[] = array('p_date'=>$value['niceDate'],'t_type'=>'Payment','t_number'=>$value['invoice_number'],'t_status'=>'credit','t_amount'=>$value['Amount']); 
				}
				foreach ($record_credit_notes as $key => $value) {
					$sub_credit_note_array[] = array('p_date'=>$value['dateApproved'],'t_type'=>'Credit','t_number'=>$value['invoice_no'],'t_status'=>'credit','t_amount'=>$value['creditnote_amount']); 
				}
				$main_array = array_merge($sub_invoice_array,$sub_onpay_array,$sub_offpay_array,$sub_credit_note_array);
				$name = 'p_date';
			   	usort($main_array, function ($a, $b) use(&$name){return strtotime($a[$name]) - strtotime($b[$name]);});
			   	$last_array = array();
			   	$temp_amnt = $starting_balance;
			   	foreach ($main_array as $key => $value) {
			   			$last_array[] = $value;
			   			if($value['t_status'] == 'debit'){
			   				$temp_amnt = $temp_amnt - $value['t_amount'];
			   				$last_array[$key]['t_outstanding'] = $temp_amnt;
			   			}elseif ($value['t_status'] == 'credit') {
			   				$temp_amnt = $temp_amnt + $value['t_amount'];
			   				$last_array[$key]['t_outstanding'] = $temp_amnt;
			   			}elseif ($value['t_status'] == 'paid') {
			   				$temp_amnt = $temp_amnt + $value['t_amount'];
			   				$last_array[$key]['t_outstanding_credit'] = $temp_amnt;
			   				$temp_amnt = $temp_amnt - $value['t_amount'];
			   				$last_array[$key]['t_outstanding_debit'] = $temp_amnt;
			   			}
			   	}
			   	$ending_array = end($last_array);
				$data['acc_statement']['ending_balance'] 		= $ending_array['t_outstanding'];
				$data['acc_statement']['ending_balance_date']	= $ending_array['p_date'];
			   	$reversed_main_array = array_reverse($last_array, true);
			   	$starting_array = end($reversed_main_array);
			   	$data['acc_statement']['staring_balance_date']	= $starting_array['p_date'];
				$data['acc_statement']['invoice'] = $reversed_main_array;
			}
			$data['table_heading'] = 'Statement of Accounts';
			$this->load->view("account_statement",$data);
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function account_statements_pdf($userId = '',$compan_id ='',$stdate = '' ,$endate = ''){
		authenticate(array('ut4','ut11','ut7','ut10','ut5'));
		if($userId == '' || $compan_id == '' || $stdate == '' || $endate == ''){
			die('Not accessable this page');
		}
		$userId 	= base64_decode(base64_decode($userId));
		$compan_id 	= base64_decode(base64_decode($compan_id));
		$stdate 	= base64_decode(base64_decode($stdate));
		$endate 	= base64_decode(base64_decode($endate));
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['acc_statement'] = array();
		$data['start_date'] = $stdate;
		$temp_start_date 	= explode('-', $data['start_date']);
		$data['end_date']	= $endate;
		$temp_end_date 		= explode('-', $data['end_date']);
		//-------------------------------------------------------
		$starting_balance = $this->invoice_model->get_starting_balance($compan_id,$temp_start_date);
		$starting_balance = ($starting_balance!= '') ? $starting_balance : 0;
		$data['acc_statement']['staring_balance'] 		= $starting_balance;
		//------------------------------------------------------
		$record_invoices 		= $this->invoice_model->get_invoices($compan_id,$temp_start_date,$temp_end_date);
		$record_payment_online 	= array();
		$record_payment_offline = array();
		$record_credit_notes 	= array();

		$sub_invoice_array 		= array();
		$sub_onpay_array 		= array();
		$sub_offpay_array 		= array();
		$sub_credit_note_array 	= array();
		foreach ($record_invoices as $key => $value) {
			$return_data_online = $this->invoice_model->get_payments_online($value['id'],$temp_start_date,$temp_end_date);
			if(count($return_data_online) != 0 && !empty($return_data_online)){
				$record_payment_online[] = $return_data_online;
			}

			$return_data_offline = $this->invoice_model->get_payments_offline($temp_start_date,$temp_end_date);
			if(count($return_data_offline) != 0 && !empty($return_data_offline)){
				$record_payment_offline = $return_data_offline;
			}

			$return_data_credit_notes = $this->invoice_model->get_credit_notes($temp_start_date,$temp_end_date);
			if(count($return_data_credit_notes) != 0 && !empty($return_data_credit_notes)){
				$record_credit_notes = $return_data_credit_notes;
			}
		}
		foreach ($record_invoices as $key => $value) {
			$sub_invoice_array[] = array('p_date'=>$value['publish_date'],'t_type'=>'Invoice','t_number'=>$value['invoice_number'],'t_status'=>'debit','t_amount'=>$value['total_amount']); 
		}
		foreach ($record_payment_online as $row) {
			foreach ($row as $key => $value) {
				$sub_onpay_array[] = array('p_date'=>$value['niceDate'],'t_type'=>'Online Payment','t_number'=>$value['Transaction_Reference_No'],'t_status'=>'paid','t_amount'=>($value['Amount']/100)); 
			}
		}
		foreach ($record_payment_offline as $key => $value) {
			$sub_offpay_array[] = array('p_date'=>$value['niceDate'],'t_type'=>'Payment','t_number'=>$value['invoice_number'],'t_status'=>'credit','t_amount'=>$value['Amount']); 
		}
		foreach ($record_credit_notes as $key => $value) {
			$sub_credit_note_array[] = array('p_date'=>$value['dateApproved'],'t_type'=>'Credit','t_number'=>$value['invoice_no'],'t_status'=>'credit','t_amount'=>$value['creditnote_amount']); 
		}
		$main_array = array_merge($sub_invoice_array,$sub_onpay_array,$sub_offpay_array,$sub_credit_note_array);
		$name = 'p_date';
	   	usort($main_array, function ($a, $b) use(&$name){return strtotime($a[$name]) - strtotime($b[$name]);});
	   	$last_array = array();
	   	$temp_amnt = $starting_balance;
	   	foreach ($main_array as $key => $value) {
	   			$last_array[] = $value;
	   			if($value['t_status'] == 'debit'){
	   				$temp_amnt = $temp_amnt - $value['t_amount'];
	   				$last_array[$key]['t_outstanding'] = $temp_amnt;
	   			}elseif ($value['t_status'] == 'credit') {
	   				$temp_amnt = $temp_amnt + $value['t_amount'];
	   				$last_array[$key]['t_outstanding'] = $temp_amnt;
	   			}elseif ($value['t_status'] == 'paid') {
	   				$temp_amnt = $temp_amnt + $value['t_amount'];
	   				$last_array[$key]['t_outstanding_credit'] = $temp_amnt;
	   				$temp_amnt = $temp_amnt - $value['t_amount'];
	   				$last_array[$key]['t_outstanding_debit'] = $temp_amnt;
	   			}
	   	}
	   	$ending_array = end($last_array);
		$data['acc_statement']['ending_balance'] 		= $ending_array['t_outstanding'];
		$data['acc_statement']['ending_balance_date']	= $ending_array['p_date'];
	   	$reversed_main_array = array_reverse($last_array, true);
	   	$starting_array = end($reversed_main_array);
	   	$data['acc_statement']['staring_balance_date']	= $starting_array['p_date'];
		$data['acc_statement']['invoice'] = $reversed_main_array;
		$data['table_heading'] = 'Statement of Accounts';
		$html = $this->load->view("account_statement_pdf",$data, true);
		ini_set('memory_limit','32M');
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);				
		$mpdf->SetTitle("Smartworks - Account Statement");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->WriteHTML($html);
		$mpdf->Output('Smartworks_account_statement_'.date('d_M_Y').'.pdf','I');
		exit;
	}
	public function get_companyby_location($city){
    	$data['cmpny']=$this->invoice_model->get_companyby_location($city);	
		
		if(!empty($data['cmpny']))
		{
			foreach($data['cmpny'] as $key=>$value)
			{
				echo '<option value="'.$value['id'].'">'.$value['company_name'].' ('.$value['userEmail'].')</option>'; 
			}			
		}else{
			
			echo '<option value="0">No Client Available</option>';
		}
	}
	public function discountOnInvoice(){
		$data = $this->data;
		$data['invoice_id'] = $this->input->post("invoiceId");
		$data['discount'] = $this->input->post("discount");
		$status = $this->invoice_model->reqInvoiceDiscount($data);
		echo json_encode($status);
	}
	public function generate_invoice_html_view($invid = ''){
		authenticate(array('ut4','ut11'));
		if($invid == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($invid));
		$data = $this->data;
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['title'] = 'Smartworks - Invoice';
		$data['company'] = $this->invoice_model->getCompanyDetails($data['userData']['company_id']);
		$data['invoice'] = $this->invoice_model->getInvoiceById($invoice_id);
		$this->db->select("locations.email");
		$this->db->from('locations');
		$this->db->where('locations.locationId',$data['company']['location_id']);
		$query=$this->db->get();
		if(!empty($query->result_array())){
			$data['community_manager'] = $query->result_array()[0]['email'];
		}else{
			$data['community_manager'] = '';
		}
		if(empty($data['invoice'])){
			die('Not accessable this page');
		}
		$data['discount'] = $this->invoice_model->getDiscountById($invoice_id);
		$data['invoice_items'] = $this->invoice_model->getInvoiceItems($invoice_id);
		$this->load->view('html_view_first', $data);
		$this->load->view('html_view_second', $data);
		$this->load->view('html_view_third', $data);
		$this->load->view('html_view_fourth', $data);
	}
	public function generate_invoice_pdf($invid = ''){
		authenticate(array('ut4','ut11'));
		if($invid == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($invid));
		$data = $this->data;
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['company'] = $this->invoice_model->getCompanyDetails($data['userData']['company_id']);
		$data['invoice'] = $this->invoice_model->getInvoiceById($invoice_id);
		$this->db->select("locations.email");
		$this->db->from('locations');
		$this->db->where('locations.locationId',$data['company']['location_id']);
		$query=$this->db->get();
		if(!empty($query->result_array())){
			$data['community_manager'] = $query->result_array()[0]['email'];
		}else{
			$data['community_manager'] = '';
		}
		if(empty($data['invoice'])){
			die('Not accessable this page');
		}
		$data['discount'] = $this->invoice_model->getDiscountById($invoice_id);
		$data['invoice_items'] = $this->invoice_model->getInvoiceItems($invoice_id);
		$html = $this->load->view('pdf_html_first', $data, true);
		$html1 = $this->load->view('pdf_html_second', $data, true);
		$html3 = $this->load->view('pdf_html_third', $data, true);
		$html4 = $this->load->view('pdf_html_fourth', $data, true);
		ini_set('memory_limit','32M');
		//$this->load->library('pdf');
		//$mpdf = $this->pdf->load();
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetTitle("Smartworks - Invoice");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->WriteHTML($html,2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($html1,2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($html3,2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($html4,2);
		//$mpdf->debug = true;
		$mpdf->Output('Smartworks_'.date('d_M_Y').'.pdf','I');
		exit;
	}
	public function invoice_generate_by_cron(){
		$from_email 	= 'sworks_team@sworks.co.in'; 
        $from_name 		= ucfirst('Team Smartworks');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to('sohom@simayaa.com'); 
		$this->email->subject('test cron');
		$this->email->message('this is a test cron from invoice controller');
		$this->email->send();
	}
	public function test(){
		$from_email 	= 'sworks_team@sworks.co.in'; 
        $from_name 		= ucfirst('Team Smartworks');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to('sohom@simayaa.com'); 
		$this->email->subject('test cron');
		$this->email->message('this is a test cron');
		$this->email->send();
	}
}