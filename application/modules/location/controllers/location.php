<?php
class location extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('users/login');
		$this->load->model('location_model', 'lm');
		$this->load->helper('form','url');
		$this->load->model('login/login_model');
		$this->load->library('email');
		$this->output->enable_profiler(FALSE); // Default FALSE 
	}
	public function view($city_name){
		//$data['title'] = 'SMARTWORKS-LOCATION';
		$data['city_id']=$this->lm->getcityidbyName($city_name);				
		$location_id =$data['city_id'][0]['cityId'];
		$data['location'] = base64_encode(base64_encode($data['city_id'][0]['cityId']));
		$data['city_name']=$this->lm->getcity($location_id);
		$data['location_data'] = $this->lm->getLocationData($location_id);
		
		$data['location_arr']=$this->lm->getcities();
		
		if($city_name == 'Delhi'){
			$data['title'] = 'Leading Commercial & Office Space Rental Agency in Delhi / NCR';
			$data['meta_key'] = 'office space rent Delhi, shared office space Delhi / NCR, coworking space Delhi, virtual office address Delhi,';
			$data['meta_description'] = 'Looking for commercial & office space rental in Delhi / NCR? We offer best offices with best ambiance. We also offer virtual office address. Call @ 1800-833-9675';
		}else if($city_name == 'Mumbai'){
			$data['title'] = 'Office Space for Rent in Mumbai | Virtual Office Address Mumbai';
			$data['meta_key'] = 'office space rent Mumbai, shared office space Mumbai, coworking space Mumbai, virtual office address Mumbai';
			$data['meta_description'] = 'Get perfect office space for rent in Mumbai, suitable for your business. *Great Infrastructure at best price. You can book virtual office too. Call @ 1800-833-9675';
		}else if($city_name == 'Gurgaon'){
			$data['title'] = 'Commercial Space for Rent, Buy | Office Space Rental in Gurgaon';
			$data['meta_key'] = 'office space rent Gurgaon, shared office space Gurgaon, coworking space Gurgaon, virtual office address Gurgaon';
			$data['meta_description'] = 'Looking to buy, rent commercial & office space in Gurgaon? We offer office space rental, virtual office address in Gurgaon *Best ambiance. Call @ 1800-833-9675';
		}else if($city_name == 'Noida'){
			$data['title'] = 'Commercial Space for Rent | Virtual, Office Space Rental in Noida';
			$data['meta_key'] = 'office space rent Noida, shared office space Noida, coworking space Noida, virtual office address Noida';
			$data['meta_description'] = 'Looking to buy, rent commercial & office space in Noida? We offer office space rental, virtual office address in Noida at best price. Call @ 1800-833-9675';
		}else if($city_name == 'Pune'){
			$data['title'] = 'Office Space for Rent in Pune | Virtual Office Address Pune';
			$data['meta_key'] = 'office space rent Pune, shared office space Pune, coworking space Pune, virtual office address Pune';
			$data['meta_description'] = '';
		}else if($city_name == 'Bangalore'){
			$data['title'] = 'Commercial Property for Rent, Buy | Office Space in Bangalore';
			$data['meta_key'] = 'office space rent Bangalore, shared office space Bangalore, coworking space Bangalore, virtual office address Bangalore';
			$data['meta_description'] = 'Looking to buy, rent commercial & office space in Bangalore? We offer office space rental, virtual office address in Bangalore *Best ambiance. Call @ 1800-833-9675';
		}else if($city_name == 'Kolkata'){
			$data['title'] = 'Commercial Space for Rent in Kolkata | Shared Office Space Rental';
			$data['meta_key'] = 'office space rent Kolkata, shared office space Kolkata, virtual office address Kolkata';
			$data['meta_description'] = 'Get commercial space for rent in Kolkata and shared office space at the most affordable rate. With great infrastructure. Call @ 1800-833-9675 to know more';
		}
		
		
		
		$this->load->view('location', $data);
	}
	public function floor_plan(){
		$data['title'] = 'SMARTWORKS-FLOORPLAN';
		$data['location_arr']=$this->lm->getcities();
		$this->load->view('floor_plan', $data);
	}
	public function image_gallery($business_id){
		$data['title'] = 'SMARTWORKS-IMAGEGALLERY';
		if($business_id!='all'){
			$data['business_images'] =$this->lm->getbusinessimages(base64_decode(base64_decode($business_id)));
		}else{
			$data['business_images'] =$this->lm->getbusinessimagesfor_all();	
		}
		$data['location_arr']=$this->lm->getcities();
		$this->load->view('photo_gallery', $data);
	}
	public function video_gallery($business_id){
		$data['title'] = 'SMARTWORKS-VIDEOGALLERY';
		if($business_id!='all'){
			$data['business_videos'] =$this->lm->getbusinessvideos(base64_decode(base64_decode($business_id)));
		}else{
			$data['business_videos'] =$this->lm->getbusinessvideosfor_all();
		}
		$data['location_arr']=$this->lm->getcities();
		$this->load->view('video_gallery', $data);
	}
	public function book_a_tour($business_id="",$city_id=""){
		if(($business_id == "") || ($city_id == "")){
			die("URL parameter(s) missing!!");
		}
		$message = '';
		if (isset($_POST) && (!empty($_POST))){
			$location = explode('/', $_POST['location']);
			$book_a_tour_data=array(
		        'userId'=>substr(create_guid(),0,16),
		        'enquiry_type'=>1,
		        'FirstName'=>$this->input->post("firstname"),
		        'LastName'=>$this->input->post("lastname"),
		        'userEmail'=>$this->input->post("email"),
		        'phone'=>$this->input->post("phoneno"),
		        'locationId'=> $location[0],
				'cityId'=> $location[1],
				'dateAdded'=> date('Y-m-d h:i:s'),
		        'street'=>$this->input->post("street"),
				'city'=> $this->input->post("city"),
				'pincode'=> $this->input->post("pin"),
				'know_info'=> $this->input->post("info"),
	        );
			$status = $this->lm->book_a_tour($book_a_tour_data);
			if($status == 1){
				$email_template_id="39a99e23-0f69-a2"; // BOOK A TOUR MANAGEMENT TEMPLATE ID
				$email_template_location_manager = $this->login_model->getEmailTemplate($email_template_id);
				$bussness_data = $this->lm->get_business_details(base64_decode(base64_decode($business_id)));
				$mail_to_and_cc = $this->lm->mail_to_user_details(base64_decode(base64_decode($city_id)));
				$loc_man_email = '';
				$loc_man_fullname = '';
				if(!empty($mail_to_and_cc['loc_managers'])){
				foreach($mail_to_and_cc['loc_managers'] as $locman){
					$loc_man_email.= $locman['userEmail'].',';
					$loc_man_fullname.= ucfirst($locman['FirstName']).' '.ucfirst($locman['LastName']).',';
				}
				}
				$loc_man_email = rtrim($loc_man_email,",");
				$loc_man_fullname = rtrim($loc_man_fullname,",");
				$ad =!empty($mail_to_and_cc['area_director']) ? $mail_to_and_cc['area_director'][0]['userEmail'] : '';
				$ist = !empty($mail_to_and_cc['ist_user']) ? $mail_to_and_cc['ist_user'][0]['userEmail'] : '';
				//$ad = $mail_to_and_cc['area_director'][0]['userEmail'];
				//$ist = $mail_to_and_cc['ist_user'][0]['userEmail'];
				$body = $email_template_location_manager['description'];
				$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
				$body = str_replace('[user Full name]',ucfirst($this->input->post("firstname")).' '.ucfirst($this->input->post("lastname")),$body);
				$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
		  		/*Mail function start here*/
		  		$from_email = $this->input->post("email"); 
		  		$from_name = ucfirst($this->input->post("firstname")).' '.ucfirst($this->input->post("lastname"));
	         	$to_email = $loc_man_email;// should change with location manager email address
		   		$cc = $ad.','.$ist.',aparajita@simayaa.com';// should be cc to AD & IST team.
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
					$body = str_replace('[user Full name]',ucfirst($this->input->post("firstname")).' '.ucfirst($this->input->post("lastname")),$body);
					$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
			  		$from_email = 'sworks_team@sworks.co.in'; // should change with smartworks team
			  		$from_name = ucfirst('Team Smartworks');
		         	$to_email = $this->input->post("email"); 
					$this->email->set_newline("\r\n");
					$this->email->from($from_email, $from_name); 
			        $this->email->to($to_email);
			        $this->email->cc('');
					$this->email->subject($email_template_client['subject']);
					$this->email->message($body);
			        //Send mail for Client
			        if($this->email->send()){
		        		$message = '<div class="alert alert-success fade in" style="margin-top:18px;">
										<strong>Your booking has been completed. We will contact you sortly.</strong>.
									</div>';
			        }else{
			         	
			        	$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
										<strong>We are very sorry, something goes wrong!</strong>.
									</div>';
		        	}
		        }else{
		         	
		        	$message = '<div class="alert alert-danger fade in" style="margin-top:18px;">
									<strong>We are very sorry, something goes wrong!</strong>.
								</div>';
		        }
				/*Mail function end here*/
				
			}
		}
		$data['title'] 		 	= 	'SMARTWORKS-BOOK A TOUR';
		$data['business_id'] 	= 	base64_decode(base64_decode($business_id));
		$data['city_id'] 	 	= 	base64_decode(base64_decode($city_id));
		$data['location_arr']=$this->lm->getcities();
		$data['location']	 	=	$this->lm->getAlllocation();
		$data['message'] 		= 	$message;
		$this->load->view('book_a_tour', $data);
	} 
	public function city_list(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['city']=$this->lm->getcitiesregion();
        $this->load->view('city_list', $data);	
	}
		public function region_list(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['region']=$this->lm->getregions();
		$this->load->view('region_list', $data);	
	}
	public function view_locations(){
		authenticate(array('ut6','ut1'));	
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getAlllocation();
		$this->load->view('location_list', $data);		
	}
	public function view_locations_email(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getAlllocation();
		$this->load->view('location_email_list', $data);	
	}
	public function manage_buisness_centers($cityid,$locationid){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['buisness']=$this->lm->getbuisnessbylocationcity($cityid,$locationid);
		$data['location_name']=$this->lm->getlocation($locationid);
		$data['city_name']=$this->lm->getcity($cityid);		
		$this->load->view('buisness_list', $data);		
	}
	public function change_city_status(){
		authenticate(array('ut6','ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="cities";
					$pid='cityId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_city_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_city_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}	
	}
	public function change_location_status(){
		authenticate(array('ut6','ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
				$table	="locations";
				$pid='locationId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}	
	}
	public function edit_city_name($id){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($_POST)
		{
		    $cityId = $_POST['cityId'];
			
			$arr = array(
				'name' => $_POST['attiributespeName'],
				'regionId'=>$_POST['region_name']
				);
			 $table='cities';	
			 $pid='cityId';
		     $result = $this->lm->editPage($pid,$arr,$cityId,$table);
			
			$data['city']=$this->lm->getcity($cityId);	
			$this->session->set_flashdata('item','city updated successfully');
		
			redirect('index.php/location/city_list');
		}
		else{
			$data['region']=$this->lm->getregions();
			$data['city']=$this->lm->getcity($id);	
			$this->load->view('location/edit_city',$data);	
		}		
	}
		public function edit_region($id){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($_POST)
		{
		    $regionId = $_POST['regionId'];
			$arr = array(
				'name' => $_POST['name'],
				);
			 $table='region';	
			 $pid='regionId';
		     $result = $this->lm->editPage($pid,$arr,$regionId,$table);
			 $this->session->set_flashdata('item','region updated successfully');
		
			redirect('index.php/location/region_list');
		}
		else{
			$data['region']=$this->lm->get_region_cityname($id);
			$this->load->view('location/edit_region',$data);	
		}		
	}
	public function edit_location($location_id,$city_id){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		authenticate();
		if($_POST)
		{
		    $cityId = $city_id;
		    $locationId =$location_id;
			
			$arr = array(
			
				'name' => $_POST['name']
				
				);
			  $table	='locations';
			  $pid='locationId';
			  $location=trim($_POST['name']);
			  $location_exist=$this->lm->isLocationAvailable($location,$cityId);	
			
			
			if($location_exist=='0'){
				$this->session->set_flashdata('item_error','Location is already exists');	
				redirect('index.php/location/edit_location/'.$locationId.'/'.$cityId);
				
			}else{
		     $result = $this->lm->editPage($pid,$arr,$locationId,$table);
			
			
			$data['location']=$this->lm->getlocation($location_id);	
			$data['city']=$this->lm->getcity($city_id);	
			$data['cities']=$this->lm->getcities();
			$this->session->set_flashdata('item','location updated successfully');
		
			redirect('index.php/location/edit_location/'.$locationId.'/'.$cityId);
		}
		}
		else{
			$data['location']=$this->lm->getlocation($location_id);	
			$data['city']=$this->lm->getcity($city_id);	
			$data['cities']=$this->lm->getcities();
			$this->load->view('location/edit_location',$data);	
		}	
	}
	public function delete_city($id=''){
		authenticate(array('ut6','ut1'));
		if($id)
		{
			$table='cities';
			
			$column_name='cityId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'city deleted successfully');
			redirect('index.php/location/city_list');
		}
	}
	public function delete_region($id=''){
		authenticate(array('ut6','ut1'));
		if($id)
		{
			$table='region';
			
			$column_name='regionId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'region deleted successfully');
			redirect('index.php/location/region_list');
		}
	}
	public function delete_location($id='',$city_id=''){
		authenticate(array('ut6','ut1'));
		if($id)
			{
				$table='locations';
				$column_name='locationId';
				$result = $this->lm->delete($table,$id,$column_name);
				$this->session->set_flashdata('item', 'location deleted successfully');
				redirect('index.php/location/view_locations/'.$city_id);
			}			
	}
	public function add_city(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST)
		{
		    $cityId=create_guid();
		    $cityId= substr($cityId,0,16);
			$arr = array(
			    'cityId'=>	$cityId,
				'name' =>  $_POST['attiributespeName'],
				
				'regionId' => $_POST['region_name'],
				
				'deleted' => 0,
				
				'status' => 1);
				$city=trim($_POST['attiributespeName']);
			$city_exist=$this->lm->isCityAvailable($city);	
			
			
			if($city_exist=='0'){
				$this->session->set_flashdata('item_error','city is already exists');	
				 redirect('index.php/location/add_city');	
				
			}else{	
		    	$result = $this->lm->addcity($arr);
		    	$this->session->set_flashdata('item','New city added successfully');
		    	redirect('index.php/location/city_list');
			}
		}
		else{
			$data['region']=$this->lm->getregions();
            $this->load->view('location/add_city',$data);	
		}
	}
	public function edit_location_email($location_id,$city_id){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		authenticate();
		if($_POST)
		{
			$arr = array('email' =>  $_POST['email'],'admin_name'=>$_POST['admin_name']);
		 	$table	='locations';
		 	$pid='locationId';
	 		$result = $this->lm->editPage($pid,$arr,$location_id,$table);
		    $this->session->set_flashdata('item','Location Admin Email is added successfully');
		    redirect('index.php/location/view_locations_email');
		}
		else{
			$data['location']=$this->lm->getlocation($location_id);	
			$data['city']=$this->lm->getcity($city_id);	
			$data['cities']=$this->lm->getcities();
			$this->load->view('location/edit_location_email',$data);	
		}
	}
	public function add_location(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST)
		{
		  	$locationId=create_guid();
		  	$locationId= substr($locationId,0,16);
		  	$city_id=$_POST['city'];
			$arr = array(
			    'locationId'=>$locationId,
			    'cityId'=>$_POST['city'],
				'name' =>  $_POST['attiributespeName'],
				'deleted' => 0,
				'status' => 1);
			$location=trim($_POST['attiributespeName']);
			$city_id=$_POST['city'];
			$location_exist=$this->lm->isLocationAvailable($location,$city_id);	
			if($location_exist=='0'){
				$this->session->set_flashdata('item_error','Location is already exists');	
			 	redirect('index.php/location/add_location');		
			}else{	
		    	$result = $this->lm->addlocation($arr);
		    	$this->session->set_flashdata('item','New Location added successfully');
		    	redirect('index.php/location/view_locations');
			}
		}
		else{
			$data['city']=$this->lm->getcities();
			$this->load->view('location/add_location',$data);	
		}
	}
	public function add_region(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST)
		{
		  	$regionId=create_guid();
		  	$regionId= substr($regionId,0,16);
		  	$arr = array(
			    'regionId'=>$regionId,
			    'name' =>  $_POST['name'],
				'deleted' => 0
				);

			    $result = $this->lm->add_region($arr);
		    	$this->session->set_flashdata('item','New Region added successfully');
		    	redirect('index.php/location/region_list');
			
		}
		else{
			
			$this->load->view('location/add_region',$data);	
		}
	}
	public function add_buisness($locationid,$cityid){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		authenticate();
		if($_POST)
		{
			$arr = array(
			    'cityId'=>$_POST['city'],
				'name' =>  $_POST['attiributespeName'],
				'deleted' => 0,
				'status' => 1);
			$location=trim($_POST['attiributespeName']);
			$city_id=$_POST['city'];
			$location_exist=$this->lm->isLocationAvailable($location,$city_id);	
			if($location_exist=='0'){
				$this->session->set_flashdata('item_error','Location is already exists');	
			 	redirect('index.php/location/add_location/'.$id);	
			}else{	
		    	$result = $this->lm->addlocation($arr);
		    	$this->session->set_flashdata('item','New Location added successfully');
		    	redirect('index.php/location/view_locations/'.$id);
			}
		}
		else{
			$data['city']=$this->lm->getcities();
			$data['city_name']=$this->lm->getcity($id);	
			$this->load->view('location/add_buisness',$data);	
		}
	}
	public function concierge_city_list(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['city']=$this->lm->getconciergecities();
		$this->load->view('concierge_city_list', $data);	
	}
	public function edit_concierge_city_name($id){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($_POST)
		{
		    $cityId = $_POST['cityId'];
			
			$arr = array(
				'name' => $_POST['attiributespeName']
				
				);
			 $table='concierge_cities';	
			 $pid='cityId';
		     $result = $this->lm->editPage($pid,$arr,$cityId,$table);
			
			$data['city']=$this->lm->getconciergecity($cityId);	

			$this->session->set_flashdata('item','city updated successfully');
		
			redirect('index.php/location/concierge_city_list');
		}
		else{
			$data['city']=$this->lm->getconciergecity($id);
			
			$this->load->view('location/edit_concierge_cites',$data);	
		}		
	}
	public function concierge_add_city(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST)
		{
		    $cityId=create_guid();
		    $cityId= substr($cityId,0,16);
			$arr = array(
			    'cityId'=>	$cityId,
				'name' =>  $_POST['attiributespeName'],
				
				'countryId' => '243',
				
				'deleted' => 0,
				
				'status' => 1);
				$city=trim($_POST['attiributespeName']);
			$city_exist=$this->lm->isConciergeCityAvailable($city);	
			
			
			if($city_exist=='0'){
				$this->session->set_flashdata('item_error','city is already exists');	
				 redirect('index.php/location/concierge_add_city');	
				
			}else{	
		    	$result = $this->lm->addconciergecity($arr);
		    	$this->session->set_flashdata('item','New city added successfully');
		    	redirect('index.php/location/concierge_city_list');
			}
		}
		else{
			$this->load->view('location/concierge_add_city',$data);	
		}
	}
	public function delete_concierge_city($id=''){
		authenticate(array('ut1'));
		if($id)
		{
			$table='concierge_cities';
			
			$column_name='cityId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'city deleted successfully');
			redirect('index.php/location/concierge_city_list');
		}
	}
	public function airlines(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['airlines']=$this->lm->get_airlines();
		$this->load->view('airlines_list', $data);
	}
	public function add_airlines(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
            $airlinesId=create_guid();
            $arrlines_data=array(
            	'airlinesId'=>$airlinesId,
            	'name'=>$this->input->post('airlinesName')
            	);
            $this->lm->add_airlines($arrlines_data);
            $this->session->set_flashdata('item', 'Airlines added successfully');
            @redirect(base_url().'index.php/location/airlines');
		}else{
			$this->load->view('add_airlines', $data);
		}
		
	}
	public function edit_airline($id=''){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$airlinesId=$this->input->post('airlineId');
            $airline_data=array(
            	'name'=>$this->input->post('airlineName')
            	);
            $this->lm->update_airline($airlinesId,$airline_data);
            $this->session->set_flashdata('item', 'Airlines updated successfully');
            @redirect(base_url().'index.php/location/airlines');
		}else{
			$data['airline']=$this->lm->get_airline_byid($id);
			$this->load->view('edit_airlines', $data);
		}

	}
	public function delete_airline($id=''){
		authenticate(array('ut1'));
		if($id)
		{
			$table='airlines';
			
			$column_name='airlinesId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'Airline deleted successfully');
			redirect('index.php/location/airlines');
		}
	}
	public function change_airline_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="airlines";
					$pid='airlinesId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_airline_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_airline_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function cab(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['cabs']=$this->lm->get_cabs();
		$this->load->view('cab_list', $data);
	}
	public function add_cab(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
           $cabId=create_guid();
            $cab_data=array(
            	'cabId'=>$cabId,
            	'name'=>$this->input->post('cabName')
            	);
            $this->lm->add_cab($cab_data);
            $this->session->set_flashdata('item', 'Cab added successfully');
            @redirect(base_url().'index.php/location/cab');
		}else{
			$this->load->view('add_cab',$data);
		}
	}
	public function edit_cab($id=''){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$cabId=$this->input->post('cabId');
            $cab_data=array(
            	'name'=>$this->input->post('cabName')
            	);
            $this->lm->update_cab($cabId,$cab_data);
            $this->session->set_flashdata('item', 'Cab updated successfully');
            @redirect(base_url().'index.php/location/cab');
		}else{
			$data['cab']=$this->lm->get_cab_byid($id);
			$this->load->view('edit_cab', $data);
		}

	}
	public function change_cab_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="cab";
					$pid='cabId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_cab_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_cab_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_cab($id=''){
		authenticate(array('ut1'));
		if($id)
		{
			$table='cab';
			
			$column_name='cabId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'Cab deleted successfully');
			redirect('index.php/location/cab');
		}
	}
	public function movie_hall(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['movie_hall']=$this->lm->get_movie_hall();
		$this->load->view('movie_hall',$data);
	}
	public function add_movie_hall(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
            $hall_data=array(
            	'hallId'=>substr(create_guid(),0,16),
            	'name'=>$this->input->post('hallName'),
            	'location'=>$this->input->post('hall_location')
            	);
            $this->lm->add_hall_data($hall_data);
            $this->session->set_flashdata('item', 'Movie Hall added successfully');
            @redirect(base_url().'index.php/location/movie_hall');
		}else{
			$this->load->view('add_movie_hall',$data);
		}
		
	}
	public function edit_movie_hall($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$hallId=$this->input->post('hallId');
            $hall_data=array(
            	'name'=>$this->input->post('hallName'),
            	'location'=>$this->input->post('hall_location')
            	);
            $this->lm->update_hall($hallId,$hall_data);
            $this->session->set_flashdata('item', 'Movie Hall updated successfully');
            @redirect(base_url().'index.php/location/movie_hall');
		}else{
			$data['movie']=$this->lm->get_hall_byid($id);
			$this->load->view('edit_movie_hall', $data);
		}
	}
	public function change_hall_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="movie_hall";
					$pid='hallId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_hall_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_hall_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_hall($id=''){
		authenticate(array('ut1'));
		if($id)
		{
			$table='movie_hall';
			$column_name='hallId';
			$table1='movie_hall_data';
			$column_name1='hallId';
			$result = $this->lm->delete($table,$id,$column_name);
			$result1 = $this->lm->delete($table1,$id,$column_name1);
			$this->session->set_flashdata('item', 'Movie Hall deleted successfully');
			redirect('index.php/location/movie_hall');
		}
	}
	public function movie(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['movie']=$this->lm->get_movie();
		
		for($i=0;$i<count($data['movie']);$i++){
			$movie_id=$data['movie'][$i]['movieId'];
			$movie_dt=$this->lm->get_movie_byid($movie_id);
            $movie_nm=$movie_dt[0]['name'];
			$data['movie'][$i]['movie_name']=$movie_nm;
		}
        $this->load->view('movie',$data);
	}
	public function add_movie(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$movie_name=trim($this->input->post('movieName'));
			$mv_ext=$this->lm->get_ext_movie_name($movie_name);
			if(count($mv_ext)>0){
				$movie_id=$mv_ext[0]['movieId'];
			}else{
				$movie_id=substr(create_guid(),0,16);
			}
			
			$movie_data=array(
            	'movieId'=>$movie_id,
            	'name'=>$movie_name
            	);
           $movie_hall_data=array(
           	'Id'=>substr(create_guid(),0,16),
           	'movieId'=>$movie_id,
            'hallId'=>$this->input->post('movie_hall')
            );
           if(count($mv_ext)>0){
           	   $this->lm->add_movie_data($movie_hall_data);
           }else{
           	   $this->lm->add_movie_data_all($movie_data,$movie_hall_data);
           }
            
            $this->session->set_flashdata('item', 'Movie added successfully');
            @redirect(base_url().'index.php/location/movie');
		}else{
			$data['hall']=$this->lm->get_active_movie_hall();
			$this->load->view('add_movie',$data);
		}
	}
	public function edit_movie($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
            $movieId=$this->input->post('movieId');
            $moviehallId=$this->input->post('moviehallId');
            $mov_name=trim($this->input->post('hidmoviename'));
			$mv_ext=$this->lm->get_ext_movie_name($mov_name);
			if(count($mv_ext)>0 && $mov_name<>$this->input->post('movieName')){
				$flin=1;
				$movieId=substr(create_guid(),0,16);
				$movie_data=array(
				'movieId'=>$movieId,
            	'name'=>$this->input->post('movieName')
            	);
            	$movie_hall_data=array(
            	'movieId'=>$movieId,
            	'hallId'=>$this->input->post('movie_hall')
            	);
			}else{
				$flin=0;
				$movie_data=array(
            	'name'=>$this->input->post('movieName'),
            	);
            $movie_hall_data=array(
            	'hallId'=>$this->input->post('movie_hall')
            	);
			}
            
            $this->lm->update_movie($movieId,$movie_data,$moviehallId,$movie_hall_data,$flin);
            $this->session->set_flashdata('item', 'Movie updated successfully');
            @redirect(base_url().'index.php/location/movie');
		}else{
			$data['hall']=$this->lm->get_active_movie_hall();
			$data['movie']=$this->lm->get_movie_hall_data_byid($id);
			for($i=0;$i<count($data['movie']);$i++){
				$movie_id=$data['movie'][$i]['movieId'];
			$movie_dt=$this->lm->get_movie_byid($movie_id);
            $movie_nm=$movie_dt[0]['name'];
				$data['movie'][$i]['name']=$movie_nm;
			}
			$this->load->view('edit_movie',$data);
		}
	}
	public function delete_movie($id=""){
		authenticate(array('ut1'));
		if($id)
		{
			$table='movie_hall_data';
			$column_name='Id';
			$ext_movie_hall_data=$this->lm->get_movie_hall_data_byid($id);
			$movieId=$ext_movie_hall_data[0]['movieId'];
			$ext_movie=$this->lm->get_movie_hall_data_bymovieid($movieId);
			if(count($ext_movie)>1){
				$result = $this->lm->delete($table,$id,$column_name);
			}else{
				$table1='movie';
			    $column_name1='movieId';
                $result = $this->lm->delete($table,$id,$column_name);
                $result1 = $this->lm->delete($table1,$movieId,$column_name1);
			}
			
			$this->session->set_flashdata('item', 'Movie deleted successfully');
			redirect('index.php/location/movie');
		}
	}
	public function change_movie_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="movie_hall_data";
					$pid='Id';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_movie_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_movie_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function restaurant_location(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['res_loc']=$this->lm->get_resturant_location();
		$this->load->view('resturant_location',$data);
	}
	public function add_restaurant_location(){
        authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
            $res_loc_data=array(
            	'locationId'=>substr(create_guid(),0,16),
            	'name'=>$this->input->post('res_location')
            	);
            $this->lm->add_res_loc_data($res_loc_data);
            $this->session->set_flashdata('item', 'Restaurant Location added successfully');
            @redirect(base_url().'index.php/location/restaurant_location');
		}else{
			$this->load->view('add_resturant_location',$data);
		}
	}
	
	public function edit_restaurant_location($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$locId=$this->input->post('location_id');
            $loc_data=array(
            	'name'=>$this->input->post('locationName')
            	);
            $this->lm->update_res_loc($locId,$loc_data);
            $this->session->set_flashdata('item', 'Restaurant Location updated successfully');
            @redirect(base_url().'index.php/location/restaurant_location');
		}else{
			$data['res_loc']=$this->lm->get_resturant_location_byid($id);
			$this->load->view('edit_resturant_location', $data);
		}
	}
	public function delete_restaurant_location($id=""){
        authenticate(array('ut1'));
		if($id)
		{
			$table='resturant_location';
			$column_name='locationId';
			$table1='resturant_location_data';
			$column_name1='locationId';
			$result = $this->lm->delete($table,$id,$column_name);
			$result1 = $this->lm->delete($table1,$id,$column_name1);
			$this->session->set_flashdata('item', 'Restaurant Location deleted successfully');
			redirect('index.php/location/restaurant_location');
		}
	}
	public function change_res_location_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="resturant_location";
					$pid='locationId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_res_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_res_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function restaurant(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['resturant']=$this->lm->get_resturant();
		
		for($i=0;$i<count($data['resturant']);$i++){
			$res_id=$data['resturant'][$i]['resturantId'];
			$res_dt=$this->lm->get_resturant_byid($res_id);
            $res_nm=$res_dt[0]['name'];
			$data['resturant'][$i]['res_name']=$res_nm;
		}
		//print_r($data);
        $this->load->view('resturant',$data);
	}
	public function add_restaurant(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$res_name=trim($this->input->post('resName'));
			$mv_ext=$this->lm->get_ext_res_name($res_name);
			if(count($mv_ext)>0){
				$res_id=$mv_ext[0]['resturantId'];
			}else{
				$res_id=substr(create_guid(),0,16);
			}
			
			$res_data=array(
            	'resturantId'=>$res_id,
            	'name'=>$res_name
            	);
           $res_loc_data=array(
           	'Id'=>substr(create_guid(),0,16),
           	'resturantId'=>$res_id,
            'locationId'=>$this->input->post('res_loc')
            );
           if(count($mv_ext)>0){
           	   $this->lm->add_resturant_data($res_loc_data);
           }else{
           	   $this->lm->add_resturant_data_all($res_data,$res_loc_data);
           }
            
            $this->session->set_flashdata('item', 'Restaurant added successfully');
            @redirect(base_url().'index.php/location/restaurant');
		}else{
			$data['res_loc']=$this->lm->get_active_resturant_hall();
			$this->load->view('add_resturant',$data);
		}
	}
	public function edit_restaurant($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
            $resId=$this->input->post('resId');
            $reslocId=$this->input->post('reslocId');
            $res_name=trim($this->input->post('hidresname'));
			$mv_ext=$this->lm->get_ext_res_name($res_name);
			if(count($mv_ext)>0 && $res_name<>$this->input->post('resturantName')){
				$flin=1;
				$returantId=substr(create_guid(),0,16);
				$res_data=array(
				'resturantId'=>$returantId,
            	'name'=>$this->input->post('resturantName')
            	);
            	$res_loc_data=array(
            	'resturantId'=>$returantId,
            	'locationId'=>$this->input->post('res_loc')
            	);
			}else{
				$flin=0;
				$res_data=array(
            	'name'=>$this->input->post('resturantName'),
            	);
            $res_loc_data=array(
            	'locationId'=>$this->input->post('res_loc')
            	);
			}
            
            $this->lm->update_resturant($resId,$res_data,$reslocId,$res_loc_data,$flin);
            $this->session->set_flashdata('item', 'Restaurant updated successfully');
            @redirect(base_url().'index.php/location/restaurant');
		}else{
			$data['res_loc']=$this->lm->get_active_resturant_hall();
			$data['resturant']=$this->lm->get_resturant_loc_data_byid($id);
			for($i=0;$i<count($data['resturant']);$i++){
				$res_id=$data['resturant'][$i]['resturantId'];
			$res_dt=$this->lm->get_resturant_byid($res_id);
            $res_nm=$res_dt[0]['name'];
				$data['resturant'][$i]['name']=$res_nm;
			}
			$this->load->view('edit_resturant',$data);
		}
	}
	public function change_restaurant_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="resturant_location_data";
					$pid='Id';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_restaurant_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_restaurant_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_restaurant($id=""){
		authenticate(array('ut1'));
		if($id)
		{
			$table='resturant_location_data';
			$column_name='Id';
			$ext_res_loc_data=$this->lm->get_resturant_location_data_byid($id);
			$resId=$ext_res_loc_data[0]['resturantId'];
			$ext_resturant=$this->lm->get_resturant_location_data_byresturantid($resId);
			if(count($ext_resturant)>1){
				$result = $this->lm->delete($table,$id,$column_name);
			}else{
				$table1='resturant';
			    $column_name1='resturantId';
                $result = $this->lm->delete($table,$id,$column_name);
                $result1 = $this->lm->delete($table1,$resId,$column_name1);
			}
			
			$this->session->set_flashdata('item', 'Restaurant deleted successfully');
			redirect('index.php/location/restaurant');
		}
	}
	public function event(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['event']=$this->lm->get_event();
		$this->load->view('event',$data);
	}
	public function add_event(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$event_data=array(
				'eventId'=>substr(create_guid(),0,16),
				'eventName'=>$this->input->post('eventName')
				);
			$this->lm->add_event_data($event_data);
			$this->session->set_flashdata('item', 'Event added successfully');
			redirect('index.php/location/event');
		}else{
			$this->load->view('add_event',$data);
		}
		
	}
	public function edit_event($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['event']=$this->lm->get_event_byid($id);
		if($_POST){
			$eventId=$this->input->post('eventId');
			$event_data=array(
				'eventName'=>$this->input->post('eventName')
				);
			
			$this->lm->update_event_data($eventId,$event_data);
			$this->session->set_flashdata('item', 'Event updated successfully');
			redirect('index.php/location/event');
		}
		$this->load->view('edit_event',$data);
	}
	public function change_event_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="event";
					$pid='eventId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_event_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_event_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_event($id=""){
         authenticate(array('ut1'));
		if($id)
		{
			$table='event';
			
			$column_name='eventId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'Event deleted successfully');
			redirect('index.php/location/event');
		}
	}
	public function event_location(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['event_location']=$this->lm->get_event_location();
		$this->load->view('event_location',$data);
	}
	public function add_event_location(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$event_data=array(
				'locationId'=>substr(create_guid(),0,16),
				'location'=>$this->input->post('eventLocation')
				);
			$this->lm->add_event_location_data($event_data);
			$this->session->set_flashdata('item', 'Event Location added successfully');
			redirect('index.php/location/event_location');
		}else{
			$this->load->view('add_event_location',$data);
		}
	}
	public function edit_event_location($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['event_loc']=$this->lm->get_event_location_byid($id);
		if($_POST){
			$locationId=$this->input->post('locationId');
			$event_data=array(
				'location'=>$this->input->post('eventLocation')
				);
			
			$this->lm->update_event_location_data($locationId,$event_data);
			$this->session->set_flashdata('item', 'Event Location updated successfully');
			redirect('index.php/location/event_location');
		}
		$this->load->view('edit_event_location',$data);
	}
	public function change_event_location_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="event_location";
					$pid='locationId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_event_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_event_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_event_location($id=""){
		 authenticate(array('ut1'));
		if($id)
		{
			$table='event_location';
			
			$column_name='locationId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'Event Location deleted successfully');
			redirect('index.php/location/event_location');
		}
	}
	public function experience(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['experience']=$this->lm->get_experience();
		$this->load->view('experience',$data);
	}
	public function add_experience(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$exp_data=array(
				'experienceId'=>substr(create_guid(),0,16),
				'experienceName'=>$this->input->post('experienceName')
				);
			$this->lm->add_experience_data($exp_data);
			$this->session->set_flashdata('item', 'Experience added successfully');
			redirect('index.php/location/experience');
		}else{
			$this->load->view('add_experience',$data);
		}
	}
	public function edit_experience($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['experience']=$this->lm->get_experience_byid($id);
		if($_POST){
			$experienceId=$this->input->post('experienceId');
			$exp_data=array(
				'experienceName'=>$this->input->post('experienceName')
				);
			
			$this->lm->update_experience_data($experienceId,$exp_data);
			$this->session->set_flashdata('item', 'Experience updated successfully');
			redirect('index.php/location/experience');
		}
		$this->load->view('edit_experience',$data);
	}
	public function change_experience_status(){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="experience";
					$pid='experienceId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_experience_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_experience_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_experience($id=""){
		 authenticate(array('ut1'));
		if($id)
		{
			$table='experience';
			
			$column_name='experienceId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'Experience deleted successfully');
			redirect('index.php/location/experience');
		}
	}
	public function experience_location(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['experience_loc']=$this->lm->get_experience_location();
		$this->load->view('experience_location',$data);
	}
	public function add_experience_location(){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		if($_POST){
			$exp_loc_data=array(
				'locationId'=>substr(create_guid(),0,16),
				'location'=>$this->input->post('experienceLocation')
				);
			$this->lm->add_experience_location_data($exp_loc_data);
			$this->session->set_flashdata('item', 'Experience Location added successfully');
			redirect('index.php/location/experience_location');
		}else{
			$this->load->view('add_experience_location',$data);
		}
	}
	public function edit_experience_location($id=""){
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['exp_loc']=$this->lm->get_experience_location_byid($id);
		if($_POST){
			$locationId=$this->input->post('locationId');
			$exp_loc_data=array(
				'location'=>$this->input->post('experienceLocation')
				);
			
			$this->lm->update_experience_location_data($locationId,$exp_loc_data);
			$this->session->set_flashdata('item', 'Experience Location updated successfully');
			redirect('index.php/location/experience_location');
		}
		$this->load->view('edit_experience_location',$data);
	}
	public function change_experience_location_status($id=""){
		authenticate(array('ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status
				
				);
					$table	="experience_location";
					$pid='locationId';
		    $result = $this->lm->editPage($pid,$arr,$id,$table);
		   
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_experience_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_experience_location_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_experience_location($id=""){
		 authenticate(array('ut1'));
		if($id)
		{
			$table='experience_location';
			
			$column_name='locationId';
			
			$result = $this->lm->delete($table,$id,$column_name);
			$this->session->set_flashdata('item', 'Experience Location deleted successfully');
			redirect('index.php/location/experience');
		}
	}

}
?>
