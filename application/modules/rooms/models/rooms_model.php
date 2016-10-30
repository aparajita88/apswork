<?php
class Rooms_model extends MY_Model {
	
    public function __construct(){
		
     
		parent::__construct();
		
        $this->load->database(); 
	}
public function	get_all_subscription(){
$sql = "select subscription.* from subscription ORDER BY price ASC";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
	
}
public function getlockerbybusiness($business_id){
	$sql="select locker_room.* from locker_room where business_id='".$business_id."' AND deleted='0'";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
	
}
public function  getbuisnessbylocationcity($cityid,$locationid){
	$sql="select business_centers.* from business_centers where cityId='".$cityid."' AND locationId='".$locationid."' AND deleted='0'";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
		
	}
public function get_conference_rooms(){
	$sql = "select  bc.businessName, conference_room.*,rooms_images.imageName,locations.name as l_name,cities.name as c_name FROM conference_room left join rooms_images on rooms_images.room_id=conference_room.conference_id left join locations on conference_room.location=locations.locationId left join cities on cities.cityId=locations.cityId left join business_centers as bc on bc.business_id=conference_room.business_id WHERE rooms_images.roomtype='conference' AND conference_room.deleted ='0' ORDER BY conference_room.dateAdded DESC";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}
public function get_game_types($id){
	
$sql = "select game_types.*,user.userEmail from game_types left join user on game_types.ownerId=user.userId where game_types.id='".$id."' AND game_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function get_subscription_type($id){
	
	$id=base64_decode(base64_decode($id));	
	
$sql = "select subscription.* from subscription  where subscription.Id='".$id."' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}

public function get_allgame_types(){
	$sql = "select game_types.*,user.userEmail from game_types left join user on game_types.ownerId=user.userId where game_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
	
}
public function all_game_types(){
$sql="select game_types.* from game_types where game_types.deleted='0'";	
$query=$this->db->query($sql);
return $result=$query->result_array();		
}

public function get_courier_types($id){
	$sql = "select courier_types.*,user.userEmail from courier_types left join user on courier_types.ownerId=user.userId where courier_types.id='".$id."' AND courier_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function get_allcourier_types(){
	$sql = "select courier_types.*,user.userEmail from courier_types left join user on courier_types.ownerId=user.userId where courier_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
	
}
public function get_concierge_types($id){
	$sql = "select concierge_types.*,user.userEmail from concierge_types left join user on concierge_types.ownerId=user.userId where concierge_types.id='".$id."' AND concierge_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}


public function get_allconcierge_types(){
	
$sql = "select concierge_types.*,user.userEmail from concierge_types left join user on concierge_types.ownerId=user.userId where concierge_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function get_cafe_cat($city_id,$location_id){
$sql = "select cafe_types.* from cafe_types where cafe_types.parent_id ='' AND cafe_types.deleted='0' AND cafe_types.location_id='".$location_id."' AND cafe_types.city_id='".$city_id."' ";
$query=$this->db->query($sql);
return $result=$query->result_array();		
	
	
}
public function get_cafe_types($id){
	$sql = "select cafe_types.*,user.userEmail from cafe_types left join user on cafe_types.ownerId=user.userId where cafe_types.id='".$id."' AND cafe_types.deleted='0' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function getcafecategory(){
	
$sql = "select cafe_types.*,cities.name as c_name from cafe_types left join cities on cafe_types.city_id=cities.cityId  where cafe_types.parent_id='' AND cafe_types.deleted='0' ";
$query=$this->db->query($sql);
return $result=$query->result_array();		
	
}
public function get_allcafe_subtypes(){
	$sql = "select c1.*, (select name from cafe_types where id=c1.parent_id) parent from cafe_types c1  where c1.deleted='0'";
	$query=$this->db->query($sql);
	return $result=$query->result_array();
	
			
 	
	}
public function get_cafe_subcat($id){
$sql = "select cafe_types.* from cafe_types where cafe_types.parent_id='".$id."' AND cafe_types.deleted='0' ";
$query=$this->db->query($sql);
return $result=$query->result_array();			
	
}
public function get_meeting_rooms()
{
	
	$sql = "select bc.businessName,meeting_room.*,rooms_images.imageName,locations.name as l_name,cities.name as c_name FROM meeting_room left join rooms_images on rooms_images.room_id=meeting_room.meeting_id
	left join locations on meeting_room.location=locations.locationId left join cities on cities.cityId=locations.cityId left join business_centers as bc on bc.business_id=meeting_room.business_id WHERE rooms_images.roomtype='meeting' AND meeting_room.deleted ='0' AND bc.deleted='0' ORDER BY meeting_room.dateAdded DESC";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}
public function get_day_offices(){
$sql = "select bc.businessName,day_office.*,rooms_images.imageName,locations.name as l_name,cities.name as c_name FROM day_office left join rooms_images on rooms_images.room_id=day_office.dayoffice_id
left join locations on day_office.location=locations.locationId left join cities on cities.cityId=day_office.city left join business_centers as bc on bc.business_id=day_office.business_id WHERE rooms_images.roomtype='dayoffice' AND day_office.deleted ='0' ORDER BY day_office.dateAdded DESC";
$query=$this->db->query($sql);
return $result=$query->result_array();	
}

public function get_game_rooms()
{
	
	$sql = "select bc.businessName, game_room.*,rooms_images.imageName,rooms_images.id,locations.name as l_name,cities.name as c_name FROM game_room left join rooms_images on rooms_images.room_id=game_room.game_id left join locations on game_room.location=locations.locationId left join cities on cities.cityId=locations.cityId left join business_centers as bc on bc.business_id=game_room.business_id WHERE rooms_images.roomtype='game' AND game_room.deleted ='0' ORDER BY game_room.dateAdded DESC";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}

public function get_locker_rooms()
{
	
	$sql = "select bc.businessName, locker_room.*,rooms_images.imageName,rooms_images.id,locations.name as l_name,cities.name as c_name FROM locker_room left join rooms_images on rooms_images.room_id=locker_room.locker_id left join locations on locker_room.location=locations.locationId left join cities on cities.cityId=locations.cityId left join business_centers as bc on bc.business_id=locker_room.business_id WHERE rooms_images.roomtype='locker' AND locker_room.deleted ='0' AND bc.deleted='0' ORDER BY locker_room.dateAdded DESC";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}




public function get_meeting_room($meeting_id)
{
	$sql = "select meeting_room.*, rooms_images.imageName,rooms_images.id from meeting_room LEFT JOIN rooms_images ON meeting_room.meeting_id= rooms_images.room_id  WHERE  meeting_room.meeting_id='".$meeting_id."'  AND rooms_images.roomtype ='meeting'";  
	$query=$this->db->query($sql);
    return $result=$query->result_array();			
}

public function get_day_office($dayoffice_id)
{
	$sql = "select day_office.*, rooms_images.imageName,rooms_images.id from day_office LEFT JOIN rooms_images ON day_office.dayoffice_id= rooms_images.room_id  WHERE  day_office.dayoffice_id='".$dayoffice_id."'  AND rooms_images.roomtype ='dayoffice'";  
	$query=$this->db->query($sql);
    return $result=$query->result_array();			
}
public function get_conference_room($conference_id)
{
	$sql = "select conference_room.*, rooms_images.imageName,rooms_images.id from conference_room LEFT JOIN rooms_images ON conference_room.conference_id= rooms_images.room_id  WHERE  conference_room.conference_id='".$conference_id."'  AND rooms_images.roomtype ='conference'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function get_game_room($game_id)
{
	$sql = "select game_room.*, rooms_images.imageName,rooms_images.id from game_room LEFT JOIN rooms_images ON game_room.game_id= rooms_images.room_id  WHERE  game_room.game_id='".$game_id."'  AND rooms_images.roomtype ='game'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function get_locker_room($locker_id)
{
	$sql = "select locker_room.*, rooms_images.imageName,rooms_images.id from locker_room LEFT JOIN rooms_images ON locker_room.locker_id= rooms_images.room_id  WHERE  locker_room.locker_id='".$locker_id."'  AND rooms_images.roomtype ='locker'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}


public function get_business()
{
	$sql = "select * from business_centers";
    $query=$this->db->query($sql);
    return $result=$query->result_array();	
}

public function getbusinesslocation($business_id,$roomtype)
{
	
	if($roomtype=='conference'){
		
	$table='conference_room';
	$id='conference_id';	
	
	}else if($roomtype=='meeting'){
		
		$table='meeting_room';	
		$id='meeting_id';
	}else if($roomtype=='locker'){
		
		$table='locker_room';	
		$id='locker_id';
	}else if($roomtype=='game'){
		
		$table='game_room';	
		$id='game_id';
	}else if($roomtype=='dayoffice'){
		
		$table='day_office';	
		$id='dayoffice_id';
	}
			
	$sql = "select bc.business_id,bc.businessName,$table.$id as id,$table.name,$table.city,$table.location,$table.status, rooms_images.imageName,locations.name as l_name,cities.name as c_name from  $table LEFT JOIN rooms_images
	ON  $table.$id= rooms_images.room_id left join locations on  $table.location=locations.locationId left join cities on cities.cityId=locations.cityId left join business_centers as bc on bc.business_id=$table.business_id
	WHERE rooms_images.roomtype ='".$roomtype."' AND bc.business_id='".$business_id."' AND bc.deleted='0'";
 
    $query=$this->db->query($sql);
    return $result=$query->result_array();		
	
}
public function get_ajax_booking_room($id,$type){
    if($type='conference'){
    $sql = "select book_conference_room.booking_details,book_conference_room.book_for,conference_room.name from book_conference_room
    left join conference_room on conference_room.conference_id=book_conference_room.conference_room_id where book_conference_room.conference_room_id='".$id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();
    }else if($type='meeting'){
    $sql = "select book_meeting_room.booking_details,book_meeting_room.book_for,meeting_room.name from book_meeting_room
    left join meeting_room on meeting_room.meeting_id=book_meeting_room.meeting_room_id where book_meeting_room.meeting_room_id='".$id."'";
    $query=$this->db->query($sql);
    return $result=$query->result_array();
    }
}

	public function edittable($pid='',$data=array(),$id='',$table='')
	{
	    $this->db->where($pid, $id);
		$result = $this->db->update($table, $data); 
        return $result;	
		
	}
	
}



