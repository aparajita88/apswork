<?php
class Areadirector_model extends MY_Model {
	
    public function __construct(){
		
     
		parent::__construct();
		
        $this->load->database(); 
	}
	public function virtual_agg($start_date,$end_date,$city,$location,$business){
	 $this->db->select("booking_virtual_office.*");
	$this->db->from('booking_virtual_office');
	$this->db->join('business_centers','business_centers.business_id=booking_virtual_office.b_id');
	$this->db->where('booking_virtual_office.isApproved',1);
	$this->db->where('business_centers.business_id',$business);
	$this->db->where('booking_virtual_office.start_date between "'.$start_date.'" AND "'.$end_date.'"');
	$this->db->where('booking_virtual_office.end_date between "'.$start_date. '" AND "'.$end_date.'"');
	$query=$this->db->get();
	return $query->num_rows();       
	}
	public function private_agg($start_date,$end_date,$city,$location,$business){
	 $this->db->select("book_floor_plan.*");
	$this->db->from('book_floor_plan');
	$this->db->join('floor_plan','book_floor_plan.floor_plan_id=floor_plan.floor_id');
	$this->db->join('business_centers','business_centers.business_id=floor_plan.business_id');
	$this->db->where('book_floor_plan.isApproved',1);
	$this->db->where('business_centers.business_id',$business);
	$this->db->where('book_floor_plan.start_date between "'.$start_date.'" AND "'.$end_date.'"');
	$this->db->where('book_floor_plan.end_date between "'.$start_date. '" AND "'.$end_date.'"');
	$query=$this->db->get();
	return $query->num_rows();       
	}
	public function total_enq($start_date,$end_date,$city,$location){
	 $this->db->select("registered_user.userId");
	$this->db->from('registered_user');
	$this->db->where('registered_user.enquiry_type', 2);
	$this->db->where('registered_user.cityId',$city);
	$this->db->where('registered_user.locationId',$location);
	$this->db->where('registered_user.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
	$query=$this->db->get();
        return $query->num_rows();     
	    
	    
	}
	public function total_tour($start_date,$end_date,$city,$location){
	 $this->db->select("registered_user.userId");
	$this->db->from('registered_user');
	$this->db->where('registered_user.enquiry_type', 1);
	$this->db->where('registered_user.cityId',$city);
	$this->db->where('registered_user.locationId',$location);
	$this->db->where('registered_user.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
	$query=$this->db->get();
        return $query->num_rows(); 
	    }
public function leads_gnrtd($start_date,$end_date,$city,$location){
    $ignore = array('web','brokers','internet-brokers','ist','referral');
	$this->db->select("registered_user.source,COUNT(source) as total");
	$this->db->group_by('source'); 
        $this->db->order_by('total', 'desc'); 
	$this->db->from('registered_user');
	$this->db->where_in('registered_user.source', $ignore);
	$this->db->where('registered_user.cityId',$city);
	$this->db->where('registered_user.locationId',$location);
	$this->db->where('registered_user.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
	$query=$this->db->get();
        return $result=$query->result_array();	
    
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

                                                                            
public function get_seat_booking_info($city_id){
		$this->db->select('book_floor_plan.*,floor_plan.description,business_centers.businessName,cities.name as city,locations.name as location');
		$this->db->from('book_floor_plan');
		$this->db->join('floor_plan','book_floor_plan.floor_plan_id=floor_plan.floor_id');
		$this->db->join('business_centers','floor_plan.business_id=business_centers.business_id');
		$this->db->join('cities','cities.cityId=floor_plan.city_id');
		$this->db->join('locations','locations.locationId=floor_plan.location_id');
		$this->db->where('floor_plan.city_id',$city_id);
		$this->db->where('book_floor_plan.Is_approved_ad','1');
		$this->db->or_where('book_floor_plan.Is_approved_ad','2');
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function get_seat_title($seatid){
		$query=$this->db->get_where('floor_plan_seats',array('seat_id'=>$seatid));
		return $query->result_array();
		
	}
	public function  seat_book_info($appid,$appdata){
	$this->db->where('id',$appid);
	$this->db->update('book_floor_plan',$appdata); 
	return '1';
	
	 
 }
 public function get_client_List($city_id){
	

	$this->db->select('u.*,user_type.userTypeName,locations.name as l_name,cities.name as c_name,company.company_name');
	
	$this->db->join('user_type', 'user_type.userTypeId=u.userTypeId', 'left');
	$this->db->join('company','u.company_id=company.id', 'left');
	$this->db->join('locations', 'locations.locationId=u.location_id', 'left');
	$this->db->join('cities', 'cities.cityId=u.city_id', 'left');
	$query=$this->db->get_where('user u ',array('u.userTypeId'=>'ut4','u.city_id'=>$city_id));
  
	
	return $query->result_array(); 
	 
	 
 }
  public function get_revenue_byLocation($location,$city,$month,$year){
	 $this->db->select('sum(total_amount) AS MySum'); 
	 $this->db->from('invoices');
    $this->db->join('company', 'invoices.customerId=company.id', 'left');
	$this->db->where(array('company.city_id'=>$city,'company.location_id'=>$location));
	$this->db->where('YEAR(invoices.invoice_date)',$year);
	$this->db->where('MONTH(invoices.invoice_date)',$month);
	$query = $this->db->get();

  
	
	return $query->result_array(); 
	
$this->db->where('invoices.invoice_date <= ( NOW( ) - INTERVAL 1 MONTH )');  
	  
  }
   public function get_revenue_List($location,$city){
	  
	
	$this->db->select('company.*,invoices.total_amount,invoices.publish_date,locations.name as l_name,cities.name as c_name');
	 $this->db->from('company');
	$this->db->join('invoices', 'invoices.customerId=company.id', 'left');
	$this->db->join('locations', 'locations.locationId=company.location_id', 'left');
	$this->db->join('cities', 'cities.cityId=company.city_id', 'left');
	$this->db->where('company.city_id',$city);
	$this->db->where('invoices.invoice_date <= ( NOW( ) - INTERVAL 1 MONTH )');
	$this->db->order_by("CAST(invoices.total_amount AS DECIMAL ) DESC ");
	$query = $this->db->get();
   
	return $query->result_array();    
	   
   }
   public function get_book_floor_plan_byid($book_floor_id){
   	  $query=$this->db->get_where('book_floor_plan',array('id'=>$book_floor_id));
   	  return $query->result_array();
   }
   public function discount_amount($discount_data,$id){
   	   $this->db->where('id',$id);
   	   $this->db->update('book_floor_plan',$discount_data);
   }
}



