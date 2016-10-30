<?php
class pantry extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('pantry_login');
		$this->load->model('location/location_model', 'lm');
		$this->load->helper('form'); 
		$this->load->model('pantry_listing');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
	}
    public function index(){
		if($this->session->userdata("userId")!="" && $this->session->userdata("userTypeId")=="ut9"){
			redirect(base_url().'index.php/pantry/dashBoard', 'refresh');
		}else{
			$this->load->view('pantry_login');
		}
	}
	public function dashBoard(){ // Concierge dashboard
		authenticate(array('ut9'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->pantry_login->getUserProfile($userId);
		if(!empty($data['userData'])){
			$currentCityId = $data['userData']['city_id'];
			if($currentCityId != ''){
				$data['serviceRequests'] = $this->pantry_listing->getServiceRequests($currentCityId);
			}
		}
		if($userId!="" && $userTypeId=="ut9"){
		$data['title'] = 'Smartworks | Pantry Service Assistant';
		$data['table_header_date_opend'] = 'Date Opened';
		$data['table_header_request_from'] = 'Order From';
		$data['table_header_request_type'] = 'Order type';
		$data['table_header_request_details'] = 'Order Details';
		$data['table_header_date_closed'] = 'Date Closed';
		$data['table_header_status'] = 'Status';
		$data['table_header_action'] = 'Action';
		
		$data['table_heading'] = 'My Orders';
		$this->load->view("pantry/pantry_dashboard", $data);		
		}
	}
	
	function getServiceRequestDetails(){ // for ajax get service request details
		authenticate(array('ut9'));
		$serviceId = $this->input->post("serviceId");
		$serviceDetails = $this->pantry_listing->details($serviceId);
		echo json_encode($serviceDetails);
	}
	function approveServiceRequestDetails(){ // for ajax update service request details
		authenticate(array('ut9'));
		$data = array();
		$data['requestId'] = $this->input->post("requestId");
		$data['userId'] = $this->input->post("userId");
		$data['totalPrice'] = $this->input->post("totalPrice");
		$data['comid'] = $this->input->post("comid");
		$data['serviceDesc'] = $this->input->post("serviceDesc");
		$reqStatus = $this->pantry_listing->approve_request($data);
		echo json_encode(array('status'=>$reqStatus));
	}
	function rejectpantryRequestDetails(){ // for ajax update service request details
		authenticate(array('ut9'));
		$data = array();
		$data['serviceId'] = $this->input->post("serviceId");
		$reqStatus = $this->pantry_listing->reject_request($data['serviceId']);
		echo json_encode(array('status'=>$reqStatus));
	}
}
?>
