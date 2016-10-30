<?php
class private_office_agreement extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('office_agreement_data');
		$this->load->model('manager/floor_plan');
		$this->load->model('login/login_model');
		$this->load->model('users/user');
		$this->load->helper('common');
		$this->load->helper('form'); 
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
	}
	public function view($bookingid){
		$data['agreementdata']=$this->office_agreement_data->book_floor_plan_info($bookingid);
		$floor_plan_id=$data['agreementdata'][0]['floor_plan_id'];
		$data['business_center']=$this->office_agreement_data->businessdata_byfloorplan($floor_plan_id);
		$booking_details=json_decode($data['agreementdata'][0]['booking_detailes']);
		$no_of_people=0;
		$office_no="";
		$i=1;
		foreach($booking_details as $bkdetails){
			$expbkdetails=explode(":",$bkdetails);
			$seatinfo=$this->floor_plan->getseatinfo($expbkdetails[0]);
			$no_of_people=$no_of_people+$seatinfo[0]['no_of_people'];
			if($i<count($booking_details)){
            	$office_no.=$seatinfo[0]['Title'].",";
            }else{
            	$office_no.=$seatinfo[0]['Title'];
            }
            $i++;
		}
		$data['no_of_people']=$no_of_people;
		$data['office_no']=$office_no;
		$is_client=$data['agreementdata'][0]['Isclient'];
		$book_for=$data['agreementdata'][0]['book_for_client'];
		$data['client_data']=$this->office_agreement_data->client_info($book_for,$is_client);
		if($is_client==1){
			$companyid=$data['client_data'][0]['company_id'];
			$data['company']=$this->office_agreement_data->company_info($companyid);
		}else if($is_client==0){
			$data['regcompany']=$data['client_data'][0]['company'];
		}
		$this->load->view('vprivate_office_agreement',$data);
	}
	public function acceptagreement(){
		$book_floor_plan_id=$this->input->post('book_floor_plan_id');
		$book_floor_plan_info=$this->office_agreement_data->book_floor_plan_info($book_floor_plan_id);
		$book_floor_plan_data=array(
			'IsApproved'=>1
			);
		$book_for_client=$book_floor_plan_info[0]['book_for_client'];
		$is_client=$book_floor_plan_info[0]['Isclient'];
		$total_price=$book_floor_plan_info[0]['total_price'];
		$book_for=$book_floor_plan_info[0]['book_for'];
		$company=$book_floor_plan_info[0]['company'];
		$clientinfo=$this->office_agreement_data->book_for_client_info($book_for_client,$is_client);
		if($is_client==0){
			$data['info']=$this->user->getdetails($book_for_client);
			$register_user_deleted=array(
				'deleted'=>1,
				'company'=>$company
				);
			$company_info=$this->office_agreement_data->company_exist($company);
			if(count($company_info)>0){
                $company_id=$company_info[0]['id'];
			}
            else{
            	$company_id=substr(create_guid(),0,16);
                $company_data=array(
                	'id'=>$company_id,
                	'company_name'=>$company,
                	'company_account_no'=>rand(1000000,9999999),
                	'address'=>$data['info'][0]['street'],
				    'city_id'=>$data['info'][0]['cityId'],
		            'location_id'=>$data['info'][0]['locationId'],
		            'added_by'=>$book_for,
                	'date_added'=>date('Y-m-d h:i:s'),
                	'status'=>1
                	);
                $this->office_agreement_data->add_company($company_data);
            }
			$userid=$book_for_client;
			$new_client_user_id=substr(create_guid(),0,16);
			$new_client_data=array(
				'userId'=>$new_client_user_id,
				'userTypeId'=>'ut4',
				'FirstName'=>$clientinfo[0]['FirstName'],
				'LastName'=>$clientinfo[0]['LastName'],
				'location_id'=>$clientinfo[0]['locationId'],
				'city_id'=>$clientinfo[0]['cityId'],
				'gender'=>$clientinfo[0]['gender'],
				'phone'=>$clientinfo[0]['phone'],
				'street'=>$clientinfo[0]['street'],
				'add_city'=>$clientinfo[0]['city'],
				'pin'=>$clientinfo[0]['pincode'],
				'userProfilename'=>$clientinfo[0]['FirstName'],
				'userEmail'=>$clientinfo[0]['userEmail'],
				'userName'=>$clientinfo[0]['userEmail'],
				'password'=>$clientinfo[0]['password'],
				'status'=>1,
				'company_id'=>$company_id,
				'is_company'=>1,
				'can_view_bill'=>'1',
				'dateAdded'=>date('Y-m-d H:i:s'),
				'addedBy'=>$book_for
				);
            $invoice_data=array(
            	'id'=>substr(create_guid(),0,16),
            	'invoice_number'=>rand(10000000,99999999),
            	'invoice_date'=>date('Y-m-d'),
            	'customerId'=>$company_id,
            	'is_company'=>1,
            	'status'=>0
            	);
            $profileArray=array(
				'userProfileId'=>substr(create_guid(),0,16),	
			 	'userId'=> $new_client_user_id,	
			);
			$this->db->insert('user_profile',$profileArray);
            $book_floor_plan_data_for_client=array(
            	'book_for_client'=>$new_client_user_id,
				'Isclient'=>1
            	);
            $this->office_agreement_data->register_user_deleted($register_user_deleted,$userid,$new_client_data,$invoice_data,$book_floor_plan_data_for_client,$book_floor_plan_id);
		}
		else if($is_client==1){
			$company_id=$clientinfo[0]['company_id'];
		}
		$invoice_info=$this->office_agreement_data->invoice_info($company_id);
		$invoice_id=$invoice_info[0]['id'];
		$invoice_item_data=array(
			'id'=>substr(create_guid(),0,16),
			'invoice_id'=>$invoice_id,
			'description'=>'Private Office booking',
			'quantity'=>1,
			'unit_price'=>$total_price,
			'total'=>$total_price,
			'table_name'=>'book_floor_plan',
			'row_id'=>$book_floor_plan_id
			);
        $subtotal=$invoice_info[0]['sub_total']+$total_price;
        $invoice_data=array(
        	'sub_total'=>$subtotal
        	);
        $this->office_agreement_data->invoice_update_after_agreement($book_floor_plan_data,$book_floor_plan_id,$invoice_data,$invoice_id,$invoice_item_data);
        $manager_info=$this->office_agreement_data->manager_info($book_for);
        $manager_full_name=$manager_info[0]['FirstName']." ".$manager_info[0]['LastName'];
        $city_id=$manager_info[0]['city_id'];
        $region_info=$this->office_agreement_data->get_region($city_id);
        $region=$region_info[0]['region_id'];
        $ad_info=$this->office_agreement_data->ad_info($region);
        $email=$manager_info[0]['userEmail'];
        $ad_mail=$ad_info[0]['userEmail'];
        $email_template_id='8f260258-be74-6d';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $contname=$clientinfo[0]['FirstName']." ".$clientinfo[0]['LastName'];
		 $url=base_url().'private_office_agreement/view/'.$book_floor_plan_id;
		 $body = str_replace('[location manager full name]',$manager_full_name,$body);
		 $body = str_replace('[client fullname]',$contname,$body);
		 $body = str_replace('[url]',$url,$body);
		
		 $from_email='sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($email); //$inputArray['email']
		$this->email->cc($ad_mail);
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
        echo 'You have successfully accept your agreement';
	}
	public function rejectagreement(){
		$book_floor_plan_id=$this->input->post('book_floor_plan_id');
		$book_floor_plan_data=array(
			'IsApproved'=>2
			);
		$this->office_agreement_data->rejectagreement($book_floor_plan_data,$book_floor_plan_id);
		echo 'You have successfully reject your agreement';
	}
	public function vprivate_office_agreement_print($bookingid){
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['tick'] = $this->gallery_path_url.'tick-box.png';
		$data['agreementdata']=$this->office_agreement_data->book_floor_plan_info($bookingid);
		$floor_plan_id=$data['agreementdata'][0]['floor_plan_id'];
		$data['business_center']=$this->office_agreement_data->businessdata_byfloorplan($floor_plan_id);
		$booking_details=json_decode($data['agreementdata'][0]['booking_detailes']);
		$no_of_people=0;
		$office_no="";
		$i=1;
		foreach($booking_details as $bkdetails){
			$expbkdetails=explode(":",$bkdetails);
			$seatinfo=$this->floor_plan->getseatinfo($expbkdetails[0]);
			$no_of_people=$no_of_people+$seatinfo[0]['no_of_people'];
			if($i<count($booking_details)){
            	$office_no.=$seatinfo[0]['Title'].",";
            }else{
            	$office_no.=$seatinfo[0]['Title'];
            }
            $i++;
		}
		$data['no_of_people']=$no_of_people;
		$data['office_no']=$office_no;
		$is_client=$data['agreementdata'][0]['Isclient'];
		$book_for=$data['agreementdata'][0]['book_for_client'];
		$data['client_data']=$this->office_agreement_data->client_info($book_for,$is_client);
		if($is_client==1){
			$companyid=$data['client_data'][0]['company_id'];
			$data['company']=$this->office_agreement_data->company_info($companyid);
		}else if($is_client==0){
			$data['regcompany']=$data['client_data'][0]['company'];
		}
		$html = $this->load->view('vprivate_office_agreement_pdf',$data,true);
		ini_set('memory_limit','32M');
		$mpdf = new mPDF('c','A4','','',0,0,5,5,5,5);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetTitle("Smartworks :: Private office agreement");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->WriteHTML($html,2);
		$attachment_name = 'Smartworks_private_office_agreement_'.date('d_M_Y').'.pdf'; // pdf attachment file name
		$pdfname = $attachment_name;
	    $mpdf->Output($pdfname,'D'); // D for direct download and I for open in browser
	}
}
