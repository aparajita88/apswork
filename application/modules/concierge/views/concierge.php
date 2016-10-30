<?php
class concierge extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('concierge_login');
		$this->load->model('location/location_model', 'lm');
		$this->load->helper('form'); 
		$this->load->model('concierge_listing');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		
	//	$this->load->library('session');
	}
    public function index(){
		if($this->session->userdata("userId")!="" && $this->session->userdata("userTypeId")=="ut8"){
			redirect(base_url().'index.php/concierge/dashBoard', 'refresh');
		}else{
			$this->load->view('concierge_login');
		}
	}
	public function dashBoard(){ // Concierge dashboard
		authenticate(array('ut8'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->concierge_login->getUserProfile($userId);
		if(!empty($data['userData'])){
			$currentCityId = $data['userData']['city_id'];
			if($currentCityId != ''){
				$data['serviceRequests'] = $this->concierge_listing->get_request_service_bytype('Flight',$currentCityId);
				for($i=0;$i<count($data['serviceRequests']);$i++){
					$frmcityid=$data['serviceRequests'][$i]['from_city_id'];
					$tocityid=$data['serviceRequests'][$i]['to_city_id'];
					$frm_city=$this->lm->getconciergecity($frmcityid);
		            $to_city=$this->lm->getconciergecity($tocityid);
		            $data['serviceRequests'][$i]['from_city']=$frm_city[0]['name'];
		            $data['serviceRequests'][$i]['to_city']=$to_city[0]['name'];
				}

			}
		}
		if($userId!="" && $userTypeId=="ut8"){
		$data['title'] = 'Smartworks | Smart Concierge Assistant';
		$data['table_header_status'] = 'Status';
		$data['table_header_date_opend'] = 'Date Opened';
		$data['table_header_request_from'] = 'Request From';
		$data['table_header_request_type'] = 'Request type';
		$data['table_header_request_details'] = 'Request Details';
		$data['table_header_date_closed'] = 'Date Closed';
		$data['table_header_action'] = 'Action';
		
		$data['table_heading'] = 'Service Request List';
		$this->load->view("concierge/concierge_dashboard", $data);		
		}
	}
	public function demo(){
		authenticate(array('ut8'));
	$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->concierge_login->getUserProfile($userId);
		if(!empty($data['userData'])){
			$currentCityId = $data['userData']['city_id'];
			if($currentCityId != ''){
				$data['serviceRequests'] = $this->concierge_listing->getServiceRequests($currentCityId);
			}
		}
		if($userId!="" && $userTypeId=="ut8"){
		$data['title'] = 'Smartworks | Smart Concierge Assistant';
		$data['table_header_status'] = 'Status';
		$data['table_header_date_opend'] = 'Date Opened';
		$data['table_header_request_from'] = 'Request From';
		$data['table_header_request_type'] = 'Request type';
		$data['table_header_request_details'] = 'Request Details';
		$data['table_header_date_closed'] = 'Date Closed';
		$data['table_header_action'] = 'Action';
		
		$data['table_heading'] = 'Service Request List';
		$this->load->view("concierge/demo",$data);
	} 
}
	public function membership(){
		authenticate(array('ut8'));
	$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->concierge_login->getUserProfile($userId);
		if(!empty($data['userData'])){
			$currentCityId = $data['userData']['city_id'];
			if($currentCityId != ''){
				$data['serviceRequests'] = $this->concierge_listing->getServiceRequests($currentCityId);
			}
		}
		if($userId!="" && $userTypeId=="ut8"){
		$data['title'] = 'Smartworks | Smart Concierge Assistant';
		$data['table_header_status'] = 'Status';
		$data['table_header_date_opend'] = 'Date Opened';
		$data['table_header_request_from'] = 'Request From';
		$data['table_header_request_type'] = 'Request type';
		$data['table_header_request_details'] = 'Request Details';
		$data['table_header_date_closed'] = 'Date Closed';
		$data['table_header_action'] = 'Action';
		
		$data['table_heading'] = 'Service Request List';
		$this->load->view("concierge/membership",$data);
	} 
}
public function demo2(){
		authenticate(array('ut8'));
	$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->concierge_login->getUserProfile($userId);
		if(!empty($data['userData'])){
			$currentCityId = $data['userData']['city_id'];
			if($currentCityId != ''){
				$data['serviceRequests'] = $this->concierge_listing->getServiceRequests($currentCityId);
			}
		}
		if($userId!="" && $userTypeId=="ut8"){
		$data['title'] = 'Smartworks | Smart Concierge Assistant';
		$data['table_header_status'] = 'Status';
		$data['table_header_date_opend'] = 'Date Opened';
		$data['table_header_request_from'] = 'Request From';
		$data['table_header_request_type'] = 'Request type';
		$data['table_header_request_details'] = 'Request Details';
		$data['table_header_date_closed'] = 'Date Closed';
		$data['table_header_action'] = 'Action';
		
		$data['table_heading'] = 'Service Request List';
		$this->load->view("concierge/demo2",$data);
	} 
}
public function privateOffice(){
		authenticate(array('ut8'));
	$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->concierge_login->getUserProfile($userId);
		if(!empty($data['userData'])){
			$currentCityId = $data['userData']['city_id'];
			if($currentCityId != ''){
				$data['serviceRequests'] = $this->concierge_listing->getServiceRequests($currentCityId);
			}
		}
		if($userId!="" && $userTypeId=="ut8"){
		$data['title'] = 'Smartworks | Smart Concierge Assistant';
		$data['table_header_status'] = 'Status';
		$data['table_header_date_opend'] = 'Date Opened';
		$data['table_header_request_from'] = 'Request From';
		$data['table_header_request_type'] = 'Request type';
		$data['table_header_request_details'] = 'Request Details';
		$data['table_header_date_closed'] = 'Date Closed';
		$data['table_header_action'] = 'Action';
		
		$data['table_heading'] = 'Service Request List';
		$this->load->view("concierge/privateOffice",$data);
	} 
}
	function getServiceRequestDetails(){ // for ajax get service request details
		authenticate(array('ut8'));
		$serviceId = $this->input->post("serviceId");
		$reqtype=$this->input->post('reqtype');
		$serviceDetails = $this->concierge_listing->details($serviceId,$reqtype);
		if($reqtype=="Flight" || $reqtype=="Train" || $reqtype=="Bus" || $reqtype=="Cab"){
		
			$frmcityid=$serviceDetails[0]['from_city_id'];
			$tocityid=$serviceDetails[0]['to_city_id'];
			$frm_city=$this->lm->getconciergecity($frmcityid);
            $to_city=$this->lm->getconciergecity($tocityid);
            $serviceDetails[0]['from_city']=$frm_city[0]['name'];
            $serviceDetails[0]['to_city']=$to_city[0]['name'];
            $cab=$serviceDetails[0]['cab'];
            $cabnm=$this->lm->get_cab_byid($cab);
            if($serviceDetails[0]['cab']<>""){
            	$serviceDetails[0]['cabnm']=$cabnm[0]['name'];
            }
            if($serviceDetails[0]['total_passengers']<>""){
			$totalpassenger=json_decode($serviceDetails[0]['total_passengers']);
			$passengerdt="Adult: ".$totalpassenger->adult.",Child: ".$totalpassenger->child.",Infant: ".$totalpassenger->infant;
		$serviceDetails[0]['passengerdt']=$passengerdt;
	}else{
		$serviceDetails[0]['passengerdt']="";
	}

		
	}else if($reqtype=="Hotel"){
		
			$frmcityid=$serviceDetails[0]['city'];
			$frm_city=$this->lm->getconciergecity($frmcityid);
            $serviceDetails[0]['location']=$frm_city[0]['name'];
            $rm_details=json_decode($serviceDetails[0]['room_details']);
            $str_boader="";
            foreach($rm_details as $key->$val){
            	$str_boader.=$key.":".$val;
            }
			
		$serviceDetails[0]['roomdt']=$str_boader;
            
		
	}else if($reqtype=="Movie"){
		
			$mvname=$serviceDetails[0]['name'];
			$mvlocation=$serviceDetails[0]['location'];
			$mv_name=$this->lm->get_movie_byid($mvname);
			$mv_loc=$this->lm->get_hall_byid($mvlocation);
			$serviceDetails[0]['movie']=$mv_name[0]['name'];
            $serviceDetails[0]['location']=$mv_loc[0]['name'];
            
		
	}
	else if($reqtype=="Restaurant"){
		
			$resnm=$serviceDetails[0]['name'];
			$reslocation=$serviceDetails[0]['location'];
			$res_name=$this->lm->get_resturant_byid($resnm);
			$res_loc=$this->lm->get_resturant_location_byid($reslocation);
			$serviceDetails[0]['restaurant']=$res_name[0]['name'];
            $serviceDetails[0]['location']=$res_loc[0]['name'];
            
		
	}
    else if($reqtype=="Event"){
		
			$evntnm=$serviceDetails[0]['name'];
			$evntlocation=$serviceDetails[0]['location'];
			$evnt_name=$this->lm->get_event_byid($evntnm);
			$evnt_loc=$this->lm->get_event_location_byid($evntlocation);
			$serviceDetails[0]['event']=$evnt_name[0]['eventName'];
            $serviceDetails[0]['location']=$evnt_loc[0]['location'];
            
		
	}else if($reqtype=="Experience"){
		
			$expnm=$serviceDetails[0]['name'];
			$explocation=$serviceDetails[0]['location'];
			$exp_name=$this->lm->get_experience_byid($expnm);
			$exp_loc=$this->lm->get_experience_location_byid($explocation);
			$serviceDetails[0]['experience']=$exp_name[0]['experienceName'];
            $serviceDetails[0]['location']=$exp_loc[0]['location'];
            
		
	}

		
		
		echo json_encode($serviceDetails);
	}
	function approveServiceRequestDetails(){ // for ajax update service request details
		authenticate(array('ut8'));
		$data = array();
		$data['requestId'] = $this->input->post("requestId");
		$data['userId'] = $this->input->post("userId");
		$data['price'] = $this->input->post("price");
		$data['comid'] = $this->input->post("comid");
		$data['serviceDesc'] = $this->input->post("serviceDesc");
		$reqStatus = $this->concierge_listing->approve_request($data);
		echo json_encode(array('status'=>$reqStatus));
	}
	function rejectServiceRequestDetails(){ // for ajax update service request details
		authenticate(array('ut8'));
		$data = array();
		$data['serviceId'] = $this->input->post("serviceId");
		$reqStatus = $this->concierge_listing->reject_request($data['serviceId']);
		echo json_encode(array('status'=>$reqStatus));
	}
	public function getServiceRequestList(){
		$reqtype=$this->input->post('reqtype');
		authenticate(array('ut8'));
		$userId = $this->session->userdata("userId");
		$userData = $this->concierge_login->getUserProfile($userId);
		$currentCityId = $userData['city_id'];
		$data['reqlist']=$this->concierge_listing->get_request_service_bytype($reqtype,$currentCityId);
		$data['reqtype']=$reqtype;
		if($reqtype=="Flight" || $reqtype=="Train" || $reqtype=="Bus" || $reqtype=="Cab"){
		for($i=0;$i<count($data['reqlist']);$i++){
			$frmcityid=$data['reqlist'][$i]['from_city_id'];
			$tocityid=$data['reqlist'][$i]['to_city_id'];
			$frm_city=$this->lm->getconciergecity($frmcityid);
            $to_city=$this->lm->getconciergecity($tocityid);
            $data['reqlist'][$i]['from_city']=$frm_city[0]['name'];
            $data['reqlist'][$i]['to_city']=$to_city[0]['name'];
		}
	}else if($reqtype=="Hotel"){
		for($i=0;$i<count($data['reqlist']);$i++){
			$frmcityid=$data['reqlist'][$i]['city'];
			$frm_city=$this->lm->getconciergecity($frmcityid);
            $data['reqlist'][$i]['location']=$frm_city[0]['name'];
            
		}
	}else if($reqtype=="Movie"){
		for($i=0;$i<count($data['reqlist']);$i++){
			$mvname=$data['reqlist'][$i]['name'];
			$mvlocation=$data['reqlist'][$i]['location'];
			$mv_name=$this->lm->get_movie_byid($mvname);
			$mv_loc=$this->lm->get_hall_byid($mvlocation);
			$data['reqlist'][$i]['movie']=$mv_name[0]['name'];
            $data['reqlist'][$i]['location']=$mv_loc[0]['name'];
            
		}
	}
	else if($reqtype=="Restaurant"){
		for($i=0;$i<count($data['reqlist']);$i++){
			$resnm=$data['reqlist'][$i]['name'];
			$reslocation=$data['reqlist'][$i]['location'];
			$res_name=$this->lm->get_resturant_byid($resnm);
			$res_loc=$this->lm->get_resturant_location_byid($reslocation);
			$data['reqlist'][$i]['restaurant']=$res_name[0]['name'];
            $data['reqlist'][$i]['location']=$res_loc[0]['name'];
            
		}
	}
    else if($reqtype=="Event"){
		for($i=0;$i<count($data['reqlist']);$i++){
			$evntnm=$data['reqlist'][$i]['name'];
			$evntlocation=$data['reqlist'][$i]['location'];
			$evnt_name=$this->lm->get_event_byid($evntnm);
			$evnt_loc=$this->lm->get_event_location_byid($evntlocation);
			$data['reqlist'][$i]['event']=$evnt_name[0]['eventName'];
            $data['reqlist'][$i]['location']=$evnt_loc[0]['location'];
            
		}
	}else if($reqtype=="Experience"){
		for($i=0;$i<count($data['reqlist']);$i++){
			$expnm=$data['reqlist'][$i]['name'];
			$explocation=$data['reqlist'][$i]['location'];
			$exp_name=$this->lm->get_experience_byid($expnm);
			$exp_loc=$this->lm->get_experience_location_byid($explocation);
			$data['reqlist'][$i]['experience']=$exp_name[0]['experienceName'];
            $data['reqlist'][$i]['location']=$exp_loc[0]['location'];
            
		}
	}
		$this->load->view('concierge_dashboard_data',$data);
	}
	
}
?>
