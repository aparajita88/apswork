<?php
class Indirect_client_model extends MY_Model {	
	public function __construct(){
		parent::__construct();
	    $this->load->database(); 
	}
	public function	getbusinessbyuserlocation($city_id,$location_id){
			
		$sql="select business_centers.business_id,business_centers.businessName from business_centers where business_centers.locationId='".$location_id."' AND business_centers.cityId='".$city_id."' AND business_centers.deleted='0'";
		//echo $sql;
		//exit;
		$query=$this->db->query($sql);
	    return $result=$query->result_array();				
	}
	public function get1stconferenceroom($conference_id){
		$sql="select conference_room.*,rooms_images.imageName from conference_room left join rooms_images on rooms_images.room_id=conference_room.conference_id where conference_room.conference_id='".$conference_id."' AND conference_room.deleted='0' AND rooms_images.roomtype='conference'";
		$query=$this->db->query($sql);
		return $result=$query->result_array();				
	}
	public function getconferencebybusiness($business_id){
		$sql="select conference_room.* from conference_room where conference_room.business_id='".$business_id."' AND conference_room.deleted='0'";
		$query=$this->db->query($sql);
		return $result=$query->result_array();				
	}
	public function getmeetingbybusiness($business_id){
		$sql="select meeting_room.* from meeting_room where meeting_room.business_id='".$business_id."' AND meeting_room.deleted='0'";
		$query=$this->db->query($sql);
		return $result=$query->result_array();				
	}
	public function getdayofficebybusiness($business_id){
		$sql="select day_office.* from day_office where day_office.business_id='".$business_id."' AND day_office.deleted='0'";
		$query=$this->db->query($sql);
		return $result=$query->result_array();				
	}
	public function getConferenceData($conf_id){
		$this->db->select('conference_room.*,rooms_images.imageName');
		$this->db->from('conference_room');
		$this->db->join('rooms_images','rooms_images.room_id=conference_room.conference_id');
		$this->db->where('conference_room.conference_id',$conf_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getMeetingData($m_id){
		$this->db->select('meeting_room.*,rooms_images.imageName');
		$this->db->from('meeting_room');
		$this->db->join('rooms_images','rooms_images.room_id=meeting_room.meeting_id');
		$this->db->where('meeting_room.meeting_id',$m_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getDayofficeData($dayoff_id){
		$this->db->select('day_office.*,rooms_images.imageName');
		$this->db->from('day_office');
		$this->db->join('rooms_images','rooms_images.room_id=day_office.dayoffice_id');
		$this->db->where('day_office.dayoffice_id',$dayoff_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function getBookSlots($conf_id){
		$this->db->select('book_conference_room.*');
		$this->db->from('book_conference_room');
		$this->db->where('book_conference_room.is_approved',1);
		$this->db->where('book_conference_room.conference_room_id',$conf_id);
		$query=$this->db->get();
		$booked = array();
		foreach($query->result_array() as $var){
			$returnValue = json_decode($var['booking_details'], true);
			$booked[] = $returnValue;
		}
		return $booked;
	}
	public function getBookSlotsMeeting($m_id){
		$this->db->select('book_meeting_room.*');
		$this->db->from('book_meeting_room');
		$this->db->where('book_meeting_room.is_approved',1);
		$this->db->where('book_meeting_room.meeting_room_id',$m_id);
		$query=$this->db->get();
		$booked = array();
		foreach($query->result_array() as $var){
			$returnValue = json_decode($var['booking_details'], true);
			$booked[] = $returnValue;
		}
		return $booked;
	}
	public function getBookSlotsDayOffice($df_id){
		$this->db->select('book_dayoffice.*');
		$this->db->from('book_dayoffice');
		$this->db->where('book_dayoffice.is_approved',1);
		$this->db->where('book_dayoffice.dayoffice_id',$df_id);
		$query=$this->db->get();
		$booked = array();
		foreach($query->result_array() as $var){
			$returnValue = json_decode($var['booking_details'], true);
			$booked[] = $returnValue;
		}
		return $booked;
	}
	public function setReqBooking($dt){
		if(!empty($dt)){
			$this->db->insert('book_conference_room',$dt);
			return true;
		}else{
			return false;
		}	
	}
	public function setReqBookingMeeting($dt){
		if(!empty($dt)){
			$this->db->insert('book_meeting_room',$dt);
			return true;
		}else{
			return false;
		}	
	}
	public function setReqBookingDayoffice($dt){
		if(!empty($dt)){
			$this->db->insert('book_dayoffice',$dt);
			return true;
		}else{
			return false;
		}	
	}
	public function setReqBookingLocker($dt){
		if(!empty($dt)){
			$this->db->insert('book_locker_room',$dt);
			return true;
		}else{
			return false;
		}	
	}
	public function setReqBookingGame($dt){
		if(!empty($dt)){
			$this->db->insert('book_game_room',$dt);
			return true;
		}else{
			return false;
		}	
	}
	public function get1stlockerroom($locker_id){
		$sql="select locker_room.*,rooms_images.imageName from locker_room left join rooms_images on rooms_images.room_id=locker_room.locker_id where locker_room.locker_id='".$locker_id."' AND locker_room.deleted='0' AND rooms_images.roomtype='locker'";
		$query=$this->db->query($sql);
	    return $result=$query->result_array();			
	}
	public function getlockerbybusiness($business_id){
		$sql="select locker_room.* from locker_room where locker_room.business_id='".$business_id."' AND locker_room.deleted='0'";
		$query=$this->db->query($sql);
	    return $result=$query->result_array();			
	}
	public function get1stgameroom($game_id){
		$sql="select game_room.*,rooms_images.imageName from game_room left join rooms_images on rooms_images.room_id=game_room.game_id where game_room.game_id='".$game_id."' AND game_room.deleted='0' AND rooms_images.roomtype='game'";
		$query=$this->db->query($sql);
	    return $result=$query->result_array();			
	}
	public function getgamebybusiness($business_id){
		$sql="select game_room.* from game_room where game_room.business_id='".$business_id."' AND game_room.deleted='0'";
		$query=$this->db->query($sql);
	    return $result=$query->result_array();			
	}
	public function getgame_type_name($value){
		$sql="select game_types.* from game_types where game_types.id='".$value."'";
		$query=$this->db->query($sql);
	    return $result=$query->result_array();	
	}
	public function get_client_event($uid){
		$today=date('Y-m-d');
		$this->db->select('client_event.*,FirstName,LastName,phone');
		$this->db->from('client_event');
		$this->db->join('user','client_event.createdby=user.userId');
		$this->db->where('client_event.createdby',$uid);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function put_client_event($data){
		if(!empty($data)){
			$this->db->insert('client_event',$data);
			return true;
		}else{
			return false;
		}	
	}
	public function upd_client_event($data,$event_id){
		if(!empty($data)){
			$this->db->where('event_id',$event_id);
			$this->db->update('client_event',$data);
			return true;
		}else{
			return false;
		}	
	}
	public function get_client_event_byeventid($evntid){	
		$this->db->select('client_event.*');
		$this->db->from('client_event');
		$this->db->where('event_id',$evntid);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_todo($client_id){
		$this->db->select('todo.*');
		$this->db->from('todo');
		$this->db->where('DATE(todo.dateAdded) = DATE(NOW())');
		$this->db->where('todo.createdby',$client_id);
		$this->db->order_by("todo.dateAdded",'desc');
		$query=$this->db->get();
		if(!empty($query->result_array())){
			return $query->result_array();
		}else{
			return false;	
		}
	}
	public function set_todo($uid,$msg){
		$data=array(
	        'id'=>substr(create_guid(),0,16),
			'message'=>$msg,
	        'dateAdded'=>date('Y-m-d h:i:s'),
	        'createdby'=>$uid,
	    );
		$this->db->insert('todo',$data);
		return ($this->db->affected_rows() > 0) ? true : false;
	}
	public function upd_todo($todoid,$msg){
		$data=array(
		'message'=>$msg,
		'dateModified'=>date('Y-m-d h:i:s')
		);
		$this->db->where('id',$todoid);
		$this->db->update('todo',$data);
		return ($this->db->affected_rows() > 0) ? true : false; 
	}
	public function get_invoice_by_comid($comid){
		$query=$this->db->get_where('invoices',array('customerId'=>$comid,'status'=>0));
		return $query->result_array();	
	}
	/* added for new booking request process start here*/
	public function process_request($invoice_id,$invoice_data,$invoice_item_data){
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices',$invoice_data);
		$this->db->insert('invoice_items',$invoice_item_data);
	}
	public function process_request_online($inputArray_payment,$invoice_item_data){
		$this->db->insert('payment',$inputArray_payment);
		$this->db->insert('invoice_items',$invoice_item_data);
	}
}
