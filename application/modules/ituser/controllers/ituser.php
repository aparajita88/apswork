<?php
class Ituser extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
		$this->load->model('users/login');
		$this->load->model('ituser_model');
		$this->load->model('cms/cms_model');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
	}
    public function index(){
		$this->session->sess_destroy();
		$this->load->view('ituser_login');
	}
	public function dashBoard(){ // admin dashboard
		authenticate(array('ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['count_pages']= $this->cms_model->getAllPage();
		$data['count_pages']=count($data['count_pages']);
		$data['pg']=$this->cms_model->getAllPageBy5();;
		$this->load->view('ituser_dashboard',$data);
		
		
	}
	
}
?>
