<?php
class Cron extends MY_Controller {
	var $gallery_path;
	var $gallery_path_url;
	var $atos_url;
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('login/login_model');
	    $this->load->model('rooms/rooms_model');
	    $this->load->model('location/location_model', 'lm');
	    $this->load->model('cron_model');
	    $this->load->library("atos");
	   	$this->load->helper('common');
		$this->load->helper('form'); 
		$this->load->library('email');
		$this->load->helper('path');
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->atos_url = 'https://cgt.in.worldline.com/ipg/doMEPayRequest'; //should call model from admin settings for live or test server
		$this->output->enable_profiler(FALSE); //Default FALSE
	}
	public function invoice_generate_by_cron(){
		/*$current_invoice_details = $this->cron_model->get_current_invoice_by_staus();
		echo "<pre>";
		print_r($current_invoice_details);
		echo "</pre>";
		$current_invoice_id = $current_invoice_details['id'];
		$update_invoice_current_data = array();
		$update_invoice_current_data['tax_amount'] 		= (double)round((($current_invoice_details['sub_total']*$current_invoice_details['tax_rate'])/100),2);
		$update_invoice_current_data['total_amount'] 	= round($update_invoice_current_data['tax_amount'] + $current_invoice_details['sub_total'],2);
		$update_invoice_current_data['dateModified'] 	= date('Y-m-d h:i:s');
		$update_invoice_current_data['status'] 			= 1;
		echo "<pre>";
		print_r($update_invoice_current_data);
		echo "</pre>";*/
		/*$from_email 	= 'sworks_team@sworks.co.in'; 
        $from_name 		= ucfirst('Team Smartworks');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to('sohom@simayaa.com'); 
		$this->email->subject('test cron');
		$this->email->message('this is a test cron from new controller cron');
		$this->email->send();*/
	}
}
