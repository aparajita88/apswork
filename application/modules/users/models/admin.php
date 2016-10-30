<?php
class user extends MY_Model {
	
	var $adminEmail;
	public function __construct() {
	   	parent::__construct();
        $this->adminEmail = $this->getAdminEmail();
      	$this->load->database(); 
    }
     
	public function getAdminEmail(){
		return "sovan@simayaa.com";
	}
        
}
?>
