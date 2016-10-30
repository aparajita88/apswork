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
		$this->load->model('receptionist/receptionist_listing');
		$this->load->model('receptionist/receptionist_login');
		$this->load->model('rooms/rooms_model');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$this->load->model('invoice/invoice_model');
		
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
        $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['room_data_conference']=$this->rooms_model->getbusinesslocation($data['business_data'][0]['business_id'],'conference');
		$data['room_data_meeting']=$this->rooms_model->getbusinesslocation($data['business_data'][0]['business_id'],'meeting');
		$data['room_data_day']=$this->rooms_model->getbusinesslocation($data['business_data'][0]['business_id'],'dayoffice');
		$data['mainArray'] = array('Conference Room' => $data['room_data_conference'],'Meeting Room' => $data['room_data_meeting'],'Day office'=>$data['room_data_day']);
		$book_data['bookingdate']=date('d-m-Y');
		$book_data['bookingid']=$data['room_data_conference'][0]['id'];
		$book_data['bookingtype']="Conference Room";
		$booking_listing=$this->receptionist_listing->get_bookdata_bydate($book_data);
		foreach($booking_listing as $bklist){
			$booking_status=$this->receptionist_listing->get_check_info_byid($bklist['id']);
			$booking_details_arr=json_decode($bklist['booking_details']);
				if($bklist['book_for']<>$bklist['company_id']){
					$clientname=$bklist['FirstName']." ".$bklist['LastName']."(".$bklist['company_name'].")";
				}
			    else{
			    	$clientname=$bklist['FirstName']." ".$bklist['LastName']."(Individual)";
			    }
			
			if(!empty($booking_details_arr->$book_data['bookingdate'])){
				foreach($booking_details_arr->$book_data['bookingdate'] as $k=>$v){
					$timestamp = strtotime($v) + 60*60;
					$start_time=date('h:i A',strtotime($v));
	                $time = date('h:i A', $timestamp);
	                $checkstatus=array(
	                	'booking_id'=>$bklist['id'],
	                	'booking_date'=>date('Y-m-d',strtotime($book_data['bookingdate'])),
	                	'start_time'=>$start_time,
	                	'end_time'=>$time
	                	);
					$checking_status=$this->receptionist_listing->get_checkinstatus_forbooking($checkstatus);
					if(count($checking_status)>0){
                    	$status=$checking_status[0]['status'];
                    }else{
                    	$status=0;
                    }
						$booking_data[]=array(
						'id'=>$bklist['id'],
						'table'=>'book_conference_room',
						'date'=>$book_data['bookingdate'],
						'start_time'=>$start_time,
						'end_time'=>$time,
						'Room'=>$bklist['name'],
						'client'=>$clientname,
						'status'=>$status
						);
								
			    }
			}
			

		}
		if(empty($booking_data)){
			$data['book_data']="";
		}else{
			$data['book_data']=$booking_data;
		}

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
		
		$data['todo']=$this->client_model->get_todo($userId);
		if($userId!="" && $userTypeId=="ut7"){
		$this->load->view("vmanager_dashboard", $data);
		
		}
	}
	public function service_request(){
		authenticate(array('ut7','ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['legal_support']=$this->service_request->get_service($legal_data);
		$data['courier_support']=$this->service_request->get_courier_service($legal_data);
		$data['staff_type']=$this->service_request->get_service_type();
		$this->load->view('vlegal_support',$data);
	}
	public function get_request_by_id(){
		authenticate(array('ut7','ut5'));
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
		authenticate(array('ut7','ut5'));
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
		$req_client_data=$this->service_request->get_request_client_info($appid,$tbname);
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
		$email_template_id='af2e0608-c88a-d7';
		$email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $contname=$req_client_data[0]['FirstName']." ".$req_client_data[0]['LastName'];
		 $ticket_no=$req_client_data[0]['ticketId'];
		 $email=$req_client_data[0]['userEmail'];
		 $body = str_replace('[Customer Full Name]',$contname,$body);
		 $body = str_replace('[Ticket No.]',$ticket_no,$body);
		 	
		 $from_email='sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($email); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		$this->service_request->set_approved_request($appdata,$appid,$invoice_id,$invoice_data,$invoice_item_data,$tbname);
	}
	public function reject_request(){
		authenticate(array('ut7','ut5'));
		$appdata=array(
		  'IsApproved'=>'2'
		);
		$email_template_id='358f39d3-356e-30';
		$email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $req_client_data=$this->service_request->get_request_client_info($this->input->post('appid'),$this->input->post('tbname'));
		 $contname=$req_client_data[0]['FirstName']." ".$req_client_data[0]['LastName'];
		 $ticket_no=$req_client_data[0]['ticketId'];
		 $email=$req_client_data[0]['userEmail'];
		 $body = str_replace('[client fullname]',$contname,$body);
		 $body = str_replace('[Ticket No.]',$ticket_no,$body);
		 	
		 $from_email='sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($email); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
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
		$this->session->unset_userdata('seatid');
		$data['floor_plan']=$this->floor_plan->ger_floor_plan_byid($this->input->post('floor_id'));
		$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		$this->load->view('vsit_map',$data);
	}
	public function get_floor_plan_by_floorid_and_date(){
		$data['floor_plan']=$this->floor_plan->ger_floor_plan_byid($this->input->post('floor_id'));
		$data['floor_plan_seat']=$this->floor_plan->get_floor_plan_seat($data['floor_plan'][0]['floor_id']);
		$start_date=$this->input->post('startdate');
		$end_date=$this->input->post('enddate');
		$booking_seat=$this->booking_info->get_booking_seat_info_bydate($start_date,$end_date);
		$book_seat_details=array();
		foreach($booking_seat as $book_seat){
			$book_seat_details['id'][]=$book_seat['booking_detailes'];
			$book_seat_details['start_date'][]=$book_seat['start_date'];
			$book_seat_details['end_date'][]=$book_seat['end_date'];
			$book_seat_details['client'][]=$book_seat['FirstName']." ".$book_seat['LastName'];

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
			unset($seatidarr);
            for($k=0;$k<count($bkinfodata);$k++){
				$expseatinfo=explode(":",$bkinfodata[$k]);
				$seatinfo=$this->booking_info->get_seat_title($expseatinfo[0]);
				$seatidarr[$k]=$seatinfo[0]['Title'];
			}
			$data['booking_info'][$i]['title']=json_encode($seatidarr);
			if($bkinfo['book_for_client']!=""){
				$company=$bkinfo['Isclient'];
				if($company==1){
					$clntinfo=$this->booking_info->clntinfo($bkinfo['book_for_client'],$company);
					
					$data['booking_info'][$i]['clntname']=$clntinfo[0]['FirstName']." ".$clntinfo[0]['LastName'];
					$data['booking_info'][$i]['company_name']=$clntinfo[0]['company_name'];
				
				}else if($company==0){
					$clntinfo=$this->booking_info->clntinfo($bkinfo['book_for_client'],$company);
					
					$data['booking_info'][$i]['clntname']=$clntinfo[0]['FirstName']." ".$clntinfo[0]['LastName'];
					$data['booking_info'][$i]['company_name']=$clntinfo[0]['company_name'];
				}
				
			}else{
                  $data['booking_info'][$i]['clntname']="";
					$data['booking_info'][$i]['company_name']="";
			}
			$i++;
		}
		
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
			$this->load->view('vbooking_details',$data);
	}
	public function get_booking_details($tbname){
	 authenticate(array('ut7','ut5'));
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
	 
		
	 }
	 public function get_booking_details_for_game($tbname){
		 authenticate(array('ut7','ut5'));
		 $userId = $this->session->userdata("userId");
			$userTypeId = $this->session->userdata("userTypeId");
			if($userTypeId=='ut7'){
				$data['userData'] = $this->login->getUserProfile($userId);
			}else if($userTypeId=='ut5'){
				$data['userData'] = $this->receptionist_login->getUserProfile($userId);
			}
			
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
		 authenticate(array('ut7','ut5'));
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
			$data['booking_info']=$this->booking_info->get_booking_view_byid($legal_data,$appid,$tbname);
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
						if($_POST['business'] != ''){
							$bussness_data = $this->lm->get_business_details($_POST['business']);
						}
						$loc_man_email = $manager['userEmail'];
						$loc_man_fullname = ucfirst($manager['FirstName']).' '.ucfirst($manager['LastName']);
						$ad = $mail_to_and_cc['area_director'][0]['userEmail'];
						$body = $email_template_location_manager['description'];
						$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
						$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
						$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
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
							$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
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
						if($_POST['business'] != ''){
							$bussness_data = $this->lm->get_business_details($_POST['business']);
						}
						$loc_man_email = $manager['userEmail'];
						$loc_man_fullname = ucfirst($manager['FirstName']).' '.ucfirst($manager['LastName']);
						$ad = $mail_to_and_cc['area_director'][0]['userEmail'];
						$body = $email_template_location_manager['description'];
						$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
						$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
						$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
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
							$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
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
	public function getBusinessByCityLocation(){
		$val		=	$this->input->post('val');
		$temp 		= 	explode('/', $val);
		$this->db->select('business_centers.*');
		$this->db->where('locationId', $temp[0]);
		$this->db->where('cityId', $temp[1]);
		$this->db->where('deleted', 0);
		$this->db->from('business_centers');
		$query = $this->db->get();
		$business = $query->result_array();
		echo '<option value="">Select Business</option>';
		foreach($business as $value) {
       	echo '<option value="'.$value['business_id'].'">'.ucfirst($value['businessName']).'</option>';
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
				$addStatus = $this->istusermodel->addNeedAnalysis($data_en,$_POST['registered_user_id']);
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
	 	if (isset($_POST) && (!empty($_POST))){
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

				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
				$img=$upName;
				return $img;
			}

		}else{
			
		}	
		
	}
	
	/*************Invoice Part start here****************/
	public function all_bills(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['table_header_date'] = 'Date';
		$data['table_header_amount'] = 'Amount';
		$data['table_header_description'] = 'Description';
		$data['table_header_action'] = 'Action';
		$flag 	= $this->uri->segment(2);
		$com_id = $this->uri->segment(3);
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'Invoices';
			$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();	
	        $temp_ut4 = $query->result_array();	
	        $this->db->select('user.*');
			$this->db->from('user');
			$this->db->where("user.userTypeId = 'ut11'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut11_temp = $query->result_array();
	        $temp_ut11 = array();
	        foreach ($temp_ut11_temp as $key => $value) {
	        	$temp_ut11[] = $value;
	        	$temp_ut11[$key]['company_name'] = 'Individual'; 
	        }
	        $data['userlist'] = array_merge($temp_ut4,$temp_ut11);
			if($com_id != ''){
				$company_id = base64_decode(base64_decode($com_id));
				$data['invoice'] = $this->invoice_model->getInvoice($company_id,$flag);
				$this->load->view("all_bills",$data);
			}else{
				$this->load->view("user_list",$data);
			}
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function account_statements(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['acc_statement'] = array();
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'Invoices';
			$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut4 = $query->result_array();	
	        $this->db->select('user.*');
			$this->db->from('user');
			$this->db->where("user.userTypeId = 'ut11'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut11_temp = $query->result_array();
	        $temp_ut11 = array();
	        foreach ($temp_ut11_temp as $key => $value) {
	        	$temp_ut11[] = $value;
	        	$temp_ut11[$key]['company_name'] = 'Individual'; 
	        }
	        $data['userlist'] = array_merge($temp_ut4,$temp_ut11);
			if ($this->input->post()){
				$data['com_id'] 	= $this->input->post('com_id');
				$ud = explode('|++|', $this->input->post('com_id'));
		        $data['userDetails'] = $this->login->getUserProfile($ud[1]);
				$data['start_date'] = $this->input->post('start_date');
				$temp_start_date 	= explode('-', $data['start_date']);
				$data['end_date']	= $this->input->post('end_date');
				$temp_end_date 		= explode('-', $data['end_date']);
				//-------------------------------------------------------
				$starting_balance = $this->invoice_model->get_starting_balance($ud[0],$temp_start_date);
				$starting_balance = ($starting_balance!= '') ? $starting_balance : 0;
				$data['acc_statement']['staring_balance'] 		= $starting_balance;
				//------------------------------------------------------
				$record_invoices 		= $this->invoice_model->get_invoices($ud[0],$temp_start_date,$temp_end_date);
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
	public function generate_invoice_html_view($invid = '',$com_id = ''){
		authenticate(array('ut7'));
		if($invid == ''){
			die('Not accessable this page');
		}elseif($com_id == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($invid));
		$company_id = base64_decode(base64_decode($com_id));
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['title'] = 'Smartworks - Invoice';
		$data['company'] = $this->invoice_model->getCompanyDetails($company_id);
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
		$this->load->view('invoice/html_view_first', $data);
		$this->load->view('invoice/html_view_second', $data);
		$this->load->view('invoice/html_view_third', $data);
		$this->load->view('invoice/html_view_fourth', $data);
	}
	public function generate_invoice_pdf($invid = '',$com_id = ''){
		authenticate(array('ut7'));
		if($invid == ''){
			die('Not accessable this page');
		}elseif($com_id == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($invid));
		$company_id = base64_decode(base64_decode($com_id));
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['company'] = $this->invoice_model->getCompanyDetails($company_id);
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
		$html = $this->load->view('invoice/pdf_html_first', $data, true);
		$html1 = $this->load->view('invoice/pdf_html_second', $data, true);
		$html3 = $this->load->view('invoice/pdf_html_third', $data, true);
		$html4 = $this->load->view('invoice/pdf_html_fourth', $data, true);
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
	/*************Invoice Part End here****************/
	public function floor_image(){
	 	authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$data['userData'] = $this->login->getUserProfile($userId);
	  	$this->load->view("floor_image",$data);	
	}
	public function getfloorplanservicebybusiness($bussid){
		$floorservice=$this->floor_plan->getservice_bybussid($bussid);
		$this->session->unset_userdata('seatid');
		if(count($floorservice)>0){
			$servicecost=0;
	        $internetcost=0;
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
	        echo json_encode(array('totalcost'=>$servicecost,'bookself_cost'=>$floorservice[0]['bookself_cost'],'internal_storage_cost'=>$floorservice[0]['internal_storage_cost'],'phone_cost'=>$floorservice[0]['phone_cost'],'wifi_cost'=>$floorservice[0]['wifi_cost'],'intspeed'=>$intspeed,'internet_cost'=>$internetcost,'int_cost_info'=>$floorservice[0]['internet_cost'],'speed'=>json_encode($speeddata)));
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
			'service_retainer'=>$this->input->post('service_retainer'),
			'comments'=>$this->input->post('comments')
			);
		$book_floor_plan_data=array(
			'book_for_client'=>$this->input->post('userId'),
			'Isclient'=>$this->input->post('Isclient'),
			'company'=>$company
			);

		$this->booking_info->add_agreement_data($agrement_data,$book_floor_plan_data);
		$url='<a href="'.base_url().'private_office_agreement/view/'.$agrement_data['book_floor_plan_id'].'">'.base_url().'private_office_agreement/view/'.$agrement_data['book_floor_plan_id'].'</a>';
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
	public function getUserList(){
		$id = $this->input->post('id');
		if($id != ''){
			$table_name = '';
			$html = "";
			switch ($id) {
		    case "eu":
		    	$this->db->select('user.*,company.company_name');
				$this->db->from('user');
				$this->db->join('company','company.id=user.company_id');
				$this->db->where("user.userTypeId = 'ut4'");
		        $this->db->where('user.status', 1);
		        $this->db->where('user.Isprimary', 1);
		        $query=$this->db->get();
		        $temp_ut4 = $query->result_array();	
		        $this->db->select('user.*');
				$this->db->from('user');
				$this->db->where("user.userTypeId = 'ut11'");
		        $this->db->where('user.status', 1);
		        $this->db->where('user.Isprimary', 1);
		        $query=$this->db->get();
		        $temp_ut11_temp = $query->result_array();
		        $temp_ut11 = array();
		        foreach ($temp_ut11_temp as $key => $value) {
		        	$temp_ut11[] = $value;
		        	$temp_ut11[$key]['company_name'] = 'Individual'; 
		        }
		        $clients = array_merge($temp_ut4,$temp_ut11);
		        $html.= '<select name="user_list" id="user_list" class="fform-control selection2">
                          <option value="">Select Existing Client</option>';
	            foreach($clients as $value) {
		             $html.= '<option value="'.$value['userId'].'">'.ucfirst($value['FirstName']).' '.ucfirst($value['LastName']).' ['.$value['userEmail'].']  '.ucfirst($value['company_name']).'</option>'; 
	            }
	            $html.='</select>';
		       	break;
		    case "ru":
		       	$this->db->select('*');
				$this->db->from('registered_user');
				$this->db->join('need_analysis','need_analysis.registered_user_id=registered_user.userId');
		        $this->db->where('registered_user.deleted', 0);
		        $query=$this->db->get();
		        $html.= '<select name="user_list" id="user_list" class="fform-control selection2">
                          <option value="">Select Prospect</option>';
	            foreach($query->result() as $value) {
		             $html.= '<option value="'.$value->userId.'">'.ucfirst($value->FirstName).' '.ucfirst($value->LastName).' ['.$value->userEmail.']</option>'; 
	            }
	            $html.='</select>';
		        break;
		    default:
		        echo "";
			}
			echo $html;
		}else{

		}
	}
	public function getCurrentHour(){
		echo trim(date('H')," ");
	}
	function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                
      return $password;
    }	
	/*Book Game Room start here*/
	public function getGameRoom($game_id){
		$data['get_game_room']=$this->client_model->get1stgameroom($game_id);   
	 	$this->load->view("ajax_gameroom",$data);		
   	}
   	public function book_game_room(){
	 	authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['game_data']=$this->client_model->getgamebybusiness($data['business_data'][0]['business_id']);
	  	$this->load->view("book_game_room",$data);	  
   	}
   	public function setbookingGameRoomRequest(){
		$data = array();
		$game_room_id 		= $this->input->post('game_room_id');
		$game_type 			= $this->input->post('game_type');
		$start_date 		= $this->input->post('start_date');
		$end_date 			= $this->input->post('end_date');
		$price 				= $this->input->post('price');
		$userId 			= $this->input->post("userId");
		$userData 			= $this->login->getUserProfile($userId);

		if(!empty($userData && count($userData) != 0) ){
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

				$invoice_data=$this->client_model->get_invoice_by_comid($userData['company_id']);
				$invoice_id=$invoice_data[0]['id'];
				$invoice_price=$invoice_data[0]['sub_total']+$price;

				$invoice_data=array(
					'sub_total'=>$invoice_price
				);

				$invoice_item_data=array(
					'id'=>substr(create_guid(),0,16),
					'invoice_id'=>$invoice_id,
					'description'=>'booking game room',
					'quantity'=>'1',
					'unit_price'=>$price,
					'total'=>$price,
					'table_name'=>$tbname,
					'row_id'=>$appid
				);
				$status = $this->client_model->setReqBookingGame($data);
				$this->client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);

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
				$this->email->to($userData['userEmail'].',sohom@simayaa.com'); // $userData['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
		}else{
			$this->db->select('registered_user.*');
			$this->db->from('registered_user');
			$this->db->join('need_analysis','need_analysis.registered_user_id=registered_user.userId');
	        $this->db->where('registered_user.deleted', 0);
	        $this->db->where('registered_user.userId',$userId);
	        $query=$this->db->get();
	        $reg_user_data = $query->result_array();
	        if(!empty($reg_user_data) && count($reg_user_data) != 0){
	        	$password=$this->get_random_password();
	        	$data['inputArray']=array(
				   	'userId'		=>$reg_user_data[0]['userId'],
				   	'userEmail'		=>$reg_user_data[0]['userEmail'],
				   	'userName'		=>$reg_user_data[0]['userEmail'],
					'password'		=>md5($password),
					'status'		=>1,
					'userTypeId'	=>'ut11',
					'FirstName'		=>$reg_user_data[0]['FirstName'],
					'LastName'		=>$reg_user_data[0]['LastName'],
					'gender'		=>$reg_user_data[0]['gender'],
				    'location_id'	=>$reg_user_data[0]['locationId'],
					'city_id'		=>$reg_user_data[0]['cityId'],
					'phone'			=>$reg_user_data[0]['phone'],
					'street'		=>$reg_user_data[0]['street'],	
					'pin'			=>$reg_user_data[0]['pincode'],	
					'company_id'	=>$reg_user_data[0]['userId'],
				 	'is_company'	=>'0',
				 	'can_view_bill'	=>'1',
				 	'Isprimary'     => '1',
                 	'dateAdded'		=>date('Y-m-d H:i:s'),
					'addedBy'		=>$this->session->userdata("userId")
				);
				$this->db->insert('user',$data['inputArray']);
				$data['profileArray']=array(
					'userProfileId'=>substr(create_guid(),0,16),	
				 	'userId'=> $reg_user_data[0]['userId'],	
				);
				$this->db->insert('user_profile',$data['profileArray']);
				$data['data_dl']=array('deleted'=>1,);
				$this->db->where('userId',$reg_user_data[0]['userId']);
				$this->db->update('registered_user',$data['data_dl']);

				$data['booking']['id'] 					= substr(create_guid(),0,16);
				$data['booking']['game_room_id'] 		= $game_room_id;
				$data['booking']['game_type'] 			= $game_type;
				$data['booking']['start_date'] 			= $start_date;
				$data['booking']['end_date'] 			= $end_date;
				$data['booking']['price'] 				= $price;
				$data['booking']['book_for'] 			= $reg_user_data[0]['userId'];
				$data['booking']['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
				$data['booking']['addedBy'] 			= $this->session->userdata("userId");
				$data['booking']['dateAdded'] 			= date('Y-m-d h:i:s');
				$data['booking']['deleted'] 			= 0;
				$data['booking']['company_id'] 			= $reg_user_data[0]['userId'];

				$status = $this->client_model->setReqBookingGame($data['booking']);
				$in_id=substr(create_guid(),0,16);
				$data['invoice_insert_data']=array(
					'id'				=> $in_id,
					'invoice_number'	=> rand(10000000,99999999),
					'invoice_date'		=> date('Y-m-d'),
					'customerId'		=> $reg_user_data[0]['userId'],
					'is_company'		=> 0,
					'sub_total'			=> $price,
				);
				$data['invoice_item_data']=array(
					'id'				=>substr(create_guid(),0,16),
					'invoice_id'		=>$in_id,
					'description'		=>'booking game room',
					'quantity'			=>'1',
					'unit_price'		=>$price,
					'total'				=>$price,
					'table_name'		=>'book_locker_room',
					'row_id'			=>$data['booking']['id'],
				);
				$this->db->insert('invoices',$data['invoice_insert_data']);
				$this->db->insert('invoice_items',$data['invoice_item_data']);

				$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
				$email_template = $this->login_model->getEmailTemplate($email_template_id);
				$body 			= $email_template['description'];
				$price 			= $price;
				$fullname		= ucfirst($reg_user_data[0]['FirstName']).' '.ucfirst($reg_user_data[0]['LastName']);
				$body 			= str_replace('[amount excluding taxes]',$price,$body);
				$body 			= str_replace('[client full name]',$fullname,$body);
				$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
				$from_name 		= ucfirst('Team Smartworks');

				/*User Payment Mail Function*/
				$this->email->set_newline("\r\n");
				$this->email->from($from_email,$from_name);
				$this->email->to($reg_user_data[0]['userEmail'].',sohom@simayaa.com'); // $reg_user_data[0]['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
	        }
		}
	}
	/*Book Game Room end here*/

	/*Book Locker Room start here*/
	public function getLockerRoom($locker_id){
		$data['get_locker_room']=$this->client_model->get1stlockerroom($locker_id);   
	 	$this->load->view("ajax_lockerroom",$data);		
   	}
   	public function book_locker_room(){
 		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['locker_data']=$this->client_model->getlockerbybusiness($data['business_data'][0]['business_id']);
		$this->load->view("book_locker_room",$data);	  
   	}
	public function setbookingLockerRequest(){
		$data 		= array();
		$locker_room_id 	= $this->input->post('locker_room_id');
		$locker_type 		= $this->input->post('locker_type');
		$total_locker 		= $this->input->post('total_locker');
		$start_date 		= $this->input->post('start_date');
		$end_date 			= $this->input->post('end_date');
		$price 				= $this->input->post('price');
		$userId 			= $this->input->post("userId");
		$userData 			= $this->login->getUserProfile($userId);
		if(!empty($userData && count($userData) != 0) ){
				$data['id'] 				= substr(create_guid(),0,16);
				$data['locker_room_id'] 	= $locker_room_id;
				$data['locker_type'] 		= $locker_type;
				$data['total_locker'] 		= $total_locker;
				$data['start_date'] 		= $start_date;
				$data['end_date'] 			= $end_date;
				$data['price'] 				= $price;
				$data['book_for'] 			= $userId;
				$data['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
				$data['addedBy'] 			= $this->session->userdata("userId");
				$data['dateAdded'] 			= date('Y-m-d h:i:s');
				$data['deleted'] 			= 0;
				$data['company_id'] 		= $userData['company_id'];
				
				$tbname ='book_locker_room';
				$appid = $data['id'];

				$invoice_data=$this->client_model->get_invoice_by_comid($userData['company_id']);
				$invoice_id=$invoice_data[0]['id'];
				$invoice_price=$invoice_data[0]['sub_total']+$price;

				$invoice_data=array(
					'sub_total'=>$invoice_price
				);

				$invoice_item_data=array(
					'id'=>substr(create_guid(),0,16),
					'invoice_id'=>$invoice_id,
					'description'=>'booking locker(s) room',
					'quantity'=>'1',
					'unit_price'=>$price,
					'total'=>$price,
					'table_name'=>$tbname,
					'row_id'=>$appid
				);
				$status = $this->client_model->setReqBookingLocker($data);
				$this->client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);

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
				$this->email->to($userData['userEmail'].',sohom@simayaa.com'); // $userData['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
		}else{
			$this->db->select('registered_user.*');
			$this->db->from('registered_user');
			$this->db->join('need_analysis','need_analysis.registered_user_id=registered_user.userId');
	        $this->db->where('registered_user.deleted', 0);
	        $this->db->where('registered_user.userId',$userId);
	        $query=$this->db->get();
	        $reg_user_data = $query->result_array();
	        if(!empty($reg_user_data) && count($reg_user_data) != 0){
	        	$password=$this->get_random_password();
	        	$data['inputArray']=array(
				   	'userId'		=>$reg_user_data[0]['userId'],
				   	'userEmail'		=>$reg_user_data[0]['userEmail'],
				   	'userName'		=>$reg_user_data[0]['userEmail'],
					'password'		=>md5($password),
					'status'		=>1,
					'userTypeId'	=>'ut11',
					'FirstName'		=>$reg_user_data[0]['FirstName'],
					'LastName'		=>$reg_user_data[0]['LastName'],
					'gender'		=>$reg_user_data[0]['gender'],
				    'location_id'	=>$reg_user_data[0]['locationId'],
					'city_id'		=>$reg_user_data[0]['cityId'],
					'phone'			=>$reg_user_data[0]['phone'],
					'street'		=>$reg_user_data[0]['street'],	
					'pin'			=>$reg_user_data[0]['pincode'],	
					'company_id'	=>$reg_user_data[0]['userId'],
				 	'is_company'	=>'0',
				 	'can_view_bill'	=>'1',
				 	'Isprimary'     => '1',
                 	'dateAdded'		=>date('Y-m-d H:i:s'),
					'addedBy'		=>$this->session->userdata("userId")
				);
				$this->db->insert('user',$data['inputArray']);
				$data['profileArray']=array(
					'userProfileId'=>substr(create_guid(),0,16),	
				 	'userId'=> $reg_user_data[0]['userId'],	
				);
				$this->db->insert('user_profile',$data['profileArray']);
				$data['data_dl']=array('deleted'=>1,);
				$this->db->where('userId',$reg_user_data[0]['userId']);
				$this->db->update('registered_user',$data['data_dl']);

				$data['booking']['id'] 				= substr(create_guid(),0,16);
				$data['booking']['locker_room_id'] 	= $locker_room_id;
				$data['booking']['locker_type'] 	= $locker_type;
				$data['booking']['total_locker'] 	= $total_locker;
				$data['booking']['start_date'] 		= $start_date;
				$data['booking']['end_date'] 		= $end_date;
				$data['booking']['price'] 			= $price;
				$data['booking']['book_for'] 		= $reg_user_data[0]['userId'];
				$data['booking']['is_approved'] 	= 1; //No need to further approved in smartworks 1st phase for booking conference room 
				$data['booking']['addedBy'] 		= $this->session->userdata("userId");
				$data['booking']['dateAdded'] 		= date('Y-m-d h:i:s');
				$data['booking']['deleted'] 		= 0;
				$data['booking']['company_id'] 		= $reg_user_data[0]['userId'];
				$status = $this->client_model->setReqBookingLocker($data['booking']);
				$in_id=substr(create_guid(),0,16);
				$data['invoice_insert_data']=array(
					'id'				=> $in_id,
					'invoice_number'	=> rand(10000000,99999999),
					'invoice_date'		=> date('Y-m-d'),
					'customerId'		=> $reg_user_data[0]['userId'],
					'is_company'		=> 0,
					'sub_total'			=> $price,
				);
				$data['invoice_item_data']=array(
					'id'				=>substr(create_guid(),0,16),
					'invoice_id'		=>$in_id,
					'description'		=>'booking locker(s) room',
					'quantity'			=>'1',
					'unit_price'		=>$price,
					'total'				=>$price,
					'table_name'		=>'book_locker_room',
					'row_id'			=>$data['booking']['id'],
				);
				$this->db->insert('invoices',$data['invoice_insert_data']);
				$this->db->insert('invoice_items',$data['invoice_item_data']);

				$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
				$email_template = $this->login_model->getEmailTemplate($email_template_id);
				$body 			= $email_template['description'];
				$price 			= $price;
				$fullname		= ucfirst($reg_user_data[0]['FirstName']).' '.ucfirst($reg_user_data[0]['LastName']);
				$body 			= str_replace('[amount excluding taxes]',$price,$body);
				$body 			= str_replace('[client full name]',$fullname,$body);
				$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
				$from_name 		= ucfirst('Team Smartworks');

				/*User Payment Mail Function*/
				$this->email->set_newline("\r\n");
				$this->email->from($from_email,$from_name);
				$this->email->to($reg_user_data[0]['userEmail'].',sohom@simayaa.com'); // $reg_user_data[0]['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
	        }
		}
	}
   	/*Book Locker Room end here*/

	/*Book Conference Room start here*/
	public function book_conference_room(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['conference_data']=$this->client_model->getconferencebybusiness($data['business_data'][0]['business_id']);
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
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['conference_data']=$this->client_model->getConferenceData($conference_id);
		$data['booked']=$this->client_model->getBookSlots($conference_id);
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
		$userId 	= $this->input->post("userId");
		$userData 	= $this->login->getUserProfile($userId);
		$tempArray = $this->session->userdata("dataArray");
		if(!empty($userData && count($userData) != 0) ){
			if(!empty($tempArray)){
				$tempData = array();
				foreach($tempArray as $temp){
					$tempData[$temp[0]][] = $temp[1] ;
				}
				$data['id'] 				= substr(create_guid(),0,16);
				$data['conference_room_id'] = $conf_id;				
				$data['booking_details'] 	= json_encode($tempData);
				$data['price'] 				= $price;
				$data['purpose'] 			= $purpose;
				$data['is_shared']			= 1;
				$data['book_for'] 			= $userId;
				$data['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
				$data['addedBy'] 			= $this->session->userdata("userId");
				$data['dateAdded'] 			= date('Y-m-d h:i:s');
				$data['deleted'] 			= 0;
				$data['company_id'] 		= $userData['company_id'];

				$tbname ='book_conference_room';
				$appid = $data['id'];

				$invoice_data=$this->client_model->get_invoice_by_comid($userData['company_id']);
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
				$status = $this->client_model->setReqBooking($data);
				$this->client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
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
				$this->email->to($userData['userEmail'].',sohom@simayaa.com'); // $userData['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
			}else{
				echo json_encode('noslotsSelected');
			}
		}else{
			if(!empty($tempArray)){
				$this->db->select('registered_user.*');
				$this->db->from('registered_user');
				$this->db->join('need_analysis','need_analysis.registered_user_id=registered_user.userId');
		        $this->db->where('registered_user.deleted', 0);
		        $this->db->where('registered_user.userId',$userId);
		        $query=$this->db->get();
		        $reg_user_data = $query->result_array();
		        if(!empty($reg_user_data) && count($reg_user_data) != 0){
		        	$password=$this->get_random_password();
		        	$data['inputArray']=array(
					   	'userId'		=>$reg_user_data[0]['userId'],
					   	'userEmail'		=>$reg_user_data[0]['userEmail'],
					   	'userName'		=>$reg_user_data[0]['userEmail'],
						'password'		=>md5($password),
						'status'		=>1,
						'userTypeId'	=>'ut11',
						'FirstName'		=>$reg_user_data[0]['FirstName'],
						'LastName'		=>$reg_user_data[0]['LastName'],
						'gender'		=>$reg_user_data[0]['gender'],
					    'location_id'	=>$reg_user_data[0]['locationId'],
						'city_id'		=>$reg_user_data[0]['cityId'],
						'phone'			=>$reg_user_data[0]['phone'],
						'street'		=>$reg_user_data[0]['street'],	
						'pin'			=>$reg_user_data[0]['pincode'],	
						'company_id'	=>$reg_user_data[0]['userId'],
					 	'is_company'	=>'0',
					 	'can_view_bill'	=>'1',
					 	'Isprimary'     => '1',
	                 	'dateAdded'		=>date('Y-m-d H:i:s'),
						'addedBy'		=>$this->session->userdata("userId")
					);
					$this->db->insert('user',$data['inputArray']);
					$data['profileArray']=array(
						'userProfileId'=>substr(create_guid(),0,16),	
					 	'userId'=> $reg_user_data[0]['userId'],	
					);
					$this->db->insert('user_profile',$data['profileArray']);
					$data['data_dl']=array('deleted'=>1,);
					$this->db->where('userId',$reg_user_data[0]['userId']);
					$this->db->update('registered_user',$data['data_dl']);
					$tempData = array();
					foreach($tempArray as $temp){
						$tempData[$temp[0]][] = $temp[1] ;
					}
					$data['booking']['id'] 					= substr(create_guid(),0,16);
					$data['booking']['conference_room_id'] 	= $conf_id;
					$data['booking']['booking_details'] 	= json_encode($tempData);
					$data['booking']['price'] 				= $price;
					$data['booking']['purpose'] 			= $purpose;
					$data['booking']['is_shared'] 			= 1;
					$data['booking']['book_for'] 			= $reg_user_data[0]['userId'];
					$data['booking']['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
					$data['booking']['addedBy'] 			= $this->session->userdata("userId");
					$data['booking']['dateAdded'] 			= date('Y-m-d h:i:s');
					$data['booking']['deleted'] 			= 0;
					$data['booking']['company_id'] 			= $reg_user_data[0]['userId'];
					$status = $this->client_model->setReqBooking($data['booking']);
					$in_id=substr(create_guid(),0,16);
					$data['invoice_insert_data']=array(
						'id'				=> $in_id,
						'invoice_number'	=> rand(10000000,99999999),
						'invoice_date'		=> date('Y-m-d'),
						'customerId'		=> $reg_user_data[0]['userId'],
						'is_company'		=> 0,
						'sub_total'			=> $price,
					);
					$data['invoice_item_data']=array(
						'id'				=>substr(create_guid(),0,16),
						'invoice_id'		=>$in_id,
						'description'		=>$purpose,
						'quantity'			=>'1',
						'unit_price'		=>$price,
						'total'				=>$price,
						'table_name'		=>'book_conference_room',
						'row_id'			=>$data['booking']['id'],
					);
					$this->db->insert('invoices',$data['invoice_insert_data']);
					$this->db->insert('invoice_items',$data['invoice_item_data']);
					$this->session->unset_userdata('dataArray');

					$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
					$email_template = $this->login_model->getEmailTemplate($email_template_id);
					$body 			= $email_template['description'];
					$price 			= $price;
					$fullname		= ucfirst($reg_user_data[0]['FirstName']).' '.ucfirst($reg_user_data[0]['LastName']);
					$body 			= str_replace('[amount excluding taxes]',$price,$body);
					$body 			= str_replace('[client full name]',$fullname,$body);
					$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
					$from_name 		= ucfirst('Team Smartworks');

					/*User Payment Mail Function*/
					$this->email->set_newline("\r\n");
					$this->email->from($from_email,$from_name);
					$this->email->to($reg_user_data[0]['userEmail'].',sohom@simayaa.com'); // $reg_user_data[0]['userEmail']
					$this->email->subject($email_template['subject']);
					$this->email->message($body);
						if($this->email->send()){ // Send mail to client
							echo json_encode($status);
						}
			        }
			}else{
				echo json_encode('noslotsSelected');
			}
		}
	}
	/*Book Conference Room end here*/

	/*Book Meeting Room start here*/
	public function book_meeting_room(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['meeting_data']=$this->client_model->getmeetingbybusiness($data['business_data'][0]['business_id']);
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
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['meeting_data']=$this->client_model->getMeetingData($meeting_id);
		$data['booked']=$this->client_model->getBookSlotsMeeting($meeting_id);
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
		$data 		= array();
		$meeting_id = $this->input->post('meeting_id');
		$purpose 	= $this->input->post('purpose');
		$price 		= $this->input->post('price');
		$userId 	= $this->input->post("userId");
		$userData 	= $this->login->getUserProfile($userId);
		$tempArray = $this->session->userdata("dataMeetingArray");
		if(!empty($userData && count($userData) != 0) ){
			if(!empty($tempArray)){
				$tempData = array();
				foreach($tempArray as $temp){
					$tempData[$temp[0]][] = $temp[1] ;
				}
				$data['id'] 				= substr(create_guid(),0,16);
				$data['meeting_room_id'] 	= $meeting_id;				
				$data['booking_details'] 	= json_encode($tempData);
				$data['price'] 				= $price;
				$data['purpose'] 			= $purpose;
				$data['is_shared']			= 1;
				$data['book_for'] 			= $userId;
				$data['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
				$data['addedBy'] 			= $this->session->userdata("userId");
				$data['dateAdded'] 			= date('Y-m-d h:i:s');
				$data['deleted'] 			= 0;
				$data['company_id'] 		= $userData['company_id'];

				$tbname ='book_meeting_room';
				$appid = $data['id'];

				$invoice_data=$this->client_model->get_invoice_by_comid($userData['company_id']);
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
				$status = $this->client_model->setReqBookingMeeting($data);
				$this->client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
				$this->session->unset_userdata('dataMeetingArray');

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
				$this->email->to($userData['userEmail'].',sohom@simayaa.com'); // $userData['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
			}else{
				echo json_encode('noslotsSelected');
			}
		}else{
			if(!empty($tempArray)){
				$this->db->select('registered_user.*');
				$this->db->from('registered_user');
				$this->db->join('need_analysis','need_analysis.registered_user_id=registered_user.userId');
		        $this->db->where('registered_user.deleted', 0);
		        $this->db->where('registered_user.userId',$userId);
		        $query=$this->db->get();
		        $reg_user_data = $query->result_array();
		        if(!empty($reg_user_data) && count($reg_user_data) != 0){
		        	$password=$this->get_random_password();
		        	$data['inputArray']=array(
					   	'userId'		=>$reg_user_data[0]['userId'],
					   	'userEmail'		=>$reg_user_data[0]['userEmail'],
					   	'userName'		=>$reg_user_data[0]['userEmail'],
						'password'		=>md5($password),
						'status'		=>1,
						'userTypeId'	=>'ut11',
						'FirstName'		=>$reg_user_data[0]['FirstName'],
						'LastName'		=>$reg_user_data[0]['LastName'],
						'gender'		=>$reg_user_data[0]['gender'],
					    'location_id'	=>$reg_user_data[0]['locationId'],
						'city_id'		=>$reg_user_data[0]['cityId'],
						'phone'			=>$reg_user_data[0]['phone'],
						'street'		=>$reg_user_data[0]['street'],	
						'pin'			=>$reg_user_data[0]['pincode'],	
						'company_id'	=>$reg_user_data[0]['userId'],
					 	'is_company'	=>'0',
					 	'can_view_bill'	=>'1',
					 	'Isprimary'     => '1',
	                 	'dateAdded'		=>date('Y-m-d H:i:s'),
						'addedBy'		=>$this->session->userdata("userId")
					);
					$this->db->insert('user',$data['inputArray']);
					$data['profileArray']=array(
						'userProfileId'=>substr(create_guid(),0,16),	
					 	'userId'=> $reg_user_data[0]['userId'],	
					);
					$this->db->insert('user_profile',$data['profileArray']);
					$data['data_dl']=array('deleted'=>1,);
					$this->db->where('userId',$reg_user_data[0]['userId']);
					$this->db->update('registered_user',$data['data_dl']);
					$tempData = array();
					foreach($tempArray as $temp){
						$tempData[$temp[0]][] = $temp[1] ;
					}
					$data['booking']['id'] 					= substr(create_guid(),0,16);
					$data['booking']['meeting_room_id'] 	= $meeting_id;
					$data['booking']['booking_details'] 	= json_encode($tempData);
					$data['booking']['price'] 				= $price;
					$data['booking']['purpose'] 			= $purpose;
					$data['booking']['is_shared'] 			= 1;
					$data['booking']['book_for'] 			= $reg_user_data[0]['userId'];
					$data['booking']['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
					$data['booking']['addedBy'] 			= $this->session->userdata("userId");
					$data['booking']['dateAdded'] 			= date('Y-m-d h:i:s');
					$data['booking']['deleted'] 			= 0;
					$data['booking']['company_id'] 			= $reg_user_data[0]['userId'];
					$status = $this->client_model->setReqBookingMeeting($data['booking']);
					$in_id=substr(create_guid(),0,16);
					$data['invoice_insert_data']=array(
						'id'				=> $in_id,
						'invoice_number'	=> rand(10000000,99999999),
						'invoice_date'		=> date('Y-m-d'),
						'customerId'		=> $reg_user_data[0]['userId'],
						'is_company'		=> 0,
						'sub_total'			=> $price,
					);
					$data['invoice_item_data']=array(
						'id'				=>substr(create_guid(),0,16),
						'invoice_id'		=>$in_id,
						'description'		=>$purpose,
						'quantity'			=>'1',
						'unit_price'		=>$price,
						'total'				=>$price,
						'table_name'		=>'book_meeting_room',
						'row_id'			=>$data['booking']['id'],
					);
					$this->db->insert('invoices',$data['invoice_insert_data']);
					$this->db->insert('invoice_items',$data['invoice_item_data']);
					$this->session->unset_userdata('dataMeetingArray');

					$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
					$email_template = $this->login_model->getEmailTemplate($email_template_id);
					$body 			= $email_template['description'];
					$price 			= $price;
					$fullname		= ucfirst($reg_user_data[0]['FirstName']).' '.ucfirst($reg_user_data[0]['LastName']);
					$body 			= str_replace('[amount excluding taxes]',$price,$body);
					$body 			= str_replace('[client full name]',$fullname,$body);
					$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
					$from_name 		= ucfirst('Team Smartworks');

					/*User Payment Mail Function*/
					$this->email->set_newline("\r\n");
					$this->email->from($from_email,$from_name);
					$this->email->to($reg_user_data[0]['userEmail'].',sohom@simayaa.com'); // $reg_user_data[0]['userEmail']
					$this->email->subject($email_template['subject']);
					$this->email->message($body);
						if($this->email->send()){ // Send mail to client
							echo json_encode($status);
						}
			        }
			}else{
				echo json_encode('noslotsSelected');
			}
		}
	}
	/*Book Meeting Room end here*/

	/*Book Day Office start here*/
	public function book_day_office(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']); 
		$data['dayoffice_data']=$this->client_model->getdayofficebybusiness($data['business_data'][0]['business_id']);
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
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['dayoffice_data']=$this->client_model->getDayofficeData($dayoffice_id);
		$data['booked']=$this->client_model->getBookSlotsDayOffice($dayoffice_id);
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
		$data 		= array();
		$dayoff_id = $this->input->post('dayoffice_id');
		$purpose 	= $this->input->post('purpose');
		$price 		= $this->input->post('price');
		$userId 	= $this->input->post("userId");
		$userData 	= $this->login->getUserProfile($userId);
		$tempArray = $this->session->userdata("dataDayOfficeArray");
		if(!empty($userData && count($userData) != 0) ){
			if(!empty($tempArray)){
				$tempData = array();
				foreach($tempArray as $temp){
					$tempData[$temp[0]][] = $temp[1] ;
				}
				$data['id'] 				= substr(create_guid(),0,16);
				$data['dayoffice_id'] 		= $dayoff_id;				
				$data['booking_details'] 	= json_encode($tempData);
				$data['price'] 				= $price;
				$data['purpose'] 			= $purpose;
				$data['is_shared']			= 1;
				$data['book_for'] 			= $userId;
				$data['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
				$data['addedBy'] 			= $this->session->userdata("userId");
				$data['dateAdded'] 			= date('Y-m-d h:i:s');
				$data['deleted'] 			= 0;
				$data['company_id'] 		= $userData['company_id'];

				$tbname ='book_dayoffice';
				$appid = $data['id'];

				$invoice_data=$this->client_model->get_invoice_by_comid($userData['company_id']);
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
				$status = $this->client_model->setReqBookingDayoffice($data);
				$this->client_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
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
				$this->email->to($userData['userEmail'].',sohom@simayaa.com'); // $userData['userEmail']
				$this->email->subject($email_template['subject']);
				$this->email->message($body);
				if($this->email->send()){ // Send mail to client
					echo json_encode($status);
				}
			}else{
				echo json_encode('noslotsSelected');
			}
		}else{
			if(!empty($tempArray)){
				$this->db->select('registered_user.*');
				$this->db->from('registered_user');
				$this->db->join('need_analysis','need_analysis.registered_user_id=registered_user.userId');
		        $this->db->where('registered_user.deleted', 0);
		        $this->db->where('registered_user.userId',$userId);
		        $query=$this->db->get();
		        $reg_user_data = $query->result_array();
		        if(!empty($reg_user_data) && count($reg_user_data) != 0){
		        	$password=$this->get_random_password();
		        	$data['inputArray']=array(
					   	'userId'		=>$reg_user_data[0]['userId'],
					   	'userEmail'		=>$reg_user_data[0]['userEmail'],
					   	'userName'		=>$reg_user_data[0]['userEmail'],
						'password'		=>md5($password),
						'status'		=>1,
						'userTypeId'	=>'ut11',
						'FirstName'		=>$reg_user_data[0]['FirstName'],
						'LastName'		=>$reg_user_data[0]['LastName'],
						'gender'		=>$reg_user_data[0]['gender'],
					    'location_id'	=>$reg_user_data[0]['locationId'],
						'city_id'		=>$reg_user_data[0]['cityId'],
						'phone'			=>$reg_user_data[0]['phone'],
						'street'		=>$reg_user_data[0]['street'],	
						'pin'			=>$reg_user_data[0]['pincode'],	
						'company_id'	=>$reg_user_data[0]['userId'],
					 	'is_company'	=>'0',
					 	'can_view_bill'	=>'1',
					 	'Isprimary'     => '1',
	                 	'dateAdded'		=>date('Y-m-d H:i:s'),
						'addedBy'		=>$this->session->userdata("userId")
					);
					$this->db->insert('user',$data['inputArray']);
					$data['profileArray']=array(
						'userProfileId'=>substr(create_guid(),0,16),	
					 	'userId'=> $reg_user_data[0]['userId'],	
					);
					$this->db->insert('user_profile',$data['profileArray']);
					$data['data_dl']=array('deleted'=>1,);
					$this->db->where('userId',$reg_user_data[0]['userId']);
					$this->db->update('registered_user',$data['data_dl']);
					$tempData = array();
					foreach($tempArray as $temp){
						$tempData[$temp[0]][] = $temp[1] ;
					}
					$data['booking']['id'] 					= substr(create_guid(),0,16);
					$data['booking']['dayoffice_id'] 		= $dayoff_id;
					$data['booking']['booking_details'] 	= json_encode($tempData);
					$data['booking']['price'] 				= $price;
					$data['booking']['purpose'] 			= $purpose;
					$data['booking']['is_shared'] 			= 1;
					$data['booking']['book_for'] 			= $reg_user_data[0]['userId'];
					$data['booking']['is_approved'] 		= 1; //No need to further approved in smartworks 1st phase for booking conference room 
					$data['booking']['addedBy'] 			= $this->session->userdata("userId");
					$data['booking']['dateAdded'] 			= date('Y-m-d h:i:s');
					$data['booking']['deleted'] 			= 0;
					$data['booking']['company_id'] 			= $reg_user_data[0]['userId'];
					$status = $this->client_model->setReqBookingDayoffice($data['booking']);
					$in_id=substr(create_guid(),0,16);
					$data['invoice_insert_data']=array(
						'id'				=> $in_id,
						'invoice_number'	=> rand(10000000,99999999),
						'invoice_date'		=> date('Y-m-d'),
						'customerId'		=> $reg_user_data[0]['userId'],
						'is_company'		=> 0,
						'sub_total'			=> $price,
					);
					$data['invoice_item_data']=array(
						'id'				=>substr(create_guid(),0,16),
						'invoice_id'		=>$in_id,
						'description'		=>$purpose,
						'quantity'			=>'1',
						'unit_price'		=>$price,
						'total'				=>$price,
						'table_name'		=>'book_dayoffice',
						'row_id'			=>$data['booking']['id'],
					);
					$this->db->insert('invoices',$data['invoice_insert_data']);
					$this->db->insert('invoice_items',$data['invoice_item_data']);
					$this->session->unset_userdata('dataDayOfficeArray');

					$email_template_id='ea9d3e66-e440-ce'; //Booking service offline template id
					$email_template = $this->login_model->getEmailTemplate($email_template_id);
					$body 			= $email_template['description'];
					$price 			= $price;
					$fullname		= ucfirst($reg_user_data[0]['FirstName']).' '.ucfirst($reg_user_data[0]['LastName']);
					$body 			= str_replace('[amount excluding taxes]',$price,$body);
					$body 			= str_replace('[client full name]',$fullname,$body);
					$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
					$from_name 		= ucfirst('Team Smartworks');

					/*User Payment Mail Function*/
					$this->email->set_newline("\r\n");
					$this->email->from($from_email,$from_name);
					$this->email->to($reg_user_data[0]['userEmail'].',sohom@simayaa.com'); // $reg_user_data[0]['userEmail']
					$this->email->subject($email_template['subject']);
					$this->email->message($body);
						if($this->email->send()){ // Send mail to client
							echo json_encode($status);
						}
			        }
			}else{
				echo json_encode('noslotsSelected');
			}
		}
	}
	/*Book Day Office end here*/
	public function manual_payment(){
		authenticate(array('ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$clientinfo=$this->service_request->getallclient();
		$individualclient=$this->service_request->getallindividualclient();
		foreach($individualclient as $k=>$v){
			$individualclient[$k]['company_id']=$individualclient[$k]['userId'];
			$individualclient[$k]['company_name']="Individual";
		}
		$data['clientinfo']=array_merge($clientinfo,$individualclient);
		
		if(!empty($_POST) && count($_POST)>0){
			$clientid=$this->input->post('client');
            $expclientid=explode("|",$clientid);
		    $client=$expclientid[0];
			$payment_data=array(
				'paymentId'=>substr(create_guid(),0,16),
				'userId'=>$client,
				'details'=>$this->input->post('purpose'),
				'payment_type'=>$this->input->post('payment_type'),
				'Transaction_Reference_No'=>$this->input->post('cheque_no'),
				'invoice_id'=>$this->input->post('invoice'),
				'Amount'=>$this->input->post('amount'),
				'Status_Description'=>"Transaction is Successful",
				'orderDate'=>date('Y-m-d h:i:s'),
				'orderStatus'=>'S'
				);
			$invoice_info=$this->service_request->get_invoice_byid($payment_data['invoice_id']);
		    $paid_amount=$invoice_info[0]['paid_amount']+$this->input->post('amount');
		    $invoice_update=array(
			   'paid_amount'=>$paid_amount
			);
			$this->service_request->manual_amount_paid($payment_data,$invoice_update,$payment_data['invoice_id']);
			
			
		    
		  @redirect(base_url()."index.php/manager/payment_pdf/".$payment_data['paymentId']);
           
		}
		
		$this->load->view('vmanual_payment',$data);
	}
	public function payment_pdf($payment_id){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['paymentId']=$payment_id;
		$this->load->view('vpayment_pdf',$data);
	}
	public function payment_pdf_download($payment_id){
		    $payment_info=$this->service_request->payment_bypaymentid($payment_id);
		    $pdf_data['logo_img'] = $this->gallery_path_url.'logo.png';
			$pdf_data['payment_date']=$payment_info[0]['orderDate'];
			$pdf_data['purpose']=$payment_info[0]['details'];
			$pdf_data['payment_type']=$payment_info[0]['payment_type'];
			$pdf_data['Transaction_Reference_No']=$payment_info[0]['Transaction_Reference_No'];
			$pdf_data['amount']=$payment_info[0]['Amount'];
			$invoice_info=$this->service_request->get_invoice_byid($payment_data['invoice_id']);
			if($invoice_info[0]['is_company']==1){
				$customer_id=$invoice_info[0]['customerId'];
				$company_info=$this->service_request->get_company_info($customer_id);
				$pdf_data['company_name']=$company_info[0]['company_name'];
                $pdf_data['company_address']=$company_info[0]['address'];
			}
			else if($invoice_info[0]['is_company']==0){
                $pdf_data['company_name']="Individual";
                $pdf_data['company_address']="";
			} 
			$pdf_data['invoice_number']=$invoice_info[0]['invoice_number'];
			$html = $this->load->view('vprint_manual_payment',$pdf_data,true);
			ini_set('memory_limit','32M');
			$mpdf = new mPDF('c','A4','','',0,0,5,5,5,5);
			$mpdf->SetDisplayMode('fullpage');
			$mpdf->SetTitle("Smartworks :: Manual Payment");
			$mpdf->SetAuthor("Smartworks Co.");
			$mpdf->WriteHTML($html,2);
			$attachment_name = 'Manual_Payment_'.date('d_M_Y').'.pdf'; // pdf attachment file name
			$pdfname = $attachment_name;
		    $mpdf->Output($pdfname,'D');
	}
	public function get_invoice_for_client(){
		$clientid=$this->input->post('clientid');
		$expclientid=explode("|",$clientid);
		$custid=$expclientid[1];
		$data['invoice_data']=$this->service_request->get_invoice_byclient($custid);
		$this->load->view('vinvoice_data',$data);
	}
}
?>
