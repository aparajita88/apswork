<?php
class location_model extends MY_Model {
    public function __construct() {
		parent::__construct();
        $this->load->database();
    }
	public function getbusinessimages($business_id){
	    $this->db->select('business_images.*');
		$this->db->from('business_images');
		$this->db->join('business_centers', 'business_centers.business_id = business_images.businessId', 'left');
		$this->db->where(array('business_images.businessId'=>$business_id,'business_images.deleted'=>'0'));
		$query = $this->db->get();
		if(!empty($query->result_array())){
			return $query->result_array();	
		}else{
			return array();
		}	
	}
	public function getbusinessimagesfor_all(){
	 $this->db->select('business_images.*');
		$this->db->from('business_images');
		$this->db->join('business_centers', 'business_centers.business_id = business_images.businessId', 'left');
		$this->db->where(array('business_centers.deleted'=>'0','business_images.deleted'=>'0'));
		$query = $this->db->get();
		if(!empty($query->result_array())){
			return $query->result_array();	
		}else{
			return array();
		}	
	}
	public function getbusinessvideosfor_all(){
	 	$this->db->select('business_videos.*');
		$this->db->from('business_videos');
		$this->db->join('business_centers', 'business_centers.business_id = business_videos.businessID', 'left');
		$query = $this->db->get();
		if(!empty($query->result_array())){
			return $query->result_array();	
		}else{
			return array();
		}			
	}
	public function getbusinessvideos($business_id){
	    $this->db->select('business_videos.*');
		$this->db->from('business_videos');
		$this->db->join('business_centers', 'business_centers.business_id = business_videos.businessID', 'left');
		$this->db->where(array('business_videos.businessID'=>$business_id));
		$query = $this->db->get();
		
		if(!empty($query->result_array())){
			return $query->result_array();	
		}else{
			return array();
		}		
	}
	public function getLocationData($location_id){
		$this->db->select('business_centers.*, business_images.imageName,cities.name as c_name');
		$this->db->from('business_centers');
		$this->db->join('business_images', 'business_centers.business_id = business_images.businessId', 'left');
		$this->db->join('cities', 'cities.cityId = business_centers.cityId', 'left');
		$this->db->where(array('business_centers.cityId'=> $location_id,'business_centers.deleted'=>'0','business_images.primaryImage'=>'1'));
		$query = $this->db->get();
		if(!empty($query->result_array())){
			return $query->result_array();	
		}else{
			return array();
		}
	}
	public function setImageProperPath($data = array(), $fieldName){
		if(empty($data) || !count($data))
			return $data = array();
		foreach($data as $key => $value){
			$data[$key][$fieldName] = base_url().'assets/front/images/'.(($value['imageName']!='')?$value[$fieldName]:'nopreview.jpg');
		}
		return $data;
	}
	public function getcities(){
		$this->db->order_by("orderBy","asc");
		$this->db->select('c.*');	
		$query=$this->db->get_where('cities c',array('deleted' =>'0','isProposed' =>'0'));
	    return $query->result_array();	
		
		
	}
	public function getcitiesregion(){
    $this->db->select('cities.*,region.name as r_name ');
	$this->db->from('cities');
	$this->db->join('region', 'region.regionId = cities.regionId', 'left');
	$query = $this->db->get();
	if(!empty($query->result_array())){
		return $query->result_array();	
	}else{
		return array();
	}
}
	public function getregions(){
    $this->db->select('r.*');	
	$query=$this->db->get_where('region r',array('deleted' =>'0'));
	return $query->result_array();	

	}
	public function get_region_cityname($region_id){
 	$this->db->select('r.*');	
	$this->db->from('region r');
	$this->db->where(array('regionId' =>$region_id));
	$query=$this->db->get();
	return $query->result_array();	
	}
	public function getlocationbycity($cityid){
		$this->db->select('locations.*');	
		$query=$this->db->get_where('locations',array('cityId' =>$cityid,'deleted' =>'0'));
		return $query->result_array();		
	}
	public function  getbuisnessbylocationcity($cityid,$locationid){
		$this->db->select('buisness_centers.*');	
		$query=$this->db->get_where('buisness_centers',array('cityId' =>$cityid,'locationId' =>$locationid));
		return $query->result_array();			
	}
	public function getcity($cityid){
		$this->db->select('c.*');	
		$this->db->from('cities c');
		$this->db->where(array('cityId' =>$cityid));
		$query=$this->db->get();
		return $query->result_array();	
	}
	public function getcityidbyName($city_name){
        $this->db->select('c.*');	
		$this->db->from('cities c');
		$this->db->where(array('name' =>$city_name));
		$query=$this->db->get();
		return $query->result_array();

	}
	public function editPage($pid,$data=array(),$id='',$table=''){
		$this->db->where($pid, $id);
		$result = $this->db->update($table, $data); 
        return $result;
	}
	public function delete($table='',$id='',$column_name=''){
		$result = $this->db->delete($table, array($column_name => $id)); 
		return $result;
	}
	public function addcity($data=array()){
        $result = $this->db->insert('cities', $data); 
        return $result;
	}
	public function isCityAvailable($city){
		$this->db->select('cityId');
		$this->db->where('name =', $city);
		$this->db->from('cities');
		$query = $this->db->get();
		$cityId = $query->row_array();
		if(isset($cityId['cityId']) && $cityId['cityId']!=''){
			return 0;
		}else{
			return 1;
		}
	}
	public function isLocationAvailable($location,$city_id){
	    $this->db->select('locationId');
		$this->db->where(array('name' => $location,'cityId'=>$city_id));
		$this->db->from('locations');
		$query = $this->db->get();
		$locationId = $query->row_array();
		if(isset($locationId['locationId']) && $locationId['locationId']!=''){
			return 0;
		}else{
			return 1;
		}		
	}
	public function addlocation($data=array()){
	 	$result = $this->db->insert('locations', $data); 
        return $result;		
	}
	public function add_region($data=array()){
	 	$result = $this->db->insert('region', $data); 
        return $result;		
	}
	public function getlocation($location_id){
		$this->db->select('locations.*');	
		$query=$this->db->get_where('locations',array('locationId' =>$location_id));
		return $query->result_array();			
	}
	public function getAlllocation(){
		$sql="select locations.*,cities.cityId,cities.name as c_name from locations left join cities on locations.cityId=cities.cityId ";
		$query=$this->db->query($sql);
	 	return $query->result_array();			
	}
	public function getManagers($location_id,$city_id){
		$this->db->select('user.*');	
		$query=$this->db->get_where('user',array('location_id' =>$location_id,'city_id' =>$city_id,'status' =>1, 'userTypeId'=>'ut7'));
		return $query->result_array();			
	}
	/*public function getAllLocationAndBusinness(){
		$sql="select locations.*, cities.cityId, cities.name as c_name, business_centers.business_id, business_centers.businessName from locations left join cities on locations.cityId=cities.cityId left join business_centers on locations.locationId = business_centers.locationId";
		$query=$this->db->query($sql);
	 	return $query->result_array();			
	}*/
	public function getAlllocationBylimit(){
	 	$sql="select locations.*,cities.cityId,cities.name as c_name from locations left join cities on locations.cityId=cities.cityId ORDER BY dateAdded DESC LIMIT 0,5";
		$query=$this->db->query($sql);
	 	return $query->result_array();	      
	}
	public function book_a_tour($data=array()){
		$result = $this->db->insert('registered_user', $data); 
        return $result;
	}
	public function mail_to_user_details($cityid){
		$mail_to_user_data = array();
		//=================LM==================
		$this->db->select('user.FirstName,user.LastName,user.userEmail,user.userName');
		$this->db->where('user.city_id', $cityid);
 		$this->db->where('user.userTypeId','ut7');
		$this->db->from('user');
		$query = $this->db->get();
		$mail_to_user_data['loc_managers'] = $query->result_array();
		//=================AD==================
		$this->db->select('user.FirstName,user.LastName,user.userEmail,user.userName');
		$this->db->where('user.city_id', $cityid);
 		$this->db->where('user.userTypeId','ut10');
		$this->db->from('user');
		$query = $this->db->get();
		$mail_to_user_data['area_director'] = $query->result_array();
		//=================IST User==================
		$this->db->select('user.FirstName,user.LastName,user.userEmail,user.userName');
		$this->db->where('user.city_id', $cityid);
 		$this->db->where('user.userTypeId','ut12');
		$this->db->from('user');
		$query = $this->db->get();
		$mail_to_user_data['ist_user'] = $query->result_array();
		if(count($mail_to_user_data) > 0){
			return $mail_to_user_data;
		}
	}
	public function getLocationManagerById($id){
		$this->db->select('user.FirstName,user.LastName,user.userEmail,user.userName');
		$this->db->where('user.userId', $id);
 		$this->db->where('user.userTypeId','ut7');
		$this->db->from('user');
		$query = $this->db->get();
		$temp = $query->result_array()[0];
		if(count($temp) > 0)
		return $query->result_array()[0];
	}
	public function get_business_details($bid){
		$this->db->select('business_centers.*');
		$this->db->where('business_centers.business_id', $bid);
		$this->db->from('business_centers');
		$query = $this->db->get();
		$business_centers_data = $query->row_array();
		if(count($business_centers_data) > 0){
			return $business_centers_data;
		}
	}
	public function getconciergecities(){
		$this->db->select('c.*');	
		$query=$this->db->get_where('concierge_cities c',array('deleted' =>'0'));
		return $query->result_array();	
	}
	public function getconciergecity($cityid){
		$this->db->select('c.*');	
		$this->db->from('concierge_cities c');
		$this->db->where(array('cityId' =>$cityid));
		$query=$this->db->get();
		return $query->result_array();	
	}
	public function addconciergecity($data=array()){
        $result = $this->db->insert('concierge_cities', $data); 
        return $result;
	}
	public function isConciergeCityAvailable($city){
		$this->db->select('cityId');
		$this->db->where('name =', $city);
		$this->db->from('concierge_cities');
		$query = $this->db->get();
		$cityId = $query->row_array();
		if(isset($cityId['cityId']) && $cityId['cityId']!=''){
			return 0;
		}else{
			return 1;
		}
	}
	public function get_airlines(){
		$query=$this->db->get_where('airlines',array('deleted'=>0));
		return $query->result_array();

	}
	public function add_airlines($arrlines_data){
		$this->db->insert('airlines',$arrlines_data);
	}
	public function get_airline_byid($id){
		$query=$this->db->get_where('airlines',array('airlinesId'=>$id,'deleted'=>0));
		return $query->result_array();
	}
	public function update_airline($airlinesId,$airline_data){
		$this->db->where('airlinesId',$airlinesId);
		$this->db->update('airlines',$airline_data);
	}
	public function get_cabs(){
		$query=$this->db->get_where('cab',array('deleted'=>0));
		return $query->result_array();
	}
	public function add_cab($cab_data){
		$this->db->insert('cab',$cab_data);
	}
	public function get_cab_byid($id){
		$query=$this->db->get_where('cab',array('cabId'=>$id,'deleted'=>0));
		return $query->result_array();
	}
	public function update_cab($cabId,$cab_data){
		$this->db->where('cabId',$cabId);
		$this->db->update('cab',$cab_data);
	}
	public function get_movie_hall(){
		$query=$this->db->get_where('movie_hall',array('deleted'=>0));
		return $query->result_array();
	}
	public function add_hall_data($hall_data){
		$this->db->insert('movie_hall',$hall_data);
	}
	public function get_hall_byid($id){
		$query=$this->db->get_where('movie_hall',array('hallId'=>$id));
		return $query->result_array();

	}
	public function update_hall($hallId,$hall_data){
		$this->db->where('hallId',$hallId);
		$this->db->update('movie_hall',$hall_data);
	}
	public function get_movie(){
		$this->db->select('movie_hall.name as hallname,movie_hall_data.*');
		$this->db->from('movie_hall_data');
		$this->db->join('movie_hall','movie_hall_data.hallId=movie_hall.hallId');
		$this->db->where('movie_hall_data.deleted','0');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_active_movie_hall(){
		$query=$this->db->get_where('movie_hall',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function add_movie_data($movie_hall_data){
		$this->db->insert('movie_hall_data',$movie_hall_data);
	}
	public function add_movie_data_all($movie_data,$movie_hall_data){
		$this->db->insert('movie',$movie_data);
		$this->db->insert('movie_hall_data',$movie_hall_data);
	}
	public function get_movie_byid($id){
		$query=$this->db->get_where('movie',array('movieId'=>$id,'deleted'=>0));
		return $query->result_array();
	}
	public function get_ext_movie_name($movie_name){
		$query=$this->db->get_where('movie',array('name'=>$movie_name,'deleted'=>'0'));
		return $query->result_array();

	}
	public function get_movie_hall_data_byid($id){
		$query=$this->db->get_where('movie_hall_data',array('Id'=>$id,'deleted'=>'0'));
		return $query->result_array();

	}
	public function update_movie($movieId,$movie_data,$moviehallId,$movie_hall_data,$flin){
		if($flin==0){
    		$this->db->where('movieId',$movieId);
		    $this->db->update('movie',$movie_data);
    	}else{
    		$this->db->insert('movie',$movie_data);
		    
    	}
		
		$this->db->where('Id',$moviehallId);
		$this->db->update('movie_hall_data',$movie_hall_data);
	}
	public function get_movie_hall_data_bymovieid($movieId){
		$query=$this->db->get_where('movie_hall_data',array('movieId'=>$movieId,'deleted'=>0));
		return $query->result_array();
	}
	public function get_resturant_location(){
		$query=$this->db->get_where('resturant_location',array('deleted'=>0));
		return $query->result_array();
	}
	public function add_res_loc_data($res_loc_data){
		$this->db->insert('resturant_location',$res_loc_data);
	}
	public function get_resturant_location_byid($id){
		$query=$this->db->get_where('resturant_location',array('locationId'=>$id));
		return $query->result_array();
	}
	public function update_res_loc($locId,$loc_data){
		$this->db->where('locationId',$locId);
		$this->db->update('resturant_location',$loc_data);
	}
	public function get_resturant(){
		$this->db->select('resturant_location.name as locname,resturant_location_data.*');
		$this->db->from('resturant_location_data');
		$this->db->join('resturant_location','resturant_location_data.locationId=resturant_location.locationId');
		$this->db->where('resturant_location_data.deleted','0');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_resturant_byid($res_id){
		$query=$this->db->get_where('resturant',array('resturantId'=>$res_id,'deleted'=>0));
		return $query->result_array();
	}
	public function get_active_resturant_hall(){
		$query=$this->db->get_where('resturant_location',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function get_ext_res_name($res_name){
		$query=$this->db->get_where('resturant',array('name'=>$res_name,'deleted'=>'0'));
		return $query->result_array();

	}
	public function add_resturant_data($res_loc_data){
		$this->db->insert('resturant_location_data',$res_loc_data);
	}
	public function add_resturant_data_all($res_data,$res_loc_data){
		$this->db->insert('resturant',$res_data);
		$this->db->insert('resturant_location_data',$res_loc_data);
	}
	public function get_resturant_loc_data_byid($id){
		$query=$this->db->get_where('resturant_location_data',array('deleted'=>0,'Id'=>$id));
		return $query->result_array();
	}
    public function update_resturant($resId,$res_data,$reslocId,$res_loc_data,$flin){
    	if($flin==0){
    		$this->db->where('resturantId',$resId);
		    $this->db->update('resturant',$res_data);
    	}else{
    		$this->db->insert('resturant',$res_data);
		    
    	}
    	
		$this->db->where('Id',$reslocId);
		$this->db->update('resturant_location_data',$res_loc_data);
    }
    public function get_resturant_location_data_byid($id){
         $query=$this->db->get_where('resturant_location_data',array('Id'=>$id,'deleted'=>'0'));
		return $query->result_array();
    }
    public function get_resturant_location_data_byresturantid($resId){
    	$query=$this->db->get_where('resturant_location_data',array('resturantId'=>$resId,'deleted'=>'0'));
		return $query->result_array();
    }
    public function get_event(){
    	$query=$this->db->get_where('event',array('deleted'=>0,'status'=>1));
    	return $query->result_array();
    }
    public function add_event_data($event_data){
    	$this->db->insert('event',$event_data);
    }
    public function get_event_byid($id){
    	$query=$this->db->get_where('event',array('eventId'=>$id,'deleted'=>0));
    	return $query->result_array();
    }
    public function update_event_data($eventId,$event_data){
    	$this->db->where('eventId',$eventId);
    	$this->db->update('event',$event_data);
    }
    public function get_event_location(){
    	$query=$this->db->get_where('event_location',array('deleted'=>0));
    	return $query->result_array();
    }
    public function add_event_location_data($event_data){
    	$this->db->insert('event_location',$event_data);
    }
    public function get_event_location_byid($id){
    	$query=$this->db->get_where('event_location',array('locationId'=>$id,'deleted'=>0));
    	return $query->result_array();
    }
    public function update_event_location_data($locationId,$event_data){
    	$this->db->where('locationId',$locationId);
    	$this->db->update('event_location',$event_data);
    }
    public function get_experience(){
    	$query=$query=$this->db->get_where('experience',array('deleted'=>0));
    	return $query->result_array();
    }
    public function add_experience_data($exp_data){
    	$this->db->insert('experience',$exp_data);
    }
    public function get_experience_byid($id){
    	$query=$this->db->get_where('experience',array('experienceId'=>$id,'deleted'=>0));
    	return $query->result_array();
    }
    public function update_experience_data($experienceId,$exp_data){
    	$this->db->where('experienceId',$experienceId);
    	$this->db->update('experience',$exp_data);
    }
    public function get_experience_location(){
    	$query=$this->db->get_where('experience_location',array('deleted'=>0));
    	return $query->result_array();
    }
    public function add_experience_location_data($exp_loc_data){
    	$this->db->insert('experience_location',$exp_loc_data);
    }
    public function get_experience_location_byid($id){
    	$query=$this->db->get_where('experience_location',array('locationId'=>$id,'deleted'=>0));
    	return $query->result_array();
    }
    public function update_experience_location_data($locationId,$exp_loc_data){
    	$this->db->where('locationId',$locationId);
    	$this->db->update('experience_location',$exp_loc_data);
    }
 }
 ?>


