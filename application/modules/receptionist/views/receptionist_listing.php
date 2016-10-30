<?php

class receptionist_listing extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
   public function  approve_primary($data,$val){
   	$this->db->where('userId',$val);
    $result =$this->db->update('user',$data);
    return $result;
   }
   public function getcompanies_foradd_contact(){
    $query=$this->db->get_where('company',array('status'=>'1'));
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
		$this->db->select("user.*,company.company_name");
		$this->db->from('user');
		$this->db->join('company','user.company_id=company.id');
		$this->db->where('user.location_id',$this->session->userdata('location_id'));
		$this->db->where('user.city_id',$this->session->userdata('city_id'));
		$this->db->where('user.status','1');
		$this->db->where('user.userTypeId','ut4');
		$query=$this->db->get();
		return $query->result_array();
		
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
			$this->db->select('*');
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
			$this->db->select('*');
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
		if($data['bookingtype']=='Locker Room'){
			$this->db->select('*');
            $this->db->from('locker_room');
            $this->db->join('book_locker_room','locker_room.locker_id=book_locker_room.locker_room_id');
            $this->db->join('user','book_locker_room.book_for=user.userId');
            $this->db->join('company','company.id=book_locker_room.company_id','right');
            $this->db->where('locker_room.locker_id',$data['bookingid']);
            $this->db->where("book_locker_room.booking_details like '%".$data['bookingdate']."%'");
            $this->db->group_by('book_locker_room.id');
            $query=$this->db->get();
            return $query->result_array();
		}
	}

}
?>
