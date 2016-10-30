<?php
class users extends MY_Controller {
	var $gallery_path;
    var $gallery_path_url;
	public function __construct() {
		parent::__construct();
		$this->load->model('user');
		$this->load->model('login', 'login');
		$this->load->model('login/login_model');
		$this->load->model('users/login');
		$this->load->model('location/location_model', 'lm');
		$this->load->model('business/business_model');
		$this->load->model('home/home_model');
		$this->load->helper('common');
		$this->load->helper('form'); 
		$this->load->helper('url'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->load->library("atos");
    }
	
	 public function creditnote_staff_List(){//credit note master data listing
	   authenticate(array('ut6','ut1'));
	   $userId = $this->session->userdata("userId");
	   $userTypeId = $this->session->userdata("userTypeId");
       $data['userData'] = $this->login->getUserProfile($userId);	
       $data['staff_credit']=$this->login->get_all_staff_credit();
       $this->load->view('creditnote_staff_List', $data);						 

 }
	 public function creditnote_edit_staff($id){//credit note edit master data 
 	authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['staff_credit']= $this->login->get_staff_credit($id);
    if (isset($_POST) && (!empty($_POST)))
	 {  
		 $data=array(
					'amount_creditnote'=>$this->input->post('amount_creditnote'),
					'percentage_creditnote'=>$this->input->post('percentage_creditnote')
					);
						
					$result = update_tbl('creditnote_staff','userTypeId',$id,$data);
				
		if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					redirect(base_url().'index.php/users/creditnote_staff_List');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/users/creditnote_edit_staff/'.$id);
				}
       } 
   $this->load->view("creditnote_edit_staff",$data);
    
 }
	    public function adminLogin(){
		$userId = $this->session->userdata("userId");
		if($userId!=""){
			redirect(base_url()."index.php/users/doLogOut");
		}else{
			$this->load->view('users/admin_login');
		}
    }
    
    
	public function login(){//login for client,staffs
		  $data['username'] = $this->input->post('username');
		  $data['password'] = md5($this->input->post('password'));
		  $data['type'] = $this->input->post('type');
		  if($data['username']!='' && $data['password']!='')
		  {
			   $res=$this->login->login($data);
			   if($res!=0)
			   {
					$typ=$res[0]['userTypeName'];
					echo $typ;
			   }else
					 echo 0;
			   
			   exit;
		  }
	}

	public function doLogOut(){//logout for client,staffs
		$userTypeId = $this->session->userdata("userTypeId");
		$this->session->sess_destroy();
		$url = base_url()."index.php/admin";
		if($userTypeId=="ut1"){
			$url = base_url()."index.php/admin";
		}else if($userTypeId=="ut5"){
			$url = base_url()."index.php/receptionist";
		}
		else if($userTypeId=="ut6"){
			$url = base_url()."index.php/ituser";
		}
		else if($userTypeId=="ut8"){
			$url = base_url()."index.php/concierge";
		}
		else if($userTypeId=="ut7"){
			$url = base_url()."index.php/manager";
		}
		else if($userTypeId=="ut9"){
			$url = base_url()."index.php/pantry";
		}
		else if($userTypeId=="ut2"){
			$url = base_url()."index.php/owner";
		}
		else if($userTypeId=="ut10"){
			$url = base_url()."index.php/areadirector";
		}else if($userTypeId=="ut12"){
			$url = base_url()."index.php/istuser";
		}else{
			$url = base_url()."index.php/login/Login";
		}
		redirect($url);
	}
     public function changePassword()
    {        
			$this->load->view('users/changePassword');           
    }
    
    public function getLoggedinUserProfileData(){
		$userId = $this->session->userdata("userId");
	    $data['profData']=$this->login->getUserProfile($userId);
		if(empty($data['profData'])){
			redirect(base_url().'login/signup');
		}
		if($data['profData'][0]['image']=='' || $data['profData'][0]['image'] == '0'){
			$data['profData'][0]['image'] = base_url().'assets/uploads/images/thumbnails/NoProfileImage.jpg';
		}else if($data['profData'][0]['fbUserId']== '' && $data['profData'][0]['g+userId']== ''){
			$data['profData'][0]['image'] = base_url().'assets/uploads/images/thumbnails/'.$data['profData'][0]['image'];
		}
	    return $data;
	}
    
    public function myProfile(){//Update profile for client,staffs
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
       if($data['userData']['userId']=='0'){
		redirect(base_url().'?status=not_authorized');
		}
		$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
		$data['cities']=$this->lm->getcities();
		$data['table_heading'] = 'My Profile';
		$this->load->view("organizer_profile",$data);
    }
    public function mySubscription(){//subsription page for client,indirect client
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['subscription']=$this->home_model->get_subscription();
		$data['my_subscription']=$this->home_model->my_subscription($data['userData']['userId']);
        $data['table_heading'] = 'My Membership';
		$this->load->view("mySubscription",$data);
    }
    public function membership_check_bydate(){//subscription checking by date
    if($_POST)
		{
			$uid=$_POST['uid'];
			$sid=$_POST['sid'];
	        $result = $this->home_model->get_result($uid,$sid);
	        $no=count($result);
	        echo $no;
	        exit;
	    }
    }
     public function upgrade_membership(){//upgrade membership for client/imdirect client
     if($_POST)
		{
      $newdata = array(
			  	 'UserSubscriptionId'=> $this->input->post('upsub_id')
		              );
		$this->session->set_userdata('newdata', $newdata);	
		$atos_url = 'https://cgt.in.worldline.com/ipg/doMEPayRequest'; 
		$this->atos->load($_REQUEST['mid'],$_REQUEST['OrderId'],100,$_REQUEST['meTransReqType'],$_REQUEST['enckey'],$_REQUEST['currencyName'],$_REQUEST['responseUrl'],$atos_url);	
	     }
    }
    public function upgrade_payment_response(){//upgrade membership responce from atos for client/imdirect client

        $session_user_data = $this->session->userdata['newdata'];
		$this->session->unset_userdata($this->session->userdata['newdata']);
		$response = $this->atos->atos_response($_REQUEST['merchantResponse']);
		$userId = $this->session->userdata('userId');  
		$data['userData'] = $this->login->getUserProfile($userId);	
		if ($response->getStatusCode()=="S"){
			$inputArray_user=array(
				'membershipno'=>$this->home_model->get_membership_number(),
				'UserSubscriptionId'=>$session_user_data['UserSubscriptionId'],
				'UserSubscriptiondate'=>date('Y-m-d')
				);
			$result = update_tbl('user','userId',$userId,$inputArray_user);
			$paymentId=create_guid();
			$paymentId= substr($paymentId,0,16);
			$inputArray_payment=array(
				'paymentId'=> $paymentId,
				'userId'=>$userId,
				'details'=>'Upgrade membership',
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
			$userData= $this->login->getUserProfile($userId);
			$email_template_id='50498cdd-3a16-40';
			$email_template = $this->login_model->getEmailTemplate($email_template_id);
			$body = $email_template['description'];
			$body = str_replace('[First Name]',$userData['FirstName'],$body);
			$body = str_replace('[membership no]',wordwrap($userData['membershipno'],4,' ',true),$body);
			$body = str_replace('[transaction id]',$response->getpgMeTrnRefNo(),$body);
			$from_email='sworks_team@sworks.co.in'; // should change with smartworks team
            $from_name=ucfirst('Team Smartworks');
			/*User Payment Mail Function*/
			$this->load->library('email');
			$this->email->set_newline("\r\n");
			$this->email->from($from_email,$from_name);
			$this->email->to($userData['userEmail']); 
			$this->email->subject($email_template['subject']);
			$this->email->message($body);
			$this->email->send();
			$this->load->view('payment_success',$data);


    }else if($response->getStatusCode()=="F"){
			$this->load->view('payment_failure',$data);	
 		}
}
	public function updateProf(){//my profile  	
		 $userId = $this->session->userdata('userId');  	
		 if($_FILES['ListeeTypeImage']['name']!="")
			{ 
			$userData = $this->login->getUserProfile($userId);
			$img=$userData['image'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    if(file_exists($img4)) {
			   unlink($img1);
			   unlink($img3);
			   unlink($img4);
			  }	
				$value = $_FILES['ListeeTypeImage']['name'];
				$config = array(
				'file_name' => $this->session->userdata('userId'),
				'allowed_types' => 'jpg|jpeg|gif|png',
				'upload_path' => $this->gallery_path.'/full',
				'max_size' => 2000
				);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
			    if (!$this->upload->do_upload('ListeeTypeImage')) {
				$error=$this->upload->display_errors(); 
			    $this->session->set_flashdata('item_error',$error);
			    redirect(base_url().'index.php/users/myprofile/'.$userId);
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
			else
			{
				$img=$this->input->post('imgCurrent');
			}		
		     $data['FirstName']=$this->input->post('first-name');
			 $data['LastName']=$this->input->post('last-name');
			 $data['userProfilename']=$this->input->post('userProfilename');
			 if($this->input->post('password')=='')
			 {
				$data['password']=$this->input->post('pass');
				 }else{
				$data['password']=md5($this->input->post('password'));	 
				 }
			 if($img!=''){
				$data['image']=$img;
			 }
      	 $data['phone']=$this->input->post('phone'); 
      	 $data['modifiedBy']=$this->session->userdata('userId');  
      	 $data['address']=$this->input->post('address');
      	 $data['location_id']=$this->input->post('location');
      	 $data['city_id']=$this->input->post('city');
      	 $data['dateModified']   = gmdate('Y-m-d H:i:s');
      	 $data['gender'] = $this->input->post('gender');
      	 $result = update_tbl('user','userId',$userId,$data);
         $this->session->set_flashdata('edit',"Your account has been successfuly updated.");
     	redirect(base_url().'index.php/users/myprofile/'.$userId);
	}
    
    public function checkOldPass()
    {
        $data['password'] = $this->input->post('oldPass');
        $uId = $this->session->userdata('userId');
        $returnData = $this->login->checkOldPass($data,$uId);
        echo $returnData; 
    }
    public function forgotPassword(){//forgot password
        $this->load->view('users/admin_forgotPassword');
    }
    public function checkEmail(){//checking the email exist or not
         $data['userEmail'] = $this->input->post('email');
         $results = $this->login->checkEmail($data);
         echo $results;
   }
   public function captcha(){// This function genrate CAPTCHA image and store in "image folder".
		$this->load->helper('captcha');
		$checkrules = array(
			'img_path' => realpath(BASEPATH . '../images') . '/',
			'img_url' => base_url() . 'images/',
			'img_width' => 170,
			'img_height' => 35,
			'expiration' => 7200
		);
		$data = create_captcha($checkrules);
		$this->session->set_userdata('captcha_info', $data['word']);
		$refresh = (isset($_GET['refresh']) ? 1 : 0);
		if($refresh==1){
			print_r(json_encode($data)); exit;
		}else{
			return $data;
		}
    }   
    
   public function captchaValidation(){
		$captcha_input = $this->input->get('captcha');
		$actual_captcha = $this->session->userdata('captcha_info');
		if($captcha_input == $actual_captcha){
			$data['status'] = 1;
		}else{
			$data['status'] = 0;
		}
		$this->load->view('is_valid_email', $data);
	}
	
   public function isEmailAvailable(){//checking the email exist or not
		$operation = $this->input->post('operation');
		$actual_email = $this->session->userdata('userEmail');
		$input_email = $this->input->get('email');
		if($input_email == ''){
			$input_email = $this->input->post('email');
		}
		if($actual_email!='' && $actual_email==$input_email){
			$data['status'] = 1;
			$this->load->view('is_valid_email', $data);
		}else{
			$data['status'] = $this->user->isEmailAvailable($input_email);
			$this->load->view('is_valid_email', $data);
		}
	}
    
    public function doRegistration(){
		$firstName = $this->input->post('first_name');
		$lastName = $this->input->post('last_name');
		$phone = $this->input->post('phone');
		$userEmail = $this->input->post('email');
		$address = $this->input->post('address');
		$postcode = $this->input->post('postcode');
		$password = md5($this->input->post('password'));
		
		
		$data['userId']         =create_guid();
		$data['userTypeId']     ='ut4';
		$data['FirstName']      =$firstName;
		$data['LastName']       =$lastName;
		
		$data['userName']       =$userEmail;
		$data['userEmail']      =$userEmail;
		$data['password']       =$password;

		$data['addedBy']        ='';
		$data['modifiedBy']     ='';
		$data['dateModified']   ='0000-00-00 00:00:00';
		$data['status']         =1;
		$data['deleted']        ='0';
		$resId = $this->user->addUser($data);
	
	/*-----------------Insert data into profile table-----------------------------*/
		
		$dataUserProfile['userProfileId']  =create_guid();
      	$dataUserProfile['userId']         =substr($data['userId'],0,16);
      	$dataUserProfile['userEmail']      =$userEmail;
      	$dataUserProfile['address1']       =$address;
      	$dataUserProfile['firstname']      =$firstName;
      	$dataUserProfile['lastname']       =$lastName;
      	$dataUserProfile['phone']          =$phone;
      	$dataUserProfile['zipCode']        =$postcode;
      	$dataUserProfile['dateModified']   ='0000-00-00 00:00:00';
      	$dataUserProfile['status']         ='1';
      	$dataUserProfile['deleted']        ='0';
 		$profileResId = $this->user->addProfileInfo($dataUserProfile);
		$email=$this->user->sendMailForNewCustomerSignUp($userEmail, 'fa3d0068-aff4-be');
		redirect(base_url()."users/registration?email=".$email);
		
	}
	
	public function confirmation(){
		$token = base64_decode($this->input->get('token'));
		$this->user->changeStatus($token,0);
	}
	
	public function uploadImage(){//image upload
		if($_FILES['userImage']['name']!=""){
			$value = $_FILES['userImage']['name'];
			$config = array(
			'file_name' => $this->input->post('user_id'),
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path.'/full',
			'max_size' => 2000
			);

			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('userImage')) {
				echo $this->upload->display_errors(); die();
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
		 
		}else{
			$img=$this->input->post('imgCurrent');
		}		
	}
	
	public function contact_us(){//contact us
		$data['location_arr']=$this->lm->getcities();
		
		$data['title'] = "Contact Us - Best Office Space Rental in India"; 
		$data['meta_key'] = "office space rent India, shared office space, coworking space India, virtual office space, office space for rent";
		$data['meta_description'] = "You can get the best office space rental, virtual office address rental service in cities like Delhi, Bangalore, Mumbai, Pune, Noida, Kolkata. Call @ 1800-833-9675";
		$this->load->view("contactus",$data);
	}
	
	public function sendContactUs(){//send contact us mail
		$data['first_name']	= $this->input->post("first_name");
		$data['last_name'] 	= $this->input->post("last_name");
		$data['email'] 		= $this->input->post("email");
		$data['phone'] 		= $this->input->post("phone");
		$data['message']	= $this->input->post("message");
		print_r($this->user->sendContactUs($data)); exit;
	}
	
	public function subscribeEmail(){
		$email = $this->input->post("email");
		print_r($this->user->subscribeEmail($email)); exit;
	}
	
	 public function sendMail()
   {  
	  
      $email = $this->input->post("email");
        
        $results = $this->login->checkEmail($email);
      
        if($results==0)
        {
        		echo $results;
        		exit();
        }
        else 
        {
        $data['password'] = generate_password(8);
        $data['email']=$email;
        $res = $this->forgotpass($data);
        $getEtemp = $this->login->getforgetPassTemplate();
			 
			$form_name = 'Smartworks Admin';
        	$subject = $getEtemp[0]['subject'];  
        	$form_email = 'info@sworks.co.in';
        	$to_email =  $email;  
        	$message=$getEtemp[0]['description']; 
        	$rcverName=ucfirst($res['userProfilename']);
        	$message=str_ireplace("receiverPHL",$rcverName,$message);
        	$message=str_ireplace("passPHL",$data['password'],$message);
       
      $type=$this->login_model->sendMail($to_email, $form_email, $subject, $message, $bcc=''); 
      echo $type;
      exit;
       	}
        
   }
     
   public function forgotpass($data)
   {
        $randomPass = md5($data['password']); 
        $email = $data['email']; 
        $query=$this->db->query("SELECT * FROM user WHERE userEmail='$email'");
        $result = $query->result_array();
        $uid = $result[0]['userId'];
        $this->db->set("password", $randomPass);
		$this->db->where("userId", $uid);
		$this->db->update("user");
        
   }  
    public function user_List()
   {
	    
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['query']=$this->user->getusers();
	    $this->load->view('test_userList',$data);
   }
    public function staff_List()
   {
	    
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['query']=$this->login->get_staff_List();
	    $this->load->view('staff_List',$data);
   }

    public function vendor_List()
   {
	    
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['query']=$this->login->get_vendor_List();
	    $this->load->view('vendor_list',$data);
   }

    public function add_staff(){
	 	authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		
		if($_POST)
		{
		    $userId=create_guid();
		    $userId= substr($userId,0,16);
		    if($this->login_model->isEmailAvailableforstaff($_POST['staff_email'])){
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			$password=$this->get_random_password();
			$image=$this->doUpload('ListeeTypeImage',$imageid);
				if($image!=""){
					$arr = array(
			    'userId'=>	$userId,
				'userTypeId' =>  $_POST['staff_type'],
				'FirstName' => $_POST['first_name'],
				'LastName'=>$_POST['last_name'],
				'location_id'=>$_POST['location'],
				'city_id'=>$_POST['city'],
				'userProfilename'=>$_POST['userProfilename'],
				'phone'=>$_POST['phone'],
				'image'=>$image,
				'address'=>$_POST['address'],
				'userEmail'=>$_POST['staff_email'],
				'userName'=>$_POST['staff_email'],
				'password'=>md5($password),
				'deleted' => 0,
				'deleted'=> 0,
				'dateAdded'=>date('Y-m-d h:i:s'),
				'addedBy'=>$this->session->userdata("userId"),
				'status' => 1,
				'can_view_bill'=>'1');
			$name=$_POST['first_name']." ".$_POST['last_name'];	
			$email=	$_POST['staff_email'];
			$staff_type=$_POST['staff_type'];
			$location=$_POST['location'];
			$city=$_POST['city'];
			if($this->db->insert('user',$arr)){	
			$email=$this->login_model->sendemailforstaffcreation($name,$email,$password,$staff_type,$location,$city);
		}
			$this->session->set_flashdata('item','staff is added successfully');	
			redirect('index.php/users/staff_List?email='.$email);		
			}
			
		}
			else{
				$this->session->set_flashdata('item_error','Email is already exists');	
				 redirect('index.php/users/add_staff');	
				
			}
			
			
		}	
		
		else{
		    $data['cities']=$this->lm->getcities();
		    $data['staff_type']=$this->login->get_staff_types();
			$this->load->view('users/add_staff',$data);	
		}  
	   
   }
    public function edit_staff($id)
    { 
		 authenticate(array('ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['userinfo'] = $this->login->getUserProfile($id);
	$data['cities']=$this->lm->getcities();
	$data['location']=$this->lm->getlocationbycity($data['userinfo']['cityId']);
	
     if (isset($_POST) && (!empty($_POST)))
	 {
 		$arr = array(
			   'FirstName' => $_POST['first_name'],
				'LastName'=>$_POST['last_name'],
				'location_id'=>$_POST['location'],
				'city_id'=>$_POST['city'],
				'userProfilename'=>$_POST['userProfilename'],
				'phone'=>$_POST['phone'],
				'address'=>$_POST['address'],
				'userEmail'=>$_POST['staff_email'],
				'userName'=>$_POST['staff_email'],
                'dateModified'=>date('Y-m-d h:i:s'),
				'password'=>md5($_POST['password']),
				'discount'=>$this->input->post('discount')
				
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
			    redirect(base_url().'index.php/users/staff_list');
			}
			else
			{
				$this->session->set_flashdata('edit',"Your updation is not completed.");
			    redirect(base_url().'index.php/users/edit_staff/'.$business_id);
			}       
      }       
    $this->load->view("edit_staff",$data);
}
 public function edit_vendor($id)
    { 
		 authenticate(array('ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['userinfo'] = $this->login->getvendorProfile($id);
	
   
     if (isset($_POST) && (!empty($_POST)))
	 {

			$arr = array(
	    'name' => $_POST['name'],
		'email' => $_POST['email'],
		'phone'=>$_POST['phone'],
		'dateModified'=>date('Y-m-d h:i:s')
		
		
		);
																																	
				$result = update_tbl('vendor','id',$id,$arr);
				
			if($result == 1)
			{
				$this->session->set_flashdata('edit',"You have successfully upadded.");
			    redirect(base_url().'index.php/users/vendor_List');
			}
			else
			{
				$this->session->set_flashdata('edit',"Your updation is not completed.");
			    redirect(base_url().'index.php/users/edit_vendor/'.$id);
			}       
      }    
    
    $this->load->view("edit_vendor",$data);
}

public function add_vendor(){
	 	authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		
		if($_POST)
		{
		    $vendorId=create_guid();
		    $vendorId= substr($vendorId,0,16);
		if($this->login_model->isEmailAvailableforvendor($_POST['email'])){
			$arr = array(
			    'id'=>$vendorId,
				'name' =>$_POST['name'],
				'email' => $_POST['email'],
				'phone'=>$_POST['phone'],
				'status'=>'1',
				'deleted'=>'0',
				'addedBy'=>$this->session->userdata("userId"),
				'dateadded'=>date('Y-m-d h:i:s')
				);
		    $this->db->insert('vendor',$arr);
			$this->session->set_flashdata('item','vendor is added successfully');	
			redirect('index.php/users/vendor_List');		
			
			
		}
			else{
				$this->session->set_flashdata('item_error','Email is already exists');	
				 redirect('index.php/users/add_vendor');	
				}
			}	
		
		else{
			$this->load->view('users/add_vendor',$data);	
		}  
	   
   }
   public function changeuserStatus()
	{
		 authenticate(array('ut1','ut7','ut10'));
		
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];		
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->business_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changeuserStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changeuserStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}

	 
	public function delete_staff($id)
{
	 authenticate(array('ut1'));
		 $table='user';
		 $column_name='userId';
		 $result=$this->user->delete($table,$id,$column_name);  
	   if($result)
	   {
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/users/staff_List');
	   }
   }
  	 
	public function delete_vendor($id)
  {
	 authenticate(array('ut1'));
		 $table='vendor';
		 $column_name='id';
		 $result=$this->user->delete($table,$id,$column_name);  
	   if($result)
	   {
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/users/vendor_List');
	   }
   }
    
    public function edit_user($uId)
    {
		$userId=$this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->login->getUserProfile($userId);
		$data['userTbl']=$this->user->getdetails($uId);
		$this->load->view('edit_userList',$data);
	}
	
	public function update($id)
	{
		$data = array(
		'FirstName' => $this->input->post('edit_firstName'),
		'LastName' => $this->input->post('edit_lastName'),
		'userEmail' => $this->input->post('edit_userEmail'),
		'phone' => $this->input->post('edit_phone'),
		
		);
		
		
		$this->user->update_user($id,$data);
		
		$data['query']=$this->user->getusers();
		$userId=$this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->login->getUserProfile($userId);
	    $this->load->view('test_userList',$data);
	}
		
		
   
   
   public function delete_user($id='',$userId='')
   {
	   if($id)
	   {
		   $table='registered_user';
		   $column_name='userId';
		   $result=$this->user->delete($table,$id,$column_name);
		   $this->session->set_flashdata('item','user deleted successfully');
		   redirect('index.php/users/user_List');
	   }
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
	

}
?>
