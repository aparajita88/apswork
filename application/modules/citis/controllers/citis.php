<?php
class citis extends MY_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('form'); 
      $this->load->helper('url'); 
    }
	
    public function index(){
		if($this->session->userdata('userId')==""){
			redirect(base_url()."index.php/users/doLogOut");
		}
		$this->load->view("city");
	}
}
?>
