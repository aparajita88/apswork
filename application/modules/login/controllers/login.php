<?php

class login extends MY_Controller {
	var $adminEmail="";
	var $adminName="Admin smartworks";
	public function __construct() {
		parent::__construct();
		$this->load->model('login_model');
		$this->load->helper('form','url'); 
		$this->load->model('location/location_model', 'lm');
		$this->load->model('rooms/rooms_model');
		$this->load->model('home/home_model');
		include_once APPPATH.'third_party/PHP_WLIPG/WL/AWLMEAPI.php';  
		$this->output->enable_profiler(FALSE); //default FALSE
		$this->load->library("atos");
	}

	public function Login()
	{
		
		if($this->input->post('pageAction')=='SIGNIN'){		
			exit;
		  $data['username'] = ($this->input->post('username')!='')?$this->input->post('username'):$username;
		  $data['password'] = md5(($this->input->post('password')!='')?$this->input->post('password'):$password);
		   print_r($data);
			   exit;
		
		 
		  if($data['username']!='' && $data['password']!='')
		  {
			  
			   $res=$this->logib_model->login($data);
			   if($res!=0)
			   {
				   if($populate_userId==1){
						print_r($this->session->userdata('userId')); exit;
					}else{
						$typ=$res[0]['userTypeName'];
						echo $typ;
					}
			   }else
					 echo 0;
			   
			   exit;
		  }
	  }
	  $data['location_arr']=$this->lm->getcities();
		$data['title'] = "SMARTWORKS-LOGIN"; 
		$this->load->view('login',$data);
		  
	}
	public function afterreg(){
	$user_id =base64_decode($this->input->get('id'));
	$data['user_info']=$this->login_model->getuserinfo($user_id);
	$data['title'] = "SMARTWORKS-SIGNUP-MESSAGE"; 
	$data['location_arr']=$this->lm->getcities();
	 $this->load->view('afterreg',$data);	
	}
	
	public function signup(){

		
		$firstName = $this->input->post('firstname');
		$lasttname = $this->input->post('lasttname');
		$email = $this->input->post('email');
		$userTypeId1 = $this->input->post('id');
		$phone = $this->input->post('phoneno');
		$salutation=$this->input->post('salutation');
		$name=$firstName." ".$lasttname;
		$location=$this->input->post('location');
		
		   
			
	if (!empty($firstName) && !empty($lasttname) && !empty($email)  && !empty($phone)  ){
			
	    $password=$this->get_random_password();
	  
	   $userId=create_guid();
	   $userId= substr($userId,0,16);
	   $location=explode("/",$location);
	   $location_id=$location['1'];
	   $city_id=$location['0'];
	   $inputArray=array(
	   'userId'=> $userId,
	   'userEmail'=>$email,
	   'password'=>md5($password),
	   'FirstName'=>$firstName,
	    'LastName'=>$lasttname,
		'gender'=>$salutation,
	    'locationId'=>$location_id,
		'cityId'=>$city_id,
		'phone'=>$phone,
		'dateAdded'=>date('Y-m-d H:i:s'))	;			
		
		if($this->login_model->isEmailAvailable($email)){
			
		
		if($this->db->insert('registered_user',$inputArray)){
		
                        $distribution_user= $this->get_ist_usr();
			$uid=base64_encode($userId);
			$email=$this->login_model->sendMailForNewCustomerSignUp($email, 'fa3d0068-aff4-be',$password,$salutation,$name,$location_id,$phone,$distribution_user);
			$this->session->set_flashdata('success', '<div class="col-sm-12">
					<p>Your account has been successfuly created. An email send to your given email id, please confirm your account with click on given link on your email.</p>
            	</div>');
			redirect(base_url()."index.php/login/afterreg?id=".$uid."&email=".$email);
			}}else{
			$this->session->set_flashdata('error', '<div class="col-sm-12">
					<p>Some error occurs,while signing up...</p>
            	</div>');
			redirect(base_url()."index.php/login/signup?email=emailavailable");
			
		}
	   }
       $data['location']=$this->lm->getAlllocation();
       $data['location_arr']=$this->lm->getcities();
    	$data['title'] = "SMARTWORKS-SIGNUP"; 
		$this->load->view('signup',$data);
	} 
	
	public function membership($id){
	
		$data['location']=$this->lm->getAlllocation();
	    $data['location_arr']=$this->lm->getcities();
	    $data['subscription']=$this->rooms_model->get_subscription_type($id);
	    $data['title'] = "SMARTWORKS-SIGNUP"; 
		$this->load->view('membership',$data);
	     if (isset($_POST) && (!empty($_POST)))
		 {  
			$UserSubscriptionId = base64_decode(base64_decode($this->input->post('id')));
	        $firstName = $this->input->post('firstname');
			$lasttname = $this->input->post('lasttname');
			$email = $this->input->post('email');
			$phone = $this->input->post('phoneno');
			$street= $this->input->post('street');
			$location=$this->input->post('location');
			$location_arr=explode("/",$location);
			$location=$location_arr['1'];
			$city=$location_arr['0'];
			$pin= $this->input->post('pin');
			$add_city=$this->input->post('city');
			$info=$this->input->post('info');
			if (!empty($firstName) && !empty($lasttname) && !empty($email)  && !empty($phone)  ){
				$this->session->unset_userdata('newdata');	
				$membernum=$this->home_model->get_membership_number();
                $newdata = array(
			  	           'UserSubscriptionId'=> $UserSubscriptionId,
			  	           'membershipno'=>$membernum,
		                   'firstName'  => $firstName,
		                   'lasttname'     => $lasttname,
		                   'email' => $email,
		                   'phone'=>$phone,
		                   'street'=>$street,
		                   'add_city'=>$add_city,
		                   'pin'=>$pin,
		                   'location'=>$location,
		                   'city'=>$city,
		                   'info'=>$info
		               );
		      	$this->session->set_userdata('newdata', $newdata);
			}
			$atos_url = 'https://cgt.in.worldline.com/ipg/doMEPayRequest'; 
		    $this->atos->load($_REQUEST['mid'],$_REQUEST['OrderId'],100,$_REQUEST['meTransReqType'],$_REQUEST['enckey'],$_REQUEST['currencyName'],$_REQUEST['responseUrl'],$atos_url);
		}
	}	

	public function payment_response(){
		$session_user_data = $this->session->userdata['newdata'];
		$this->session->unset_userdata($this->session->userdata['newdata']);
		$data['fullname']=$session_user_data['firstName']." ".$session_user_data['lasttname'];
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		if ($response->getStatusCode()=="S"){
			$password=$this->get_random_password();
		   	$userId=create_guid();
		   	$userId= substr($userId,0,16);
			$inputArray_user=array(
				'membershipno'=>$session_user_data['membershipno'],
				'UserSubscriptionId'=>$session_user_data['UserSubscriptionId'],
				'UserSubscriptiondate'=>date('Y-m-d'),
				'userId'=> $userId,
				'userEmail'=> $session_user_data['email'],
				'userName'=>$session_user_data['email'],
				'password'=>md5($password),
				'userTypeId'=>'ut11',
				'FirstName'=>$session_user_data['firstName'],
				'LastName'=>$session_user_data['lasttname'],
			    'location_id'=>$session_user_data['location'],
				'city_id'=>$session_user_data['city'],
				'status'=>'1',
				'phone'=>$session_user_data['phone'],
				'street'=>$session_user_data['street'],
				'add_city'=>$session_user_data['add_city'],
				'pin'=>$session_user_data['pin'],
				'info'=>$session_user_data['info'],
				'dateAdded'=>date('Y-m-d H:i:s')
			);
			$this->db->insert('user',$inputArray_user);
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'=> $paymentId,
				'userId'=>$userId,
				'details'=>'Buy membership',
				'payment_Data'=>json_encode((array)$response),
				'Transaction_Reference_No'=>$response->getpgMeTrnRefNo(),
				'orderId'=>$response->getOrderId(),
				'Amount'=>$response->getTrnAmt(),
				'Status_Description'=>$response->getstatusDesc(),
				'RRN'=>$response->getrrn(),
			    'Authzcode'=>$response->getauthZCode(),
				'Response_code'=>$response->getresponseCode(),
				'orderDate'=>$response->gettrnReqDate(),
				'orderStatus'=>$response->getstatusCode()
          	)	;			
			$this->db->insert('payment',$inputArray_payment);
	 		
			$user_info=$this->login_model->getuserdetails($session_user_data['email']);
			$payment_info=$this->login_model->getpaymentdetails($user_info['userId']);
			$email_template_id='1c2c1f5d-01f0-95';
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body = $email_template['description'];
			$body = str_replace('[First Name]',$user_info['FirstName'],$body);
			$body = str_replace('[membership no]',wordwrap($userData['membershipno'],4,' ',true),$body);
			$body = str_replace('[transaction id]',$payment_info['Transaction_Reference_No'],$body);
			$body = str_replace('[login id]',$user_info['userEmail'],$body);
			$body = str_replace('[password]',$password,$body);
            $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
            $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($user_info['userEmail']); //$inputArray['email']
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$this->email->send();
			$this->load->view('payment_success',$data);
 		}
		else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
	}
	public function isEmailAvailable_member(){
    	if($_POST)
		{
			$email = $_POST['email'];
			$result = $this->login_model->isEmailAvailable_member($email);
			echo json_encode($result);
		}
	}
		
	public function reg(){
	
	$data['title'] = "SMARTWORKS-SMARTSIGNUP"; 
	$data['location_arr']=$this->lm->getcities();	
	$this->load->view('reg',$data);	
	}
	
	public function confirmation(){
		$token = base64_decode($this->input->get('token'));
		$this->login_model->changeStatus($token,0);
	}
	
	function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
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
	
	 public function atos_test()
    {
    	print_r($this->atos);
        echo($this->atos->show_hello_world());
    }
    // New Actions for IST's
             public function get_free_ist(){ // returns array of free Ist's Distribution Users
                 $free_ist = $this->login_model->get_free();
                 return $free_ist;
             }
             public function get_busy_ist(){ // returns array of busy Ist's Distribution Users
                 $busy_ist = $this->login_model->get_busy();
                 return $busy_ist;
             }
             public function get_all_ist(){ // returns array of all Ist's Distribution Users
                 $all_ist = $this->login_model->get_all();
                 return $all_ist;
             }
             public function check_all_free_ist(){ // returns True if all Ist's Distribution users are free
                 $all_free = $this->login_model->check_all_free();
                 return $all_free;
             }
             public function get_last_request_sent_to_ist(){ // returns the ID of the IST user who received the last request
                 $last_served_ist = $this->login_model->get_last_request_sent_to();
                 return $last_served_ist;
             }
            public function set_last_request_sent_to_ist($id){ // returns the ID of the IST user who received the last request
                 $last_served_ist = $this->login_model->set_last_request_sent_to($id);
                 return $last_served_ist;
             }
             public function set_status_of_ist($id){ // returns the ID of the IST user who received the last request
                 $update_status = $this->login_model->set_status($id);
                 return $update_status;
             }
             public function check_all_ist_busy(){ // returns the ID of the IST user who received the last request
                 return  $this->login_model->check_all_busy();
                 
             }
             
             
            public function get_ist_usr(){

                $free_ist_aaray = $this->get_free_ist();
                if (isset($free_ist_aaray)) {
                    $free_ist = $free_ist_aaray[0]; // Selects the First Free User to Return
                } else {
                    $free_ist = "0";
                }
                $this->set_status_of_ist($free_ist['id']);// Sets the First Free User to Return
                $all_busy= $this->check_all_ist_busy();
                if($all_busy=="true")  // If All users are busy
                {
                     $last_request_sent = $this->get_last_request_sent_to_ist();
                     if(empty($last_request_sent))
                     {
                         $all_ist = $this->get_all_ist(); 
                         $free_ist = $all_ist[0];
                         $this->set_last_request_sent_to_ist($free_ist['id']); // Sets the First User to Return
                     }
                     else 
                     {
                         $all_ist = $this->get_all_ist(); 
                         $tot_ist = count($all_ist);
                         if($last_request_sent == $tot_ist)  // If the last IST user is reached
                         {
                         $free_ist =$all_ist[0];
                         $this->login_model->refresh_last_sent_user();
                         $this->set_last_request_sent_to_ist($free_ist['id']); // Resets the Loop  
                         }                       
                         else
                         {    
                          $free_ist =$all_ist[$last_request_sent];
                          $this->login_model->refresh_last_sent_user();
                          $this->set_last_request_sent_to_ist($free_ist['id']);// If the last IST user is reached
                         }
                     }
                }
               $to_serve = $free_ist;
               return $to_serve;
            }



}
?>
