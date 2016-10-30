<?php
class manager extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('users/login');
		$this->load->model('location/location_model', 'lm');
		$this->load->model('complaints/complaints_model');
		$this->load->model('client/client_model');
		$this->load->model('manager_event');
		$this->load->model('floor_plan');
		$this->load->model('booking_info');
		$this->load->helper('form'); 
		$this->load->model('service_request');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		
	//	$this->load->library('session');
	}
    public function index(){
		$this->session->sess_destroy();
		$this->load->view('vmanager_login');
	}
	public function dashBoard(){ // admin dashboard
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$manager_event=$this->manager_event->get_manager_event($userId);
		//print_r($manager_event);
		$i=0;
		$data['eventdata']=array();
		foreach($manager_event as $clnt_evnt){
			$expsttime=explode(":",$clnt_evnt['start_time']);
			$expendtm=explode(":",$clnt_evnt['end_time']);
			$data['eventdata'][$i]['id']=$clnt_evnt['event_id'];
			$data['eventdata'][$i]['start']=$expsttime[0];
			$data['eventdata'][$i]['end']=$expendtm[0];
			$data['eventdata'][$i]['title']=substr($clnt_evnt['message'],0,40);
			$data['eventdata'][$i]['reminder']=$clnt_evnt['is_reminded'];
			$data['eventdata'][$i]['body']=$clnt_evnt['message'];
			
			$data['eventyearmonthday'][$i]=$clnt_evnt['event_date'];
			
			$i++;
		}
		//echo json_encode($data['eventdata']);
		if($userId!="" && $userTypeId=="ut7"){
		$this->load->view("vmanager_dashboard", $data);
		
		}
	}
	
	public function service_request(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['legal_support']=$this->service_request->get_service($legal_data);
		$data['courier_support']=$this->service_request->get_courier_service($legal_data);
		$this->load->view('vlegal_support',$data);
		
		
	}
	public function get_request_by_id(){
		authenticate(array('ut7'));
		$appid=$this->input->post('appid');
		$tbname=$this->input->post('tbname');
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		if($tbname=="request_stuff_service"){
			$data['legal_support']=$this->service_request->get_request_of_id($legal_data,$appid);
		}
		else if($tbname=="request_courier_service"){
			$data['legal_support']=$this->service_request->get_courier_request_of_id($legal_data,$appid);
		}
		
		$data['tbname']=$this->input->post('tbname');
		$this->load->view('vrequest_approved',$data);
		
	}
	public function get_request_by_type(){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		if($this->input->post('apptype')<>"courier"){
			$data['legal_support']=$this->service_request->get_request_of_type($legal_data,$this->input->post('apptype'));
			$this->load->view('vservice_data',$data);
		}else{
			$data['courier_support']=$this->service_request->get_courier_service($legal_data);
			$this->load->view('vservice_data',$data);
		}
		
		
	}
	public function get_requestview_by_id(){
		authenticate(array('ut7'));
		$appid=$this->input->post('appid');
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['tbname']=$this->input->post('tbname');
		if($data['tbname']=="request_stuff_service"){
		$data['legal_support']=$this->service_request->get_request_of_id($legal_data,$appid);
	}
	else if($data['tbname']=="request_courier_service"){
			$data['legal_support']=$this->service_request->get_courier_request_of_id($legal_data,$appid);
		}
		$this->load->view('vrequest_view',$data);
	}
	
	
	public function approved_request(){
		authenticate(array('ut7'));
		$appdata=array(
		'IsApproved'=>'1',
		'Approved_on'=>date('Y-m-d h:i:s'),
		'approvedBy'=>$this->session->userdata("userId"),
		'price'=>$this->input->post('price'),
		'dateModified'=>date('Y-m-d h:i:s')
		);
		$tbname=$this->input->post('tbname');
		$appid=$this->input->post('appid');
		$invoice_data=$this->service_request->get_invoice_by_custid($this->input->post('custid'));
		$invoice_id=$invoice_data[0]['id'];
		$invoice_price=$invoice_data[0]['sub_total']+$this->input->post('price');
		$invoice_data=array(
		'sub_total'=>$invoice_price
		);
		$invoice_item_data=array(
		'id'=>substr(create_guid(),0,16),
		'invoice_id'=>$invoice_id,
		'description'=>$this->input->post('appdesc'),
		'quantity'=>'1',
		'unit_price'=>$this->input->post('price'),
		'total'=>$this->input->post('price'),
		'table_name'=>$this->input->post('tbname'),
		'row_id'=>$appid
		);
		$this->service_request->set_approved_request($appdata,$appid,$invoice_id,$invoice_data,$invoice_item_data,$tbname);
	}
	public function reject_request(){
		authenticate(array('ut7'));
		$appdata=array(
		  'IsApproved'=>'2'
		);
		$this->service_request->set_reject_request($appdata,$this->input->post('appid'),$this->input->post('tbname'));
	}
	public function submit_event(){
		$event_data=array(
			'event_id'=>substr(create_guid(),0,16),
			'message'=>$this->input->post('description'),
			'event_date'=>$this->input->post('event_date'),
			'start_time'=>$this->input->post('start_time'),
			'end_time'=>$this->input->post('end_time'),
			'createdby'=>$this->session->userdata("userId")
		);
		$this->manager_event->add_event_by_manager($event_data);
	
	}
	public function edit_event(){
		$event_data=array(
		'message'=>$this->input->post('message')
		);
		$event_id=$this->input->post('id');
		$this->manager_event->set_event($event_data,$event_id);
	}
	public function get_guid(){
		echo substr(create_guid(),0,16);
	}
	public function seat_allocation(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['floor_plan']=$this->floor_plan->get_floor_plan($data['business_data'][0]['business_id']);
		if(!empty($this->session->userdata('seatid'))){
			$expseat=explode(",",$this->session->userdata('seatid'));
		    if($expseat[1]<>$data['floor_plan'][0]['floor_id']){
				$this->session->unset_userdata('seatid');
			}
		}
		$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		//print_r($data['floor_plan_seat']);
		$this->load->view('vseat_allocation',$data);
	}
	public function get_floor_plan_by_floorid(){
		//print_r($_POST);
		$this->session->unset_userdata('seatid');
		
		$data['floor_plan']=$this->floor_plan->ger_floor_plan_byid($this->input->post('floor_id'));
		$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		$this->load->view('vsit_map',$data);
	}
	public function getfloorplanbybusiness($bussid){
		$data['floor_plan']=$this->floor_plan->get_floor_plan($bussid);
		if(!empty($data['floor_plan']))
		{
			echo '<option value="0">Select Floor Plan</option>';
			foreach($data['floor_plan'] as $key=>$value)
			{
				echo '<option value="'.$value['floor_id'].'">'.$value['description'].'</option>'; 
			}			
		}else{
			echo '<option value="0">No Floor Plan</option>';
			
		}
	}
	public function getseatallocationinsession(){
		$book_seat=$this->booking_info->get_booking_seat_info($this->input->post('seatid'),$this->input->post('start_date'),$this->input->post('end_date'));
		if(count($book_seat)==0){
		$flexit=0;
		if(!empty($this->session->userdata('seatid'))){
		
		$expseat=explode(",",$this->session->userdata('seatid'));
		$expseatid=explode("|",$expseat[0]);
		if (in_array($this->input->post('seatid'), $expseatid)){
			$flexit=1;
		}else{
		$seatid=$expseat[0]."|".$this->input->post('seatid');
	    }
		
		
	}else{
		$seatid=$this->input->post('seatid');
	}
	if($flexit=='0'){
		$seatid.=",".$this->input->post('floor_id');
		$this->session->set_userdata('seatid',$seatid);
		echo $this->session->userdata('seatid');
	}
	else{
		echo "Already you have selected this seat.";
	}
}
else{
	echo "Seat already booked.";
}
	}
	public function addseatallocation(){
	 
	 $expseatalloc=explode(",",trim($this->input->post('seat_allocation')));
	 $floor_id=$expseatalloc[1];
	 $booking_details=explode("|",$expseatalloc[0]);
	 $bookinfo=json_encode($booking_details);
	 $book_floor_plan_data=array(
	       'id'=>substr(create_guid(),0,16),
	      'floor_plan_id'=>$floor_id,
	      'booking_detailes'=>$bookinfo,
	      'purpose'=>$this->input->post('purpose'),
	      'book_for'=>$this->session->userdata("userId"),
	      'start_date'=>date('Y-m-d',strtotime($this->input->post('start_date'))),
	      'end_date'=>date('Y-m-d',strtotime($this->input->post('end_date')))
	 );
	  $this->booking_info->seat_alloc_of_manager($book_floor_plan_data);
	 $this->session->unset_userdata('seatid');
	 echo 'Seat Allocation have successfully Completed';
 }
 public function booking_seat(){
	 authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['booking_info']=$this->booking_info->get_seat_booking_info();
		$i=0;
		foreach($data['booking_info'] as $bkinfo){
			$bkinfodata=json_decode($bkinfo['booking_detailes']);
			for($k=0;$k<count($bkinfodata);$k++){
				$seatinfo=$this->booking_info->get_seat_title($bkinfodata[$k]);
				$seatidarr[$k]=$seatinfo[0]['Title'];
			}
			$data['booking_info'][$i]['title']=json_encode($seatidarr);
			$i++;
		}
		//print_r($data['booking_info']);
		$this->load->view('vbooking_seat',$data);
 }
 /*-----------Client Creation and seat book----------*/
 public function approved_seat_book($seatrequestid){
	 authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['seatrequestid']=$seatrequestid;
	    $this->load->view('vapproved_seat_book',$data);
 }
 public function approvedseatbook(){
	 $img="";
	 $userId = $this->session->userdata("userId");
	 $userData = $this->login->getUserProfile($userId);
	 $booking_info=$this->booking_info->get_book_info_byid($this->input->post('seatrequestid'));
	 $company_name=$this->input->post('compName');
	 $compinfo=$this->booking_info->chk_company($company_name);
	 if(count($compinfo)>0){
		 $compid=$compinfo[0]['id'];
	 }else{
		 $company_data=array(
		 'id'=>substr(create_guid(),0,16),
		 'company_name'=>$this->input->post('compName'),
		 'address'=>$this->input->post('compAdd'),
		 'added_by'=>$this->session->userdata("userId"),
		 'date_added'=>date('Y-m-d h:i:s')
		 );
		 //print_r($company_data);
		 $compid=$this->booking_info->add_company($company_data);
		 
	 }
	 
	 
	 for($i=0;$i<count($this->input->post('FirstName'));$i++)
	 {
		 $im=$i+1;
		 $usreml=$this->booking_info->check_email_for_client($this->input->post('userEmail')[$i]);
		 
		 if(count($usreml)>0){
			 $update_client_info=array(
			 'company_id'=>$compid
			 );
			 $this->booking_info->update_client_info($update_client_info,$usreml[0]['userId']);
			 
		 }else{
			 $uid=substr(create_guid(),0,16);
			 if($_FILES['ListeeTypeImage'.$im]['name']!=""){
				$value = $_FILES['ListeeTypeImage'.$im]['name'];
				$config = array(
				'file_name' => $uid,
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path' => $this->gallery_path.'/full',
				'max_size' => 2000
				);
				$this->load->library('upload', $config);
				$this->upload->initialize($config); 
			 
			 if (!$this->upload->do_upload('ListeeTypeImage'.$im)) {
        		$error=$this->upload->display_errors(); 
			    $this->session->set_flashdata('item_error',$error);
			    redirect(base_url().'index.php/manager/approved_seat_book/'.$this->input->post('seatrequestid'));
					
				}else{
					$flag=1;
					$image_data = $this->upload->data();
					$this->load->library('image_lib');
					$upName=$image_data['file_name'];
			
					$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => $this->gallery_path . '/thumbnails',
					'maintain_ration' => true,
					'width' => 150,
					'height' => 150
					);
			
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
					
					$config = array(
					'source_image' => $image_data['full_path'],
					'new_image' => $this->gallery_path . '/medium',
					'maintain_ration' => true,
					'width' => 520,
					'height' => 480
					);
					
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					$this->image_lib->clear();
				}
         $img=$upName;
	 }
	 $password=mt_rand();
		 $client_info=array(
		 'userId'=>$uid,
		 'userTypeId'=>'ut4',
		 'FirstName'=>$this->input->post('FirstName')[$i],
		 'LastName'=>$this->input->post('LastName')[$i],
		 'location_id'=>$userData['location_id'],
		 'city_id'=>$userData['city_id'],
		 'image'=>$img,
		 'userEmail'=>$this->input->post('userEmail')[$i],
		 'userName'=>$this->input->post('userEmail')[$i],
		 'password'=>md5($password),
		 'status'=>'1',
		 'company_id'=>substr(create_guid(),0,16),
		 'expiry_date'=>$booking_info[0]['end_date'],
		 'can_view_bill'=>$this->input->post('view_bill'.$im)
		 );
		 //print_r($client_info);
		 $this->booking_info->add_client($client_info);
		 
		 $name=$this->input->post('FirstName')[$i]." ".$this->input->post('LastName')[$i];
		 $l_name=$this->booking_info->get_location_email($userData['location_id']);
	     $c_name=$this->lm->getcity($userData['city_id']);
	     $address=$l_name [0]['name'].", ".$c_name[0]['name'];
	     $email=$this->input->post('userEmail')[$i];
		$subject='Account Created With Smartworks';
		$message  ="Dear ".$name; 
        $message .= "<BR>";
        $message .="We are very glad to inform you that your account has been created with smartworks for  ".$l_name [0]['name']."( ".$c_name[0]['name']." ).";
         $message .= "<BR>";
        $message .= "We are happy to serve you.For any queries and help please visit us ".base_url();
		
		$message .= "<BR>";
		$message .= "<BR>";
	    $message .= "<b>Login Credential:</b>";
	    $message .= "<BR>";
	    $message .= "Login Url: ".base_url()."index.php/login";
	    $message .= "<BR>";
        $message .= "User Email : ".$email;
        $message .= "<BR>";
      
        $message .= "Password: ".$password;
        $message .= "<BR>";
        
        $message .= "Note:Please change the system generated password after login.";
        $message .= "<BR>";
        
        $message .= "Thank you."; 
        $message .= "<BR>";
        $message .="Smartworks Business Center";
	   //echo $message;
	    
	  //  exit;
	    $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <admin@smartworks.com>' . "\r\n";
		//$headers .= 'Cc: myboss@example.com' . "\r\n";
	    //echo $email;
	    //echo $subject;
	    //echo $message;
	    //echo $headers;

		mail($email,$subject,$message,$headers);
	 
	 }
 }
 $book_floor_plan_data=array(
	 'IsApproved'=>'1',
	 'approvedBy'=>$userId,
	 'dateApproved'=>date('Y-m-d h:i:s'),
	 'price'=>$this->input->post('price')
	 );
	 //print_r($book_floor_plan_data);
	 $this->booking_info->approval_seat_book($book_floor_plan_data,$this->input->post('seatrequestid'));
	 @redirect(base_url().'index.php/manager/booking_seat');
 }
 public function get_chk_eml(){
	 $eml=$this->input->post('eml');
	 $usreml=$this->booking_info->check_email_for_client($eml);
	 if(count($usreml)>0){
		 echo '<strong><font color="red">Email Id already exist</font></strong>';
	 }
 }
	/*-------------------code for todo--------------------*/
	public function getTodo(){
	$userId = $this->session->userdata("userId");
	$todoData=$this->client_model->get_todo($userId);		
	echo json_encode($todoData);
}
public function setTodo(){
	$userId = $this->session->userdata("userId");	
	$message = $this->input->post('message');	
	$todoData=$this->client_model->get_todo($userId);
	if(!empty($todoData)){		
		$todoStatus=$this->client_model->upd_todo($userId,$message);
		echo json_encode($todoStatus);
	}else{
		$todoStatus=$this->client_model->set_todo($userId,$message);
		echo json_encode($todoStatus);
	}
}
 
}
?>
