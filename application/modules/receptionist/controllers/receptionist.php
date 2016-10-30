<?php
class receptionist extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('receptionist_login');
		$this->load->model('users/login');
		$this->load->model('rooms/rooms_model');
		$this->load->model('location/location_model', 'lm');
		$this->load->model('complaints/complaints_model');
		$this->load->model('client/client_model');
		$this->load->model('login/login_model');
		$this->load->library('email');
		$this->load->helper('form'); 
		$this->load->model('manager/booking_info');
		$this->load->model('receptionist_listing');
		$this->load->model('manager/service_request');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$this->load->model('invoice/invoice_model');
	}
	public function doUploadImage($fieldName,$imageid){
	
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
			$img="";
			return $img;
		}	
		
	}
	public function add_contacts(){
	 	authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
		if($_POST)
			{
				
			    $user=create_guid();
			    $user= substr($user,0,16);
			
				if($this->login_model->isEmailAvailableforstaff($_POST['email'])){
				$imageid=create_guid();
				$imageid= substr($imageid,0,16);
				$password=$_POST['password'];
				$image=$this->doUploadImage('ListeeTypeImage',$imageid);
				
					$arr = array(
				        'userId'=>$user,
					'userTypeId' =>'ut4',
					'FirstName' => $_POST['first_name'],
					 'phone'=>$_POST['phone'],
					 'image'=>$image,
					 'userEmail'=>$_POST['email'],
					 'userName'=>$_POST['email'],
					 'password'=>md5($password),
					'deleted' => 0,
					'company_id'=>$_POST['client'],
					'dateAdded'=>date('Y-m-d h:i:s'),
					'addedBy'=>$this->session->userdata("userId"),
					'status' => '1',
					'company_id'=>$_POST['client'],
					'is_company'=>'1'
					);
					
				
				if($this->db->insert('user',$arr)){
			$new_user = $this->receptionist_login->getUserProfile($user);			
			$email_template_id='29834305-f2f6-ef'; 
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$fullname		= ucfirst($new_user['FirstName']).' '.ucfirst($new_user['LastName']);
			$body 			= str_replace('[First Name]',$fullname,$body);
			$body 			= str_replace('[email]',$new_user['userEmail'],$body);
			$body 			= str_replace('[password]',$password,$body);
			$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
			$from_name 		= ucfirst('Team Smartworks');

			/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($new_user['userEmail']); // $userData['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$this->email->send(); // Send mail to client 
		}
			$this->session->set_flashdata('item','Contact is added successfully');	
			redirect('index.php/receptionist/add_contacts');		
			
			
		}else{
				$this->session->set_flashdata('item_error','Email is already exists');	
				 redirect('index.php/receptionist/add_contacts');	
				
		}
			
			
		}else{
        	$data['company_data']=$this->receptionist_listing->getcompanies_foradd_contact();
		$data['company_data_individual']=$this->receptionist_listing->getindividual();
        	$this->load->view('add_contacts',$data);
		}
	}
	public function delete_contacts($id){
		$this->db->where('userId', $id);
	    $this->db->delete('user');
		$this->session->set_flashdata('item',"You have successfully Deleted.");
	    redirect(base_url().'index.php/receptionist/add_contacts');
	}
	public function get_client_bycompany($id){
		$data['get_client_list']=$this->receptionist_listing->get_client_bycompany($id);
		if(count($data['get_client_list'])!=0){
		$data['get_client_list']=$this->receptionist_listing->get_client_bycompany($id);	
		}else{
		$data['get_client_list']=$this->receptionist_listing->getuser($id);	
		}
		$this->load->view('add_contacts_ajax',$data);
	}
	public function approve_client($val){
		$password=$this->get_random_password();
		$data=array(
		'password'=>md5($password),
		'status'=>'1',
		'dateModified'=>date('Y-m-d h:i:s'),
		'modifiedBy'=>$this->session->userdata("userId")
		);

		$rslt=$this->receptionist_listing->approve_client_status($data,$val);
		if($rslt==1){
			$new_user = $this->receptionist_login->getUserProfile($val);
			$email_template_id='29834305-f2f6-ef'; 
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$fullname		= ucfirst($new_user['FirstName']).' '.ucfirst($new_user['LastName']);
			$body 			= str_replace('[First Name]',$fullname,$body);
			$body 			= str_replace('[email]',$new_user['userEmail'],$body);
			$body 			= str_replace('[password]',$password,$body);
			$from_email 	= 'sworks_team@sworks.co.in'; // should change with smartworks team
			$from_name 		= ucfirst('Team Smartworks');

			/*User Payment Mail Function*/
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($new_user['userEmail']); // $userData['userEmail']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$this->email->send(); // Send mail to client 	
			echo 'Active';
			exit;
		}
	}
	public function approve_primary($val){
		$data['userData'] = $this->receptionist_login->getUserProfile($val);
		if($data['userData']['Isprimary']=='1'){
		    $data=array(
				'Isprimary'=>'0'
				);
		}else{
			$data=array(
			'Isprimary'=>'1'
			);
		}
		$rslt=$this->receptionist_listing->approve_primary($data,$val);
		if($rslt==1){
			echo 'Status is changed';
			exit;
		}
	}
	public function approve_canview($val){
    	$data['userData'] = $this->receptionist_login->getUserProfile($val);
		if($data['userData']['can_view_bill']=='1'){
		    $data=array(
				'can_view_bill'=>'0'
				);
		}else{
			$data=array(
			'can_view_bill'=>'1'
			);
		}
		$rslt=$this->receptionist_listing->approve_primary($data,$val);
		if($rslt==1){
			echo 'Status is changed';
			exit;
		}
	}
	public function center_dashBoard(){
		authenticate(array('ut5','ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
	public function get_ajax_booking_room($id,$type){
		authenticate(array('ut5','ut7','ut10'));
		$data['rbooking']=$this->rooms_model->get_ajax_booking_room($id,$type);
		print_r($data['rbooking']);
		exit;
		$this->load->view("get_ajax_booking_room",$data);
	}
	public function getroomsBybusiness($id){
		$data['room_data_conference']=$this->rooms_model->getbusinesslocation($id,'conference');
		$data['room_data_meeting']=$this->rooms_model->getbusinesslocation($id,'meeting');
		$data['room_data_day']=$this->rooms_model->getbusinesslocation($id,'dayoffice');
		$data['mainArray'] = array('Conference Room' => $data['room_data_conference'],'Meeting Room' => $data['room_data_meeting'],'Day office'=>$data['room_data_day']);
		if(!empty($data['mainArray']))
		{
			echo '<option value="0">Select Rooms</option>';
			foreach($data['mainArray'] as $key=>$value)
			{
				foreach($value as $v){
				echo '<option value="'.$key.'/'.$v['id'].'">'.$key.':'.$v['name'].'</option>';
				}
			}			
		}else{
			echo '<option value="0">No Rooms Available</option>';
			
		}
	}
	public function getbookingofroom(){
		$bookingid=$this->input->post('bookingid');
		$data['bookingdate']=date('d-m-Y',strtotime($this->input->post('bookingdate')));
		$expbookid=explode('/',$bookingid);
		$data['bookingtype']=$expbookid[0];
		$data['bookingid']=$expbookid[1];
        print_r($data);
		$booking_listing=$this->receptionist_listing->get_bookdata_bydate($data);

		if($data['bookingtype']=='Conference Room'){
        	$table='book_conference_room';
        }else if($data['bookingtype']=='Meeting Room'){
        	$table='book_meeting_room';
        }else if($data['bookingtype']=='Day office'){
        	$table='book_dayoffice';
        }
        if(!empty($booking_listing)){
			foreach($booking_listing as $bklist){
				if(!empty($bklist['booking_details'])){
					$booking_details_arr=json_decode($bklist['booking_details']);
				}
				if($bklist['book_for']<>$bklist['company_id']){
					$clientname=$bklist['FirstName']." ".$bklist['LastName']."(".$bklist['company_name'].")";
				}
			    else{
			    	$clientname=$bklist['FirstName']." ".$bklist['LastName']."(Individual)";
			    }
				foreach($booking_details_arr->$data['bookingdate'] as $k=>$v){
					
						$timestamp = strtotime($v) + 60*60;
						$start_time=date('h:i A',strtotime($v));
		                $time = date('h:i A', $timestamp);
		                $checkstatus=array(
		                	'booking_id'=>$bklist['id'],
		                	'booking_date'=>date('Y-m-d',strtotime($data['bookingdate'])),
		                	'start_time'=>$start_time,
		                	'end_time'=>$time
		                	);
		                $checking_status=$this->receptionist_listing->get_checkinstatus_forbooking($checkstatus);
	                    if(count($checking_status)>0){
	                    	$status=$checking_status[0]['status'];
	                    }else{
	                    	$status=0;
	                    }
						$book_data[]=array(
						'id'=>$bklist['id'],
						'table'=>$table,
						'date'=>$data['bookingdate'],
						'start_time'=>$start_time,
						'end_time'=>$time,
						'Room'=>$bklist['name'],
						'client'=>$clientname,
						'status'=>$status
						);					
				}

			}
		}
		if(empty($book_data)){
			$ajxdata['book_data']="";
		}else{
			$ajxdata['book_data']=$book_data;
		}
		
		$this->load->view('ajxbookingdata',$ajxdata);
	}
    public function index(){
		$this->session->sess_destroy();
		$this->load->view('vreceptionist_login');
	}
	public function dashBoard(){ // admin dashboard
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$client_event=$this->receptionist_login->get_client_event($clntstr);
		$i=0;
		if(!empty($client_event)){
			foreach($client_event as $clnt_evnt){
				$expsttime=explode(":",$clnt_evnt['start_time']);
				$expendtm=explode(":",$clnt_evnt['end_time']);
				$data['eventdata'][$i]['id']=$clnt_evnt['event_id'];
				$data['eventdata'][$i]['start']=$expsttime[0];
				$data['eventdata'][$i]['end']=$expendtm[0];
				$data['eventdata'][$i]['title']=$clnt_evnt['FirstName']." ".$clnt_evnt['LastName']." [".$clnt_evnt['phone']."]";
				$data['eventdata'][$i]['reminder']=$clnt_evnt['is_reminded'];
				
				$data['eventyearmonthday'][$i]=$clnt_evnt['event_date'];
				
				$i++;
			}
		}else{
				$data['eventdata']= '';
				$data['eventyearmonthday']='';
		}
		if($userId!="" && $userTypeId=="ut5"){
		$this->load->view("receptionist/receptionist_dashboard", $data);
		
		}
	}
	public function getcalevent(){
		$evntdata=$this->receptionist_login->get_client_event_byeventid($this->input->post('evntid'));
		$evntdata[0]['event_date']=date('d/m/Y',strtotime($evntdata[0]['event_date']));
		$evntdata[0]['start_time']=date('h:i A',strtotime($evntdata[0]['event_date']." ".$evntdata[0]['start_time']));
		$evntdata[0]['end_time']=date('h:i A',strtotime($evntdata[0]['event_date']." ".$evntdata[0]['end_time']));
		echo json_encode($evntdata[0]);
	}
	public function receptionist_dashboard(){
		authenticate(array('ut5'));
		$this->load->view('receptionist_dashboard');
	}
	public function setreminder(){
		$data=array(
		 'is_reminded'=>$this->input->post('reminder'),
		 'remindedby'=>$this->session->userdata("userId")
		);
		
		$evntid=$this->input->post('evntid');
		$this->receptionist_login->updatereminder($data,$evntid);
	}
	public function myProfile() {
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
		

		if($data['userData']['userId']=='0'){
			
			redirect(base_url().'?status=not_authorized');
		}
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
		$data['cities']=$this->lm->getcities();
		$this->load->view("receptionist_profile",$data);
    }
	public function updateProfile(){
		$data=array();
		$img 						= $this->doUpload("profile_image");
		$userId 					= $this->session->userdata('userId');  
		$data['FirstName']			= $this->input->post('first_name');
		$data['LastName']			= $this->input->post('last_name');
		$data['userProfilename']	= $data['FirstName']."-".$data['LastName'];
		if($img!='') $data['image']	= $img;
		$data['modifiedBy']			= $userId;
		$data['dateMOdified']		= gmdate('Y-m-d H:i:s');
		$data['city_id']=$this->input->post('city');
		$data['location_id']=$this->input->post('location');
		if($this->input->post('password')<>""){
			$data['password']=md5($this->input->post('password'));
		}
		/////----------- UPDATING USER TABLE---------////////
		
		if($this->receptionist_login->commonUpdate('user', $data, array("userId"=>$userId))){

			/////-----------UPDATING USER PROFILE TABLE-----------//////
			$data=array();
			$data['address1']		= $this->input->post('address');
			$data['address2']		= $this->input->post('address2');
			$data['phone']			= $this->input->post('phone');
			$data['cityId']			= $this->input->post('city');
			$data['stateId']		= $this->input->post('state');
			$data['countryId']		= $this->input->post('country');
			$data['zipCode']		= $this->input->post('post_code');
			$data['dateModified']   = gmdate('Y-m-d H:i:s');
			$data['modifiedBy']		= $userId;
			if($this->receptionist_login->commonUpdate('user_profile', $data, array("userId"=>$userId))){
				redirect(base_url().'index.php/receptionist/dashBoard?status=updateprofile_success');
			}else{
				redirect(base_url().'index.php/reseptionist/dashBoard?status=updateprofile_error');
			}
		}else{
			redirect(base_url().'index.php/receptionist/dashBoard?status=updateprofile_error');
		}
	}
	public function doUpload($fieldName, $defaultImageFieldName = "false"){
		if($_FILES[$fieldName]['name']!=""){ 
			$value = $_FILES[$fieldName]['name'];
			$config = array(
			'file_name' => $this->session->userdata('userId'),
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path.'/full',
			'max_size' => 2000
			);
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($fieldName)) {
				// return the error message and kill the script
				echo $this->upload->display_errors(); exit();
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

				
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
			$img=$upName;
			
		}else{
			$img=$this->input->post($defaultImageFieldName);
		}	
		return $img;
	}
	public function isEmailAvailable(){
		$isEdit = $this->input->post('isEdit');
		$actual_email = $this->session->userdata('userEmail');
		$input_email = $this->input->post('email');
		
		if($isEdit && ($actual_email!='' && $input_email!='' && $actual_email==$input_email)){
			print_r("1"); exit;
		}else{
			print_r($this->user->isEmailAvailable($input_email)); exit;
		}
	}
	public function existing_client(){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->receptionist_login->getUserProfile($userId);
	    $data['location']=$this->lm->getAlllocation();
	    $data['query']=$this->receptionist_listing->get_existing_client();
		$this->load->view('vexisting_client',$data);
	}
	public function existing_visitor(){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->receptionist_login->getUserProfile($userId);
	    $data['location']=$this->lm->getAlllocation();
	    $data['client_list']=$this->receptionist_listing->get_existing_client();
	    $data['visitor_list']=$this->receptionist_listing->get_existing_visitor_forclient();
		$this->load->view('vexisting_visitor',$data);
	}
	public function add_visitor(){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->receptionist_login->getUserProfile($userId);
	    $data['client_list']=$this->receptionist_listing->get_existing_client();
		$this->load->view('add_visitor',$data);
	}
	public function added_visitor(){
		$data=array(
		    'id'=>substr(create_guid(),0,16),
		    'client_id'=>$this->input->post('client'),
		    'name'=>$this->input->post('visitorName'),
		    'phone'=>$this->input->post('visitorPhone'),
		    'address'=>$this->input->post('visitorAddress'),
		    'in_time'=>$this->input->post('in_time'),
		    'out_time'=>$this->input->post('out_time'),
		    'addedBy'=>$this->session->userdata("userId"),
		    'dateAdded'=>date('Y-m-d h:i:s')
		);
		$this->receptionist_listing->visitor_added($data);
		@redirect(base_url()."index.php/receptionist/existing_visitor");
	}
	public function edit_visitor($visitorid){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->receptionist_login->getUserProfile($userId);
	    $data['client_list']=$this->receptionist_listing->get_existing_client();
	    $data['visitor_list']=$this->receptionist_listing->get_existing_visitor_byid($visitorid);
	    $this->load->view('edit_visitor',$data);
	}
	public function edited_visitor(){
		$vid=$this->input->post('hidvisitorid');
		$data=array(
		    'client_id'=>$this->input->post('client'),
		    'name'=>$this->input->post('visitorName'),
		    'phone'=>$this->input->post('visitorPhone'),
		    'address'=>$this->input->post('visitorAddress'),
		    'in_time'=>$this->input->post('in_time'),
		    'out_time'=>$this->input->post('out_time'),
		    'addedBy'=>$this->session->userdata("userId"),
		    'dateAdded'=>date('Y-m-d h:i:s')
		);
		$this->receptionist_listing->visitor_edited($data,$vid);
		@redirect(base_url()."index.php/receptionist/existing_visitor");
	}
	public function delete_visitor($visitorid){
		authenticate(array('ut5'));
		$this->receptionist_listing->visitor_deleted($visitorid);	
	}
	/*************Invoice Part start here****************/
	public function all_bills($com_id = ''){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		authenticate(array('ut5'));
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
		authenticate(array('ut5'));
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
		authenticate(array('ut5'));
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
	 	authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$userData 			= $this->receptionist_login->getUserProfile($userId);

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
 		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$userData 			= $this->receptionist_login->getUserProfile($userId);
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
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$userData 	= $this->receptionist_login->getUserProfile($userId);
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
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$userData 	= $this->receptionist_login->getUserProfile($userId);
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
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
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
		$userData 	= $this->receptionist_login->getUserProfile($userId);
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
	public function get_checkin_checkout_booking_room(){
		if($this->input->post('status')==1){
			$check_in=date('Y-m-d h:i:s');
			$check_out="";
			$status="You have successfully Checked In";
		}else if($this->input->post('status')==2){
			$check_in="";
			$check_out=date('Y-m-d h:i:s');
			$status="You have successfully Checked Out";
		}
		$check_data=array(
			'checkid'=>substr(create_guid(),0,16),
			'table'=>$this->input->post('table'),
			'booking_id'=>$this->input->post('bookingid'),
			'status'=>$this->input->post('status'),
			'check_in'=>$check_in,
            'check_out'=>$check_out,
            'start_time'=>$this->input->post('start'),
            'end_time'=>$this->input->post('end'),
            'booking_date'=>$this->input->post('booking_date')
			);
		//print_r($check_data);
		$this->receptionist_listing->check_room($check_data);
		echo $status;
	}
	public function booking_details(){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['booking_data']=$this->booking_info->get_booking_details_for_conference_room($legal_data);
		//print_r($data['booking_data']);
		$this->load->view('vbooking_details',$data);
	}
	public function service_request(){
		authenticate(array('ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->receptionist_login->getUserProfile($userId);
		$legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$data['legal_support']=$this->service_request->get_service($legal_data);
		$data['courier_support']=$this->service_request->get_courier_service($legal_data);
		$data['staff_type']=$this->service_request->get_service_type();
		$this->load->view('vlegal_support',$data);
	}
	public function manual_payment(){
		authenticate(array('ut5'));
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
			@redirect(base_url()."index.php/receptionist/payment_pdf/".$payment_data['paymentId']);
		  

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
