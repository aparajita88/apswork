<?php

class login_model extends MY_Model {
	 var $adminEmail="moucuteee@gmail.com";
    public function __construct() {
		parent::__construct();
        $this->load->database();
        $this->load->model('location/location_model', 'lm');
 }
    
      //User profile Information

        public function addProfileInfo($genInfoData)
	{
		$this->db->insert('user_profile', $genInfoData);
	}
   public function sendemailforstaffcreation($name,$email,$password,$staff_type,$location,$city){
	    $l_name=$this->get_location_email($location);
	    $c_name=$this->lm->getcity($city);
	    $staff_type=$this->get_staff_name($staff_type);
	    $staff_type=strtolower($staff_type[0]['userTypeName']);
	    if($staff_type=='receptionist'){
		$address=$l_name [0]['name'].",  ".$c_name[0]['name'];	
			
		}else if($staff_type=='manager'){
		$address=$l_name [0]['name'].", ".$c_name[0]['name'];		
		}else if($staff_type=='ituser'){
		$address=$c_name[0]['name'];		
		}else if($staff_type=='concierge'){
		$address=$c_name[0]['name'];		
		}else if($staff_type=='pantry'){
		$address=$c_name[0]['name'];	
		}else if($staff_type=='areadirector'){
		$address=$c_name[0]['name'];		
		}
	   	$subject='Account Created With Smartworks';
		$message  ="Dear ".$name; 
        $message .= "<BR>";
        $message .="We are very glad to inform you that your account has been created with smartworks for  ( ".$address." ).";
         $message .= "<BR>";
        $message .= "We are happy to serve you for any queries and help.Please visit us ".base_url();
		
		$message .= "<BR>";
		$message .= "<BR>";
	    $message .= "<b>Login Credential:</b>";
	    $message .= "<BR>";
	    $message .= "Login Url: ".base_url()."index.php/".$staff_type;
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
	  
	    $headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		
		$headers .= 'From: <admin@smartworks.com>' . "\r\n";
		
	

		if(mail($email,$subject,$message,$headers)){
		return 'send';	
		}else{
		return 'error';	
		}   
	   
   }
   function get_staff_name($userTypeId){
	$this->db->select('user_type.*');	
	$this->db->from('user_type');	
	$this->db->where('user_type.userTypeId', $userTypeId);
	$query = $this->db->get();
	return $query->result_array();		
	}
    
	public function sendMailForNewCustomerSignUp($to, $email_template_id,$password,$salutation,$name,$location_id,$phone,$distribution_user){
	//-----------IST DISTRIBUTION
        $ist_user=$distribution_user;
        //----------
        $location1=$this->get_location_email($location_id);
        $centre=$this->get_center_admin_email($location_id);
        $location=$location1[0]['name'];
        $location_email=$location1[0]['email'];
        //$location_admin_name=$location1[0]['admin_name'];
        $centre_manager_name = $centre[0]['firstName'].' '.$centre[0]['lastName'];
        $centre_manager_email = $centre[0]['userEmail'];
        //echo $centre_manager_name."---".$centre_manager_email; 
        $city=$location1[0]['c_name'];
        $form='info@smartworks.com';
        
       
                        $user_info=$this->getuserdetailsBytype('ut12');
                        $email_template_id1='c78848f3-5ddf-a2';
                        $email_template_id2='4b4d52a3-e387-9c';
			$email_template1 = $this->getEmailTemplate($email_template_id1);
			$email_template2 = $this->getEmailTemplate($email_template_id2);
			$body1 = $email_template1['description'];
			$body2 = $email_template2['description'];
			$body3 = $email_template1['description'];
			$body1 = str_replace('[ist user full name]',$user_info['FirstName']." ".$user_info['LastName'],$body1);
			$body1 = str_replace('[client full name]',$name,$body1);
			$body1 = str_replace('[client email]',$to,$body1);
			$body1 = str_replace('[client phone]',$phone,$body1);
			$body1 = str_replace('[client location]',$location,$body1);
			$body1 = str_replace('[client city]',$city,$body1);
                        $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
                        $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($user_info['userEmail']); //$inputArray['email']
			$this->email->subject($email_template1['subject']);
			$this->email->message($body1);
			$this->email->send();
			$body2 = str_replace('[Centre Admin Fullname]',$centre_manager_name,$body2);
			//die;
                        $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
                        $from_name=ucfirst('Team Smartworks');
                        /*User Payment Mail Function*/
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($to); //$inputArray['email']
			//$this->email->cc($location_email); 
                        $this->email->cc($centre_manager_email); 
			$this->email->subject($email_template2['subject']);
			$this->email->message($body2);
			$this->email->send();
			/*User IST Distribtion mail*/
                        $body3 = str_replace('[ist user full name]',$ist_user['name'],$body3);
			$body3 = str_replace('[client full name]',$name,$body3);
			$body3 = str_replace('[client email]',$to,$body3);
			$body3 = str_replace('[client phone]',$phone,$body3);
			$body3 = str_replace('[client location]',$location,$body3);
			$body3 = str_replace('[client city]',$city,$body3);
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($ist_user['email']); //$inputArray['email']
			$this->email->subject($email_template2['subject']);
			$this->email->message($body3);
			$this->email->send();
			return 'send';	
	}
        public function sendMailForNewEnquiryLandingPage($details,$distribution_user){
	//-----------IST DISTRIBUTION
        $ist_user=$distribution_user;
        print_r($details);
        print_r($ist_user);
      //  print_r($ist_user);die;
       // ----------
        $location1=$this->get_location_email($details['locationId']);
        $centre=$this->get_center_admin_email($location_id);
        $location=$location1[0]['name'];
        $location_email=$location1[0]['email'];
        //$location_admin_name=$location1[0]['admin_name'];
        $centre_manager_name = $centre[0]['firstName'].' '.$centre[0]['lastName'];
        $centre_manager_email = $centre[0]['userEmail'];
        //echo $centre_manager_name."---".$centre_manager_email; 
        $city=$location1[0]['c_name'];
        $form='info@smartworks.com';
        
       
                        $user_info=$this->getuserdetailsBytype('ut12');
                        $email_template_id1='f207ca45-82c0-51';
                        $email_template_id2='4b4d52a3-e387-9c';
                        $email_template_id3='e109ed26-373e-fe';
			$email_template1 = $this->getEmailTemplate($email_template_id1);
			$email_template2 = $this->getEmailTemplate($email_template_id2);
                        $email_template3 = $this->getEmailTemplate($email_template_id3);
			$body1 = $email_template1['description'];
			$body2 = $email_template2['description'];
			$body3 = $email_template1['description'];
                        $body4 = $email_template3['description'];
			$body1 = str_replace('[ist user full name]',$user_info['FirstName']." ".$user_info['LastName'],$body1);
			$body1 = str_replace('[client full name]',$details['name'],$body1);
			$body1 = str_replace('[client email]',$details['userEmail'],$body1);
			$body1 = str_replace('[client phone]',$details['phone'],$body1);
			$body1 = str_replace('[client location]',$location,$body1);
			$body1 = str_replace('[client city]',$city,$body1);
                        $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
                        $from_name=ucfirst('Team Smartworks');
                        $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
                        $from_name=ucfirst('Team Smartworks');
			/*User IST Distribtion mail*/
                        $body3 = str_replace('[ist user full name]',$ist_user['name'],$body3);
			$body3 = str_replace('[client full name]',$details['name'],$body3);
			$body3 = str_replace('[client email]',$details['userEmail'],$body3);
			$body3 = str_replace('[client phone]',$details['phone'],$body3);
			$body3 = str_replace('[client location]',$location,$body3);
			$body3 = str_replace('[client city]',$city,$body3);
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($ist_user['email']); //$inputArray['email']
			$this->email->subject($email_template2['subject']);
			$this->email->message($body3);
			$this->email->send();
                        /*User Third party Email */
                        $body4 = str_replace('[Usage_Frequency]',$details['office_use'],$body4);
			$body4 = str_replace('[Business_Type]',$details['typeOfBusiness'],$body4);
			$body4 = str_replace('[Name]',$details['name'],$body4);
			$body4 = str_replace('[Email]',$details['userEmail'],$body4);
			$body4 = str_replace('[Phone]',$details['phone'],$body4);
			$body4 = str_replace('[Company_Name]',$details['company'],$body4);
                        $body4 = str_replace('[Office_Location]',$location." (".$city.")",$body4);
                        $body4 = str_replace('[Source]',$details['source'],$body4);
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to('jaydeep@techshu.com, pratik@techshu.com'); //$inputArray['email']
			$this->email->subject($email_template3['subject']);
			$this->email->message($body4);
			$this->email->send();
			return 'landing';	
	}
	public function get_location_email($location_id){
	    $sql="select locations.*,cities.cityId,cities.name as c_name from locations left join cities on locations.cityId=cities.cityId where locations.locationId='".$location_id."' ";
	$query=$this->db->query($sql);

 
 return $query->result_array();	
		
		
	}
        	public function get_center_admin_email($location_id){
	    $sql="select firstName,lastName,userEmail from user where userTypeId= 'ut7' and location_id= '$location_id' and status = 1";
	$query=$this->db->query($sql);

 
 return $query->result_array();	
		
		
	}
	public function getEmailTemplate($email_template_id){
		$this->db->select('*');
		$this->db->where('emailId =', $email_template_id);
		$this->db->from('email_templates');
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function sendMail($location_email, $form, $subject, $message, $cc='', $bcc=''){
		
		
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		
		$headers .= 'From: <admin@smartworks.com>' . "\r\n";
		
		

		if(mail($location_email,$subject,$message,$headers)){
		return 'send';	
		}else{
		return 'error';	
		}

	}
	public function changeStatus($crsId,$val)
	{
		
		
		if($val=='1')
		{
			$this->db->set("status", '0');
			$this->db->where("userId", $crsId);
			$this->db->update("user");

			$this->db->set("status", '0');
			$this->db->where("userId", $crsId);
			$this->db->update("user_profile");

			return 0;
		}
		else
		{
			$this->db->set("status", '1');
			$this->db->where("userId", $crsId);
			$this->db->update("user");

			$this->db->set("status", '1');
			$this->db->where("userId", $crsId);
			$this->db->update("user_profile");

			return 1;
		}
		$query=$this->db->query("select * from user where user.userId='$crsId'");
	     print_r($query->result_array());
	     exit;

		
	}
	
	public function isEmailAvailable($email){
		
		$this->db->select('userId');
		$this->db->where('userEmail =', $email);
		$this->db->from('registered_user');
		$query = $this->db->get();
		$userId = $query->row_array();
		
		if(isset($userId['userId']) && $userId['userId']!=''){
			return false;
		}else{
			return true;
		}
	}
	
	public function isEmailAvailable_member($email){
        $this->db->select('user.*');
		$this->db->where('userEmail', $email);
		$this->db->from('user');
		$query = $this->db->get();
		$userId = $query->row_array();
		if(!empty($userId)){
			return 1;
		}else{
			return 0;
		}


	}
	public function isEmailAvailableforstaff($email){
		
		$this->db->select('userId');
		$this->db->where('userEmail =', $email);
		$this->db->from('user');
		$query = $this->db->get();
		$userId = $query->row_array();
		
		if(isset($userId['userId']) && $userId['userId']!=''){
			return false;
		}else{
			return true;
		}
	}
	
	public function isEmailAvailableforvendor($email){
		
		$this->db->select('id');
		$this->db->where('email =', $email);
		$this->db->from('vendor');
		$query = $this->db->get();
		$userId = $query->row_array();
		
		if(isset($userId['id']) && $userId['id']!=''){
			return false;
		}else{
			return true;
		}
	}
	
	
	public function login($res)
	{
		$where = ''; 
		if($res['type']=='host'){
			$where = " user.userTypeId = 'ut4' and ";
		}
		 $query=$this->db->query("select 
										user.*, 
										user_profile.phone 
									from 
										user 
										LEFT OUTER JOIN user_profile ON user.userId = user_profile.userId
									where 
										".$where."
										user.userName='".$res['username']."' 
										and user.password='".$res['password']."' 
										and user.status='1'");

           	 $num_of_rows=$query->num_rows();
             
        
		if($num_of_rows >0)
		{
				$result=$query->result_array();
				$this->session->set_userdata('userId',$result[0]['userId']);
				$this->session->set_userdata('userName',$result[0]['userName']);
				$this->session->set_userdata('userEmail',$result[0]['userEmail']);
				$this->session->set_userdata('userPhone',$result[0]['phone']);
				$this->session->set_userdata('tenantId',$result[0]['tenantId']);
				$this->session->set_userdata('userProfileName',$result[0]['userProfilename']);
				$this->session->set_userdata('userImg',$result[0]['image']);
				
				$uId=$result[0]['userId'];
				$uTyp=$result[0]['userTypeId'];
				
				$uTyp_q=$this->db->query("select * from user_type  where userTypeId='".$uTyp."'");
				
				$uTyp_r=$uTyp_q->result_array();
				$this->session->set_userdata('userType',$uTyp_r[0]['userTypeName']);
				
				return  $uTyp_r;
       }else{
            	return $this->db->last_query();

	    }
	}
	
	
	public function getuserinfo($user_id){
		
		
		$data = array();
		$this->db->select('registered_user.*,cities.name as c_name,locations.name as l_name');
		$this->db->from('registered_user');
		$this->db->join('cities', 'cities.cityId = registered_user.cityId');
		$this->db->join('locations', 'locations.locationId = registered_user.locationId');
		$this->db->where('registered_user.userId =', $user_id);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
		
	}
	
		public function getuserdetails($user_id){
		
		
		$data = array();
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where('user.userEmail =', $user_id);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
		
	}
	public function getuserdetailsBytype($type){
		$data = array();
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where('user.userTypeId =', $type);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
	public function getpaymentdetails($user_id){
		$data = array();
		$this->db->select('payment.*');
		$this->db->from('payment');
		$this->db->where('payment.userId =', $user_id);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
        //New Objects for IST Distribution
        public function get_free(){
            $this->db->select('ist_distribution_list.*');	
            $this->db->from('ist_distribution_list');	
            $this->db->where('ist_distribution_list.status', 0);
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            return $query->result_array();
        }
        public function get_busy(){
            $this->db->select('ist_distribution_list.*');	
            $this->db->from('ist_distribution_list');	
            $this->db->where('ist_distribution_list.status', 1);
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            return $query->result_array();
        }
        public function get_all(){
            $this->db->select('ist_distribution_list.*');	
            $this->db->from('ist_distribution_list');	
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            return $query->result_array();
        }
        public function check_all_free(){
            $tot_ist_array = $this->get_all();
            $tot_ist = count($tot_ist_array);
            $busy_ist_aaray =$this->get_busy();
            $busy_ists = count($busy_ist_aaray);
            if (($tot_ist - $busy_ists) == $tot_ist) 
                    {
                        return "true";
                    }   
                    else 
                    {
                        return "false";
                    }
        }
        public function get_last_request_sent_to(){ 
            $this->db->select('ist_distribution_list.id');	
            $this->db->from('ist_distribution_list');	
            $this->db->where('ist_distribution_list.last_request_sent', 1);
            $this->db->order_by("id", "asc");
            $query = $this->db->get();
            $id=$query->result_array();
            return $id[0]['id'];
        }
        public function set_status($id) { // Sets IST's Status to busy
            $data=array('status'=>1);
            $this->db->where('id',$id);
            $this->db->update('ist_distribution_list',$data);
            if ($this->db->trans_status() === FALSE)
                {
                    return "false"; 
                }
                 else 
                {
                    return "true";
                }
        }       
         public function refresh_last_sent_user() { // Sets IST's Status to busy
            $data=array('last_request_sent'=>0);
            $this->db->update('ist_distribution_list',$data);
            if ($this->db->trans_status() === FALSE)
                {
                    return "false"; 
                }
                 else 
                {
                    return "true";
                }
        }       
          public function check_all_busy(){ 
           $tot_ist_array = $this->get_all();
           $tot_ist = count($tot_ist_array);
           $busy_ist_aaray = $this->get_busy();
           $busy_ists = count($busy_ist_aaray);
           if ($tot_ist == $busy_ists) {
            $status ="true";
            } else {
            $status ="false";
           }
           return $status;
          }
          
          function set_last_request_sent_to($id) { // sets last request sent flag
            $data=array('last_request_sent'=>1);
            $this->db->where('id',$id);
            $this->db->update('ist_distribution_list',$data);
            if ($this->db->trans_status() === FALSE)
                {
                    return "false"; 
                }
                 else 
                {
                    return "true";
                }
            }

}
 ?>
