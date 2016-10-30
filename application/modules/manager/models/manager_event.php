<?php

class manager_event extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
    public function get_manager_event($userid){
	    $sql="SELECT `client_event`.* ,`FirstName`,`LastName`,`phone`FROM (`client_event`) JOIN `user` ON `client_event`.`createdby` = `user`.`userId`
WHERE createdby='".$userid."'";
		$query=$this->db->query($sql);
		return $query->result_array();
	    
	}
	public function add_event_by_manager($event_data){
		$this->db->insert('client_event',$event_data);
	}
	public function set_event($event_data,$event_id){
		$this->db->where('event_id',$event_id);
		$this->db->update('client_event',$event_data);
	}
	public function client_details($legal_data){
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->join('cities','cities.cityId=user.city_id');
		$this->db->join('locations','locationId=user.location_id');
		$this->db->where('user.location_id',trim($legal_data['location']));
		$this->db->where('user.city_id',trim($legal_data['city']));
		
	}
	}
