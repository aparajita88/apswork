<?php

class booking_info extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
    public function seat_alloc_of_manager($book_floor_plan_data){
		$this->db->insert('book_floor_plan',$book_floor_plan_data);
	}
	public function get_book_floor_plan_byid($book_floor_id){
		$query=$this->db->get_where('book_floor_plan',array('id'=>$book_floor_id));
		return $query->result_array();
	}
	public function get_seat_booking_info(){
		
		$this->db->select('book_floor_plan.*,floor_plan.description,business_centers.businessName,cities.name as city,locations.name as location');
		$this->db->from('book_floor_plan');
		$this->db->join('floor_plan','book_floor_plan.floor_plan_id=floor_plan.floor_id');
		$this->db->join('business_centers','floor_plan.business_id=business_centers.business_id');
		$this->db->join('cities','cities.cityId=floor_plan.city_id');
		$this->db->join('locations','locations.locationId=floor_plan.location_id');
		$this->db->where('book_for',$this->session->userdata("userId"));
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_seat_title($seatid){
		$query=$this->db->get_where('floor_plan_seats',array('seat_id'=>$seatid));
		return $query->result_array();
		
	}
	public function get_booking_seat_info($seatid,$start_date,$end_date){
		$sql="select * from book_floor_plan where IsApproved='1' and booking_detailes like '%".$seatid."%' and ((start_date between '".date('Y-m-d',strtotime($start_date))."' and '".date('Y-m-d',strtotime($end_date))."') or (end_date between '".date('Y-m-d',strtotime($start_date))."' and '".date('Y-m-d',strtotime($end_date))."'))";
		$query=$this->db->query($sql); 
		return $query->result_array();
	}
	public function get_booking_seat_info_bydate($start_date,$end_date){
		$sql="select * from book_floor_plan left join user on book_floor_plan.book_for_client=user.userId where IsApproved='1' and ((start_date between '".date('Y-m-d',strtotime($start_date))."' and '".date('Y-m-d',strtotime($end_date))."') or (end_date between '".date('Y-m-d',strtotime($start_date))."' and '".date('Y-m-d',strtotime($end_date))."'))";
		$query=$this->db->query($sql); 
		return $query->result_array();
	}
	public function check_email_for_client($eml){
		$query=$this->db->get_where('user',array('userTypeId'=>'ut4','userEmail'=>$eml));
		return $query->result_array();
	}
	public function chk_company($company_name){
		$query=$this->db->get_where('company',array('company_name'=>$company_name));
		return $query->result_array();	
	}
	public function get_book_info_byid($seatrequestid){
		$query=$this->db->get_where('book_floor_plan',array('id'=>$seatrequestid));
		return $query->result_array();
	}
	public function get_location_email($location_id){
	    $sql="select locations.*,cities.cityId,cities.name as c_name from locations left join cities on locations.cityId=cities.cityId where locations.locationId='".$location_id."' ";
	$query=$this->db->query($sql);

 
 return $query->result_array();	
		
		
	}
	public function add_company($company_data){
		$this->db->insert('company',$company_data);
		
	}
	public function update_client_info($update_client_info,$userid){
		$this->db->where('userId',$userid);
		$this->db->update('user',$update_client_info);
	}
	public function add_client($client_info){
		$this->db->insert('user',$client_info);
	}
	public function approval_seat_book($book_floor_plan_data,$requestid,$invoice_id,$invoice_data,$invoice_item_data){
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices',$invoice_data);
		$this->db->insert('invoice_items',$invoice_item_data);
		$this->db->where('id',$requestid);
		$this->db->update('book_floor_plan',$book_floor_plan_data);
	}
	public function rejectseatrequest($reject_data,$seatid){
		$this->db->where('id',$seatid);
		$this->db->update('book_floor_plan',$reject_data);
	}
	public function get_booking_details_for_conference_room($legal_data){
		$this->db->select('book_conference_room.*,conference_room.name as conference_room,cities.name as cites,locations.name as location,company.company_name,user.FirstName,user.LastName');
		$this->db->from('book_conference_room');
		$this->db->join('conference_room','conference_room.conference_id=book_conference_room.conference_room_id');
		$this->db->join('user','user.userId=book_conference_room.addedBy');
		$this->db->join('company','company.id=book_conference_room.company_id');
		$this->db->join('cities','cities.cityId=conference_room.city');
	    $this->db->join('locations','locations.locationId=conference_room.location');
		$this->db->where('conference_room.location',$legal_data['location']);
		$this->db->where('conference_room.city',$legal_data['city']);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	public function get_booking_info($tbname,$legal_data){
		
		if($tbname=="conference_room"){
			$tb1="book_conference_room";
			$tb2="conference_room";
			$fld1="conference_room_id";
			$fld2="conference_id";
		}
		else if($tbname=="meeting_room"){
			$tb1="book_meeting_room";
			$tb2="meeting_room";
			$fld1="meeting_room_id";
			$fld2="meeting_id";
			
		}
		else if($tbname=="locker_room"){
			$tb1="book_locker_room";
			$tb2="locker_room";
			$fld1="locker_room_id";
			$fld2="locker_id";
			
		}
		
		$this->db->select(''.$tb1.'.*,'.$tb2.'.name as conference_room,cities.name as cites,locations.name as location,company.company_name,user.FirstName,user.LastName');
		$this->db->from(''.$tb1.'');
		$this->db->join(''.$tb2.'',''.$tb2.'.'.$fld2.'='.$tb1.'.'.$fld1.'');
		$this->db->join('user','user.userId='.$tb1.'.addedBy');
		$this->db->join('company','company.id='.$tb1.'.company_id');
		$this->db->join('cities','cities.cityId='.$tb2.'.city');
	    $this->db->join('locations','locations.locationId='.$tb2.'.location');
		$this->db->where(''.$tb2.'.location',$legal_data['location']);
		$this->db->where(''.$tb2.'.city',$legal_data['city']);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	public function get_booking_info_forgameroom($tbname,$legal_data){
		$this->db->select('book_game_room.*,game_room.name as room_name,cities.name as cites,locations.name as location,company.company_name,user.FirstName,user.LastName');
		$this->db->from('book_game_room');
		$this->db->join('game_room','book_game_room.game_room_id=game_room.game_id');
		$this->db->join('user','user.userId=game_room.addedBy');
		$this->db->join('company','company.id=book_game_room.company_id');
		$this->db->join('cities','cities.cityId=game_room.city');
	    $this->db->join('locations','locations.locationId=game_room.location');
		$this->db->where('game_room.location',$legal_data['location']);
		$this->db->where('game_room.city',$legal_data['city']);
		$query=$this->db->get();
		return $query->result_array();
		
	}
	public function get_booking_view_byid($legal_data,$appid,$tbname){
		if($tbname=="conference_room"){
			$tb1="book_conference_room";
			$tb2="conference_room";
			$fld1="conference_room_id";
			$fld2="conference_id";
		}
		else if($tbname=="meeting_room"){
			$tb1="book_meeting_room";
			$tb2="meeting_room";
			$fld1="meeting_room_id";
			$fld2="meeting_id";
			
		}
		else if($tbname=="locker_room"){
			$tb1="book_locker_room";
			$tb2="locker_room";
			$fld1="locker_room_id";
			$fld2="locker_id";
			
		}
		else if($tbname=="game_room"){
			$tb1="book_play_room";
			$tb2="game_room";
			$fld1="play_room_id";
			$fld2="game_id";
		}
		
		$this->db->select(''.$tb1.'.*,'.$tb2.'.name as conference_room,cities.name as cites,locations.name as location,company.company_name,user.FirstName,user.LastName');
		$this->db->from(''.$tb1.'');
		$this->db->join(''.$tb2.'',''.$tb2.'.'.$fld2.'='.$tb1.'.'.$fld1.'');
		$this->db->join('user','user.userId='.$tb1.'.addedBy');
		$this->db->join('company','company.id='.$tb1.'.company_id');
		$this->db->join('cities','cities.cityId='.$tb2.'.city');
	    $this->db->join('locations','locations.locationId='.$tb2.'.location');
		$this->db->where(''.$tb2.'.location',$legal_data['location']);
		$this->db->where(''.$tb2.'.city',$legal_data['city']);
		$this->db->where(''.$tb1.'.id',$appid);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function set_approved_booking($appdata,$appid,$invoice_id,$invoice_data,$invoice_item_data,$tbname){
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices',$invoice_data);
		$this->db->insert('invoice_items',$invoice_item_data);
		if($tbname=="conference_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_conference_room',$appdata);
		}else if($tbname=="meeting_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_meeting_room',$appdata);
		}else if($tbname=="locker_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_locker_room',$appdata);
		}else if($tbname=="game_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_play_room',$appdata);
		}
	}
	public function set_reject_booking($appdata,$appid,$tbname){
		if($tbname=="conference_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_conference_room',$appdata);
		}else if($tbname=="meeting_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_meeting_room',$appdata);
		}else if($tbname=="locker_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_locker_room',$appdata);
		}else if($tbname=="game_room"){
			$this->db->where('id',$appid);
			$this->db->update('book_play_room',$appdata);
		}
		
	}
	public function add_invoice($invoice_insert_data){
		$this->db->insert('invoices',$invoice_insert_data);
		
	}
	public function eml_autocomplete($eml,$usertype){
		if($usertype=='register'){
			$this->db->select('registered_user.userEmail,registered_user.FirstName,registered_user.LastName,need_analysis.company_name');
		    $this->db->from('registered_user');
		    $this->db->join('need_analysis','registered_user.userId=need_analysis.registered_user_id');
		    $this->db->where('deleted', 0);
            $this->db->where("(`userEmail` LIKE '$eml%'");
            $this->db->or_where("`FirstName` LIKE '$eml%'");
            $this->db->or_where("`LastName` LIKE '$eml%')");

            $query=$this->db->get();
            return $query->result();
		}else if($usertype=='user'){
			$this->db->select('userEmail,FirstName,LastName');
		    $this->db->from('user');
		    $this->db->where('userTypeId', 'ut4');
            $this->db->where("(`userEmail` LIKE '$eml%'");
            $this->db->or_where("`FirstName` LIKE '$eml%'");
            $this->db->or_where("`LastName` LIKE '$eml%')");
            $query=$this->db->get();
            return $query->result();
		}
		
	}
	public function display_user_data($eml,$usertype){
		if($usertype=='register'){
			//$query=$this->db->get_where('registered_user',array('userEmail'=>$eml,'deleted'=>0));
		    //return $query->result_array();
		    $this->db->select('registered_user.*,need_analysis.company_name,need_analysis.address');
			$this->db->from('registered_user');
			$this->db->join('need_analysis','registered_user.userId=need_analysis.registered_user_id');
			$this->db->where('userEmail',$eml);
			$query=$this->db->get();
		    return $query->result_array();
		}else if($usertype=='user'){
			$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','user.company_id=company.id');
			$this->db->where('userEmail',$eml);
			$query=$this->db->get();
		    return $query->result_array();
		}
		
	}
	public function get_business_center_info($floor_plan_id){
		$this->db->select('floor_plan.*,business_centers.address');
		$this->db->from('floor_plan');
		$this->db->join('business_centers','floor_plan.business_id=business_centers.business_id');
		$this->db->where('floor_plan.floor_id',$floor_plan_id);
		$query=$this->db->get();
		return $query->result_array();
	}
    public function add_agreement_data($agrement_data,$book_floor_plan_data){
         $this->db->insert('private_office_agreement',$agrement_data);
         $this->db->where('id',$agrement_data['book_floor_plan_id']);
         $this->db->update('book_floor_plan',$book_floor_plan_data);
    }
    public function get_private_office_info($business_id){
    	$query=$this->db->get_where('private_office',array('business_id'=>$business_id));
    	return $query->result_array();
    }
    public function clntinfo($book_for_client,$company){
    	if($company==1){
    		$this->db->select('*');
    		$this->db->from('user');
    		$this->db->join('company','user.company_id=company.id');
    		$this->db->where('user.userId',$book_for_client);
    		$query=$this->db->get();
            return $query->result_array();

    	}else if($company==0){
    		$this->db->select('*');
    		$this->db->from('registered_user');
    		$this->db->join('need_analysis','registered_user.userId=need_analysis.registered_user_id');
    		$this->db->where('registered_user.userId',$book_for_client);
    		$query=$this->db->get();
            return $query->result_array();
    	}
    }

	}
