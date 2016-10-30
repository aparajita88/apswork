<?php

class Complaints_model extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
          	$this->load->database();
          	
    }
    
    public function search_complaints_bydate($userId,$start_date,$end_date){
if($this->session->userdata("userTypeId")=='ut4'){		
 $sql = "select complaints.*,user.FirstName,user.LastName,cities.name as c_name,locations.name as l_name from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy left join cities on complaints.city_id=cities.cityId left join locations on complaints.location_id=locations.locationId
	    WHERE  complaints.addedBy='".$userId."' AND parent_id='0' AND complaints.dateadded BETWEEN '".$start_date."' AND '".$end_date."'  ORDER BY complaints.dateAdded DESC";
}else if($this->session->userdata("userTypeId")=='ut2'){
   $sql = "select complaints.*,user.FirstName,user.LastName,cities.name as c_name,locations.name as l_name from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy left join cities on complaints.city_id=cities.cityId left join locations on complaints.location_id=locations.locationId
	     WHERE parent_id='0' AND complaints.dateadded BETWEEN '".$start_date."' AND '".$end_date."' ORDER BY complaints.dateAdded DESC";   
}else{
	$sql = "select complaints.*,user.FirstName,user.LastName,cities.name as c_name,locations.name as l_name from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy left join cities on complaints.city_id=cities.cityId left join locations on complaints.location_id=locations.locationId
	    WHERE  complaints.addedBy IN $userId AND parent_id='0' AND complaints.dateadded BETWEEN '".$start_date."' AND '".$end_date."'  ORDER BY complaints.dateAdded DESC";
}	        
	$query=$this->db->query($sql);


	return $query->result_array();
	}
     public function search_complaints_bystatus($userId,$status){
     if($this->session->userdata("userTypeId")=='ut4'){	 
	 $sql = "select complaints.*,user.FirstName,user.LastName from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy 
	    WHERE  complaints.addedBy='".$userId."' AND parent_id='0' AND complaints.status='".$status."'  ORDER BY complaints.dateAdded DESC";
	}
	else if($this->session->userdata("userTypeId")=='ut2'){
	  $sql = "select complaints.*,user.FirstName,user.LastName from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy 
	     WHERE parent_id='0' AND complaints.status='".$status."'  ORDER BY complaints.dateAdded DESC";  
	}else{
		$sql = "select complaints.*,user.FirstName,user.LastName from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy 
	    WHERE  complaints.addedBy IN $userId AND parent_id='0' AND complaints.status='".$status."'  ORDER BY complaints.dateAdded DESC";
	}      
	$query=$this->db->query($sql);
	return $query->result_array();	 
		 
		 
	 }
	 public function set_close_complaint($complaint_id,$complaint_data){
		 $this->db->where('complain_id',$complaint_id);
		 $this->db->update("complaints",$complaint_data);
	 }
     public function get_all_complaints($userId){
		 if($this->session->userdata("userTypeId")!='ut7' && $this->session->userdata("userTypeId")!='ut10' && $this->session->userdata("userTypeId")!='ut5' &&
		    $this->session->userdata("userTypeId")!='ut2'){	 
     $sql = "select complaints.*,user.FirstName,user.LastName,cities.name as c_name,locations.name as l_name from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy left join cities on complaints.city_id=cities.cityId left join locations on complaints.location_id=locations.locationId
	    WHERE  complaints.addedBy='".$userId."' AND parent_id='0'  ORDER BY complaints.dateAdded DESC";
	   }
	   else if($this->session->userdata("userTypeId")=='ut2'){
    $sql =  "select complaints.*,user.FirstName,user.LastName,cities.name as c_name,locations.name as l_name from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy left join cities on complaints.city_id=cities.cityId left join locations on complaints.location_id=locations.locationId
	    WHERE parent_id='0'  ORDER BY complaints.dateAdded DESC";
	   }
	   else {
		   $sql = "select complaints.*,user.FirstName,user.LastName,cities.name as c_name,locations.name as l_name from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy left join cities on complaints.city_id=cities.cityId left join locations on complaints.location_id=locations.locationId
	    WHERE  complaints.addedBy IN $userId AND parent_id='0'  ORDER BY complaints.dateAdded DESC";
	   }      
	$query=$this->db->query($sql);
	return $query->result_array();
}


public function get_client_for_manager($legal_data){
	$this->db->select('*');
	$this->db->from('user');
	$this->db->where('location_id',trim($legal_data['location']));
	$this->db->where('city_id',trim($legal_data['city']));
	$query=$this->db->get();
	return $query->result_array();
}
public function get_client_for_areadirector($legal_data){
	
$this->db->select('*');
	$this->db->from('user');
	
	$this->db->where('city_id',trim($legal_data['city']));
	$query=$this->db->get();
	return $query->result_array();	
	
}
    
    }
