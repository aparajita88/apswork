<?php
class Vendor_model extends MY_Model {
	
    public function __construct(){
		
     
		parent::__construct();
		
        $this->load->database(); 
	}

public function get_classified_details($userId,$limit){
	$sql = "select classifieds.*, service_images.imageName ,service_images.primaryImage,service_images.deleted as s_deleted from classifieds LEFT JOIN service_images ON classifieds.classifiedId = service_images.serviceId  WHERE  classifieds.classifiedUserId='".$userId."' AND classifieds.deleted ='0'   AND service_images.primaryImage ='1'
	  ORDER BY classifieds.dateAdded DESC LIMIT 0,$limit";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}
public function get_classified_count_details($userId){
$sql = "select classifieds.*, service_images.imageName ,service_images.primaryImage,service_images.deleted as s_deleted from classifieds LEFT JOIN service_images ON classifieds.classifiedId = service_images.serviceId  WHERE  classifieds.classifiedUserId='".$userId."' AND classifieds.deleted ='0'   AND service_images.primaryImage ='1'
	  ORDER BY classifieds.dateAdded DESC ";
	$query=$this->db->query($sql);
	return $result=$query->result_array();		
	
}

public function get_classified($classified_id){
    
    $sql = "select classifieds.*, service_images.id,service_images.imageName,service_images.deleted as s_deleted from classifieds LEFT JOIN service_images ON classifieds.classifiedId = service_images.serviceId  WHERE  classifieds.classifiedId='".$classified_id."'  AND service_images.primaryImage ='1'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
    
    
}
public function statusChangeClassified($classifiedid,$val)
	{
		if($val == 1)
		{
			$this->db->set("status", 0);
			$this->db->where("classifiedId", $classifiedid);
			$this->db->update("classifieds");

			return 0;
		}
		else
		{
			$this->db->set("status", 1);
			$this->db->where("classifiedId", $classifiedid);
			$this->db->update("classifieds");

			return 1;
		}
		

		
	}
	
	
	public function get_classified_images($classified_id){
		
	 $sql = "select service_images.* , service_images.deleted as s_deleted from service_images WHERE service_images.deleted='0' AND service_images.serviceId ='".$classified_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
		
	}
	
	public function get_classified_videos($classified_id){
		
	 $sql = "select classified_videos.* , classified_videos.deleted as s_deleted from classified_videos WHERE classified_videos.deleted='0' AND classified_videos.classifiedID ='".$classified_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
		
	}
	
	
	

 public function get_complaints_details($userId, $complain_id){
    $sql = "select classifieds.*, complaints.*,user.FirstName,user.LastName from user LEFT JOIN complaints ON 
	    user.userId = complaints.addedBy LEFT JOIN classifieds ON classifieds.classifiedid= complaints.classified_id 
	    WHERE  parent_id='".$complain_id."' and classifieds.ownerId='".$userId."' ORDER BY complaints.dateAdded DESC";
	  	$query=$this->db->query($sql);
	return $result=$query->result_array();
	
	 }
function get_subject($complain_id){

$sql="select complaints.subject FROM complaints WHERE complain_id='".$complain_id."'";
$query=$this->db->query($sql);
 return $query->result();
}

                                                                            

	
	
	
}



