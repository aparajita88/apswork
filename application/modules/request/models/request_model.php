<?php
class Request_model extends MY_Model {
	
    public function __construct(){
		parent::__construct();
		
        $this->load->database(); 
	}
public function	getrequest($userId){
$sql = "select request_courier_service.*,courier_types.name,locations.name as l_name,cities.name as c_name from  request_courier_service LEFT JOIN courier_types on courier_types.id=request_courier_service.courier_type LEFT JOIN locations ON  request_courier_service.location_id= locations.locationId left join cities on  request_courier_service.city_id=cities.cityId WHERE  request_courier_service.deleted='0' AND request_courier_service.requested_by='".$userId."' ";
    $query=$this->db->query($sql);
    return $result=$query->result_array();			
	
}
public function getchoiceofcourier(){
	
	$sql="select courier_types.id,courier_types.name from courier_types where courier_types.deleted='0'";
	$query=$this->db->query($sql);
    return $result=$query->result_array();	
}	
	public function get_conceirge_type(){
	$sql="select concierge_types.id,concierge_types.name from concierge_types where concierge_types.deleted='0'";
	$query=$this->db->query($sql);
    return $result=$query->result_array();		
		
	}
	public function get_smart_concierge_city(){
		$query=$this->db->get_where('concierge_cities',array('deleted'=>'0','status'=>'1'));
		return $query->result_array();
	}
	public function get_smart_airline(){
		$query=$this->db->get_where('airlines',array('deleted'=>'0','status'=>'1'));
		return $query->result_array();
	}
	public function get_smart_cab(){
		$query=$this->db->get_where('cab',array('deleted'=>'0','status'=>'1'));
		return $query->result_array();
	}
	public function add_request_for_smartcocierge($travel_data,$table){
		$this->db->insert($table,$travel_data);
	}
	public function get_all_movie(){
		$query=$this->db->get_where('movie',array('deleted'=>0,'status'=>'1'));
		return $query->result_array();
	}
	public function get_movie_hall_by_movieid($movieId){
		$this->db->select('movie_hall_data.*,movie_hall.name as hollname,movie_hall.hallId as hid,movie_hall.location as lc');
		$this->db->from('movie_hall_data');
		$this->db->join('movie_hall','movie_hall_data.hallId=movie_hall.hallId');
		$this->db->where('movie_hall_data.movieId',$movieId);
		 $query=$this->db->get();
		 return $query->result_array();
	}
	public function add_bookingrequest_for_smartcocierge($booking_data,$table){
		$this->db->insert($table,$booking_data);
	}
	public function get_all_location(){
		$query=$this->db->get_where('resturant_location',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function get_all_location_of_resturant($locationId){
		
		$this->db->select('resturant_location_data.*,resturant.name as recname,resturant.resturantId as recid');
		$this->db->from('resturant_location_data');
		$this->db->join('resturant','resturant_location_data.resturantId=resturant.resturantId');
		$this->db->where('resturant_location_data.locationId',$locationId);
		 $query=$this->db->get();
		 return $query->result_array();
	}
	public function get_all_active_event(){
		$query=$this->db->get_where('event',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function get_all_active_event_location(){
		$query=$this->db->get_where('event_location',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function get_all_active_experience(){
		$query=$this->db->get_where('experience',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function get_all_active_experience_location(){
		$query=$this->db->get_where('experience_location',array('deleted'=>0,'status'=>1));
		return $query->result_array();
	}
	public function get_requestByrequestid($id){
	$query=$this->db->get_where('requests',array('id'=>$id));
	return $query->result_array();	
	}
	public function get_request_List(){
	$this->db->select('requests.*');
	$this->db->from('requests');
	$query=$this->db->get();
	return $query->result_array();	
	}
	public function get_all_client_info(){
		$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut4 = $query->result_array();	
	        $this->db->select('user.*');
			$this->db->from('user');
			$this->db->where("user.userTypeId = 'ut11'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut11_temp = $query->result_array();
	        $temp_ut11 = array();
	        foreach ($temp_ut11_temp as $key => $value) {
	        	$temp_ut11[] = $value;
	        	$temp_ut11[$key]['company_name'] = 'Individual'; 
	        }
	        return array_merge($temp_ut4,$temp_ut11);

	}
	public function get_price_for_courier($courier_type,$priority){
		if($priority=='Priority'){
			$this->db->select('priority_price');
			$this->db->from('courier_types');
			$this->db->where('id',$courier_type);
			$query=$this->db->get();
			return $query->result_array();
    	}
    	else if($priority=='Normal'){
    		$this->db->select('normal_price');
    		$this->db->from('courier_types');
    		$this->db->where('id',$courier_type);
    		$query=$this->db->get();
    		return $query->result_array();
    	}
	}
	public function add_courier_service_data($data){
        
		$this->db->insert('request_courier_service',$data);
		
	}
}



