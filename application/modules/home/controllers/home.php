<?php
class home extends MY_Controller {
	var $gallery_path;
	var $gallery_path_url;
	var $doc_path;
	public function __construct() {
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('location/location_model', 'lm');
		$this->load->model('rooms/rooms_model');
		$this->load->model('cms/cms_model');
                $this->load->model('login/login_model');
		$this->load->helper('form','url'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/';
		$this->doc_path=realpath(APPPATH . '../assets/uploads/doc');
	}
	/*This action call for plans and pricing*/
    public function price(){
	    $data['title'] = "SMARTWORKS-HOME"; 
		$this->session->unset_userdata('newdata');
		$data['location_arr']=$this->lm->getcities();
		$this->load->view('price',$data);	
    }
    /*This action call for home/index page*/
	public function index(){
		$data['location'] = $this->uri->segment(3);
		$data['data'] = $this->lm->getLocationData("Kolkata");
		$data['location_arr']=$this->lm->getcities();

		$data['meta_key'] = 'office space rent India, shared office space, coworking space India, virtual office space, office space for rent';
		$data['meta_description'] = 'Search for best commercial & office space for rent in top cities of India like: Delhi, Mumbai, Bangalore, Pune, Kolkata. Get virtual office address. Call @ 1800-833-9675';

		$var='ABOUT SMART';
		$data['cms_content_about']= $this->cms_model->cms_content_about($var);
		
		$data['cms_content_services']= $this->cms_model->get_cms_content_home('home','1');
		$data['cms_content_smart_services']= $this->cms_model->get_cms_content_home('home','2');
		$data['cms_content_i_am_a']= $this->cms_model->get_cms_content_home('home','0');
		$data['subscription']=$this->home_model->get_subscription();
		
		$data['title'] = "Commercial & Office Space for Rent India | Virtual Office Address"; 
		$this->session->unset_userdata('newdata');
		$this->load->view('index',$data);
	}
	/*This action call for CMS page(s)*/
	public function page($slg){
		$data = array();
		$data['cms_page_content']= $this->cms_model->get_cms_page_content($slg);
		if(empty($data['cms_page_content'])){
			exit('No Page found!');
		}
		$data['location_arr']=$this->lm->getcities();
		$data['title'] = "SMARTWORKS-".$data['cms_page_content']['title']; 
		$data['meta_key'] = $data['cms_page_content']['meta_keywords'];
		$this->load->view('cms_page',$data);
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
/**
 *  The following action will handle the submission from Landing Page			
 */
	public function smartclubs() {
	$return_msg = "";
    if($_POST)
	{
		if(!empty($this->input->post('firstname')))
		$firstName = $this->input->post('firstname');
	else
		$firstName = "";
	
	if(!empty($this->input->post('lastname')))
		$lastname = $this->input->post('lastname');
	else
		$lastname = "";
	
	if(!empty($this->input->post('email')))	
		$email = $this->input->post('email');
	else
		$email = "";
	
	if(!empty($this->input->post('company_name')))		
		$company = $this->input->post('company_name');
	else
		$company = "";
	
	if(!empty($this->input->post('phoneno')))		
		$phone = $this->input->post('phoneno');
	else
		$phone = "";
		
		$source=$this->input->post('source');
		$name=$firstName." ".$lasttname;
		$location=$this->input->post('location');
		$office_use = $this->input->post('office_use');
		$typeOfBusiness= $this->input->post('typeOfBusiness');
		$userId=create_guid();
		$userId= substr($userId,0,16);
		$location=explode("/",$location);
		$location_id=$location['1'];
		$city_id=$location['0'];				

		$inputArray = array(
			'userId'=> $userId,   
			'userEmail' => $email,
			'FirstName' => $firstName,
			'LastName' => $lastname,
			'source'=> $source,
			'locationId' => $location_id,
			'cityId' => $city_id,
			'phone' => $phone,
			'company'=>$company,   
			'dateAdded' => date('Y-m-d H:i:s')
		);
			
		$details = array(
			'userId'=> $userId,   
			'userEmail' => $email,
			'office_use'=> $office_use,   
			'typeOfBusiness' => $typeOfBusiness,    
			'name'=>$name,
			'source'=> $source,
			'locationId' => $location_id,
			'cityId' => $city_id,
			'phone' => $phone,
			'company'=>$company   
		);
		
		if($this->login_model->isEmailAvailable($email))
		{
                   
			if($this->db->insert('registered_user',$inputArray))
			{
				$distribution_user = $this->get_ist_usr(); // getting Ist user array
				
				// Distribute the mail to the IST
				$email = $this->login_model->sendMailForNewEnquiryLandingPage($details,$distribution_user);
			
				redirect(base_url()."index.php/home/thankyou");
			}else{
				$return_msg = "Failed to Insert Data";
			}
		}else{
                     
			$return_msg = "Your Email already exists in our database";					
		}
		
		redirect(base_url()."index.php/home/smartclubs?email=".$return_msg);	
	}
	else 
	{ 
		$this->load->view('smartclubs_landing_page');
	}
}

/**
 *  This action open the ThankYou page after successful Submission	
 */
	public function thankyou(){ 
		$this->load->view('thankyou');

	}
}
?>
