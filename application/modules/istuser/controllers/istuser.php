<?php
class istuser extends MY_Controller {
	var $gallery_path;
	var $gallery_path_url;
	var $data = array();
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('users/login');
		$this->load->model('location/location_model', 'lm');
		$this->load->model('login/login_model');
		$this->load->helper('form'); 
		$this->load->model('istusermodel');
		$this->load->library('email');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
	}
    public function index(){
		$this->session->sess_destroy();
		$this->load->view('vistuser_login');
	}
	public function dashBoard(){
		authenticate(array('ut11'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$this->load->view('vistuser_dashboard',$data);
	}
	public function enquiry(){
		authenticate(array('ut12'));
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
						$ist = $data['userData']['userEmail'];

						$body = $email_template_location_manager['description'];
						$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
						$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
						$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
				  		/*Mail function start here*/
				  		$from_email = $_POST['txtEmail']; 
				  		$from_name = ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']);
			         	$to_email = $loc_man_email;// should change with location manager email address
				   		$cc = $ad.','.$ist;// should be cc to AD & IST team.
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
						$ist = $data['userData']['userEmail'];

						$body = $email_template_location_manager['description'];
						$body = str_replace('[Location Manager Full Name]',$loc_man_fullname ,$body);
						$body = str_replace('[user Full name]',ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']),$body);
						$body = str_replace('[Business Center Name]',ucfirst($bussness_data['businessName']),$body);
				  		/*Mail function start here*/
				  		$from_email = $_POST['txtEmail']; 
				  		$from_name = ucfirst($_POST['txtFname']).' '.ucfirst($_POST['txtLname']);
			         	$to_email = $loc_man_email;// should change with location manager email address
				   		$cc = $ad.','.$ist;// should be cc to AD & IST team.
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
		authenticate(array('ut12'));
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
	public function user_display_info(){
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
}
	?>
