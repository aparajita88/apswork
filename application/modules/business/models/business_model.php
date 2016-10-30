<?php
class Business_model extends MY_Model {
	
    public function __construct(){
		parent::__construct();
		
        $this->load->database(); 
	}
	public function getadinfo($city_id){
    $sql="select user.userEmail,user.FirstName,user.LastName from user where userTypeId='ut10' AND city_id='".$city_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
	}
	public function getmanagerinfo($city_id){
    $sql="select user.userEmail,user.FirstName,user.LastName from user where userTypeId='ut7' AND city_id='".$city_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
	}
	public function getownerinfo(){
	$sql="select user.userEmail,user.FirstName,user.LastName from user where userTypeId='ut2'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();    
	}
	public function chk_company($company_name){
	$this->db->select('*');
    $this->db->from('company');
    $this->db->like('company_name',$company_name);
    return $this->db->get()->result_array();	
	}
	public function get_invoice_by_comid($comid){
	$query=$this->db->get_where('invoices',array('customerId'=>$comid,'status'=>0));
	return $query->result_array();	
	}
	public function process_request($invoice_id,$invoice_data,$invoice_item_data){
	$this->db->where('id',$invoice_id);
	$this->db->update('invoices',$invoice_data);
	$this->db->insert('invoice_items',$invoice_item_data);
        }
	public function voffice_booking_listing(){
	$sql="select booking_virtual_office.*,virtual_office.name,business_centers.businessName,business_centers.address from virtual_office
	left join business_centers on business_centers.business_id=virtual_office.business_id inner join booking_virtual_office on booking_virtual_office.v_id=virtual_office.id
	";
        $query=$this->db->query($sql);
        return $result=$query->result_array();     
	}
	public function get_voffice_view_detsiles($id){
	$sql="select booking_virtual_office.*,virtual_office.name,business_centers.businessName,business_centers.address from virtual_office
	left join business_centers on business_centers.business_id=virtual_office.business_id left join booking_virtual_office on booking_virtual_office.v_id=virtual_office.id
	where booking_virtual_office.id='".$id."'";
        $query=$this->db->query($sql);
        return $result=$query->result_array();    
	}
	public function get_businessdetailesbyvid($v_id){
	$sql="select virtual_office.name,virtual_office.id,virtual_office.price,virtual_office.onetime_price,business_centers.business_id,business_centers.businessName,business_centers.businessName,business_centers.address from virtual_office left join business_centers on business_centers.business_id=virtual_office.business_id
	where virtual_office.id='".$v_id."'";
        $query=$this->db->query($sql);
        return $result=$query->result_array();    
	}
	public function check_virtual_no($business_id){
	$sql="select virtual_office.* from virtual_office where business_id='".$business_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
	}
	public function get_office_list($id){
    $sql="select virtual_office.* from virtual_office where business_id='".$id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();			
	}
	public function get_virtual_office_bybusinessId($id){
    $sql="select virtual_office.* from virtual_office where id='".$id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();

	}
	public function get_business_image($sid,$id){
	$sql = "select business_images.* from business_images WHERE business_images.id='".$id."' AND business_images.businessId ='".$sid."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();			
		
	}
	public function get_business_video($cid,$id){
	$sql = "select business_videos.* from business_videos WHERE business_videos.id='".$id."' AND business_videos.businessID ='".$cid."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
		
	}
	public function get_business_images($business_id){
		
	 $sql = "select business_images.* , business_images.deleted as s_deleted from business_images WHERE business_images.deleted='0' AND business_images.businessId ='".$business_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
		
	}
	public function get_business_videos($business_id){
		
	 $sql = "select business_videos.* , business_videos.deleted as s_deleted from business_videos WHERE business_videos.deleted='0' AND business_videos.businessId ='".$business_id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
		
	}
public function getlocationcity($locationid){
	
	
	
	$sql = "select business_centers.*,user.userEmail, business_images.imageName,locations.name as l_name,cities.name as c_name from  business_centers LEFT JOIN business_images ON  business_centers.business_id= business_images.businessId left join locations on  business_centers.locationId=locations.locationId left join cities on cities.cityId=locations.cityId left join user on user.userId=business_centers.ownerId WHERE business_images.primaryImage ='1' AND business_centers.locationId='".$locationid."' ";
  
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function getvendor(){
	$sql="select user.userId,user.userEmail FROM user where userTypeId ='ut3' ";
	$query=$this->db->query($sql);
    return $result=$query->result_array();	
	
}
public function getvirtualofficeBybusiness($businessid){
$sql="select virtual_office.* from virtual_office where business_id='".$businessid."'";
$query=$this->db->query($sql);
return $result=$query->result_array();	

}
public function get_business_attributes($id){
	$sql="select floor_plan_service.* FROM floor_plan_service where business_id ='".$id."' ";
	$query=$this->db->query($sql);
    return $result=$query->result_array();	
	
}
public function getbusiness($userId){
	$sql = "select business_centers.*,user.userEmail, locations.name as l_name,cities.name as c_name ,business_images.imageName ,business_images.primaryImage,business_images.deleted as s_deleted from business_centers LEFT JOIN business_images ON business_centers.business_id = business_images.businessId left join locations on locations.locationId=business_centers.locationId left join cities on cities.cityId=business_centers.cityId left join user on user.userId=business_centers.ownerId WHERE  business_centers.addedBy='".$userId."' AND business_centers.deleted ='0'   AND business_images.primaryImage ='1'  ORDER BY business_centers.dateAdded DESC";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}

public function get_business($business_id)
{  
    $sql = "select business_centers.*, business_images.id,business_images.imageName,business_images.deleted as s_deleted from business_centers LEFT JOIN business_images ON business_centers.business_id = business_images.businessId  WHERE  business_centers.business_id='".$business_id."'  AND business_images.primaryImage ='1'";    
	$query=$this->db->query($sql);
    return $result=$query->result_array();      
}

public function edittable($pid='',$data=array(),$id='',$table='')
{
	    $this->db->where($pid, $id);
		$result = $this->db->update($table, $data); 
        return $result;	
		
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
	
}



