<?php
class countries extends MY_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('form'); 
      $this->load->helper('url'); 
      $this->load->model('country', 'country');
      //$this->load->library('session');
    }
	
    public function index(){
		if($this->session->userdata('userId')=="" || $this->session->userdata('userTypeId')!="ut1"){
			redirect(base_url()."index.php/users/doLogOut");
		}
		$data['allCountries'] = $this->country->getAllCountries();
		$this->load->view("country", $data);
	}
	
	public function save(){
		if($this->session->userdata('userId')=="" || $this->session->userdata('userTypeId')!="ut1"){
			redirect(base_url()."index.php/users/doLogOut");
		}
		$country = $this->input->post("country");
		$data = array();
		$data["name"]		= $country;
		$data["addedBy"]	= $this->session->userdata('userId');
		$data["dateAdded"]	= gmdate('Y-m-d H:i:s');
		$data["status"]		= (int)1;
		$data["deleted"]	= (int)0;
		$url = base_url()."index.php/countries";
		if($this->country->save($data)){
			redirect($url."?staus=country_successfully_added");
		}else{
			redirect($url."?staus=country_add_error");
		}
	}
}
?>
