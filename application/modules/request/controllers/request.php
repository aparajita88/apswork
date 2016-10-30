<?php
class Request extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('email');
		$this->load->model('login/login_model');
	    $this->load->model('users/login');
	     $this->load->model('request_model');
	     $this->load->model('rooms/rooms_model');
	     $this->load->model('location/location_model', 'lm');
	     $this->load->model('manager/service_request');
	     $this->load->helper('common');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
	
	}



 public function add_request_courier()
	{
			 authenticate(array('ut4','ut11','ut7','ut5'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		if($userTypeId=='ut7' || $userTypeId=='ut5'){
			$data['userlist']=$this->request_model->get_all_client_info();
		}
		$data['userData'] = $this->login->getUserProfile($userId);
        $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['choice_courier']=$this->request_model->getchoiceofcourier();
		$data['staff_type']=$this->service_request->get_service_type();
	
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
		    if(!empty($this->input->post('client_id'))){
		    	$request_by=$this->input->post('client_id');
		    	$clientdata = $this->login->getUserProfile($request_by);
		    	$cities=$clientdata['city_id'];
                $location=$clientdata['location_id'];
	            $company=$clientdata['company_id'];
		    }else{
		    	$request_by=$this->session->userdata('userId');
		    	$cities=$this->input->post('city');
                $location=$this->input->post('location');
	            $company=$this->session->userdata('company_id');
		    }
			$data=array(
			             'id'=>$id,
			          
						'courier_type'=>$this->input->post('courier_type'),
						
						'mode_of_delivery'=>$this->input->post('delivery_type'),
						'destination'=>$this->input->post('address'),
						
						'city_id'=>$cities,
						'location_id'=>$location,
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
						'package_description'=>$this->input->post('description'),
						
						'requested_by'=>$request_by,
						'price'=>$this->input->post('courier_price'),
						'company_id'=>$company,
						'ticketId'=>$ticketId
						);
        
		$this->request_model->add_courier_service_data($data);
         $data['userData'] = $this->login->getUserProfile($request_by);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		
			
			$this->session->set_flashdata('edit',"You have successfully request for courier service.");
			redirect(base_url().'index.php/request/add_request_courier');
		}
			
			
	
	
	$this->load->view('add_request_courier',$data);
}
public function get_priority_price(){
	$courier_type=$this->input->post('courier_type');
	$priority=$this->input->post('priority');
	$price_info=$this->request_model->get_price_for_courier($courier_type,$priority);
	if($priority=='Priority'){
		echo $price=$price_info[0]['priority_price'];
	}
	else if($priority=='Normal'){
		echo $price=$price_info[0]['normal_price'];
	}
}


public function add_request_officeboy()
	{
			 authenticate(array('ut4','ut11','ut5','ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		if($userTypeId=='ut7' || $userTypeId=='ut5'){
			$data['userlist']=$this->request_model->get_all_client_info();
		}
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['cities']=$this->lm->getcities();
	    $data['vendor']=$this->login->get_vendor_List();
	    $id='43d70765-fc3f-90';
	    $data['request']= $this->request_model->get_requestByrequestid($id);
	
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
		   if(!empty($this->input->post('client_id'))){
		    	$request_by=$this->input->post('client_id');
		    	$clientdata = $this->login->getUserProfile($request_by);
		    	$cities=$clientdata['city_id'];
                $location=$clientdata['location_id'];
	            $company=$clientdata['company_id'];
		    }else{
		    	$request_by=$this->session->userdata('userId');
		    	$cities=$this->input->post('city');
                $location=$this->input->post('location');
	            $company=$this->session->userdata('company_id');
		    }
			$data=array(
			             'id'=>$id,
			          
						'stuff_type'=>'office boy',
					    'start_date'=>($this->input->post('start_date') ==NULL ? $this->input->post('start_date_day') : $this->input->post('start_date')),
						'end_date'=>($this->input->post('end_date') ==NULL ? $this->input->post('end_date_day') : $this->input->post('end_date')),
						'description'=>$this->input->post('detailes'),
						'vendorId'=>$this->input->post('vendor_name'),
						'city_id'=>$cities,
						'location_id'=>$location,
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					    'price'=>($this->input->post('totalIncTax') ==NULL ? $this->input->post('totalIncTax_day') : $this->input->post('totalIncTax')),
						'requested_by'=>$request_by,
						 'company_id'=>$company,
						'ticketId'=>$ticketId
						);

		
		
			$result = insert_into_tbl('request_stuff_service',$data);	
			
			$data['userData'] = $this->login->getUserProfile($request_by);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		
			
			$this->session->set_flashdata('edit',"You have successfully request for officeboy service.");
			redirect(base_url().'index.php/request/add_request_officeboy');
		}
			
			
	
	
	$this->load->view('add_request_officeboy',$data);
}
 public function add_request_reception(){
	 	 authenticate(array('ut4','ut11'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['cities']=$this->lm->getcities();
	    $data['vendor']=$this->login->get_vendor_List();
	    $id='9f6ca717-2c6f-2d';
	    $data['request']= $this->request_model->get_requestByrequestid($id);
		
	
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
			$data=array(
			             'id'=>$id,
			          
						'stuff_type'=>'phone reception',
					     'start_date'=>($this->input->post('start_date') ==NULL ? $this->input->post('start_date_day') : $this->input->post('start_date')),
						'end_date'=>($this->input->post('end_date') ==NULL ? $this->input->post('end_date_day') : $this->input->post('end_date')),
						'description'=>$this->input->post('detailes'),
						'vendorId'=>$this->input->post('vendor_name'),
						'city_id'=>$this->input->post('city'),
						'location_id'=>$this->input->post('location'),
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					    'price'=>($this->input->post('totalIncTax') ==NULL ? $this->input->post('totalIncTax_day') : $this->input->post('totalIncTax')),
						
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id'),
						 'ticketId'=>$ticketId
						);

		
			
		
				
			$result = insert_into_tbl('request_stuff_service',$data);	
			
			$data['userData'] = $this->login->getUserProfile($userId);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
			
			$this->session->set_flashdata('edit',"You have successfully request for Phone Reception.");
			redirect(base_url().'index.php/request/add_request_reception');
		}
			
			
	
	
	$this->load->view('add_request_reception',$data); 
	 
	 
 }

	public function add_request_secterial(){
			 authenticate(array('ut4','ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['cities']=$this->lm->getcities();
	    $data['vendor']=$this->login->get_vendor_List();
		$id='b60ebb25-3016-ff';
	    $data['request']= $this->request_model->get_requestByrequestid($id);
	
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
			$data=array(
			             'id'=>$id,
			          
						'stuff_type'=>'secretarial support',
						
						
						 'start_date'=>($this->input->post('start_date') ==NULL ? $this->input->post('start_date_day') : $this->input->post('start_date')),
						'end_date'=>($this->input->post('end_date') ==NULL ? $this->input->post('end_date_day') : $this->input->post('end_date')),
						'description'=>$this->input->post('detailes'),
						'vendorId'=>$this->input->post('vendor_name'),
						'city_id'=>$this->input->post('city'),
						'location_id'=>$this->input->post('location'),
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					    'price'=>($this->input->post('totalIncTax') ==NULL ? $this->input->post('totalIncTax_day') : $this->input->post('totalIncTax')),
						
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id'),
						'ticketId'=>$ticketId
						);

			$result = insert_into_tbl('request_stuff_service',$data);	
			
			$data['userData'] = $this->login->getUserProfile($userId);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
			
			$this->session->set_flashdata('edit',"You have successfully request for Secterial Support.");
			redirect(base_url().'index.php/request/add_request_secterial');
		}
			
			
	
	
	$this->load->view('add_request_secterial',$data); 
	 
		
	}
 public function add_request_legal(){
	 	 authenticate(array('ut4','ut11'));
	$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['cities']=$this->lm->getcities();
	    $data['vendor']=$this->login->get_vendor_List();
	    $id='ee700d01-9ae6-35';
	    $data['request']= $this->request_model->get_requestByrequestid($id);
		
	
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
			$data=array(
			             'id'=>$id,
			          
						'stuff_type'=>'legal support',
						
						
						'start_date'=>($this->input->post('start_date') ==NULL ? $this->input->post('start_date_day') : $this->input->post('start_date')),
						'end_date'=>($this->input->post('end_date') ==NULL ? $this->input->post('end_date_day') : $this->input->post('end_date')),
						'description'=>$this->input->post('detailes'),
						'vendorId'=>$this->input->post('vendor_name'),
						'city_id'=>$this->input->post('city'),
						'location_id'=>$this->input->post('location'),
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					    'price'=>($this->input->post('totalIncTax') ==NULL ? $this->input->post('totalIncTax_day') : $this->input->post('totalIncTax')),
						
						
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id'),
						'ticketId'=>$ticketId
						);

		
			$result = insert_into_tbl('request_stuff_service',$data);	
			$data['userData'] = $this->login->getUserProfile($userId);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
			
		$this->session->set_flashdata('edit',"You have successfully request for Legal Support.");
		redirect(base_url().'index.php/request/add_request_legal');
		}
			
			
	
	
	$this->load->view('add_request_legal',$data); 
	 	
		
	}

	 public function add_request_it(){
		
		 	 authenticate(array('ut4','ut11','ut5','ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		if($userTypeId=='ut7' || $userTypeId=='ut5'){
			$data['userlist']=$this->request_model->get_all_client_info();
		}
		//print_r($data['client_info']);
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['cities']=$this->lm->getcities();
	    $data['vendor']=$this->login->get_vendor_List();
		$id='eeaaf534-7bc9-0b';
	    $data['request']= $this->request_model->get_requestByrequestid($id);
	
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
		    if(!empty($this->input->post('client_id'))){
		    	$request_by=$this->input->post('client_id');
		    	$clientdata = $this->login->getUserProfile($request_by);
		    	$cities=$clientdata['city_id'];
                $location=$clientdata['location_id'];
	            $company=$clientdata['company_id'];
		    }else{
		    	$request_by=$this->session->userdata('userId');
		    	$cities=$this->input->post('city');
                $location=$this->input->post('location');
	            $company=$this->session->userdata('company_id');
		    }
			$data=array(
			             'id'=>$id,
			          
						'stuff_type'=>'it support',
						
						
						'start_date'=>($this->input->post('start_date') ==NULL ? $this->input->post('start_date_day') : $this->input->post('start_date')),
						'end_date'=>($this->input->post('end_date') ==NULL ? $this->input->post('end_date_day') : $this->input->post('end_date')),
						'description'=>$this->input->post('detailes'),
						'vendorId'=>$this->input->post('vendor_name'),
						'city_id'=>$cities,
						'location_id'=>$location,
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					    'price'=>($this->input->post('totalIncTax') ==NULL ? $this->input->post('totalIncTax_day') : $this->input->post('totalIncTax')),
						
						'requested_by'=>$request_by,
						 'company_id'=>$company,
						'ticketId'=>$ticketId
						);

				
			$result = insert_into_tbl('request_stuff_service',$data);	
			
			$data['userData'] = $this->login->getUserProfile($request_by);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
			
			$this->session->set_flashdata('edit',"You have successfully request for It Support.");
			redirect(base_url().'index.php/request/add_request_it');
		}
				
		$this->load->view('add_request_it',$data); 
		
	}
	public function get_cafeitemby_location($location_id,$city_id){
	$data['cafe_cat']=$this->rooms_model->get_cafe_cat($city_id,$location_id);
	$this->load->view('request/ajax_cafe',$data);
      	
		
	}
	public function add_request_cafe(){
		
		authenticate(array('ut4','ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
        $firstname=$data['userData']['FirstName'];
		$lastname=$data['userData']['LastName'];
		$email=$data['userData']['userEmail'];
		$data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['cafe_cat']=$this->rooms_model->get_cafe_cat($data['userData']['city_id'],$data['userData']['location_id']);
		
		
		if (isset($_POST) && (!empty($_POST))){
			$id=create_guid();
		    $id= substr($id,0,16);
		    $ticketId=rand(10000000,99999999);
		 
			$data=array(
			             'id'=>$id,
			          
						'detailes'=>$this->input->post('order'),
						'city_id'=>$this->input->post('city'),
						'location_id'=>$this->input->post('location'),
						'price'=>$this->input->post('price'),
						'dateAdded'		=> date('Y-m-d H:i:s'),
						'status'=>'1',
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id'),
						'ticketId'=>$ticketId
						);
        
		$result = insert_into_tbl('request_food_service',$data);
		$email_template_id='43503e08-2736-6f'; //Booking service template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$fullname 		= ucfirst($firstname).' '.ucfirst($lastname);
			$body 			= str_replace('[client full name]',$fullname,$body);
			$body 			= str_replace('[Ticket No]',$ticketId,$body);
            $from_email 	= 'pantry@smartworks.com'; // should change with smartworks team
                       
	  		/*User Payment Mail Function*/
	  		$this->email->to($email);
		    $this->email->from($from_email);
		    $this->email->subject($email_template['subject']);
		    $this->email->message($body);
		    //$this->email->send();
			
			exit;	
		
		
		}
				
		$this->load->view('add_request_cafe',$data); 
		
	}
		public function add_request_travel(){
				 authenticate(array('ut4','ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    
	    if (isset($_POST) && (!empty($_POST))){
			
		$id=create_guid();
		$id= substr($id,0,16);	
		$location_id=$this->input->post('location');
		$city_id=$this->input->post('city');
	
			$data=array(
			             'id'=>$id,
			          
						
						'location_id'=>$location_id,
						'city_id'=>$city_id,
						'conceirge_type'=>'travel plans',
						'transport_type'=>$this->input->post('travel_type'),
						'direction'=>$this->input->post('way'),
						'from_city_id'=>$this->input->post('from'),
						'to_city_id'=>$this->input->post('to'),
						'start_date'=>date("Y-m-d", strtotime($this->input->post('start'))),
						'end_date'=>date("Y-m-d", strtotime($this->input->post('end'))),
						'total_passengers'=>$this->input->post('passenger_no'),
						'passenger_name'=>$this->input->post('pname'),
						'hotel_required'=>$this->input->post('bk_hotel'),
						'hotel_type'=>$this->input->post('hotel_type'),
						'special_instruction'=>$this->input->post('instruction'),
					        'dateAdded'=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					
						
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id')
						
						);

		
			$result = insert_into_tbl('request_conceirge_service',$data);	
			
			
			
			$this->session->set_flashdata('edit',"You have successfully request for smart concierge travel desk.");
			redirect(base_url().'index.php/request/add_request_travel/'.$city_id.'/'.$location_id);
		}
	    
	    
	    $this->load->view('add_request_travel',$data); 	
			
		}
		public function add_request_event(){
				 authenticate(array('ut4','ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    
	    if (isset($_POST) && (!empty($_POST))){
			
		$id=create_guid();
		$id= substr($id,0,16);	
		$location_id=$this->input->post('location');
		$city_id=$this->input->post('city');
		
			$data=array(
			            'id'=>$id,
			          
						
						'location_id'=>$location_id,
						'city_id'=>$city_id,
						'conceirge_type'=>'event',
						'details'=>$this->input->post('details'),
					        'dateAdded'=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					
						
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id')
						
						);

			$result = insert_into_tbl('request_conceirge_service',$data);	
	
			$this->session->set_flashdata('edit',"You have successfully request for smart concierge event.");
			redirect(base_url().'index.php/request/add_request_event/'.$city_id.'/'.$location_id);
		}
	    
	    
	    $this->load->view('add_request_event',$data); 	
			
		}
		public function request_list()
   {
	    
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['query']=$this->request_model->get_request_List();
		//print_r($data['query']);
	    $this->load->view('request_list',$data);
   }
   public function edit_request($id)
   {
	   authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['request']= $this->request_model->get_requestByrequestid($id);
   
      
     if (isset($_POST) && (!empty($_POST)))
	 {  
		 	
			$data=array(
						
						'day_price'=>$this->input->post('day_price'),
						'hourly_price'=>$this->input->post("hourly_price")
					   );
						
				$result = update_tbl('requests','id',$id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/request/request_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/request/edit_request/'.$id);
				}
       
      } 
   
   
  
    $this->load->view("edit_request",$data);  
   }
		public function add_request_booking(){
			 authenticate(array('ut4','ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    
	    if (isset($_POST) && (!empty($_POST))){
			
		$id=create_guid();
		$id= substr($id,0,16);	
		$location_id=$this->input->post('location');
		$city_id=$this->input->post('city');
		
			$data=array(
			            'id'=>$id,
			          
						
						'location_id'=>$location_id,
						'city_id'=>$city_id,
						'conceirge_type'=>'bookings',
						'details'=>$this->input->post('details'),
					        'dateAdded'=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					
						
						'requested_by'=>$this->session->userdata('userId'),
						 'company_id'=>$this->session->userdata('company_id')
						);

			$result = insert_into_tbl('request_conceirge_service',$data);	
	
			$this->session->set_flashdata('edit',"You have successfully request for smart concierge booking.");
			redirect(base_url().'index.php/request/add_request_booking/'.$city_id.'/'.$location_id);
		}
	    
	    
	    $this->load->view('add_request_booking',$data); 	
			
		}
		
		public function add_request_payroll(){
				 authenticate(array('ut4','ut11','ut5','ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		if($userTypeId=='ut7' || $userTypeId=='ut5'){
			$data['userlist']=$this->request_model->get_all_client_info();
		}
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    
	    if (isset($_POST) && (!empty($_POST))){
			
		$id=create_guid();
		$id= substr($id,0,16);
		$ticketId=rand(10000000,99999999);	
		if(!empty($this->input->post('client_id'))){
		    	$request_by=$this->input->post('client_id');
		    	$clientdata = $this->login->getUserProfile($request_by);
		    	$cities=$clientdata['city_id'];
                $location=$clientdata['location_id'];
	            $company=$clientdata['company_id'];
		    }else{
		    	$request_by=$this->session->userdata('userId');
		    	$cities=$this->input->post('city');
                $location=$this->input->post('location');
	            $company=$this->session->userdata('company_id');
		    }
		
		    $data=array(
			             'id'=>$id,
			          
						'stuff_type'=>'Clock in Clock Out Support',
						
						
						'start_date'=>($this->input->post('start_date') ==NULL ? $this->input->post('start_date_day') : $this->input->post('start_date')),
						'end_date'=>($this->input->post('end_date') ==NULL ? $this->input->post('end_date_day') : $this->input->post('end_date')),
						'description'=>$this->input->post('detailes'),
						'vendorId'=>$this->input->post('vendor_name'),
						'city_id'=>$cities,
						'location_id'=>$location,
					    'dateAdded'		=> gmdate('Y-m-d H:i:s'),
						'status'=>'1',
					    'price'=>($this->input->post('totalIncTax') ==NULL ? $this->input->post('totalIncTax_day') : $this->input->post('totalIncTax')),
						
						'requested_by'=>$request_by,
						 'company_id'=>$company,
						'ticketId'=>$ticketId
						);

				
			$result = insert_into_tbl('request_stuff_service',$data);	
			
			$data['userData'] = $this->login->getUserProfile($request_by);
		 $email_template_id='f26989d4-7a72-32';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[Customer Full Name]',$data['userData']['FirstName']." ".$data['userData']['LastName'],$body);
		 $body = str_replace('[Ticket No]',$ticketId,$body);
		
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['userData']['userEmail']); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
			$this->session->set_flashdata('edit',"You have successfully request for payroll service.");
			redirect(base_url().'index.php/request/add_request_payroll');
		}
	    
	    
	    $this->load->view('add_request_payroll',$data); 	
			
		}
		public function add_request_smartconcierge(){
		 authenticate(array('ut4','ut11'));	
			
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	     $this->load->view('add_request_concierge',$data);	
		}
		public function add_request_smartconcierge_traval_plan(){
			authenticate(array('ut4','ut11'));	
			
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
	    $data['cities']=$this->lm->getcities();
	    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	    $data['table_heading'] = 'Service Request List';
	    $data['concierge_city']=$this->request_model->get_smart_concierge_city();
	    $data['airline']=$this->request_model->get_smart_airline();
	    $data['cab']=$this->request_model->get_smart_cab();
	    $firstname=$data['userData']['FirstName'];
		$lastname=$data['userData']['LastName'];
		$email=$data['userData']['userEmail'];
	    if($_POST){

	    	if($this->input->post('flighttype')){
	    		$transport_type='Flight';
	    		$adult=$this->input->post('airline_adult');
	    		if($this->input->post('airline_child')<>""){
                 $child=$this->input->post('airline_child');
	    		}else{
	    			$child=0;
	    		}
	    		if($this->input->post('airline_infant')<>""){
                 $infant=$this->input->post('airline_infant');
	    		}else{
	    			$infant=0;
	    		}
	    		$tot_passenger=array(
	    			'adult'=>$adult,
	    			'child'=>$child,
	    			'infant'=>$infant
	    			);
	    	if($this->input->post('airline_return')<>""){
	    		$enddate=implode('-',array_reverse(explode("/", $this->input->post('airline_return'))));
	    	}else{
	    		$enddate="";
	    	}
            $ticketId=rand(10000000,99999999);
	    	$travel_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'conceirge_type'=>'travel plans',
	    		'transport_type'=>$transport_type,
	    		'direction'=>$this->input->post('optradio'),
	    		'from_city_id'=>$this->input->post('airline_formcity'),
	    		'to_city_id'=>$this->input->post('airline_tocity'),
	    		'start_date'=>implode('-',array_reverse(explode("/", $this->input->post('airline_departure')))),
	    		'end_date'=>$enddate,
	    		'total_passengers'=>json_encode($tot_passenger),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'status'=>1,
	    		'company_id'=>$data['userData']['company_id'],
	    		'class'=>$this->input->post('airline_class'),
	    		'airline'=>$this->input->post('airline_name'),
	    		'budget'=>$this->input->post('airline_budget'),
	    		'approxtime'=>$this->input->post('airline_time'),
	    		'countrystatus'=>$this->input->post('flighttype'),
	    		'ticketId'=>$ticketId
	    		);
	    	
	    	$table='request_conceirge_service';
	    	$this->request_model->add_request_for_smartcocierge($travel_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Flight added successfully.");
            $this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_traval_plan');
	    }
	    else if($this->input->post('railway_fromcity')){
	    	$ticketId=rand(10000000,99999999);
	    	$travel_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'conceirge_type'=>'travel plans',
	    		'transport_type'=>'Train',
	    		'from_city_id'=>$this->input->post('railway_fromcity'),
	    		'to_city_id'=>$this->input->post('railway_tocity'),
	    		'start_date'=>implode('-',array_reverse(explode("/", $this->input->post('railway_departure')))),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'status'=>1,
	    		'company_id'=>$data['userData']['company_id'],
	    		'ticketId'=>$ticketId

	    		);
	    	$table='request_conceirge_service';
	    	$this->request_model->add_request_for_smartcocierge($travel_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Train added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_traval_plan');
	    }
	    else if($this->input->post('bus_fromcity')){
	    	$ticketId=rand(10000000,99999999);
	    	$travel_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'conceirge_type'=>'travel plans',
	    		'transport_type'=>'Bus',
	    		'from_city_id'=>$this->input->post('bus_fromcity'),
	    		'to_city_id'=>$this->input->post('bus_tocity'),
	    		'start_date'=>implode('-',array_reverse(explode("/", $this->input->post('bus_departure')))),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'status'=>1,
	    		'company_id'=>$data['userData']['company_id'],
	    		'budget'=>$this->input->post('bus_budget'),
	    		'approxtime'=>$this->input->post('bus_time'),
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_service';
	    	$this->request_model->add_request_for_smartcocierge($travel_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Bus added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_traval_plan');
	    }
	    else if($this->input->post('cab_fromcity')){
	    	$ticketId=rand(10000000,99999999);
	    	$travel_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'conceirge_type'=>'travel plans',
	    		'transport_type'=>'Cab',
	    		'from_city_id'=>$this->input->post('cab_fromcity'),
	    		'to_city_id'=>$this->input->post('cab_tocity'),
	    		'start_date'=>implode('-',array_reverse(explode("/", $this->input->post('cab_departure')))),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'status'=>1,
	    		'company_id'=>$data['userData']['company_id'],
	    		'cab'=>$this->input->post('cab_preference'),
	    		'approxtime'=>$this->input->post('cab_time'),
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_service';
	    	$this->request_model->add_request_for_smartcocierge($travel_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Cab added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_traval_plan');
	    }
	    if($this->input->post('room_city')){
	    	$ticketId=rand(10000000,99999999);
	    	$room_details=array();
	    	for($i=0;$i<count($this->input->post('room_adult'));$i++){
                  $j=$i+1;
                  if($this->input->post('room_child')[$i]<>""){
                     $chlno=$this->input->post('room_child')[$i];
                  }else{
                  	$chlno=0;
                  }
                  if($this->input->post('room_adult')[$i]<>""){
                  	$room_details[]=array(
                  	'room'.$j=>array(
                  		'adult'=>$this->input->post('room_adult')[$i],
                  		'child'=>$chlno
                  		)
                  	);
                  }
                  
                  
	    	}
	    	$rm_details=json_encode($room_details);
	    	$req_hotel_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'check_in'=>implode('-',array_reverse(explode("/", $this->input->post('room_check_in')))),
	    		'check_out'=>implode('-',array_reverse(explode("/", $this->input->post('room_check_out')))),
	    		'city'=>$this->input->post('room_city'),
	    		'budget'=>$this->input->post('room_budget'),
	    		'hotel_type'=>$this->input->post('room_star'),
	    		'no_of_night'=>$this->input->post('room_no_of_night'),
	    		'room_details'=>$rm_details,
	    		'country_status'=>$this->input->post('hotel_status'),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'status'=>1,
	    		'company_id'=>$data['userData']['company_id'],
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_hotel';
	    	$this->request_model->add_request_for_smartcocierge($req_hotel_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Hotel added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_traval_plan');
	    }
	    }
	    $this->load->view('add_request_smartconcierge',$data); 
		}
		public function add_request_smartconcierge_booking(){
               authenticate(array('ut4','ut11'));	
			
				$userId = $this->session->userdata("userId");
				$userTypeId = $this->session->userdata("userTypeId");
				$data['userData'] = $this->login->getUserProfile($userId);
				$data['cities']=$this->lm->getcities();
			    $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
			    $data['movie']=$this->request_model->get_all_movie();
			    $data['res_location']=$this->request_model->get_all_location();
			    $data['event']=$this->request_model->get_all_active_event();
			    $data['event_loc']=$this->request_model->get_all_active_event_location();
			    $data['experience']=$this->request_model->get_all_active_experience();
			    $data['exp_loc']=$this->request_model->get_all_active_experience_location();
			    $firstname=$data['userData']['FirstName'];
		        $lastname=$data['userData']['LastName'];
		        $email=$data['userData']['userEmail'];
			    if($_POST){
			    	if($this->input->post('movie_name')){
			    		$ticketId=rand(10000000,99999999);
	    	$booking_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'booking_type'=>'movie',
	    		'name'=>$this->input->post('movie_name'),
	    		'location'=>$this->input->post('movie_location'),
	    		'request_date'=>implode('-',array_reverse(explode("/", $this->input->post('movie_date')))),
	    		'start_time'=>$this->input->post('movie_time'),
	    		'no_of_person'=>$this->input->post('movie_person'),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'company_id'=>$data['userData']['company_id'],
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_booking';
	    	$this->request_model->add_bookingrequest_for_smartcocierge($booking_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Movie added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_booking');
	    }
	    if($this->input->post('resturant')){
	    	$ticketId=rand(10000000,99999999);
	    	$booking_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'booking_type'=>'restaurant',
	    		'name'=>$this->input->post('resturant'),
	    		'location'=>$this->input->post('resturant_location'),
	    		'request_date'=>implode('-',array_reverse(explode("/", $this->input->post('resturant_date')))),
	    		'no_of_person'=>$this->input->post('resturant_member'),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'food_item'=>$this->input->post('food_type'),
	    		'food_type'=>$this->input->post('food_status'),
	    		'company_id'=>$data['userData']['company_id'],
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_booking';
	    	$this->request_model->add_bookingrequest_for_smartcocierge($booking_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Restaurant added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_booking');
	    }
	    if($this->input->post('event_name')){
	    	$ticketId=rand(10000000,99999999);
	    	$booking_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'booking_type'=>'event',
	    		'name'=>$this->input->post('event_name'),
	    		'location'=>$this->input->post('event_location'),
	    		'request_date'=>implode('-',array_reverse(explode("/", $this->input->post('event_date')))),
	    		'no_of_person'=>$this->input->post('no_of_person'),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'company_id'=>$data['userData']['company_id'],
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_booking';
	    	$this->request_model->add_bookingrequest_for_smartcocierge($booking_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Event added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_booking');
	    }
	    if($this->input->post('experience_name')){
	    	$ticketId=rand(10000000,99999999);
	    	$booking_data=array(
	    		'id'=>substr(create_guid(),0,16),
	    		'location_id'=>$data['userData']['location_id'],
	    		'city_id'=>$data['userData']['city_id'],
	    		'booking_type'=>'experience',
	    		'name'=>$this->input->post('experience_name'),
	    		'location'=>$this->input->post('experience_location'),
	    		'request_date'=>implode('-',array_reverse(explode("/", $this->input->post('experience_date')))),
	    		'no_of_person'=>$this->input->post('no_of_person'),
	    		'requested_by'=>$userId,
	    		'dateAdded'=>date('Y-m-d h:i:s'),
	    		'company_id'=>$data['userData']['company_id'],
	    		'ticketId'=>$ticketId
	    		);
	    	$table='request_conceirge_booking';
	    	$this->request_model->add_bookingrequest_for_smartcocierge($booking_data,$table);
	    	$this->session->set_flashdata('add_request',"Booking request for Experience added successfully.");
	    	$this->acknowledgemailforrequest($firstname,$lastname,$email,$ticketId);
			redirect(base_url().'index.php/request/add_request_smartconcierge_booking');
	    }
			    }
			    $this->load->view('add_request_smartconceirge_booking',$data);
		}
		public function get_location_for_request(){
			
			if($this->input->post('type')=='movie'){
				$movieId=$this->input->post('movieId');
				$data['movie_hall']=$this->request_model->get_movie_hall_by_movieid($movieId);
				$this->load->view('ajxreqlocation',$data);
			}
		}
		public function get_resturant_for_request(){
			$locationId=$this->input->post('locationId');
			$data['resturant']=$this->request_model->get_all_location_of_resturant($locationId);
			$this->load->view('ajxresturantname',$data);
		}

		public function acknowledgemailforrequest($firstname,$lastname,$email,$ticketId){
			$email_template_id='efeca3af-9551-50'; //Booking service template id
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body 			= $email_template['description'];
			$fullname 		= ucfirst($firstname).' '.ucfirst($lastname);
			$body 			= str_replace('[client full name]',$fullname,$body);
			$body 			= str_replace('[Ticket No]',$ticketId,$body);
            $from_email 	= 'concierge@smartworks.com'; // should change with smartworks team
                       
	  		/*User Payment Mail Function*/
	  		$this->email->to($email);
		    $this->email->from($from_email);
		    $this->email->subject($email_template['subject']);
		    $this->email->message($body);
		    $this->email->send();
			
		}
	
}
