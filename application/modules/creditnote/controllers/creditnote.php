<?php
class Creditnote extends MY_Controller {
	var $gallery_path;
	var $gallery_path_url;
	var $data = array();
	var $flag = '';
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('login/login_model');
	    $this->load->model('creditnote_model');
	    $this->load->model('business/business_model');
	    $this->load->model('invoice/invoice_model');
	    $this->load->model('location/location_model', 'lm');
        $this->load->helper('common');
		$this->load->helper('form'); 
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
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
	public function approve_credit_note($val,$type){
	    $data = array(
	   		"isApproved" => $type
		);						 
	  	$result = update_tbl('creditnote_invoice_item','id',$val,$data);
	  	redirect(base_url().'index.php/creditnote/creditnote_approval');
	}
	public function creditnote_approval(){
	 	authenticate(array('ut7','ut10','ut2'));
	 	$userId = $this->session->userdata("userId");
	 	$userTypeId = $this->session->userdata("userTypeId");
	 	$data['userData'] = $this->login->getUserProfile($userId);
	 	$manager_credit=$this->login->get_staff_credit('ut7');
     	$ad_credit=$this->login->get_staff_credit('ut10');
     	$owner_credit=$this->login->get_staff_credit('ut2');
	 	if($this->session->userdata("userTypeId")=='ut7'){
	 		$data['credit_notes']=$this->creditnote_model->getCreditInvoiceItems($manager_credit[0]['amount_creditnote'],$manager_credit[0]['percentage_creditnote'],0,0);
	 	}else if($this->session->userdata("userTypeId")=='ut10'){
	 		$data['credit_notes']=$this->creditnote_model->getCreditInvoiceItems($ad_credit[0]['amount_creditnote'],$ad_credit[0]['percentage_creditnote'],$manager_credit[0]['amount_creditnote'],$manager_credit[0]['percentage_creditnote']);	
 		}else if($this->session->userdata("userTypeId")=='ut2'){
	 		$data['credit_notes']=$this->creditnote_model->getCreditInvoiceItems($owner_credit[0]['amount_creditnote'],$owner_credit[0]['percentage_creditnote'],$ad_credit[0]['amount_creditnote'],$ad_credit[0]['percentage_creditnote']);	
	 	}
		$this->load->view('creditnote/creditnote_approval',$data);	
	}
	public function credit_note_request_edit(){
		authenticate(array('ut5'));
		if (isset($_POST) && (!empty($_POST))) {
	         foreach($this->input->post('c_id') as $k=>$v){
       			$percentage = $this->input->post('qty_'.$v);
              	$totalWidth = $this->input->post('item_price_'.$v);
	      		if($this->input->post('optradio_'.$v)=='1' &&  $this->input->post('qty_'.$v)!=''){
	      			$new_width = ($percentage / 100) * $totalWidth;
              		$total=$totalWidth-$new_width;
	      			$credit_type=$this->input->post('optradio_'.$v);
	      		}else if($this->input->post('optradio_'.$v)=='2' &&  $this->input->post('qty_'.$v)!=''){
              		$total=$totalWidth-$percentage;
	      			$credit_type=$this->input->post('optradio_'.$v);
	      		}else if($this->input->post('optradio_'.$v)=='' && $this->input->post('rad_'.$v)=='1'){
	       			$new_width = ($percentage / 100) * $totalWidth;
             		$total=$totalWidth-$new_width;
	     			$credit_type=$this->input->post('rad_'.$v);
	      		}else if($this->input->post('optradio_'.$v)=='' && $this->input->post('rad_'.$v)=='2'){
	     			$total=$totalWidth-$percentage;
	     			$credit_type=$this->input->post('rad_'.$v);
	      		}else{
	     			$total='';
	     			$credit_type='';
      			}
		       	$update_data=array(
		           'description'=>$this->input->post('description_'.$v),
		           'creditnote_amount'=>$this->input->post('qty_'.$v),
		           'credit_type'=>$credit_type,
		           'total_price'=>$total
		       	);
			    $result = update_tbl('creditnote_invoice_item','id',$v,$update_data);
			}
        }
	    $this->session->set_flashdata('item',"Credit note request sent successfully.");
		$data['location']=$this->lm->getAlllocation();
	    @redirect(base_url().'index.php/creditnote/credit_note_request');	
	}
	public function credit_note_request(){
	    authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	 	if (isset($_POST) && (!empty($_POST))){
			for($i=0;$i<count($this->input->post('cat'));$i++){
	      		$itm=$this->input->post('cat')[$i];
	      		$percentage = $this->input->post('qty')[$i];
          		$totalWidth = $this->input->post('item_price')[$i];
	      		if($this->input->post('optradio_'.$itm)=='1' && $this->input->post('qty')[$i]!=''){
	      			$new_width = ($percentage / 100) * $totalWidth;
          			$total=$totalWidth-$new_width;
	      		}else if($this->input->post('optradio_'.$itm)=='2' && $this->input->post('qty')[$i]!=''){
          			$total=$totalWidth-$percentage;
	      		}else{
	      			$total='';	
	      		}
		 		$id=substr(create_guid(),0,16);
		 		$cr_no=sprintf("%06d", mt_rand(1, 999999));
			  	$info=array(
					 'id'=>$id,
					 'creditnote_no'=>$cr_no,
					 'invoice_id'=>$this->input->post('invoice_id')[$i],
					 'invoice_no'=>$this->input->post('invoice_no')[$i],
					 'invoice_item_id'=>$this->input->post('cat')[$i],
					 'item_price'=>$this->input->post('item_price')[$i],
					 'creditnote_amount'=>$this->input->post('qty')[$i],
					 'credit_type'=>$this->input->post('optradio_'.$itm),
					 'total_price'=>$total,
					 'description'=>$this->input->post('description')[$i],
					 'dateAdded'=>date('Y-m-d'),
					 'addedBy'=>$this->session->userdata("userId"),
					 'isApproved'=>'0'
			  	);
		 		$this->db->insert('creditnote_invoice_item',$info);
		 	if($this->input->post('qty')[$i]!='' && $this->input->post('optradio_'.$itm)!='' ){
				 $client_info=$this->creditnote_model->get_user_bycompany($this->input->post('invoice_id')[$i]);
				 $manager_credit=$this->login->get_staff_credit('ut7');
				 $ad_credit=$this->login->get_staff_credit('ut10');
				 $owner_credit=$this->login->get_staff_credit('ut2');
		 	if($this->input->post('optradio_'.$itm)=='1' && $percentage<=$manager_credit[0]['percentage_creditnote']){
	    		$data['user_info']=$this->login->getUserProfile($this->session->userdata("userId"));	
				$manager_info=$this->business_model->getmanagerinfo($data['user_info']['city_id']);
				$contname=$manager_info[0]['FirstName']." ".$manager_info[0]['LastName'];
				$to=$manager_info[0]['userEmail'];	
			 }else if($this->input->post('optradio_'.$itm)=='2' && $percentage<=$manager_credit[0]['amount_creditnote']){
	         	$data['user_info']=$this->login->getUserProfile($this->session->userdata("userId"));	
				$manager_info=$this->business_model->getmanagerinfo($data['user_info']['city_id']);
				$contname=$manager_info[0]['FirstName']." ".$manager_info[0]['LastName'];
				$to=$manager_info[0]['userEmail'];	
	        }else if($this->input->post('optradio_'.$itm)=='1' && $percentage<=$ad_credit[0]['percentage_creditnote']){
	            $data['user_info']=$this->login->getUserProfile($this->session->userdata("userId"));	
				$getadinfo=$this->business_model->getadinfo($data['user_info']['city_id']);
				$contname=$getadinfo[0]['FirstName']." ".$getadinfo[0]['LastName'];
				$to=$getadinfo[0]['userEmail'];	
	        }else if($this->input->post('optradio_'.$itm)=='2' && $percentage<=$ad_credit[0]['amount_creditnote']){
	            $data['user_info']=$this->login->getUserProfile($this->session->userdata("userId"));	
				$getadinfo=$this->business_model->getadinfo($data['user_info']['city_id']);
				$contname=$getadinfo[0]['FirstName']." ".$getadinfo[0]['LastName'];
				$to=$getadinfo[0]['userEmail'];	
	        }else if($this->input->post('optradio_'.$itm)=='1' && $percentage<=$owner_credit[0]['percentage_creditnote']){
	            $data['user_info']=$this->login->getUserProfile($this->session->userdata("userId"));	
				$getownerinfo=$this->business_model->getownerinfo();
				$contname=$getownerinfo[0]['FirstName']." ".$getownerinfo[0]['LastName'];
				$to=$getownerinfo[0]['userEmail'];	
	        }else if($this->input->post('optradio_'.$itm)=='2' && $percentage<=$owner_credit[0]['amount_creditnote']){
	            $data['user_info']=$this->login->getUserProfile($this->session->userdata("userId"));	
				$getownerinfo=$this->business_model->getownerinfo();
				$contname=$getownerinfo[0]['FirstName']." ".$getownerinfo[0]['LastName'];
				$to=$getownerinfo[0]['userEmail'];	
	        }
			 $email_template_id='2a2e7003-620b-aa';
			 $email_template = $this->login_model->getEmailTemplate($email_template_id);
			 $body = $email_template['description'];
			 $body = str_replace('[Approver Full Name]',$contname,$body);
			 $body = str_replace('[No. ]',$cr_no,$body);
			 $body = str_replace('[client fullname]',$client_info[0]['FirstName']." ".$client_info[0]['LastName'],$body);
			 $body = str_replace('[location]',$client_info[0]['l_name']."  ,".$client_info[0]['c_name'],$body);
			 $body = str_replace('[no. ]',$this->input->post('invoice_no')[$i],$body);
		 
	 		 $from_email='sworks.co.in'; // should change with smartworks team
             $from_name=ucfirst('Team Smartworks');
	  		
				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from($from_email,$from_name);
				$this->email->to($to); //$inputArray['email']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				$this->email->send();
		 }
    }
	    $this->session->set_flashdata('item',"Credit note request sent successfully.");
		$data['location']=$this->lm->getAlllocation();
	    @redirect(base_url().'index.php/creditnote/credit_note_request');
	         
		}else{
		$data['location']=$this->lm->getAlllocation();
	   	$this->load->view('creditnote/credit_note_request',$data);
	   }
	}
	public function credit_note_for_client(){
		authenticate(array('ut4'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$company_id=$data['userData']['company_id'];
		$data['invoice']=$this->creditnote_model->get_invoice_byclient($company_id);
		
        $this->load->view('vcredit_note_for_client',$data);
	}
	public function getcreditlisting($invoiceid){
        $data['credit_listing']=$this->creditnote_model->get_credit_listing_byinvoiceid($invoiceid);
        $this->load->view('vcredit_listing',$data);
	}
	public function download_creditnote($creditid){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$company_id=$data['userData']['company_id'];
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['creditinfo']=$this->creditnote_model->get_creditinfo_bycreditid($creditid);
		$html = $this->load->view('vprint_credit_note',$data,true);
		ini_set('memory_limit','32M');
		$mpdf = new mPDF('c','A4','','',0,0,5,5,5,5);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetTitle("Smartworks :: Credit note");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->WriteHTML($html,2);
		$attachment_name = 'Smartworks_credit_note_'.date('d_M_Y').'.pdf'; // pdf attachment file name
		$pdfname = $attachment_name;
	    $mpdf->Output($pdfname,'D'); // D for direct download and I for open in browser*/
	}
	public function get_companyby_location($city){
        $data['userlist']=$this->creditnote_model->get_companyby_location($city);	
		
		if(!empty($data['userlist']))
		{
			echo '<option value="0">Select Client</option>';
			 foreach($data['userlist'] as $value) {
                                if (isset($com_id) && $com_id == $value['company_id']."|++|".$value['userId']) {
                                    echo '<option value="'.$value['company_id'].'">'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
                                }else{
                                 echo '<option value="'.$value['company_id'].'">'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ('.$value['userEmail'].') '.ucfirst($value['company_name']).'</option>'; 
                                }
                            }		
		}else{
			
			echo '<option value="0">No Client Available</option>';
		}
	}
	public function get_invoice_bycompany($id){
		
	 $data['invoice']=$this->creditnote_model->get_invoice_byclient($id);	
	 
	
		if(!empty($data['invoice']))
		{
			echo '<option value="0">Select Invoice</option>';
			foreach($data['invoice'] as $key=>$value)
			{
				echo '<option value="'.$value['id'].'">'.$value['invoice_number'].' |'.$value['total_amount'].' |'.($value['total_amount']==$value['paid_amount']?'Not Due':'Due').'</option>'; 
			}			
		}else{
			
			echo '<option value="0">No Invoice Available</option>';
		}		
	}
	public function get_invoice($id){
		$r=$this->creditnote_model->getInvoicecreditnote($id);
		if(count($r)!='0'){	
		$data['invoice_items']=$this->creditnote_model->getInvoicecreditnote($id);
		$this->load->view('creditnote/ajax_creditnote_edit',$data);
	    }else{
	    $data['invoice_items']=$this->creditnote_model->getInvoiceItems($id);
	    $this->load->view('creditnote/ajax_creditnote',$data);
	    }	
	}
	
}