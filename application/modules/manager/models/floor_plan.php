<?php

class floor_plan extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
    public function get_floor_plan($buisness_id){
		$query=$this->db->get_where('floor_plan',array('business_id'=>$buisness_id));
		return $query->result_array();
	}
	public function get_floor_plan_seat($floor_id){
		$query=$this->db->get_where('floor_plan_seats',array('floor_id'=>$floor_id));
		return $query->result_array();
	}
	public function ger_floor_plan_byid($floor_id){
		$query=$this->db->get_where('floor_plan',array('floor_id'=>$floor_id));
		return $query->result_array();
	}
	public function getservice_bybussid($bussid){
		$query=$this->db->get_where('floor_plan_service',array('business_id'=>$bussid));
        return $query->result_array();
	}
	public function getseatinfo($seatid){
		$query=$this->db->get_where('floor_plan_seats',array('seat_id'=>$seatid));
		return $query->result_array();
	}
	}
