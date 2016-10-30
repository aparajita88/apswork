<?php
class Indirect_client extends MY_Controller {
	var $gallery_path;
	var $gallery_path_url;
	var $atos_url;
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('login/login_model');
	    $this->load->model('rooms/rooms_model');
	    $this->load->model('location/location_model', 'lm');
	    $this->load->model('indirect_client_model');
	    $this->load->library("atos");
	   	$this->load->helper('common');
		$this->load->helper('form'); 
		$this->load->library('email');
		$this->load->helper('path');
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->atos_url = 'https://cgt.in.worldline.com/ipg/doMEPayRequest'; //should call model from admin settings for live or test server
		$this->output->enable_profiler(FALSE); //Default FALSE
	}
	public function client_dashBoard(){
	  	authenticate(array('ut11'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $this->load->view("client_dashBoard",$data);	
	}
 	public function virtual_assistant(){
 		authenticate(array('ut11'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$client_event=$this->indirect_client_model->get_client_event($userId);
		$i=0;
		if(!empty($client_event)){
			foreach($client_event as $clnt_evnt){
				$expsttime=explode(":",$clnt_evnt['start_time']);
				$expendtm=explode(":",$clnt_evnt['end_time']);
				$data['eventdata'][$i]['id']=$clnt_evnt['event_id'];
				$data['eventdata'][$i]['message']=$clnt_evnt['message'];
				$data['eventdata'][$i]['start']=$expsttime[0];
				$data['eventdata'][$i]['end']=$expendtm[0];
				$data['eventdata'][$i]['title']= $clnt_evnt['message'];
				$data['eventdata'][$i]['is_shared']= $clnt_evnt['is_shared'];
				$data['eventyearmonthday'][$i]=$clnt_evnt['event_date'];
				
				$i++;
			}
		}else{
				$data['eventdata']= '';
				$data['eventyearmonthday']='';
		}
        $this->load->view("virtual_assistant",$data);	
 	}
 	public function getcalevent(){
		$evntdata=$this->indirect_client_model->get_client_event_byeventid($this->input->post('evntid'));
		$evntdata[0]['event_date']=date('d/m/Y',strtotime($evntdata[0]['event_date']));
		$evntdata[0]['start_time']=date('h:i A',strtotime($evntdata[0]['event_date']." ".$evntdata[0]['start_time']));
		$evntdata[0]['end_time']=date('h:i A',strtotime($evntdata[0]['event_date']." ".$evntdata[0]['end_time']));
		echo json_encode($evntdata[0]);
	}
	public function putcalevent(){
		$data = array();
		$id=create_guid();
		$data['event_id']= substr($id,0,16);
		$data['message']= $this->input->post('eventDesc');
		$data['event_date']= $this->input->post('eventDate');
		$data['start_time']= $this->input->post('eventStartTime');
		$data['end_time']= $this->input->post('eventEndTime');
		$data['is_shared']= $this->input->post('eventShared');
		$data['createdby'] = $this->session->userdata("userId");
		$evntSt=$this->indirect_client_model->put_client_event($data);		
		echo json_encode($evntSt);
	}
	public function updcalevent(){
		$data = array();		
		$event_id = $this->input->post('eventId');
		$data['message']= $this->input->post('eventDesc');
		$data['is_shared']= $this->input->post('eventShared');
		$evntSt=$this->indirect_client_model->upd_client_event($data,$event_id);		
		echo json_encode($evntSt);
	}
	public function getTodo(){
		$data = array();
		$userId = $this->session->userdata("userId");
		$data['todo']=$this->indirect_client_model->get_todo($userId);
		$this->load->view("ajax_todo_view",$data);
	}
	public function setTodo(){
		$userId = $this->session->userdata("userId");
		$todoid = $this->input->post('id');	
		$message = $this->input->post('message');
		if($todoid != ''){
			$todoStatus=$this->indirect_client_model->upd_todo($todoid,$message);
			echo json_encode($todoStatus);
		}else{
			$todoStatus=$this->indirect_client_model->set_todo($userId,$message);
			echo json_encode($todoStatus);
		}
	}
    public function client_dashBoard_calender(){
		authenticate(array('ut11'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
        $this->load->view("client_dashBoard_calender",$data);	
    }
    public function client_dashBoard_floorplan(){
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
        $this->load->view("client_dashBoard_floorplan",$data);	
   	}
   	public function getlocationbycity($id){
		$cityid=$id;
	    $data['location']=$this->lm->getlocationbycity($cityid);	
		if(!empty($data['location']))
		{
			echo '<option value="0">Select Location</option>';
			foreach($data['location'] as $key=>$value)
			{
				echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
			}			
		}else{
			echo '<option value="0">No Location Available</option>';
		}	
	}
	public function getBusinessByLocation($value,$city){
		$location_id=$value;
		$cityid=$city;
	    $data['business']=$this->rooms_model->getbuisnessbylocationcity($cityid,$location_id);	
		if(!empty($data['business']))
		{
			echo '<option value="0">Select Business</option>';
			foreach($data['business'] as $key=>$value)
			{
				echo '<option value="'.$value['business_id'].'">'.$value['businessName'].'</option>'; 
			}			
		}else{
			echo '<option value="0">No Business Center</option>';
			
		}	
	}
	public function get1stconferenceroom($conference_id){
		$data['get1stconferenceroom']=$this->indirect_client_model->get1stconferenceroom($conference_id); 
		echo json_encode($data['get1stconferenceroom']);
	}
	public function getlockerByLocation($value){
		$business_id=$value;
	    $data['locker']=$this->rooms_model->getlockerbybusiness($business_id);	
		if(!empty($data['locker']))
		{
			echo '<option value="0">Select Locker Room</option>';
			foreach($data['locker'] as $key=>$value)
			{
				echo '<option value="'.$value['locker_id'].'">'.$value['name'].'</option>'; 
			}			
		}else{
			echo '<option value="0">No Locker Rooms</option>';
		}		
	}
	public function getlockerBybusiness($value){
	 	$data['getlockerBybusiness']=$this->indirect_client_model->getlockerbybusiness($value);  
		echo '<option value="0">Select Locker</option>';
		foreach($data['getlockerBybusiness'] as $key=>$value)
		{
			echo '<option value="'.$value['locker_id'].'">'.$value['name'].'</option>'; 
		}			
   	}
   	public function getgameBybusiness($value){
	 	$data['getgameBybusiness']=$this->indirect_client_model->getgamebybusiness($value);  
		echo '<option value="0">Select Game</option>';
		foreach($data['getgameBybusiness'] as $key=>$value)
		{
			echo '<option value="'.$value['game_id'].'">'.$value['name'].'</option>'; 
		}			
   	}
	public function getconferenceBybusiness($bussiness_id){
		$id=$bussiness_id;
	    $dconference = $this->indirect_client_model->getconferencebybusiness($id);			
		if(!empty($dconference))
		{
			echo '<option value="0">Select Conference Room</option>';
			foreach($dconference as $key=>$value)
			{
				echo '<option value="'.$value['conference_id'].'">'.$value['name'].'</option>'; 
			}			
		}else{
			
			echo '<option value="0">No Room Available</option>';
		}	
	}
	public function getmeetingBybusiness($bussiness_id){
		$id=$bussiness_id;
	    $meeting = $this->indirect_client_model->getmeetingbybusiness($id);			
		if(!empty($meeting))
		{
			echo '<option value="0">Select Meeting Room</option>';
			foreach($meeting as $key=>$value)
			{
				echo '<option value="'.$value['meeting_id'].'">'.$value['name'].'</option>'; 
			}			
		}else{
			
			echo '<option value="0">No Room Available</option>';
		}	
	}
	public function getdayofficeBybusiness($bussiness_id){
		$id=$bussiness_id;
	    $dayoffice = $this->indirect_client_model->getdayofficebybusiness($id);			
		if(!empty($dayoffice))
		{
			echo '<option value="0">Select Day Office</option>';
			foreach($dayoffice as $key=>$value)
			{
				echo '<option value="'.$value['dayoffice_id'].'">'.$value['name'].'</option>'; 
			}			
		}else{
			
			echo '<option value="0">No Day office Available</option>';
		}	
	}
	public function clearSessionArray(){
		if($this->session->userdata("dataArray") != ''){
			$this->session->unset_userdata('dataArray');
			exit();
		}
		if($this->session->userdata("dataMeetingArray") != ''){
			$this->session->unset_userdata('dataMeetingArray');
			exit();
		}
		if($this->session->userdata("dataDayOfficeArray") != ''){
			$this->session->unset_userdata('dataDayOfficeArray');
			exit();
		}
	}
	public function getCurrentHour(){
		echo trim(date('H')," ");
	}
	/*Book Game Room start here*/
	public function getGameRoom($game_id){
		$data['get_game_room']=$this->indirect_client_model->get1stgameroom($game_id);   
	 	$this->load->view("ajax_gameroom",$data);		
   	}
   	public function book_game_room(){
	 	authenticate(array('ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['game_data']=$this->indirect_client_model->getgamebybusiness($data['business_data'][0]['business_id']);
	  	$this->load->view("book_game_room",$data);	  
   	}
   	public function setbookingGameRoomRequest(){
		$data = array();
		$game_room_id 		= $this->input->post('game_room_id');
		$game_type 			= $this->input->post('game_type');
		$start_date 		= $this->input->post('start_date');
		$end_date 			= $this->input->post('end_date');
		$price 				= $this->input->post('price');
		$userId 			= $this->session->userdata("userId");
		$userData 			= $this->login->getUserProfile($userId);

        $data['id'] 				= substr(create_guid(),0,16);
		$data['game_room_id'] 		= $game_room_id;
		$data['game_type'] 			= $game_type;
		$data['start_date'] 		= $start_date;
		$data['end_date'] 			= $end_date;
		$data['price'] 				= $price;
		$data['book_for'] 			= $userId;
		$data['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
		$data['addedBy'] 			= $userId;
		$data['dateAdded'] 			= date('Y-m-d h:i:s');
		$data['deleted'] 			= 0;
		$data['company_id'] 		= $userData['company_id'];
		
		$tbname ='book_game_room';
		$appid = $data['id'];

		$invoice_data=$this->indirect_client_model->get_invoice_by_comid($data['company_id']);
		$invoice_id=$invoice_data[0]['id'];
		$invoice_price=$invoice_data[0]['sub_total']+$price;
		$invoice_data=array(
		'sub_total'=>$invoice_price
		);

		$invoice_item_data=array(
			'id'=>substr(create_guid(),0,16),
			'invoice_id'=>$invoice_id,
			'description'	=>'booking game room',
			'quantity'=>1,
			'unit_price'=>$price,
			'total'=>$price,
			'table_name'=>$tbname,
			'row_id'=>$appid
		);
		$status = $this->indirect_client_model->setReqBookingGame($data);
		$this->indirect_client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);

		$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
		$email_template = $this->login_model->getEmailTemplate($email_template_id);
		$body 			= $email_template['description'];
		$price 			= $data['price'];
		$fullname		= ucfirst($userData['FirstName']).' '.ucfirst($userData['LastName']);
		$body 			= str_replace('[amount excluding taxes]',$price,$body);
		$body 			= str_replace('[client full name]',$fullname,$body);
		$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
		$from_name 		= ucfirst('Team Smartworks');
        
  		/*User Payment Mail Function*/
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		//$this->email->to('sohom@simayaa.com');
		$this->email->to($userData['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $userData['userEmail']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		if($this->email->send()){ // Send mail to client
			echo json_encode($status);
		} 
	}
   	public function bookingGameRequestOnline(){
   		$booking_data 						= array();
		$userId 							= $this->session->userdata("userId");
		$userData 							= $this->login->getUserProfile($userId);
        $booking_data['id'] 				= substr(create_guid(),0,16);
		$booking_data['game_room_id'] 		= $this->input->post('gameroom_id');
		$booking_data['game_type'] 			= $this->input->post('gameroom_type');
		$booking_data['price'] 				= $this->input->post('price');
		$booking_data['start_date']			= $this->input->post('start_date');
		$booking_data['end_date']			= $this->input->post('end_date');
		$booking_data['orderid']			= $this->input->post('orderID');
		$booking_data['user_id']			= $this->session->userdata("userId");
		$booking_data['company_id'] 		= $userData['company_id'];
		$booking_data['tbl_name'] 			= 'book_game_room';
	    $this->session->set_userdata('booking_game_data', $booking_data);
		$responseUrl = $this->config->item('base_url').'index.php/client/booking_game_payment_response';
		$price = ($booking_data['price']*100);
		$this->atos->load(MID,$booking_data['orderid'],$price,ME_TRANS_REQ_TYPE,ENCKEY,CURRENCY_NAME,$responseUrl,$this->atos_url);	
   	}
   	public function booking_game_payment_response(){
		authenticate(array('ut11'));
		$session_booking_data = $this->session->userdata['booking_game_data'];
		$userId = $session_booking_data['user_id'];
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$this->session->unset_userdata($this->session->userdata['booking_game_data']);
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		if ($response->getStatusCode()=="S"){
			//---------------------book_conference_room table data start here---------------------------//
			$data_book = array();
			$data_book['id'] 				= $session_booking_data['id'];
			$data_book['game_room_id'] 		= $session_booking_data['game_room_id'];
			$data_book['game_type']			= $session_booking_data['game_type'];
			$data_book['start_date'] 		= $session_booking_data['start_date'];
			$data_book['end_date'] 			= $session_booking_data['end_date'];
			$data_book['price'] 			= $session_booking_data['price'];
			$data_book['book_for'] 			= $session_booking_data['user_id'];
			$data_book['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data_book['addedBy'] 			= $session_booking_data['user_id'];
			$data_book['dateAdded'] 		= date('Y-m-d h:i:s');
			$data_book['deleted'] 			= 0;
			$data_book['company_id'] 		= $session_booking_data['company_id'];
			//---------------------Invoice Item table data start here---------------------------//
			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($session_booking_data['company_id']);
			$invoice_id=$invoice_data[0]['id'];
			$invoice_item_id = substr(create_guid(),0,16);
			$invoice_item_data=array(
				'id'			=>$invoice_item_id,
				'invoice_id'	=>$invoice_id,
				'description'	=>'booking game room',
				'quantity'		=>1,
				'unit_price'	=>$session_booking_data['price'],
				'payment_status'=>'1',
				'total'			=>$session_booking_data['price'],
				'table_name'	=>$session_booking_data['tbl_name'],
				'row_id'		=>$session_booking_data['id']
			);
			//---------------------Payment table data start here---------------------------//
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'					=> $paymentId,
				'userId'					=> $session_booking_data['user_id'],
				'details'					=> 'Booking game room online',
				'payment_Data'				=> json_encode((array)$response),
				'Transaction_Reference_No'	=> $response->getpgMeTrnRefNo(),
				'orderId'					=> $response->getOrderId(),
				'invoice_item_number'		=> $invoice_item_id,
				'Amount'					=> $response->getTrnAmt(),
				'Status_Description'		=> $response->getstatusDesc(),
				'RRN'						=> $response->getrrn(),
			    'Authzcode'					=> $response->getauthZCode(),
				'Response_code'				=> $response->getresponseCode(),
				'orderDate'					=> $response->gettrnReqDate(),
				'orderStatus'				=> $response->getstatusCode()
   			);
			//------------------------------------------------//
			$this->indirect_client_model->setReqBookingGame($data_book);
			$this->indirect_client_model->process_request_online($inputArray_payment,$invoice_item_data);

			$email_template_id	= 'bdfd372e-2c44-31'; //Booking online service template id
			$email_template 	= $this->login_model->getEmailTemplate($email_template_id);
			$body 				= $email_template['description'];
			$price 				= $session_booking_data['price'];
			$fullname			= ucfirst($data['userData']['FirstName']).' '.ucfirst($data['userData']['LastName']);
			$body 				= str_replace('[amount including taxes]',$price,$body);
			$body 				= str_replace('[client full name]',$fullname,$body);
   			$from_email 		= 'sworks_team@sworks.co.in'; // should change with smartworks team
   			$from_name 			= ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			//$this->email->to('sohom@simayaa.com');
			$this->email->to($data['userData']['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $data['userData']['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$path = set_realpath('assets/uploads/attachments/'); // real path of directory
			$attachment_name = 'Smartworks_'.date('d_M_Y').'.pdf'; // pdf attachment file name
			if(is_dir($path)){
				$data_invoice = array();
				$data_invoice['logo_img'] 		= $this->gallery_path_url.'logo.png';
				$data_invoice['userName'] 		= $fullname;
				$data_invoice['table_name'] 	= $session_booking_data['tbl_name'];
				$data_invoice['invoice_number'] = $invoice_data[0]['invoice_number'];
				$data_invoice['bookings'] 		= $tempData;
				$data_invoice['priceIncTax'] 	= $session_booking_data['price'];
				$data_invoice['tax'] 			= SERVICE_TAX;
				$data_invoice['priceExcTax'] 	= (($session_booking_data['price'])/(1+($data_invoice['tax']/100)));
				$data_invoice['start_date'] 	= $session_booking_data['start_date'];
				$data_invoice['end_date'] 		= $session_booking_data['end_date'];
				$html = $this->load->view('booking_invoice_pdf', $data_invoice, true);
				//ini_set('memory_limit','32M');
				$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->SetTitle("Smartworks - Booking Game Room Invoice");
				$mpdf->SetAuthor("Smartworks Co.");
				$mpdf->WriteHTML($html,2);
				$pdfname = $path.$attachment_name;
			    $mpdf->Output($pdfname,'F'); 
				$this->email->attach($pdfname);  /* Enables you to send an attachment */
			}
			$this->email->send(); // Send mail to client
			$file = $path . $attachment_name;
			if(is_file($file))
  				unlink($file); // delete attachment file
			$this->load->view('payment_success',$data);
 		}
		else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
	}
	/*Book Game Room end here*/

	/*Book Locker Room start here*/
	public function getLockerRoom($locker_id){
		$data['get_locker_room']=$this->indirect_client_model->get1stlockerroom($locker_id);   
	 	$this->load->view("ajax_lockerroom",$data);		
   	}
   	public function book_locker_room(){
 		authenticate(array('ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['locker_data']=$this->indirect_client_model->getlockerbybusiness($data['business_data'][0]['business_id']);
		$this->load->view("book_locker_room",$data);	  
   	}
   	public function setbookingLockerRequest(){
		$data = array();
		$locker_room_id 	= $this->input->post('locker_room_id');
		$locker_type 		= $this->input->post('locker_type');
		$total_locker 		= $this->input->post('total_locker');
		$start_date 		= $this->input->post('start_date');
		$end_date 			= $this->input->post('end_date');
		$price 				= $this->input->post('price');
		$userId 			= $this->session->userdata("userId");
		$userData 			= $this->login->getUserProfile($userId);

        $data['id'] 				= substr(create_guid(),0,16);
		$data['locker_room_id'] 	= $locker_room_id;
		$data['locker_type'] 		= $locker_type;
		$data['total_locker'] 		= $total_locker;
		$data['start_date'] 		= $start_date;
		$data['end_date'] 			= $end_date;
		$data['price'] 				= $price;
		$data['book_for'] 			= $userId;
		$data['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
		$data['addedBy'] 			= $userId;
		$data['dateAdded'] 			= date('Y-m-d h:i:s');
		$data['deleted'] 			= 0;
		$data['company_id'] 		= $userData['company_id'];
		
		$tbname ='book_locker_room';
		$appid = $data['id'];

		$invoice_data=$this->indirect_client_model->get_invoice_by_comid($data['company_id']);
		$invoice_id=$invoice_data[0]['id'];
		$invoice_price=$invoice_data[0]['sub_total']+$price;
		$invoice_data=array(
		'sub_total'=>$invoice_price
		);

		$invoice_item_data=array(
			'id'=>substr(create_guid(),0,16),
			'invoice_id'=>$invoice_id,
			'description'	=>'booking locker(s) room',
			'quantity'=>$data['total_locker'],
			'unit_price'=>$price,
			'total'=>$price,
			'table_name'=>$tbname,
			'row_id'=>$appid
		);
		$status = $this->indirect_client_model->setReqBookingLocker($data);
		$this->indirect_client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);

		$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
		$email_template = $this->login_model->getEmailTemplate($email_template_id);
		$body 			= $email_template['description'];
		$price 			= $data['price'];
		$fullname		= ucfirst($userData['FirstName']).' '.ucfirst($userData['LastName']);
		$body 			= str_replace('[amount excluding taxes]',$price,$body);
		$body 			= str_replace('[client full name]',$fullname,$body);
		$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
		$from_name 		= ucfirst('Team Smartworks');
        
  		/*User Payment Mail Function*/
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		//this->email->to('sohom@simayaa.com,aparajita@simayaa.com');
		$this->email->to($userData['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $userData['userEmail']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		if($this->email->send()){ // Send mail to client
			echo json_encode($status);
		} 
	}
   	public function bookingLockerRequestOnline(){
   		$booking_data 						= array();
		$userId 							= $this->session->userdata("userId");
		$userData 							= $this->login->getUserProfile($userId);
        $booking_data['id'] 				= substr(create_guid(),0,16);
		$booking_data['locker_room_id'] 	= $this->input->post('locker_id');
		$booking_data['locker_type'] 		= $this->input->post('locker_type');
		$booking_data['price'] 				= $this->input->post('price');
		$booking_data['start_date']			= $this->input->post('start_date');
		$booking_data['end_date']			= $this->input->post('end_date');
		$booking_data['total_locker']		= $this->input->post('locker_count');
		$booking_data['orderid']			= $this->input->post('orderID');
		$booking_data['user_id']			= $this->session->userdata("userId");
		$booking_data['company_id'] 		= $userData['company_id'];
		$booking_data['tbl_name'] 			= 'book_locker_room';
	    $this->session->set_userdata('booking_locker_data', $booking_data);
		$responseUrl = $this->config->item('base_url').'index.php/client/booking_locker_payment_response';
		$price = ($booking_data['price']*100);
		$this->atos->load(MID,$booking_data['orderid'],$price,ME_TRANS_REQ_TYPE,ENCKEY,CURRENCY_NAME,$responseUrl,$this->atos_url);	
   	}
   	public function booking_locker_payment_response(){
		authenticate(array('ut11'));
		$session_booking_data = $this->session->userdata['booking_locker_data'];
		$userId = $session_booking_data['user_id'];
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$this->session->unset_userdata($this->session->userdata['booking_locker_data']);
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		if ($response->getStatusCode()=="S"){
			//---------------------book_conference_room table data start here---------------------------//
			$data_book = array();
			$data_book['id'] 				= $session_booking_data['id'];
			$data_book['locker_room_id'] 	= $session_booking_data['locker_room_id'];
			$data_book['locker_type']		= $session_booking_data['locker_type'];
			$data_book['total_locker']		= $session_booking_data['total_locker'];
			$data_book['price'] 			= $session_booking_data['price'];
			$data_book['start_date'] 		= $session_booking_data['start_date'];
			$data_book['end_date'] 			= $session_booking_data['end_date'];
			$data_book['book_for'] 			= $session_booking_data['user_id'];
			$data_book['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data_book['addedBy'] 			= $session_booking_data['user_id'];
			$data_book['dateAdded'] 		= date('Y-m-d h:i:s');
			$data_book['deleted'] 			= 0;
			$data_book['company_id'] 		= $session_booking_data['company_id'];
			//---------------------Invoice Item table data start here---------------------------//
			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($session_booking_data['company_id']);
			$invoice_id=$invoice_data[0]['id'];
			$invoice_item_id = substr(create_guid(),0,16);
			$invoice_item_data=array(
				'id'			=>$invoice_item_id,
				'invoice_id'	=>$invoice_id,
				'description'	=>'booking locker(s) room',
				'quantity'		=>$session_booking_data['total_locker'],
				'unit_price'	=>$session_booking_data['price'],
				'payment_status'=>'1',
				'total'			=>$session_booking_data['price'],
				'table_name'	=>$session_booking_data['tbl_name'],
				'row_id'		=>$session_booking_data['id']
			);
			//---------------------Payment table data start here---------------------------//
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'					=> $paymentId,
				'userId'					=> $session_booking_data['user_id'],
				'details'					=> 'Booking locker(s) room online',
				'payment_Data'				=> json_encode((array)$response),
				'Transaction_Reference_No'	=> $response->getpgMeTrnRefNo(),
				'orderId'					=> $response->getOrderId(),
				'invoice_item_number'		=> $invoice_item_id,
				'Amount'					=> $response->getTrnAmt(),
				'Status_Description'		=> $response->getstatusDesc(),
				'RRN'						=> $response->getrrn(),
			    'Authzcode'					=> $response->getauthZCode(),
				'Response_code'				=> $response->getresponseCode(),
				'orderDate'					=> $response->gettrnReqDate(),
				'orderStatus'				=> $response->getstatusCode()
   			);
			//------------------------------------------------//
			$this->indirect_client_model->setReqBookingLocker($data_book);
			$this->indirect_client_model->process_request_online($inputArray_payment,$invoice_item_data);
			$email_template_id='bdfd372e-2c44-31'; //Booking online service template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $session_booking_data['price'];
			$fullname		= ucfirst($data['userData']['FirstName']).' '.ucfirst($data['userData']['LastName']);
			$body 			= str_replace('[amount including taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
   			$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
   			$from_name 		= ucfirst('Team Smartworks');
            
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($data['userData']['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $data['userData']['userEmail']
			//$this->email->to('sohom@simayaa.com');
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$path = set_realpath('assets/uploads/attachments/'); // real path of directory
			$attachment_name = 'Smartworks_'.date('d_M_Y').'.pdf'; // pdf attachment file name
			if(is_dir($path)){
				$data_invoice = array();
				$data_invoice['logo_img'] 		= $this->gallery_path_url.'logo.png';
				$data_invoice['userName'] 		= $fullname;
				$data_invoice['table_name'] 	= $session_booking_data['tbl_name'];
				$data_invoice['invoice_number'] = $invoice_data[0]['invoice_number'];
				$data_invoice['bookings'] 		= $tempData;
				$data_invoice['priceIncTax'] 	= $session_booking_data['price'];
				$data_invoice['tax'] 			= SERVICE_TAX;
				$data_invoice['priceExcTax'] 	= (($session_booking_data['price'])/(1+($data_invoice['tax']/100)));
				$data_invoice['start_date'] 	= $session_booking_data['start_date'];
				$data_invoice['end_date'] 		= $session_booking_data['end_date'];
				$html = $this->load->view('booking_invoice_pdf', $data_invoice, true);
				//ini_set('memory_limit','32M');
				$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->SetTitle("Smartworks - Booking Locker Room Invoice");
				$mpdf->SetAuthor("Smartworks Co.");
				$mpdf->WriteHTML($html,2);
				$pdfname = $path.$attachment_name;
			    $mpdf->Output($pdfname,'F'); 
				$this->email->attach($pdfname);  /* Enables you to send an attachment */
			}
			$this->email->send(); // Send mail to client
			$file = $path . $attachment_name;
			if(is_file($file))
  				unlink($file); // delete attachment file
			$this->load->view('payment_success',$data);
 		}
		else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
	}
   	/*Book Locker Room end here*/

	/*Book Conference Room start here*/
	public function book_conference_room(){
		authenticate(array('ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['conference_data']=$this->indirect_client_model->getconferencebybusiness($data['business_data'][0]['business_id']);
		if(!empty($data['conference_data'])){
			$starttime = strtotime($data['conference_data'][0]['start_time']); 
			$endtime = strtotime($data['conference_data'][0]['end_time']); 
			$data['diff'] = abs($endtime - $starttime) / 3600;
		}
		$this->load->view("book_conference_room",$data);	  
	}
	public function getCalender(){
		$data = array();
		$html = '';
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$conference_id = $this->input->post('conference_id');
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['conference_data']=$this->indirect_client_model->getConferenceData($conference_id);
		$data['booked']=$this->indirect_client_model->getBookSlots($conference_id);
		$this->load->view("ajax_calender",$data);
	}
	public function setBookConferenceRoom(){
		$slotArray = [];
		$data = array();
		$flag = $this->input->post('flag');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$price = $this->input->post('price');
		if($flag == 1){
			$slot = array($date,$time,$price);
			if($this->session->userdata("dataArray") != ''){
				$slotArray = $this->session->userdata("dataArray");
				array_push($slotArray,$slot);
			}else{
				array_push($slotArray,$slot);	
			}
		}elseif($flag == 0){
			if($this->session->userdata("dataArray") != ''){
				$slotArray = $this->session->userdata("dataArray");
			}
			foreach($slotArray as $key=>$val){
				if($val[0] == $date && $val[1] == $time){
					unset($slotArray[$key]);
				}
			}
		}
		$this->session->set_userdata("dataArray",$slotArray);

		$tempArraySlot = $this->session->userdata("dataArray");
		$tempDataSlot = array();
		foreach($tempArraySlot as $temp){
			$tempDataSlot[$temp[0]]['slot'][] = $temp[1] ;
			$tempDataSlot[$temp[0]]['rate'] = $temp[2];
			$tempDataSlot[$temp[0]]['count'] = count($tempDataSlot[$temp[0]]['slot']);
			$tempDataSlot[$temp[0]]['price'] = ($temp[2]*count($tempDataSlot[$temp[0]]['slot']));
		}
		$data['price_table_details'] = $tempDataSlot;
		$this->load->view("price_table",$data);
	}
	public function setbookingRequest(){
		$data 		= array();
		$conf_id 	= $this->input->post('conference_id');
		$purpose 	= $this->input->post('purpose');
		$price 		= $this->input->post('price');
		$userId 	= $this->session->userdata("userId");
		$userData 	= $this->login->getUserProfile($userId);

        $data['id'] 				= substr(create_guid(),0,16);
		$data['conference_room_id'] = $conf_id;
		$tempArray = $this->session->userdata("dataArray");
		if(!empty($tempArray)){
			$tempData = array();
			foreach($tempArray as $temp){
				$tempData[$temp[0]][] = $temp[1] ;
			}
			$data['booking_details'] = json_encode($tempData);
			$data['price'] = $price;
			$data['purpose'] = $purpose;
			$data['is_shared'] = 1;
			$data['book_for'] = $userId;
			$data['is_approved'] = 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data['addedBy'] =$userId;
			$data['dateAdded'] =date('Y-m-d h:i:s');
			$data['deleted'] =0;
			$data['company_id'] =$userData['company_id'];

			$tbname ='book_conference_room';
			$appid = $data['id'];

			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($this->session->userdata("company_id"));
			$invoice_id=$invoice_data[0]['id'];
			$invoice_price=$invoice_data[0]['sub_total']+$price;

			$invoice_data=array(
			'sub_total'=>$invoice_price
			);

			$invoice_item_data=array(
			'id'=>substr(create_guid(),0,16),
			'invoice_id'=>$invoice_id,
			'description'=>$data['purpose'],
			'quantity'=>'1',
			'unit_price'=>$price,
			'total'=>$price,
			'table_name'=>$tbname,
			'row_id'=>$appid
			);
			$status = $this->indirect_client_model->setReqBooking($data);
			$this->indirect_client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
			$this->session->unset_userdata('dataArray');

			$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $data['price'];
			$fullname		= ucfirst($userData['FirstName']).' '.ucfirst($userData['LastName']);
			$body 			= str_replace('[amount excluding taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
			$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
			$from_name 		= ucfirst('Team Smartworks');
	        
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			//$this->email->to('sohom@simayaa.com,aparajita@simayaa.com');
			$this->email->to($userData['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $userData['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			if($this->email->send()){ // Send mail to client
				echo json_encode($status);
			}
		}else{
			echo json_encode('noslotsSelected');
		}
	}
	public function bookingConferrenceRequestOnline(){
			$this->session->unset_userdata('booking_data');
			$booking_data 						= array();
			$userId 							= $this->session->userdata("userId");
			$userData 							= $this->login->getUserProfile($userId);
	        $booking_data['id'] 				= substr(create_guid(),0,16);
			$booking_data['conference_room_id'] = $this->input->post('conference_id');
			$booking_data['purpose'] 			= $this->input->post('hidPurpose');
			$booking_data['price'] 				= $this->input->post('price');
			$booking_data['orderid']			= $this->input->post('orderID');
			$booking_data['user_id']			= $this->session->userdata("userId");
			$booking_data['company_id'] 		= $userData['company_id'];
			$booking_data['tbl_name'] 			= 'book_conference_room';
		    $this->session->set_userdata('booking_data', $booking_data);
			$responseUrl = $this->config->item('base_url').'index.php/client/booking_conference_payment_response';
			$price = ($booking_data['price']*100);
			$this->atos->load(MID,$booking_data['orderid'],$price,ME_TRANS_REQ_TYPE,ENCKEY,CURRENCY_NAME,$responseUrl,$this->atos_url);	
	}
	public function booking_conference_payment_response(){
		authenticate(array('ut11'));
		$session_booking_data = $this->session->userdata['booking_data'];
		$userId = $session_booking_data['user_id'];
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$this->session->unset_userdata($this->session->userdata['booking_data']);
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		if ($response->getStatusCode()=="S"){
			//---------------------book_conference_room table data start here---------------------------//
			$data_book = array();
			$data_book['id'] 				= $session_booking_data['id'];
			$data_book['conference_room_id'] = $session_booking_data['conference_room_id'];
			$tempData = array();
			$tempArray = $this->session->userdata("dataArray");
			foreach($tempArray as $temp){
				$tempData[$temp[0]][] = $temp[1] ;
			}
			$data_book['booking_details']	= json_encode($tempData);
			$data_book['price'] 			= $session_booking_data['price'];
			$data_book['purpose'] 			= $session_booking_data['purpose'];
			$data_book['is_shared'] 		= 1;
			$data_book['book_for'] 			= $session_booking_data['user_id'];
			$data_book['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data_book['addedBy'] 			= $session_booking_data['user_id'];
			$data_book['dateAdded'] 		= date('Y-m-d h:i:s');
			$data_book['deleted'] 			= 0;
			$data_book['company_id'] 		= $session_booking_data['company_id'];
			//---------------------Invoice Item table data start here---------------------------//
			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($session_booking_data['company_id']);
			$invoice_id=$invoice_data[0]['id'];
			$invoice_item_id = substr(create_guid(),0,16);
			$invoice_item_data=array(
				'id'			=>$invoice_item_id,
				'invoice_id'	=>$invoice_id,
				'description'	=>$session_booking_data['purpose'],
				'quantity'		=>'1',
				'unit_price'	=>$session_booking_data['price'],
				'payment_status'=>'1',
				'total'			=>$session_booking_data['price'],
				'table_name'	=>$session_booking_data['tbl_name'],
				'row_id'		=>$session_booking_data['id']
			);
			//---------------------Payment table data start here---------------------------//
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'					=> $paymentId,
				'userId'					=> $session_booking_data['user_id'],
				'details'					=> 'Booking conference room online',
				'payment_Data'				=> json_encode((array)$response),
				'Transaction_Reference_No'	=> $response->getpgMeTrnRefNo(),
				'orderId'					=> $response->getOrderId(),
				'invoice_item_number'		=> $invoice_item_id,
				'Amount'					=> $response->getTrnAmt(),
				'Status_Description'		=> $response->getstatusDesc(),
				'RRN'						=> $response->getrrn(),
			    'Authzcode'					=> $response->getauthZCode(),
				'Response_code'				=> $response->getresponseCode(),
				'orderDate'					=> $response->gettrnReqDate(),
				'orderStatus'				=> $response->getstatusCode()
          	);
			//------------------------------------------------//
			$this->indirect_client_model->setReqBooking($data_book);
			$this->indirect_client_model->process_request_online($inputArray_payment,$invoice_item_data);
			$email_template_id='bdfd372e-2c44-31'; //Booking service template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $session_booking_data['price'];
			$fullname		= ucfirst($data['userData']['FirstName']).' '.ucfirst($data['userData']['LastName']);
			$body 			= str_replace('[amount including taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
            $from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
            $from_name 		= ucfirst('Team Smartworks');
            
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($data['userData']['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $data['userData']['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$path = set_realpath('assets/uploads/attachments/'); // real path of directory
			$attachment_name = 'Smartworks_'.date('d_M_Y').'.pdf'; // pdf attachment file name
			if(is_dir($path)){
				$data_invoice = array();
				$data_invoice['logo_img'] 		= $this->gallery_path_url.'logo.png';
				$data_invoice['userName'] 		= $fullname;
				$data_invoice['table_name'] 	= $session_booking_data['tbl_name'];
				$data_invoice['invoice_number'] = $invoice_data[0]['invoice_number'];
				$data_invoice['bookings'] 		= $tempData;
				$data_invoice['priceIncTax'] 	= $session_booking_data['price'];
				$data_invoice['tax'] 			= SERVICE_TAX;
				$data_invoice['priceExcTax'] 	= (($session_booking_data['price'])/(1+($data_invoice['tax']/100)));
				$html = $this->load->view('booking_invoice_pdf', $data_invoice, true);
				ini_set('memory_limit','32M');
				$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->SetTitle("Smartworks - Booking Cinference Room Invoice");
				$mpdf->SetAuthor("Smartworks Co.");
				$mpdf->WriteHTML($html,2);
				$pdfname = $path.$attachment_name;
			    $mpdf->Output($pdfname,'F'); 
				$this->email->attach($pdfname);  /* Enables you to send an attachment */
			}
			$this->email->send(); // Send mail to client
			$file = $path . $attachment_name;
			if(is_file($file))
        		unlink($file); // delete attachment file
			$this->session->unset_userdata('dataArray');

			$this->load->view('payment_success',$data);
 		}
		else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
	}
	/*Book Conference Room end here*/

	/*Book Meeting Room start here*/
	public function book_meeting_room(){
		authenticate(array('ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['meeting_data']=$this->indirect_client_model->getmeetingbybusiness($data['business_data'][0]['business_id']);
		if(!empty($data['meeting_data'])){
			$starttime = strtotime($data['meeting_data'][0]['start_time']); 
			$endtime = strtotime($data['meeting_data'][0]['end_time']); 
			$data['diff'] = abs($endtime - $starttime) / 3600;
		}
		$this->load->view("book_meeting_room",$data);	  
	}
	public function getCalenderMeeting(){
		$data = array();
		$html = '';
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$meeting_id = $this->input->post('meeting_id');
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['meeting_data']=$this->indirect_client_model->getMeetingData($meeting_id);
		$data['booked']=$this->indirect_client_model->getBookSlotsMeeting($meeting_id);
		$this->load->view("ajax_calender_meeting",$data);
	}
	public function setBookMeetingRoom(){
		$slotArray = [];
		$data 	= array();
		$flag 	= $this->input->post('flag');
		$date 	= $this->input->post('date');
		$time 	= $this->input->post('time');
		$price 	= $this->input->post('price');
		if($flag == 1){
			$slot = array($date,$time,$price);
			if($this->session->userdata("dataMeetingArray") != ''){
				$slotArray = $this->session->userdata("dataMeetingArray");
				array_push($slotArray,$slot);
			}else{
				array_push($slotArray,$slot);	
			}
		}elseif($flag == 0){
			if($this->session->userdata("dataMeetingArray") != ''){
				$slotArray = $this->session->userdata("dataMeetingArray");
			}
			foreach($slotArray as $key=>$val){
				if($val[0] == $date && $val[1] == $time){
					unset($slotArray[$key]);
				}
			}
		}
		$this->session->set_userdata("dataMeetingArray",$slotArray);
		$tempArraySlot = $this->session->userdata("dataMeetingArray");
		$tempDataSlot = array();
		foreach($tempArraySlot as $temp){
			$tempDataSlot[$temp[0]]['slot'][] 	= $temp[1] ;
			$tempDataSlot[$temp[0]]['rate'] 	= $temp[2];
			$tempDataSlot[$temp[0]]['count'] 	= count($tempDataSlot[$temp[0]]['slot']);
			$tempDataSlot[$temp[0]]['price'] 	= ($temp[2]*count($tempDataSlot[$temp[0]]['slot']));
		}
		$data['price_table_details'] = $tempDataSlot;
		$this->load->view("price_table",$data);
	}
	public function setbookingMeetingRequest(){
		$data = array();
		$meeting_id = $this->input->post('meeting_id');
		$purpose = $this->input->post('purpose');
		$price = $this->input->post('price');
		$userId = $this->session->userdata("userId");
		$userData = $this->login->getUserProfile($userId);
        $data['id'] = substr(create_guid(),0,16);
		$data['meeting_room_id'] = $meeting_id;
		$tempArray = $this->session->userdata("dataMeetingArray");
		if(!empty($tempArray)){
			$tempData = array();
			foreach($tempArray as $temp){
				$tempData[$temp[0]][] = $temp[1] ;
			}
			$data['booking_details'] = json_encode($tempData);
			$data['price'] = $price;
			$data['purpose'] = $purpose;
			$data['is_shared'] = 1;
			$data['book_for'] = $userId;
			$data['is_approved'] = 1; //No need to further approved in smartworks 1st phase for booking meeting room
			$data['addedBy'] =$userId;
			$data['dateAdded'] =date('Y-m-d h:i:s');
			$data['deleted'] =0;
			$data['company_id'] =$userData['company_id'];

			$tbname ='book_meeting_room';
			$appid = $data['id'];

			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($this->session->userdata("company_id"));
			$invoice_id=$invoice_data[0]['id'];
			$invoice_price=$invoice_data[0]['sub_total']+$price;

			$invoice_data=array(
				'sub_total'=>$invoice_price
			);

			$invoice_item_data=array(
				'id'=>substr(create_guid(),0,16),
				'invoice_id'=>$invoice_id,
				'description'=>$data['purpose'],
				'quantity'=>'1',
				'unit_price'=>$price,
				'total'=>$price,
				'table_name'=>$tbname,
				'row_id'=>$appid
			);

			$status = $this->indirect_client_model->setReqBookingMeeting($data);
			$this->indirect_client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
			$this->session->unset_userdata('dataMeetingArray');

			$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $data['price'];
			$fullname		= ucfirst($userData['userData']['FirstName']).' '.ucfirst($userData['userData']['LastName']);
			$body 			= str_replace('[amount excluding taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
			$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
			$from_name 		= ucfirst('Team Smartworks');
	        
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			//$this->email->to('sohom@simayaa.com,aparajita@simayaa.com');
			$this->email->to($userData['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $userData['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			if($this->email->send()){ // Send mail to client
				echo json_encode($status);
			}
		}else{
			echo json_encode('noslotsSelected');
		}
	}
	public function bookingMeetingRequestOnline(){
			$this->session->unset_userdata('booking_data');
			$booking_data 						= array();
			$userId 							= $this->session->userdata("userId");
			$userData 							= $this->login->getUserProfile($userId);
	        $booking_data['id'] 				= substr(create_guid(),0,16);
			$booking_data['meeting_room_id'] 			= $this->input->post('meeting_id');
			$booking_data['purpose'] 			= $this->input->post('hidPurpose');
			$booking_data['price'] 				= $this->input->post('price');
			$booking_data['orderid']			= $this->input->post('orderID');
			$booking_data['user_id']			= $this->session->userdata("userId");
			$booking_data['company_id'] 		= $userData['company_id'];
			$booking_data['tbl_name'] 			= 'book_meeting_room';
		    $this->session->set_userdata('booking_data', $booking_data);
			$responseUrl = $this->config->item('base_url').'index.php/client/booking_meeting_payment_response';
			$price = ($booking_data['price']*100);
			$this->atos->load(MID,$booking_data['orderid'],$price,ME_TRANS_REQ_TYPE,ENCKEY,CURRENCY_NAME,$responseUrl,$this->atos_url);	
	}
	public function booking_meeting_payment_response(){
		authenticate(array('ut11'));
		$session_booking_data = $this->session->userdata['booking_data'];
		$userId = $session_booking_data['user_id'];
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$this->session->unset_userdata($this->session->userdata['booking_data']);
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		if ($response->getStatusCode()=="S"){
			//---------------------book_meeting_room table data start here---------------------------//
			$data_book = array();
			$data_book['id'] 				= $session_booking_data['id'];
			$data_book['meeting_room_id'] 	= $session_booking_data['meeting_room_id'];
			$tempData = array();
			$tempArray = $this->session->userdata("dataMeetingArray");
			foreach($tempArray as $temp){
				$tempData[$temp[0]][] = $temp[1] ;
			}
			$data_book['booking_details']	= json_encode($tempData);
			$data_book['price'] 			= $session_booking_data['price'];
			$data_book['purpose'] 			= $session_booking_data['purpose'];
			$data_book['is_shared'] 		= 1;
			$data_book['book_for'] 			= $session_booking_data['user_id'];
			$data_book['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data_book['addedBy'] 			= $session_booking_data['user_id'];
			$data_book['dateAdded'] 		= date('Y-m-d h:i:s');
			$data_book['deleted'] 			= 0;
			$data_book['company_id'] 		= $session_booking_data['company_id'];
			//---------------------Invoice Item table data start here---------------------------//
			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($session_booking_data['company_id']);
			$invoice_id=$invoice_data[0]['id'];
			$invoice_item_id = substr(create_guid(),0,16);
			$invoice_item_data=array(
				'id'			=>$invoice_item_id,
				'invoice_id'	=>$invoice_id,
				'description'	=>$session_booking_data['purpose'],
				'quantity'		=>'1',
				'unit_price'	=>$session_booking_data['price'],
				'payment_status'=>'1',
				'total'			=>$session_booking_data['price'],
				'table_name'	=>$session_booking_data['tbl_name'],
				'row_id'		=>$session_booking_data['id']
			);
			//---------------------Payment table data start here---------------------------//
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'					=> $paymentId,
				'userId'					=> $session_booking_data['user_id'],
				'details'					=> 'Booking meeting room online',
				'payment_Data'				=> json_encode((array)$response),
				'Transaction_Reference_No'	=> $response->getpgMeTrnRefNo(),
				'orderId'					=> $response->getOrderId(),
				'invoice_item_number'		=> $invoice_item_id,
				'Amount'					=> $response->getTrnAmt(),
				'Status_Description'		=> $response->getstatusDesc(),
				'RRN'						=> $response->getrrn(),
			    'Authzcode'					=> $response->getauthZCode(),
				'Response_code'				=> $response->getresponseCode(),
				'orderDate'					=> $response->gettrnReqDate(),
				'orderStatus'				=> $response->getstatusCode()
          	);
			//------------------------------------------------//
			$this->indirect_client_model->setReqBookingMeeting($data_book);
			$this->indirect_client_model->process_request_online($inputArray_payment,$invoice_item_data);
			$this->session->unset_userdata('dataMeetingArray');
			
			$email_template_id='bdfd372e-2c44-31'; //Booking online service template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $session_booking_data['price'];
			$fullname 		= ucfirst($data['userData']['FirstName']).' '.ucfirst($data['userData']['LastName']);
			$body 			= str_replace('[amount including taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
            $from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
            $from_name 		= ucfirst('Team Smartworks');
            
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($data['userData']['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $data['userData']['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$path = set_realpath('assets/uploads/attachments/'); // real path of directory
			$attachment_name = 'Smartworks_'.date('d_M_Y').'.pdf'; // pdf attachment file name
			if(is_dir($path)){
				$data_invoice = array();
				$data_invoice['logo_img'] 		= $this->gallery_path_url.'logo.png';
				$data_invoice['userName'] 		= $fullname;
				$data_invoice['table_name'] 	= $session_booking_data['tbl_name'];
				$data_invoice['invoice_number'] = $invoice_data[0]['invoice_number'];
				$data_invoice['bookings'] 		= $tempData;
				$data_invoice['priceIncTax'] 	= $session_booking_data['price'];
				$data_invoice['tax'] 			= SERVICE_TAX;
				$data_invoice['priceExcTax'] 	= (($session_booking_data['price'])/(1+($data_invoice['tax']/100)));
				$html = $this->load->view('booking_invoice_pdf', $data_invoice, true);
				ini_set('memory_limit','32M');
				$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->SetTitle("Smartworks - Booking Meeting Room Invoice");
				$mpdf->SetAuthor("Smartworks Co.");
				$mpdf->WriteHTML($html,2);
				$pdfname = $path.$attachment_name;
			    $mpdf->Output($pdfname,'F'); 
				$this->email->attach($pdfname);  /* Enables you to send an attachment */
			}
			$this->email->send(); // Send mail to client
			$file = $path . $attachment_name;
			if(is_file($file))
        		unlink($file); // delete attachment file
			$this->load->view('payment_success',$data);
 		}
		else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
	}
	/*Book Meeting Room end here*/

	/*Book Day Office start here*/
	public function book_day_office(){
		authenticate(array('ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['dayoffice_data']=$this->indirect_client_model->getdayofficebybusiness($data['business_data'][0]['business_id']);
		if(!empty($data['conference_data'])){
			$starttime = strtotime($data['conference_data'][0]['start_time']); 
			$endtime = strtotime($data['conference_data'][0]['end_time']); 
			$data['diff'] = abs($endtime - $starttime) / 3600;
		}
		$this->load->view("book_dayoffice_room",$data);
	}
	public function getCalenderDayOffice(){
		$data = array();
		$html = '';
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$dayoffice_id = $this->input->post('dayoffice_id');
		$data['business_data']=$this->indirect_client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['dayoffice_data']=$this->indirect_client_model->getDayofficeData($dayoffice_id);
		$data['booked']=$this->indirect_client_model->getBookSlotsDayOffice($dayoffice_id);
		$this->load->view("ajax_calender_dayoffice",$data);
	}
	public function setBookDayOfficeRoom(){
		$slotArray = [];
		$data = array();
		$flag = $this->input->post('flag');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$price = $this->input->post('price');
		$is_sameDate = 0;
		if($flag == 1){
			$slot = array($date,$time,$price);
			if($this->session->userdata("dataDayOfficeArray") != ''){
				$slotArray = $this->session->userdata("dataDayOfficeArray");
				foreach($slotArray as $key=>$val){
					if($val[0] != $date){
						$is_sameDate = 1;
						$data['error'] = 'Please select slot(s) within one date not different dates.';
						$data['date'] = $date; 
						$data['time'] = $time; 
					}
				}
				if($is_sameDate == 0){
					array_push($slotArray,$slot);
				}
			}else{
				array_push($slotArray,$slot);	
			}
		}elseif($flag == 0){
			if($this->session->userdata("dataDayOfficeArray") != ''){
				$slotArray = $this->session->userdata("dataDayOfficeArray");
			}
			foreach($slotArray as $key=>$val){
				if($val[0] == $date && $val[1] == $time){
					unset($slotArray[$key]);
				}
			}
		}
		$this->session->set_userdata("dataDayOfficeArray",$slotArray);

		$tempArraySlot = $this->session->userdata("dataDayOfficeArray");
		$tempDataSlot = array();
		foreach($tempArraySlot as $temp){
			$tempDataSlot[$temp[0]]['slot'][] = $temp[1] ;
			$tempDataSlot[$temp[0]]['rate'] = $temp[2];
			$tempDataSlot[$temp[0]]['count'] = count($tempDataSlot[$temp[0]]['slot']);
			$tempDataSlot[$temp[0]]['price'] = ($temp[2]*count($tempDataSlot[$temp[0]]['slot']));
		}
		if($is_sameDate == 0){
			$data['price_table_details'] = $tempDataSlot;
		}
		$this->load->view("price_table",$data);
	}
	public function setbookingDayOfficeRequest(){
		$data = array();
		$dayoff_id = $this->input->post('dayoffice_id');
		$purpose = $this->input->post('purpose');
		$price = $this->input->post('price');
		$userId = $this->session->userdata("userId");
		$userData = $this->login->getUserProfile($userId);
        $data['id'] = substr(create_guid(),0,16);
		$data['dayoffice_id'] = $dayoff_id;
		$tempArray = $this->session->userdata("dataDayOfficeArray");
		if(!empty($tempArray)){
			$tempData = array();
			foreach($tempArray as $temp){
				$tempData[$temp[0]][] = $temp[1] ;
			}
			$data['booking_details'] = json_encode($tempData);
			$data['price'] = $price;
			$data['purpose'] = $purpose;
			$data['is_shared'] = 1;
			$data['book_for'] = $userId;
			$data['is_approved'] = 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data['addedBy'] =$userId;
			$data['dateAdded'] =date('Y-m-d h:i:s');
			$data['deleted'] =0;
			$data['company_id'] =$userData['company_id'];

			$tbname ='book_dayoffice';
			$appid = $data['id'];

			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($this->session->userdata("company_id"));
			$invoice_id=$invoice_data[0]['id'];
			$invoice_price=$invoice_data[0]['sub_total']+$price;

			$invoice_data=array(
			'sub_total'=>$invoice_price
			);

			$invoice_item_data=array(
			'id'=>substr(create_guid(),0,16),
			'invoice_id'=>$invoice_id,
			'description'=>$data['purpose'],
			'quantity'=>'1',
			'unit_price'=>$price,
			'total'=>$price,
			'table_name'=>$tbname,
			'row_id'=>$appid
			);
			$status = $this->indirect_client_model->setReqBookingDayoffice($data);
			$this->indirect_client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
			$this->session->unset_userdata('dataDayOfficeArray');
			
			$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $data['price'];
			$fullname		= ucfirst($userData['FirstName']).' '.ucfirst($userData['LastName']);
			$body 			= str_replace('[amount excluding taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
			$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
			$from_name 		= ucfirst('Team Smartworks');
	        
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			//$this->email->to('sohom@simayaa.com,aparajita@simayaa.com');
			$this->email->to($userData['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $userData['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			if($this->email->send()){ // Send mail to client
				echo json_encode($status);
			}
		}else{
			echo json_encode('noslotsSelected');
		}
	}
	public function setbookingDayOfficeRequestOnline(){
			$this->session->unset_userdata('booking_data');
			$booking_data 						= array();
			$userId 							= $this->session->userdata("userId");
			$userData 							= $this->login->getUserProfile($userId);
	        $booking_data['id'] 				= substr(create_guid(),0,16);
			$booking_data['dayoffice_id'] = $this->input->post('dayoffice_id');
			$booking_data['purpose'] 			= $this->input->post('hidPurpose');
			$booking_data['price'] 				= $this->input->post('price');
			$booking_data['orderid']			= $this->input->post('orderID');
			$booking_data['user_id']			= $this->session->userdata("userId");
			$booking_data['company_id'] 		= $userData['company_id'];
			$booking_data['tbl_name'] 			= 'book_dayoffice';
		    $this->session->set_userdata('booking_data', $booking_data);
			$responseUrl = $this->config->item('base_url').'index.php/client/booking_dayoffice_payment_response';
			$price = ($booking_data['price']*100);
			$this->atos->load(MID,$booking_data['orderid'],$price,ME_TRANS_REQ_TYPE,ENCKEY,CURRENCY_NAME,$responseUrl,$this->atos_url);	
	}
	public function booking_dayoffice_payment_response(){
		authenticate(array('ut11'));
		$session_booking_data = $this->session->userdata['booking_data'];
		$userId = $session_booking_data['user_id'];
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$this->session->unset_userdata($this->session->userdata['booking_data']);
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		if ($response->getStatusCode()=="S"){
			//---------------------book_conference_room table data start here---------------------------//
			$data_book = array();
			$data_book['id'] 			= $session_booking_data['id'];
			$data_book['dayoffice_id'] 	= $session_booking_data['dayoffice_id'];
			$tempData = array();
			$tempArray = $this->session->userdata("dataDayOfficeArray");
			foreach($tempArray as $temp){
				$tempData[$temp[0]][] = $temp[1] ;
			}
			$data_book['booking_details']	= json_encode($tempData);
			$data_book['price'] 			= $session_booking_data['price'];
			$data_book['purpose'] 			= $session_booking_data['purpose'];
			$data_book['is_shared'] 		= 1;
			$data_book['book_for'] 			= $session_booking_data['user_id'];
			$data_book['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
			$data_book['addedBy'] 			= $session_booking_data['user_id'];
			$data_book['dateAdded'] 		= date('Y-m-d h:i:s');
			$data_book['deleted'] 			= 0;
			$data_book['company_id'] 		= $session_booking_data['company_id'];
			//---------------------Invoice Item table data start here---------------------------//
			$invoice_data=$this->indirect_client_model->get_invoice_by_comid($session_booking_data['company_id']);
			$invoice_id=$invoice_data[0]['id'];
			$invoice_item_id = substr(create_guid(),0,16);
			$invoice_item_data=array(
				'id'			=>$invoice_item_id,
				'invoice_id'	=>$invoice_id,
				'description'	=>$session_booking_data['purpose'],
				'quantity'		=>'1',
				'unit_price'	=>$session_booking_data['price'],
				'payment_status'=>'1',
				'total'			=>$session_booking_data['price'],
				'table_name'	=>$session_booking_data['tbl_name'],
				'row_id'		=>$session_booking_data['id']
			);
			//---------------------Payment table data start here---------------------------//
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'					=> $paymentId,
				'userId'					=> $session_booking_data['user_id'],
				'details'					=> 'Booking day office online',
				'payment_Data'				=> json_encode((array)$response),
				'Transaction_Reference_No'	=> $response->getpgMeTrnRefNo(),
				'orderId'					=> $response->getOrderId(),
				'invoice_item_number'		=> $invoice_item_id,
				'Amount'					=> $response->getTrnAmt(),
				'Status_Description'		=> $response->getstatusDesc(),
				'RRN'						=> $response->getrrn(),
			    'Authzcode'					=> $response->getauthZCode(),
				'Response_code'				=> $response->getresponseCode(),
				'orderDate'					=> $response->gettrnReqDate(),
				'orderStatus'				=> $response->getstatusCode()
          	);

			//------------------------------------------------//
			$this->indirect_client_model->setReqBookingDayoffice($data_book);
			$this->indirect_client_model->process_request_online($inputArray_payment,$invoice_item_data);
			$this->session->unset_userdata('dataDayOfficeArray');

			$email_template_id='bdfd372e-2c44-31'; //Booking online service template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$price 			= $session_booking_data['price'];
			$fullname		= ucfirst($data['userData']['FirstName']).' '.ucfirst($data['userData']['LastName']);
			$body 			= str_replace('[amount including taxes]',$price,$body);
			$body 			= str_replace('[client full name]',$fullname,$body);
            $from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
            $from_name 		= ucfirst('Team Smartworks');
            
	  		/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($data['userData']['userEmail'].',sohom@simayaa.com,aparajita@simayaa.com'); // $data['userData']['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$path = set_realpath('assets/uploads/attachments/'); // real path of directory
			$attachment_name = 'Smartworks_'.date('d_M_Y').'.pdf'; // pdf attachment file name
			if(is_dir($path)){
				$data_invoice = array();
				$data_invoice['logo_img'] 		= $this->gallery_path_url.'logo.png';
				$data_invoice['userName'] 		= $fullname;
				$data_invoice['table_name'] 	= $session_booking_data['tbl_name'];
				$data_invoice['invoice_number'] = $invoice_data[0]['invoice_number'];
				$data_invoice['bookings'] 		= $tempData;
				$data_invoice['priceIncTax'] 	= $session_booking_data['price'];
				$data_invoice['tax'] 			= SERVICE_TAX;
				$data_invoice['priceExcTax'] 	= (($session_booking_data['price'])/(1+($data_invoice['tax']/100)));
				$html = $this->load->view('booking_invoice_pdf', $data_invoice, true);
				ini_set('memory_limit','32M');
				$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
				$mpdf->SetDisplayMode('fullpage');
				$mpdf->SetTitle("Smartworks - Booking Day Office Invoice");
				$mpdf->SetAuthor("Smartworks Co.");
				$mpdf->WriteHTML($html,2);
				$pdfname = $path.$attachment_name;
			    $mpdf->Output($pdfname,'F'); 
				$this->email->attach($pdfname);  /* Enables you to send an attachment */
			}
			$this->email->send(); // Send mail to client
			$file = $path . $attachment_name;
			if(is_file($file))
        		unlink($file); // delete attachment file
			$this->load->view('payment_success',$data);
 		}
		else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
	}
	/*Book Day Office end here*/
}
