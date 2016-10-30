<?php
class manager extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	var $data = array();
	
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
		$this->load->model('login/login_model');
		$this->load->model('istuser/istusermodel');
		$this->load->library('email');
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
	public function center_dashBoard(){
	authenticate(array('ut7'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);

   $this->load->view('center_dashBoard',$data);
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
		$data['todo']=$this->client_model->get_todo($userId);
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
		//$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
		$data['location']=$this->lm->getAlllocation();
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['floor_plan']=$this->floor_plan->get_floor_plan($data['business_data'][0]['business_id']);
		$data['floor_service']=$this->floor_plan->getservice_bybussid($data['business_data'][0]['business_id']);
		if(!empty($this->session->userdata('seatid')) && !empty($data['floor_plan'])){
			$expseat=explode(",",$this->session->userdata('seatid'));
		    if($expseat[1]<>$data['floor_plan'][0]['floor_id']){
				$this->session->unset_userdata('seatid');
			}
		}
		if(!empty($data['floor_plan'])){
			$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		}else{
			$data['floor_plan_seat']=array();
		}
		$this->load->view('vseat_allocation',$data);
	}
	public function dummy_seat_allocation(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['floor_plan']=$this->floor_plan->get_floor_plan($data['business_data'][0]['business_id']);
		if(!empty($this->session->userdata('seatid')) && !empty($data['floor_plan'])){
			$expseat=explode(",",$this->session->userdata('seatid'));
		    if($expseat[1]<>$data['floor_plan'][0]['floor_id']){
				$this->session->unset_userdata('seatid');
			}
		}
		if(!empty($data['floor_plan'])){
			$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		}else{
			$data['floor_plan_seat']=array();
		}
		$this->load->view('dummy_seat_allocation',$data);
	}
	public function get_floor_plan_by_floorid(){
		//print_r($_POST);
		$this->session->unset_userdata('seatid');
		
		$data['floor_plan']=$this->floor_plan->ger_floor_plan_byid($this->input->post('floor_id'));
		$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		$this->load->view('vsit_map',$data);
	}
	public function get_floor_plan_by_floorid_and_date(){
		//print_r($_POST);
		$data['floor_plan']=$this->floor_plan->ger_floor_plan_byid($this->input->post('floor_id'));
		$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		$start_date=$this->input->post('startdate');
		$end_date=$this->input->post('enddate');
		$booking_seat=$this->booking_info->get_booking_seat_info_bydate($start_date,$end_date);
		$book_seat_details=array();
		foreach($booking_seat as $book_seat){
			$book_seat_details[]=$book_seat['booking_detailes'];
		}
		$data['marge']=$this->input->post('marge');
		$data['book_seat_info']=$book_seat_details;
		$this->load->view('vsit_maphighlight',$data);
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
		$seatinfo=$this->floor_plan->getseatinfo($this->input->post('seatid'));
		$seatinfodata=$this->input->post('seatid');
		if($seatinfo[0]['left']!=''){
			$seatinfodata.=":".$seatinfo[0]['left'];
		}
		if($seatinfo[0]['right']!=''){
			$seatinfodata.=":".$seatinfo[0]['right'];
		}
		if($seatinfo[0]['top']!=''){
			$seatinfodata.=":".$seatinfo[0]['top'];
		}
		if($seatinfo[0]['bottom']!=''){
			$seatinfodata.=":".$seatinfo[0]['bottom'];
		}
		if(count($book_seat)==0){
		$flexit=0;
		if(!empty($this->session->userdata('seatid'))){
			$expseat=explode(",",$this->session->userdata('seatid'));
			$expseatid=explode("|",$expseat[0]);
			foreach($expseatid as $stinfo){
					$expstinfo=explode(":",$stinfo);
					if(count($expstinfo)>1){
						if($expstinfo[0]==$this->input->post('seatid')){
							$flexit=1;
						}
					}else{
						if($stinfo==$this->input->post('seatid')){
							$flexit=1;
						}
					}
				}
				$seatid=$expseat[0]."|".$seatinfodata;
		}else{
			$seatid=$seatinfodata;
		}
		if($flexit=='0'){
			$seatid.=",".$this->input->post('floor_id');
			$this->session->set_userdata('seatid',$seatid);
			echo $this->session->userdata('seatid');
		}else{
			echo "Already you have selected this seat/room.";
		}
		}else{
			echo "Seat/Room already booked.";
		}
	}
	public function deselectseatallocation(){
		$seatid="|".$this->input->post('seatid');
		$expseat=explode(",",$this->session->userdata('seatid'));
		$expseatid=explode("|",$expseat[0]);
		$ex=0;
		if(count($expseatid)>1){
			foreach($expseatid as $stinfo){
				$expstinfo=explode(":",$stinfo);
				if(count($expstinfo)>1){
					if($expstinfo[0]==$this->input->post('seatid')){
						if($ex==0){
							if(count($expseatid)>1){
							   $stinfoid=$stinfo."|";
							}else{
								$stinfoid=$stinfo;
							}
						}else if($ex>0){
							$stinfoid="|".$stinfo;
						}
						
						$fnseatid=str_replace($stinfoid,"",$this->session->userdata('seatid'));
					}
				}else{
					$fnseatid=str_replace($seatid,"",$this->session->userdata('seatid'));
				}
				$ex++;
			}
		
		$this->session->set_userdata('seatid',$fnseatid);
	}
	else{
		$this->session->unset_userdata('seatid');
	}
		
		echo $this->session->userdata('seatid');
		
	}
	public function addseatallocation(){
	 
	 $expseatalloc=explode(",",trim($this->input->post('seat_allocation')));
	 $floor_id=$expseatalloc[1];
	 $booking_details=explode("|",$expseatalloc[0]);
	 $bookinfo=json_encode($booking_details);
	 $bookselfprice=$this->input->post('bookselfprice');
	 $storageprice=$this->input->post('storageprice');
	 $phoneprice=$this->input->post('phoneprice');
	 $internetprice=$this->input->post('internetprice');
	 $wifiprice=$this->input->post('wifiprice');
	 $roomprice=$this->input->post('room_price');
	 $marge=$this->input->post('marge');
	 $price_details=array('bookself'=>$bookselfprice,'internalstorage'=>$storageprice,'phone'=>$phoneprice,'wifi'=>$wifiprice,'internet'=>$internetprice,'roomprice'=>$roomprice);
	
	 $id=substr(create_guid(),0,16);
	 	
	 $book_floor_plan_data=array(
	       'id'=>$id,
	      'floor_plan_id'=>$floor_id,
	      'booking_detailes'=>$bookinfo,
	      'purpose'=>$this->input->post('purpose'),
	      'book_for'=>$this->session->userdata("userId"),
	      'IsApproved'=>0,
	      'start_date'=>date('Y-m-d',strtotime($this->input->post('start_date'))),
	      'end_date'=>date('Y-m-d',strtotime($this->input->post('end_date'))),
	      'total_price'=>$this->input->post('totalprice'),
	      'price_details'=>json_encode($price_details),
	      'Ismarged'=>$marge
	 );
	 $this->session->set_userdata('book_floor_id',$book_floor_plan_data['id']);
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
				$expseatinfo=explode(":",$bkinfodata[$k]);
				$seatinfo=$this->booking_info->get_seat_title($expseatinfo[0]);
				$seatidarr[$k]=$seatinfo[0]['Title'];
			}
			$data['booking_info'][$i]['title']=json_encode($seatidarr);
			$i++;
		}
		//print_r($data['booking_info']);
		$this->load->view('vbooking_seat',$data);
 }
 public function rejectseatbook(){
	 $seatid=$this->input->post('txtreject');
	 $reject_data=array(
	 'IsApproved'=>'2'
	 );
	 $this->booking_info->rejectseatrequest($reject_data,$seatid);
	 @redirect(base_url().'index.php/manager/booking_seat');
 }
 /*-----------Client Creation and seat book----------*/
 public function approved_seat_book($seatrequestid){
	 authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['seatrequestid']=$seatrequestid;
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
		$data['cities']=$this->lm->getcities();
	    $this->load->view('vapproved_seat_book',$data);
 }
 public function approvedseatbook(){
	 $img="";
	 $userId = $this->session->userdata("userId");
	 $userData = $this->login->getUserProfile($userId);
	 $booking_info=$this->booking_info->get_book_info_byid($this->input->post('seatrequestid'));
	 $company_name=trim($this->input->post('compName'));
	 $compinfo=$this->booking_info->chk_company($company_name);
	
	 if(count($compinfo)>0){
		 $compid=$compinfo[0]['id'];
	 }else{
		 $company_data=array(
		 'id'=>substr(create_guid(),0,16),
		 'company_name'=>$this->input->post('compName'),
		 'company_account_no'=>rand(1000000,9999999),
		  'city_id'=>$this->input->post('city'),
		 'location_id'=>$this->input->post('location'),
		 'address'=>$this->input->post('compAdd'),
		 'added_by'=>$this->session->userdata("userId"),
		 'date_added'=>date('Y-m-d h:i:s')
		 );
		 //print_r($company_data);
		 //exit;
		 $this->booking_info->add_company($company_data);
		 $compinfo=$this->booking_info->chk_company($company_name);
		 $compid=$compinfo[0]['id'];
		 
		 
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
		 'company_id'=>$compid,
		 'addedBy'=> $this->session->userdata("userId"),
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
 $invoice_data=$this->service_request->get_invoice_by_custid($compid);
 if(count($invoice_data)>0){
		$invoice_id=$invoice_data[0]['id'];
		$invoice_price=$invoice_data[0]['sub_total']+$this->input->post('price');
		
	}else{
		$invoice_insert_data=array(
		'id'=>substr(create_guid(),0,16),
		'invoice_number'=>rand(10000000,99999999),
		'invoice_date'=>date('Y-m-d'),
		'customerId'=>$compid,
		'sub_total'=>$this->input->post('price'),
		);
		$this->booking_info->add_invoice($invoice_insert_data);
		$invoice_data=$this->service_request->get_invoice_by_custid($compid);
		$invoice_id=$invoice_data[0]['id'];
		$invoice_price=$this->input->post('price');
		
	}
		$invoice_data=array(
		'sub_total'=>$invoice_price
		);
		$invoice_item_data=array(
		'id'=>substr(create_guid(),0,16),
		'invoice_id'=>$invoice_id,
		'description'=>'',
		'quantity'=>'1',
		'unit_price'=>$this->input->post('price'),
		'total'=>$this->input->post('price'),
		'table_name'=>'book_floor_plan',
		'row_id'=>$this->input->post('seatrequestid')
		);
 $book_floor_plan_data=array(
	 'IsApproved'=>'1',
	 'approvedBy'=>$userId,
	 'dateApproved'=>date('Y-m-d h:i:s'),
	 'price'=>$this->input->post('price')
	 );
	 $this->booking_info->approval_seat_book($book_floor_plan_data,$this->input->post('seatrequestid'),$invoice_id,$invoice_data,$invoice_item_data);
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
	$data = array();
	$userId = $this->session->userdata("userId");
	$data['todo']=$this->client_model->get_todo($userId);
	$this->load->view("ajax_todo_view",$data);
}
public function setTodo(){
	$userId = $this->session->userdata("userId");
	$todoid = $this->input->post('id');	
	$message = $this->input->post('message');
	if($todoid != ''){
		$todoStatus=$this->client_model->upd_todo($todoid,$message);
		echo json_encode($todoStatus);
	}else{
		$todoStatus=$this->client_model->set_todo($userId,$message);
		echo json_encode($todoStatus);
	}
}
public function booking_details(){
	authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['booking_data']=$this->booking_info->get_booking_details_for_conference_room($legal_data);
		//print_r($data['booking_data']);
		$this->load->view('vbooking_details',$data);
}
 public function get_booking_details($tbname){
	 authenticate(array('ut7'));
	 $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
	 $data['booking_data']=$this->booking_info->get_booking_info($tbname,$legal_data);
	if($tbname=="locker_room"){
		 $this->load->view('vbooking_locker_data',$data);
	 }else{
	 $this->load->view('vbook_data',$data);
 }
 
	 //print_r($data['booking_data']);
 }
 public function get_booking_details_for_game($tbname){
	 authenticate(array('ut7'));
	 $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
	 $data['booking_data']=$this->booking_info->get_booking_info_forgameroom($tbname,$legal_data);
	$this->load->view('vbooking_game_data',$data);
 }
 public function get_client_details(){
	 authenticate(array('ut7'));
	 $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		print_r($legal_data);
		$data['client']=$this->manager_event->client_details($legal_data);
		print_r($data['client']);
 }
 public function get_bookingview_by_id(){
	 authenticate(array('ut7'));
	 //print_r($_POST);
		$appid=$this->input->post('appid');
		$tbname=$this->input->post('tbname');
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['tbname']=$tbname;		
		//$this->load->view('vrequest_view',$data);
		$data['booking_info']=$this->booking_info->get_booking_view_byid($legal_data,$appid,$tbname);
		//print_r($data['booking_info']);
		$this->load->view('vbooking_viewdata',$data);
 }
 public function get_booking_by_id(){
	 authenticate(array('ut7'));
		$appid=$this->input->post('appid');
		$tbname=$this->input->post('tbname');
		$data['tbname']=$tbname;
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['booking_info']=$this->booking_info->get_booking_view_byid($legal_data,$appid,$tbname);
		$this->load->view('vbooking_approved',$data);
		
 }
 public function approved_booking(){
	 authenticate(array('ut7'));
		$appdata=array(
		'is_approved'=>'1',
		'approvedBy'=>$this->session->userdata("userId"),
		'dateApproved'=>date('Y-m-d h:i:s'),
		'price'=>$this->input->post('price'),
		'dateModified'=>date('Y-m-d h:i:s')
		);
		$tbname=$this->input->post('tbname');
		if($tbname=="conference_room"){
			$tb1="book_conference_room";
		}
		else if($tbname=="meeting_room"){
			$tb1="book_meeting_room";
		}
		else if($tbname=="locker_room"){
			$tb1="book_locker_room";
		}else if($tbname=="game_room"){
			$tb1="book_play_room";
		}
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
		'table_name'=>$tb1,
		'row_id'=>$appid
		);
		$this->booking_info->set_approved_booking($appdata,$appid,$invoice_id,$invoice_data,$invoice_item_data,$tbname);
 }
 public function reject_booking(){
	 authenticate(array('ut7'));
		$appdata=array(
		  'is_approved'=>'2'
		);
		$this->booking_info->set_reject_booking($appdata,$this->input->post('appid'),$this->input->post('tbname'));
 }
 
public function client_list(){
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$location_id=$data['userData']['location_id'];
		
		$data['query']=$this->service_request->get_client_List($location_id);
		//print_r($data['query']);
	    $this->load->view('manager_client_list',$data);
}
public function voffice(){
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
	    $this->load->view('voffice',$data);
}
/************Enquiry and Need Analysis Part Start Here 01-July-2016*************/
public function enquiry(){
	authenticate(array('ut7'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);
	$data['message']  = '';
	if(isset($_POST) && !empty($_POST)){
		if(!isset($_POST['chkBookTour'])){
			$chkBookTour = 0;
		}else{
			$chkBookTour = $_POST['chkBookTour'];
		}
		$temp = explode('/', $_POST['location']);
		if(isset($_POST['uid']) && $_POST['uid'] != ''){
			$data_en = array();
			$uid = $_POST['uid'];
			$data_en['FirstName'] 			= $_POST['txtFname'];
			$data_en['LastName'] 			= $_POST['txtLname'];
			$data_en['userEmail'] 			= $_POST['txtEmail'];
			$data_en['gender'] 				= $_POST['gender'];
			$data_en['phone'] 				= $_POST['txtPhone']; 
			$data_en['locationId'] 			= $temp[0];
			$data_en['cityId'] 				= $temp[1];
			$data_en['modifiedBy']			= $userId;
			$data_en['street'] 				= $_POST['txtStreet'];
			$data_en['city'] 				= $_POST['city'];
			$data_en['pincode'] 			= $_POST['txtZip'];
			$data_en['company'] 			= $_POST['txtCompany'];
			$data_en['source'] 				= $_POST['source'];
			$data_en['source_detail'] 		= $_POST['sourceDetail'];
			$data_en['product'] 			= $_POST['sltProduct'];
			$data_en['ws_or_people'] 		= $_POST['ws_or_people'];
			$data_en['start_date'] 			= $_POST['dtStart'];
			$data_en['office'] 				= $_POST['office'];
			$data_en['month'] 				= $_POST['months'];
			$data_en['chk_book_tour'] 		= $chkBookTour;
			$data_en['manager'] 			= $_POST['manager'];
			$data_en['details'] 			= $_POST['txtrEnDetails'];
			$data_en['know_info'] 			= '';
			$updateStatus = $this->istusermodel->updEnquiry($uid,$data_en);
			if($updateStatus == 1){
				if($chkBookTour == 1 && $_POST['manager'] != ''){
					$email_template_id="39a99e23-0f69-a2"; // BOOK A TOUR MANAGEMENT TEMPLATE ID
					$email_template_location_manager = $this->login_model->getEmailTemplate($email_template_id);
					$mail_to_and_cc = $this->lm->mail_to_user_details($temp[1]);
					
					$manager = $this->lm->getLocationManagerById($_POST['manager']);
					$loc_man_email = $manager['userEmail'];
					$loc_man_fullname = ucfirst($manager['FirstName']).' '.ucfirst($manager['LastName']);
					$ad = $mail_to_and_cc['area_director'][0]['userEmail'];
					$body = $email_template_location_manager['description'];
					$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
					$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
					$body = str_replace('[Business Center Name]','',$body);
			  		/*Mail function start here*/
			  		$from_email = $_POST['txtEmail']; 
			  		$from_name = ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']);
		         	$to_email = $loc_man_email.', sohom@simayaa.com';// should change with location manager email address
			   		$cc = $ad;// should be cc to AD & IST team.
					$this->email->set_newline("\r\n");
					$this->email->from($from_email, $from_name); 
			        $this->email->to($to_email);
			        $this->email->cc($cc);
					$this->email->subject($email_template_location_manager['subject']);
					$this->email->message($body);
			        //Send mail for Location Manager (CC AD and IST)
			        if($this->email->send()){
				        $email_template_id="ecf6561a-7748-db"; // BOOK A TOUR CLIENT TEMPLATE ID
						$email_template_client = $this->login_model->getEmailTemplate($email_template_id);
						$body = $email_template_client['description'];
						$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
						$body = str_replace('[Business Center Name]','',$body);
				  		$from_email = 'sworks_team@sworks.co.in'; // should change with smartworks team
				  		$from_name = ucfirst('Team Smartworks');
			         	$to_email = $_POST['txtEmail']; 
						$this->email->set_newline("\r\n");
						$this->email->from($from_email, $from_name); 
				        $this->email->to($to_email);
				        $this->email->cc('');
						$this->email->subject($email_template_client['subject']);
						$this->email->message($body);
			        	//Send mail for Client
				        if($this->email->send()){
				        	//$this->session->set_flashdata("email_sent","Error in sending Email."); 
			        		$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
									<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
									<strong>Your Enquiry has been completed.</strong>.
								</div>';
				        }else{
				         	//$this->session->set_flashdata("email_sent","Error in sending Email."); 
				        	$data['message'] = '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
									<strong>We are sorry! Something went wrong!!</strong>.
								</div>';
			        	}
			        }else{
			        	$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
										<strong>Your Enquiry has been completed.</strong>.
									</div>';
			        }
	        	}else{
		        	$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
									<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
									<strong>Your Enquiry has been completed.</strong>.
								</div>';	
	        	}
			}else{
				$data['message'] = '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<strong>Something went wrong!!</strong>.
						</div>';
			}
		}else{
			$data_en = array();
			$data_en['userId'] 				= substr(create_guid(),0,16);
			$data_en['enquiry_type'] 		= 2;
			$data_en['FirstName'] 			= $_POST['txtFname'];
			$data_en['LastName'] 			= $_POST['txtLname'];
			$data_en['userEmail'] 			= $_POST['txtEmail'];
			$data_en['password'] 			= '';
			$data_en['gender'] 				= $_POST['gender'];
			$data_en['phone'] 				= $_POST['txtPhone']; 
			$data_en['locationId'] 			= $temp[0];
			$data_en['cityId'] 				= $temp[1];
			$data_en['addedBy'] 			= $userId;
			$data_en['modifiedBy']			= '';
			$data_en['dateAdded'] 			= date('Y-m-d h:i:s');
			$data_en['street'] 				= $_POST['txtStreet'];
			$data_en['city'] 				= $_POST['city'];
			$data_en['pincode'] 			= $_POST['txtZip'];
			$data_en['company'] 			= $_POST['txtCompany'];
			$data_en['source'] 				= $_POST['source'];
			$data_en['source_detail'] 		= $_POST['sourceDetail'];
			$data_en['product'] 			= $_POST['sltProduct'];
			$data_en['ws_or_people'] 		= $_POST['ws_or_people'];
			$data_en['start_date'] 			= $_POST['dtStart'];
			$data_en['office'] 				= $_POST['office'];
			$data_en['month'] 				= $_POST['months'];
			$data_en['chk_book_tour'] 		= $chkBookTour;
			$data_en['manager'] 			= $_POST['manager'];
			$data_en['details'] 			= $_POST['txtrEnDetails'];
			$data_en['know_info'] 			= '';
			$addStatus = $this->istusermodel->addEnquiry($data_en);
			if($addStatus == 1){
				if($chkBookTour == 1 && $_POST['manager'] != ''){
					$email_template_id="39a99e23-0f69-a2"; // BOOK A TOUR MANAGEMENT TEMPLATE ID
					$email_template_location_manager = $this->login_model->getEmailTemplate($email_template_id);
					$mail_to_and_cc = $this->lm->mail_to_user_details($temp[1]);
					$manager = $this->lm->getLocationManagerById($_POST['manager']);
					$loc_man_email = $manager['userEmail'];
					$loc_man_fullname = ucfirst($manager['FirstName']).' '.ucfirst($manager['LastName']);
					$ad = $mail_to_and_cc['area_director'][0]['userEmail'];
					$body = $email_template_location_manager['description'];
					$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
					$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
					$body = str_replace('[Business Center Name]','',$body);
			  		/*Mail function start here*/
			  		$from_email = $_POST['txtEmail']; 
			  		$from_name = ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']);
		         	$to_email = $loc_man_email.', sohom@simayaa.com';// should change with location manager email address
			   		$cc = $ad;// should be cc to AD & IST team.
					$this->email->set_newline("\r\n");
					$this->email->from($from_email, $from_name); 
			        $this->email->to($to_email);
			        $this->email->cc($cc);
					$this->email->subject($email_template_location_manager['subject']);
					$this->email->message($body);
			        //Send mail for Location Manager (CC AD and IST)
			        if($this->email->send()){
				        $email_template_id="ecf6561a-7748-db"; // BOOK A TOUR CLIENT TEMPLATE ID
						$email_template_client = $this->login_model->getEmailTemplate($email_template_id);
						$body = $email_template_client['description'];
						$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
						$body = str_replace('[Business Center Name]','',$body);
				  		$from_email = 'sworks_team@sworks.co.in'; // should change with smartworks team
				  		$from_name = ucfirst('Team Smartworks');
			         	$to_email = $_POST['txtEmail']; 
						$this->email->set_newline("\r\n");
						$this->email->from($from_email, $from_name); 
				        $this->email->to($to_email);
				        $this->email->cc('');
						$this->email->subject($email_template_client['subject']);
						$this->email->message($body);
			        	//Send mail for Client
				        if($this->email->send()){
				        	//$this->session->set_flashdata("email_sent","Error in sending Email."); 
			        		$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
									<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
									<strong>Your Enquiry has been completed.</strong>.
								</div>';
				        }else{
				         	//$this->session->set_flashdata("email_sent","Error in sending Email."); 
				        	$data['message'] = '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
									<strong>We are sorry! Something went wrong!!</strong>.
								</div>';
			        	}
			        }else{
			        	$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
										<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
										<strong>Your Enquiry has been completed.</strong>.
									</div>';
			        }
	        	}else{
		        	$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
									<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
									<strong>Your Enquiry has been completed.</strong>.
								</div>';	
	        	}
			}else{
				$data['message'] = '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<strong>Something went wrong!!</strong>.
						</div>';
			}
		}
	}
	$reg_info=$this->istusermodel->user_info();
	$reg_email=array();
	foreach($reg_info as $reg_dt){
		$reg_email[]=$reg_dt['userEmail'];
	}
	$data['location']	=	$this->lm->getAlllocation(); 
	$data['cities']		=	$this->lm->getcities();
	$data['managers'] 	=	$this->lm->getManagers($data['userData']['location_id'],$data['userData']['city_id']);
	$data['reg_email']	=	$reg_email;
	$this->load->view('venquiry',$data);
}
public function getManagerByCityLocation(){
	$val		=	$this->input->post('val');
	$temp 		= 	explode('/', $val);
	$managers 	=	$this->lm->getManagers($temp[0],$temp[1]);
	echo '<option value="">Select Manager</option>';
	foreach($managers as $value) {
   	echo '<option value="'.$value['userId'].'">'.($value['gender'] == 'M' ? 'Mr. ' : '').ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).'</option>';
    }
}
public function getSourceDetail(){
		$val		=	$this->input->post('val');
		echo '<option value="">Source Detail</option>';
		switch ($val) {
		    case "web":
		       echo '<option value="website">Website</option>';
		       echo '<option value="search-engine">Search Engine</option>';
		       echo '<option value="online-ads">Online Ads</option>';
		       break;
		    case "brokers":
		        echo '<option value="brokers">Brokers</option>';
		        break;
		    case "internet-brokers":
		        echo '<option value="internet-brokers">Internet Brokers</option>';
		        break;
		    case "ist":
		        echo '<option value="ist">IST</option>';
		        break;
		    case "referral":
		        echo '<option value="referral">Referral</option>';
		        break;
		    default:
		        echo "";
		}
}
public function need_analysis(){
	authenticate(array('ut7'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);
	$reg_info=$this->istusermodel->user_info();
	$data['message']  = '';
	if(isset($_POST) && !empty($_POST)){
		if(isset($_POST['registered_user_id']) && $_POST['registered_user_id'] != ''){
			$data_en = array();
			$data_en['need_analysis_id'] 				= substr(create_guid(),0,16);
			$data_en['registered_user_id'] 				= $_POST['registered_user_id'];
			$data_en['prospect_name'] 					= $_POST['prosName'];
			$data_en['company_name'] 					= $_POST['comName'];
			$data_en['city_or_area_interest'] 			= $_POST['city'];
			$data_en['no_of_people'] 					= $_POST['txtNop'];
			$data_en['start_data_or_why'] 				= $_POST['stData'];
			$data_en['source']							= $_POST['source'];
			$data_en['current_location'] 				= $_POST['location']; 
			$data_en['term_or_why'] 					= $_POST['term'];
			$data_en['orther_options_by_prospect'] 		= $_POST['otherOptions'];
			$data_en['general_notes'] 					= $_POST['generalNotes'];
			$data_en['mobile']							= $_POST['txtPhone'];
			$data_en['email'] 							= $_POST['txtEmail'];
			$data_en['website'] 						= $_POST['txtWeb'];
			$data_en['address'] 						= $_POST['txtAddress'];
			$data_en['information_from_broker'] 		= $_POST['infoFrom'];
			$data_en['information_from_interner'] 		= $_POST['infoFromInternet'];
			$data_en['the_business'] 					= $_POST['theBusiness'];
			$data_en['problem_1'] 						= $_POST['theProblem1'];
			$data_en['problem_2'] 						= $_POST['theProblem2'];
			$data_en['problem_3'] 						= $_POST['theProblem3'];
			$data_en['problem_4'] 						= $_POST['theProblem4'];
			$data_en['the_location'] 					= $_POST['thelocation'];
			$data_en['the_team_1'] 						= $_POST['theTeam1'];
			$data_en['the_team_2'] 						= $_POST['theTeam2'];
			$data_en['the_team_3'] 						= $_POST['theTeam3'];
			$data_en['the_team_4'] 						= $_POST['theTeam4'];
			$data_en['the_team_5'] 						= $_POST['theTeam5'];
			$data_en['decision_making_1'] 				= $_POST['decisionMaking1'];
			$data_en['decision_making_2'] 				= $_POST['decisionMaking2'];
			$data_en['decision_making_3'] 				= $_POST['decisionMaking3'];
			$data_en['decision_making_4'] 				= $_POST['decisionMaking4'];
			$data_en['other_opportunities'] 			= $_POST['otherOpptn'];
			$data_en['addedBy'] 						= $userId;
			$data_en['modifiedBy'] 						= '';
			$data_en['dateAdded']						= date('Y-m-d h:i:s');
			$addStatus = $this->istusermodel->addNeedAnalysis($data_en);
			if($addStatus == 1){
				$data['message'] = '<div class="alert alert-success fade in" style="margin-top:18px;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<strong>Your need Analysis process has been completed.</strong>.
						</div>';
			}else{
				$data['message'] = '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<strong>You have already done need analysis!!</strong>.
						</div>';
			}
		}else{
			$data['message'] = '<div class="alert alert-danger fade in" style="margin-top:18px;"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
							<strong>Please complete the enquiry process!!</strong>.
						</div>';
		}
	}
	$reg_email=array();
	foreach($reg_info as $reg_dt){
		$reg_email[]=$reg_dt['userEmail'];
	}
	$data['location']	=	$this->lm->getAlllocation(); 
	$data['cities']		=	$this->lm->getcities();
	$data['reg_email']=$reg_email;
	$this->load->view('need_analysis',$data);
}
public function user_display_info_enq(){
	$eml=$this->input->post('eml');
	$temp = explode(' ', $eml);
	$eml_new = str_replace("[", "", str_replace("]", "", trim($temp[2])));
	$uinfo=$this->istusermodel->display_user_data($eml_new);
	if(count($uinfo)>0){
		echo json_encode($uinfo);
	}
}
public function autocompletef(){
	$eml=$this->input->post('eml');
	$uemlautocomplete=$this->istusermodel->eml_autocompletef($eml);
	if(count($uemlautocomplete) > 0){
		foreach ($uemlautocomplete as $row):
        echo "<li onclick='litxt($(this).text())'>".ucfirst($row->FirstName).' '.ucfirst($row->LastName).' ['.$row->userEmail.']'."</li>";
    	endforeach;
	}else{
		echo count($uemlautocomplete);
	}	
}
public function autocompletel(){
	$eml=$this->input->post('eml');
	$uemlautocomplete=$this->istusermodel->eml_autocompletel($eml);
	if(count($uemlautocomplete) > 0){
		foreach ($uemlautocomplete as $row):
        echo "<li onclick='litxt($(this).text())'>".ucfirst($row->FirstName).' '.ucfirst($row->LastName).' ['.$row->userEmail.']'."</li>";
    	endforeach;
	}else{
		echo count($uemlautocomplete);
	}
}
/************Enquiry and Need Analysis Part End Here 01-July-2016*************/
 public function edit_client($id){
    authenticate(array('ut7'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['userinfo'] = $this->login->getUserProfile($id);
	$data['cities']=$this->lm->getcities();
	$data['location']=$this->lm->getlocationbycity($data['userinfo']['cityId']);
	//print_r($data['location']);
	//exit;
   
     if (isset($_POST) && (!empty($_POST)))
	 {
 		//print_r($_POST);
 		//exit;
 		
					$arr = array(
			   
				
				
				'FirstName' => $_POST['first_name'],
				'LastName'=>$_POST['last_name'],
				'location_id'=>$_POST['location'],
				 'city_id'=>$_POST['city'],
				'userProfilename'=>$_POST['userProfilename'],
				
				 'phone'=>$_POST['phone'],
				 //'image'=>$image,
				 'address'=>$_POST['address'],
				 'userEmail'=>$_POST['staff_email'],
				 'userName'=>$_POST['staff_email'],
				
				
				'dateModified'=>date('Y-m-d h:i:s')
				
				
				);
						if($_FILES['ListeeTypeImage']['name']!="")
					{	
						$imageid=$this->input->post('image_id');	
						$image=$this->doUpload('ListeeTypeImage',$imageid);	
						$data1=array(						
										'image'=>$image,									
									);
						$result1 = update_tbl('user','userId',$id,$data1);
		 
					}																													
				$result = update_tbl('user','userId',$id,$arr);
				//$imageid=$this->input->post('imageid');
				////echo $imageid;
				////exit;
				//$image=$this->doUpload('ListeeTypeImage',$imageid);
				//$data1=array(		
			//'imageName'=>$image,			
			//'primaryImage'=>'1',
			//'status'=>'0'
			//);
			//$result1 = update_tbl('service_images','id',$imageid,$data1);
			if($result == 1)
			{
				$this->session->set_flashdata('edit',"You have successfully upadded.");
			    redirect(base_url().'index.php/manager/client_list');
			}
			else
			{
				$this->session->set_flashdata('edit',"Your updation is not completed.");
			    redirect(base_url().'index.php/manager/edit_client/'.$id);
			}       
      }    
   //print_r($data['classified']);
   //exit;   
    $this->load->view("edit_client",$data);
}
public function doUpload($fieldName,$imageid){
	
		if($_FILES[$fieldName]['name']!=""){ 
			$value = $_FILES[$fieldName]['name'];
			
			$config = array(
			'file_name' => $imageid,
			 'encrypt_name' => 'FALSE',
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path.'/full',
			'max_size' => 2000
			
			);
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($fieldName)) {
				$error = $this->upload->display_errors();
			   $this->session->set_flashdata('item_error',$error);
				// return the error message and kill the script
				//echo $this->upload->display_errors(); exit();
			}else{
				$flag=1;
				$image_data = $this->upload->data();
				$this->load->library('image_lib');
				$upName=$image_data['file_name'];
				
				$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/thumbnails',
				'maintain_ration' => true,
				'width' => 200,
				'height' => 200
				);

				//$this->load->library('image_lib', $config);
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

				$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/small',
				'maintain_ration' => true,
				'width' => 150,
				'height' => 150
				);

				//$this->load->library('image_lib', $config);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$img=$upName;
				return $img;
			}
			//
			//print_r($img); exit;
			//  echo 'img name.. '.$img;
		}else{
			//$img=$this->input->post($defaultImageFieldName);
		}	
		//return $img;
	}
	
	public function invoice_list(){
	 authenticate(array('ut7'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
	$data['invoice'] = $this->service_request->getInvoice_formanager($data['userData']['location_id']);
        $this->load->view("invoice_list",$data);	
		
	}
	public function generate_invoice_html_view($invid = ''){
		if($invid == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($this->uri->segment(3)));
		$data = $this->data;
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['title'] = 'Smartworks - Invoice';
		$data['company'] = $this->service_request->getCompanyDetails($invoice_id);
		$data['invoice'] = $this->service_request->getInvoiceById($invoice_id);
		if(empty($data['invoice'])){
			die('Not accessable this page');
		}
		$data['discount'] = $this->service_request->getDiscountById($invoice_id);
		$data['invoice_items'] = $this->service_request->getInvoiceItems($invoice_id);
		//echo "<pre>";
		//print_r($data);
		//echo "</pre>";
		//die();
		$this->load->view('html_view_first', $data);
		$this->load->view('html_view_second', $data);
		$this->load->view('html_view_third', $data);
		$this->load->view('html_view_fourth', $data);
	}
	public function generate_invoice_pdf($invid = ''){
		if($invid == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($this->uri->segment(3)));
		$data = $this->data;
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['company'] = $this->service_request->getCompanyDetails($invoice_id);
		$data['invoice'] = $this->service_request->getInvoiceById($invoice_id);
		if(empty($data['invoice'])){
			die('Not accessable this page');
		}
		$data['discount'] = $this->service_request->getDiscountById($invoice_id);
		$data['invoice_items'] = $this->service_request->getInvoiceItems($invoice_id);
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
	
	public function floor_image(){
		 authenticate(array('ut7'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
		
		
	  $this->load->view("floor_image",$data);	
		
	}
	public function getfloorplanservicebybusiness($bussid){
		$floorservice=$this->floor_plan->getservice_bybussid($bussid);
		//print_r($floorservice);
		$this->session->unset_userdata('seatid');
		if(count($floorservice)>0){
			$servicecost=0;
	        $internetcost=0;
	        $floorservice[0]['internet_cost'];
	        $internetdata=json_decode($floorservice[0]['internet_cost']);
	        $i=0;
	        foreach($internetdata as $k=>$v){
	           $speeddata[]=$k;
	           if($i<1){
	           	   $internetcost=$internetcost+$v;
	           }
	           $i++;
	        }
	        $intspeed=$speeddata[0];
	        $servicecost=$floorservice[0]['bookself_cost']+$floorservice[0]['internal_storage_cost']+$floorservice[0]['phone_cost']+$floorservice[0]['wifi_cost']+$internetcost;
	        echo json_encode(array('totalcost'=>$servicecost,'bookself_cost'=>$floorservice[0]['bookself_cost'],'internal_storage_cost'=>$floorservice[0]['internal_storage_cost'],'phone_cost'=>$floorservice[0]['phone_cost'],'wifi_cost'=>$floorservice[0]['wifi_cost'],'intspeed'=>$intspeed,'internet_cost'=>$internetcost,'int_cost_info'=>$floorservice[0]['internet_cost']));
		}

        
	}
	public function get_no_of_people(){
		$no_of_people=0;
		if(!empty($this->session->userdata('seatid'))){
			
			$expseat=explode(",",$this->session->userdata('seatid'));
			$expseatidinfo=explode("|",$expseat[0]);
			foreach($expseatidinfo as $stinfo){
				$expseatinfo=explode(':',$stinfo);
				$seatinfo=$this->floor_plan->getseatinfo($expseatinfo[0]);
				$no_of_people=$no_of_people+$seatinfo[0]['no_of_people'];
			}
		}
		echo '<option value="">Select no of People</option>';
		for($i=1;$i<=$no_of_people;$i++){
            echo '<option value="'.$i.'" '.(($i==$no_of_people)?"selected":"").'>'.$i.'</option>';
        }
		
	}
	public function get_room_price(){
		$room_price=0;
		$no_of_people=0;
		if(!empty($this->session->userdata('seatid'))){
			
			$expseat=explode(",",$this->session->userdata('seatid'));
			$expseatidinfo=explode("|",$expseat[0]);
			foreach($expseatidinfo as $stinfo){
				$expseatinfo=explode(':',$stinfo);
				$seatinfo=$this->floor_plan->getseatinfo($expseatinfo[0]);
				$room_price=$room_price+$seatinfo[0]['price'];
				$no_of_people=$no_of_people+$seatinfo[0]['no_of_people'];
			}
		}
		$people_price=$no_of_people*500;
		$room_price=$people_price+$room_price;
        echo $room_price;
	}
	public function get_forward_to_ad(){
		$total=$this->input->post('total');
		$discount=$this->input->post('discount');
		$calculateprice=$total-$total*$discount/100;
		$this->session->set_userdata('forward_to_ad','1');
		$this->session->set_userdata('discount_ad',$discount);
		$this->session->set_userdata('discounted_amount',$calculateprice);
	}
	public function office_agreement(){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$book_floor_id=$this->session->userdata('book_floor_id');
		$data['book_floor_data']=$this->booking_info->get_book_floor_plan_byid($book_floor_id);

		$booking_details=json_decode($data['book_floor_data'][0]['booking_detailes']);
		$no_of_people=0;
		foreach($booking_details as $bkdetails){
			$expbkdetails=explode(":",$bkdetails);
			$seatinfo=$this->floor_plan->getseatinfo($expbkdetails[0]);
			$no_of_people=$no_of_people+$seatinfo[0]['no_of_people'];
		}
		$data['no_of_people']=$no_of_people;
		$floor_plan_id=$data['book_floor_data'][0]['floor_plan_id'];
		$data['business_center']=$this->booking_info->get_business_center_info($floor_plan_id);
		$business_id=$data['business_center'][0]['business_id'];
		$data['office_info']=$this->booking_info->get_private_office_info($business_id);
		$this->load->view('voffice_agreement',$data);
	}
	public function sendagreement(){
		$company=$this->input->post('company');
		$agrement_data=array(
			'Id'=>substr(create_guid(),0,16),
			'book_floor_plan_id'=>$this->input->post('bookfloorplanid'),
			'agreement_date'=>date('Y-m-d',strtotime($this->input->post('agreement_date'))),
			'referenceno'=>$this->input->post('reference'),
			'officeno'=>$this->input->post('officeno'),
			'service_retainer'=>$this->input->post('service_retainer'),
			'service_retainer_amount'=>$this->input->post('retainer_amount'),
			'initial_amount'=>$this->input->post('initial_payment'),
			'total_monthly_payment'=>$this->input->post('total_price'),
			'comments'=>$this->input->post('comments')
			);
		$book_floor_plan_data=array(
			'book_for_client'=>$this->input->post('userId'),
			'Isclient'=>$this->input->post('Isclient')
			);
		if($this->input->post('Isclient')==0){
            $company_data=array(
            	'id'=>substr(create_guid(),0,16),
            	'company_name'=>$company,
            	'status'=>1
            	);
            $register_company_data=array(
            	'company'=>$company
            	);
            $this->booking_info->add_company_data($company_data,$register_company_data,$book_floor_plan_data['book_for_client']);
		}
		$this->booking_info->add_agreement_data($agrement_data,$book_floor_plan_data);
		$url=base_url().'private_office_agreement/view/'.$agrement_data['book_floor_plan_id'];
		$contname=$this->input->post('contname');
		$email=$this->input->post('email');
		$email_template_id='6ad6d2cf-c7b2-2c';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[client fullname]',$contname,$body);
		 $body = str_replace('[url]',$url,$body);
		
		 $from_email='sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($email); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		echo 'You have successfully send the agreement';
	}
	public function autocomplete(){
		$eml=$this->input->post('eml');
		$usertype=$this->input->post('usertype');
		$uemlautocomplete=$this->booking_info->eml_autocomplete($eml,$usertype);
		foreach ($uemlautocomplete as $row):
            echo "<li onclick='litxt($(this).text())'>".$row->FirstName." ".$row->LastName." [".$row->userEmail."]</li>";
        endforeach;
	}
	public function user_display_info(){
		$eml=$this->input->post('eml');
		$usertype=$this->input->post('usertype');
		$uinfo=$this->booking_info->display_user_data($eml,$usertype);
		if(count($uinfo)>0){
			echo json_encode($uinfo);
		}
	}
}
?>
