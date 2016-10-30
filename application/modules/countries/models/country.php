<?php
class country extends MY_Model {
	
	public function __construct() {
	   	parent::__construct();
	   	 $this->load->database();
    }
        
	public function save($data){
		return $this->db->insert("countries", $data);
	}
	
	public function getAllCountries(){
		$this->db->select("*");
		$this->db->from('countries');
		$this->db->where('status =', (int)1);
		$this->db->where('deleted =', (int)0);
		$query = $this->db->get();
		return $query->result_array();
	}
}
?>
