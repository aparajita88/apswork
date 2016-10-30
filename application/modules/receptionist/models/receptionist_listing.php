<?php

class receptionist_listing extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
    public function getuser($id){
    $query=$this->db->get_where('user',array('userId'=>$id));
    return $query->result_array();    
    }
   public function  approve_primary($data,$val){
   	$this->db->where('userId',$val);
    $result =$this->db->update('user',$data);
    return $result;
   }
   public function getcompanies_foradd_contact(){
    $this->db->select('user.*,company.company_name,company.id');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	         return $query->result_array();
   }
  public function getindividual(){
    $this->db->select("user.*");
    $this->db->from('user');
    $this->db->where('user.userTypeId','ut11');
    $query=$this->db->get();
    return $query->result_array(); 
  }
    public function get_client_bycompany($id){
    $this->db->select("user.*");
    $this->db->from('user');
    $this->db->join('company','user.company_id=company.id');
    $this->db->where('company.id',$id);
    $this->db->where('user.userTypeId','ut4');
    $query=$this->db->get();
    return $query->result_array();
    }
    public function approve_client_status($data,$val){
    $this->db->where('userId',$val);
    $result =$this->db->update('user',$data);
    return $result;
    }
    public function get_existing_client(){
		$this->db->select("user.*,company.company_name,locations.name as l_name,cities.name as c_name");
		$this->db->from('user');
		$this->db->join('company','user.company_id=company.id');
        $this->db->join('locations', 'locations.locationId=user.location_id', 'left');
        $this->db->join('cities', 'cities.cityId=user.city_id', 'left');
		$this->db->where('user.location_id',$this->session->userdata('location_id'));
		$this->db->where('user.city_id',$this->session->userdata('city_id'));
		$this->db->where('user.status','1');
		$this->db->where('user.userTypeId','ut4');
		$query=$this->db->get();
		return $query->result_array();
		
	}
    public function get_client_list(){

    }
    public function visitor_added($data){
		$this->db->insert('visitors',$data);
	}
    public function get_existing_visitor_forclient(){
		$this->db->select("visitors.*,user.FirstName,user.LastName,company.company_name");
		$this->db->from('visitors');
		$this->db->join('user','user.userId=visitors.client_id');
		$this->db->join('company','user.company_id=company.id');
		$this->db->where('visitors.addedBy',$this->session->userdata("userId"));
		$this->db->where('visitors.deleted','0');
		$query=$this->db->get();
		return $query->result_array();
	} 
    public function get_existing_visitor_byid($visitorid){
		$query=$this->db->get_where('visitors',array('id'=>$visitorid,'deleted'=>'0'));
		return $query->result_array();
	}
	public function visitor_edited($data,$vid){
		$this->db->where('id',$vid);
		$this->db->update('visitors',$data);
	}
	public function visitor_deleted($visitorid){
		$this->db->where('id',$visitorid);
		$this->db->delete('visitors');
	}
	public function get_bookdata_bydate($data){
		if($data['bookingtype']=='Conference Room'){
			$this->db->select('conference_room.*,book_conference_room.*,user.FirstName,user.LastName,company.company_name');
            $this->db->from('conference_room');
            $this->db->join('book_conference_room','conference_room.conference_id=book_conference_room.conference_room_id');
            $this->db->join('user','book_conference_room.book_for=user.userId');
            $this->db->join('company','company.id=book_conference_room.company_id','right');
            $this->db->where('conference_room.conference_id',$data['bookingid']);
            $this->db->where("book_conference_room.booking_details like '%".$data['bookingdate']."%'");
            $this->db->group_by('book_conference_room.id');
            $query=$this->db->get();
            return $query->result_array();

		}
		if($data['bookingtype']=='Meeting Room'){
			$this->db->select('meeting_room.*,book_meeting_room.*,user.FirstName,user.LastName,company.company_name');
            $this->db->from('meeting_room');
            $this->db->join('book_meeting_room','meeting_room.meeting_id=book_meeting_room.meeting_room_id');
            $this->db->join('user','book_meeting_room.book_for=user.userId');
            $this->db->join('company','company.id=book_meeting_room.company_id','right');
            $this->db->where('meeting_room.meeting_id',$data['bookingid']);
            $this->db->where("book_meeting_room.booking_details like '%".$data['bookingdate']."%'");
            $this->db->group_by('book_meeting_room.id');
            $query=$this->db->get();
            return $query->result_array();
		}
		if($data['bookingtype']=='Day office'){
			$this->db->select('day_office.*,book_dayoffice.*,user.FirstName,user.LastName,company.company_name');
            $this->db->from('day_office');
            $this->db->join('book_dayoffice','day_office.dayoffice_id=book_dayoffice.dayoffice_id');
            $this->db->join('user','book_dayoffice.book_for=user.userId');
            $this->db->join('company','company.id=book_dayoffice.company_id','right');
            $this->db->where('day_office.dayoffice_id',$data['bookingid']);
            $this->db->where("book_dayoffice.booking_details like '%".$data['bookingdate']."%'");
            $this->db->group_by('book_dayoffice.id');
            $query=$this->db->get();
            return $query->result_array();
		}
        
	}
    public function check_room($check_data){
        if($check_data['status']==1){
           $this->db->insert('checkin_checkout_book_room',$check_data);
        }else{
            $check_update_data=array(
                'status'=>2,
                'check_out'=>date('Y-m-d h:i:s')
                );
            $this->db->where('booking_id',$check_data['booking_id']);
            $this->db->where('start_time',$check_data['start_time']);
            $this->db->where('end_time',$check_data['end_time']);
            $this->db->where('booking_date',$check_data['booking_date']);
            $this->db->update('checkin_checkout_book_room',$check_update_data);
        }
        
    }
    public function get_check_info_byid($bkid){
        $query=$this->db->get_where('checkin_checkout_book_room',array('booking_id'=>$bkid));
        return $query->result_array();

    }
    public function get_checkinstatus_forbooking($checkstatus){
        $query=$this->db->get_where('checkin_checkout_book_room',array('booking_id'=>$checkstatus['booking_id'],'start_time'=>$checkstatus['start_time'],'end_time'=>$checkstatus['end_time'],'booking_date'=>$checkstatus['booking_date']));
        return $query->result_array();
    }
}
?>
