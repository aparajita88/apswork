<?php
class Owner_model extends MY_Model {
	
    public function __construct(){
		
     
		parent::__construct();
		
        $this->load->database(); 
	}
	public function get_customers($start_date,$end_date,$city,$location){
		$main_array = array();
		$stack = array();
		$this->db->select("user.*,locations.name as l_name,cities.name as c_name,user.address,company.company_name");
		$this->db->from('user');
		$this->db->join('locations','locations.locationId=user.location_id');
		$this->db->join('cities','cities.cityId=user.city_id');
		$this->db->join('company','company.id=user.company_id');
		$this->db->where_in('user.userTypeId', 'ut4');
		$this->db->where('user.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
		$this->db->where('user.city_id',$city);
		$this->db->where('user.location_id',$location);
		$query=$this->db->get();
		if(count($query->result_array())>0){
		    $res=$query->result_array();
		    foreach ($res as $key => $value) {
		    	$main_array[] = $value;
			 	$this->db->select("book_meeting_room.meeting_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_meeting_room');
				$this->db->where('book_meeting_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'MR';
				}

				$this->db->select("book_conference_room.conference_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_conference_room');
				$this->db->where('book_conference_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'CR';	
				}

				$this->db->select("book_dayoffice.dayoffice_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_dayoffice');
				$this->db->where('book_dayoffice.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'DO';	
				}
				$this->db->select("book_game_room.game_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_game_room');
				$this->db->where('book_game_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'GR';	
				}
				$this->db->select("book_locker_room.locker_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_locker_room');
				$this->db->where('book_locker_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'LR';	
				}
				$this->db->select("booking_virtual_office.id");
			  	$this->db->group_by('booked_for'); 
				$this->db->from('booking_virtual_office');
				$this->db->where('booking_virtual_office.booked_for',$value['userId']);
				$this->db->where('booking_virtual_office.isApproved',1);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'VO';	
				}	
				$this->db->select("book_floor_plan.id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_floor_plan');
				$this->db->where('book_floor_plan.book_for',$value['userId']);
				$this->db->where('book_floor_plan.isApproved',1);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'PO';	
				}		
			}
			return $main_array;
		}
	}
	public function get_customers_individual($start_date,$end_date,$city,$location){
	$main_array = array();
	$stack = array();
	$this->db->select("user.*,locations.name as l_name,cities.name as c_name,user.address");
	$this->db->from('user');
	$this->db->join('locations','locations.locationId=user.location_id');
	$this->db->join('cities','cities.cityId=user.city_id');
	$this->db->where_in('user.userTypeId', 'ut11');
	$this->db->where('user.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
	$this->db->where('user.city_id',$city);
	$this->db->where('user.location_id',$location);
	$query=$this->db->get();
	if(count($query->result_array())>0){
		    $res=$query->result_array();
		    foreach ($res as $key => $value) {
		    	$main_array[] = $value;
			 	$this->db->select("book_meeting_room.meeting_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_meeting_room');
				$this->db->where('book_meeting_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'MR';
				}

				$this->db->select("book_conference_room.conference_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_conference_room');
				$this->db->where('book_conference_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'CR';	
				}

				$this->db->select("book_dayoffice.dayoffice_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_dayoffice');
				$this->db->where('book_dayoffice.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'DO';	
				}
				$this->db->select("book_game_room.game_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_game_room');
				$this->db->where('book_game_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'GR';	
				}
				$this->db->select("book_locker_room.locker_room_id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_locker_room');
				$this->db->where('book_locker_room.book_for',$value['userId']);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'LR';	
				}
				$this->db->select("booking_virtual_office.id");
			  	$this->db->group_by('booked_for'); 
				$this->db->from('booking_virtual_office');
				$this->db->where('booking_virtual_office.booked_for',$value['userId']);
				$this->db->where('booking_virtual_office.isApproved',1);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'VO';	
				}	
				$this->db->select("book_floor_plan.id");
			  	$this->db->group_by('book_for'); 
				$this->db->from('book_floor_plan');
				$this->db->where('book_floor_plan.book_for',$value['userId']);
				$this->db->where('book_floor_plan.isApproved',1);
				$query=$this->db->get();
				if ($query->num_rows() > 0) {
					$main_array[$key]['types'][] = 'PO';	
				}		
			}
			return $main_array;
		}
	}
	public function enquiery($start_date,$end_date){
	$ignore = array('private-office','virtual-office','leasing');
    $this->db->select("registered_user.*");
	$this->db->from('registered_user');
	$this->db->where_not_in('registered_user.product', $ignore);
	$this->db->where('registered_user.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
	$query=$this->db->get();
	return $query->num_rows();

	}
public function total_revenue($business,$start_date,$end_date){
	$total_sum = 0;
	$main_array = array();
	$sum=0;
	$this->db->select("meeting_room.meeting_id");
	$this->db->from('meeting_room');
	$this->db->where('meeting_room.business_id',$business);
	$query=$this->db->get();
	if(count($query->result_array())>0){
		$res=$query->result_array();
		$sub_array = array();
		foreach ($res as $key => $value) {
                $this->db->select("book_meeting_room.meeting_room_id,book_meeting_room.booking_details,book_meeting_room.price");
				$this->db->from('book_meeting_room');
				$this->db->where('book_meeting_room.meeting_room_id',$value['meeting_id']);
				$this->db->where('book_meeting_room.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
				$query=$this->db->get();
				$temp = $query->result_array();
				if (!empty($temp) && count($temp) > 0) {
					foreach ($temp as $key => $value) {
						$sum = $sum + $value['price'];
					}
				}
		}
		$total_sum = $total_sum + $sum; 
		$main_array['rooms'][] = array('MR'=>$sum);
	}
	$sum=0;
    $this->db->select("conference_room.conference_id");
	$this->db->from('conference_room');
	$this->db->where('conference_room.business_id',$business);
	$query=$this->db->get();
	if(count($query->result_array())>0){
		$res=$query->result_array();
		$sub_array = array();
		foreach ($res as $key => $value) {
                $this->db->select("book_conference_room.conference_room_id,book_conference_room.booking_details,book_conference_room.price");
				$this->db->from('book_conference_room');
				$this->db->where('book_conference_room.conference_room_id',$value['conference_id']);
				$this->db->where('book_conference_room.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
				$query=$this->db->get();
				$temp = $query->result_array();
				if (!empty($temp) && count($temp) > 0) {
					foreach ($temp as $key => $value) {
						$sum = $sum + $value['price'];
					}
				}
		}
		$total_sum = $total_sum + $sum; 
		$main_array['rooms'][]= array('CR'=>$sum);
	}
	$sum=0;
    $this->db->select("day_office.dayoffice_id");
	$this->db->from('day_office');
	$this->db->where('day_office.business_id',$business);
	$query=$this->db->get();
	if(count($query->result_array())>0){
		$res=$query->result_array();
		$sub_array = array();
		foreach ($res as $key => $value) {
                $this->db->select("book_dayoffice.dayoffice_id,book_dayoffice.booking_details,book_dayoffice.price");
				$this->db->from('book_dayoffice');
				$this->db->where('book_dayoffice.dayoffice_id',$value['dayoffice_id']);
				$this->db->where('book_dayoffice.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
				$query=$this->db->get();
				$temp = $query->result_array();
				if (!empty($temp) && count($temp) > 0) {
					foreach ($temp as $key => $value) {
						$sum = $sum + $value['price'];
					}
				}
		}
		$total_sum = $total_sum + $sum; 
		$main_array['rooms'][] = array('DO'=>$sum);
	}
	/*$sum=0;
    $this->db->select("game_room.game_id");
	$this->db->from('game_room');
	$this->db->where('game_room.business_id',$business);
	$query=$this->db->get();
	if(count($query->result_array())>0){
		$res=$query->result_array();
		$sub_array = array();
		foreach ($res as $key => $value) {
                $this->db->select("book_game_room.game_room_id,book_game_room.price");
				$this->db->from('book_game_room');
				$this->db->where('book_game_room.game_room_id',$value['game_id']);
				$this->db->where('book_game_room.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
				$query=$this->db->get();
				$temp = $query->result_array();
				if (!empty($temp) && count($temp) > 0) {
					foreach ($temp as $key => $value) {
						$sum = $sum + $value['price'];
					}
				}
		}
		$total_sum = $total_sum + $sum; 
		$main_array['rooms'][] = array('GR'=>$sum);
	}
	$sum=0;
    $this->db->select("locker_room.locker_id");
	$this->db->from('locker_room');
	$this->db->where('locker_room.business_id',$business);
	$query=$this->db->get();
	if(count($query->result_array())>0){
		$res=$query->result_array();
		$sub_array = array();
		foreach ($res as $key => $value) {
                $this->db->select("book_locker_room.locker_room_id,book_locker_room.price");
				$this->db->from('book_locker_room');
				$this->db->where('book_locker_room.locker_room_id',$value['locker_id']);
				$this->db->where('book_locker_room.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
				$query=$this->db->get();
				$temp = $query->result_array();
				if (!empty($temp) && count($temp) > 0) {
					foreach ($temp as $key => $value) {
						$sum = $sum + $value['price'];
					}
				}
		}
		$total_sum = $total_sum + $sum; 
		$main_array['rooms'][] = array('LR'=>$sum);
	}*/
	$main_array['total'] = $total_sum;
	if (isset($total_sum) && !empty($main_array) && count($main_array) > 0) {
		return $main_array;
	}

}
public function occupancy_percentage($business,$start_date,$end_date){
	$occ=0;
	$this->db->_protect_identifiers=false;
	$this->db->select("time_format(timediff(meeting_room.end_time,meeting_room.start_time),'%H') as hour,meeting_room.meeting_id,meeting_room.name");
	$this->db->from('meeting_room');
	$this->db->where('meeting_room.business_id',$business);
	$query=$this->db->get();
	$this->db->_protect_identifiers=true;
	if(count($query->result_array())>0){
		$res=$query->result_array();
		$sub_array = array();
		foreach ($res as $key => $value) {
            $this->db->select("book_meeting_room.booking_details");
			$this->db->from('book_meeting_room');
			$this->db->where('book_meeting_room.meeting_room_id',$value['meeting_id']);
			$this->db->where('book_meeting_room.dateAdded between "'.$start_date.'" AND "'.$end_date.'"');
			$query=$this->db->get();
			$temp = $query->result_array();
			if (!empty($temp) && count($temp) > 0) {
				foreach ($temp as $key => $valu) {
					$sub_array[] = $value;
					$sub_array[$key]['total_slot_time'] = count($res)*$value['hour'];
					$temp = json_decode($valu['booking_details'],true);
					$sum_slot = 0;
					foreach ($temp as $key1 => $val) {
						$sum_slot = $sum_slot + count($val);
					}
					$sub_array[$key]['booked_slot_time'] = $sum_slot;
					
				}
			}
		}
		/*echo "<pre>";
		print_r($sub_array);
		echo "</pre>";
		exit;*/
		//$total_sum = $total_sum + $sum; 
		//$main_array['rooms'][] = array('MR'=>$sum);
	}	

}
public function total_vo_office_booked($business){
$this->db->select("booking_virtual_office.start_date,booking_virtual_office.end_date,user.*,company.company_name");
	$this->db->from('booking_virtual_office');
	$this->db->join('user','booking_virtual_office.booked_for=user.userId');
	$this->db->join('company','user.company_id=company.id');
	$this->db->where('booking_virtual_office.b_id',$business);
    $query=$this->db->get();
	return $query->result();

	}
public function total_ws($business,$start_date,$end_date){
    
 $this->db->select_sum("floor_plan_seats.no_of_people");
	$this->db->from('floor_plan_seats');
	$this->db->join('floor_plan','floor_plan_seats.floor_id=floor_plan.floor_id');
	$this->db->join('business_centers','business_centers.business_id=floor_plan.business_id');
	$this->db->where('business_centers.business_id',$business);
	$query=$this->db->get();
	return $query->result();
    
}
public function total_vo_office($business){
$this->db->select("virtual_office.*");
	$this->db->from('virtual_office');
	$this->db->where('virtual_office.business_id',$business);
	$query=$this->db->get();
	return $query->num_rows();

}
public function total_ws_booked($business,$start_date,$end_date){
	$sum = 0;
	$this->db->select("floor_plan.floor_id");
	$this->db->from('floor_plan');
	$this->db->where('floor_plan.business_id',$business);
	$query=$this->db->get();
	if(count($query->result_array())>0){
	$r=$query->result_array()[0];
	if(!empty($r) && count($r)>0){
		$this->db->select("book_floor_plan.booking_detailes");
		$this->db->from('book_floor_plan');
		$this->db->where('book_floor_plan.floor_plan_id',$r['floor_id']);
		$this->db->where('book_floor_plan.IsApproved', 1);
		$this->db->where('book_floor_plan.start_date between "'.$start_date.'" AND "'.$end_date.'"');
	   	$this->db->where('book_floor_plan.end_date between "'.$start_date. '" AND "'.$end_date.'"');
		$query=$this->db->get();
		$s=$query->result_array();
		if(!empty($s) && count($s)>0){
			$s=json_decode($s[0]['booking_detailes'],true);
			$s=explode(':', $s[0]);
			foreach ($s as $key => $value) {
				$this->db->select("floor_plan_seats.no_of_people");
				$this->db->from('floor_plan_seats');
				$this->db->where('floor_plan_seats.seat_id',$value);
				$query=$this->db->get();
				$temp = $query->result_array();
				if (!empty($temp) && count($temp)>0) {
					$sum = $sum + $temp[0]['no_of_people'];
				}
			}
		}
    }
	return $sum;
    
  } 
}
public function total_price($business){
$this->db->select_sum("floor_plan_seats.price");
	$this->db->from('floor_plan_seats');
	$this->db->join('floor_plan','floor_plan_seats.floor_id=floor_plan.floor_id');
	$this->db->join('business_centers','business_centers.business_id=floor_plan.business_id');
	$this->db->where('business_centers.business_id',$business);
	$query=$this->db->get();
    $r=$query->result_array()[0];
    //print_r($r);
    //exit;
	return $r;

}
public function get_clients_count_details(){
	
	$sql="select user.* from user where user.userTypeId='ut4'AND user.status='1'";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}

public function	get_total_occupancy(){
	$sql="select book_locker_room.* from book_locker_room WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date ";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select book_game_room.* from book_game_room where CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date ";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select book_conference_room.* from book_conference_room";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select book_meeting_room.* from book_meeting_room";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
	
	
}
public function get_total_services(){
	$sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date ";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date ";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
	
}
public function get_total_seats(){
$sql="select book_floor_plan.id from book_floor_plan left join floor_plan_seats on 
floor_plan_seats.floor_id=book_floor_plan.floor_plan_id left join floor_plan on 
floor_plan.floor_id=floor_plan_seats.floor_id WHERE 
CURDATE() BETWEEN book_floor_plan.start_date AND book_floor_plan.end_date GROUP BY book_floor_plan.id";	
//echo $sql;
//exit;	
//$sql="select floor_plan.floor_id from floor_plan left join floor_plan_seats on floor_plan_seats.floor_id=floor_plan.floor_id inner join book_floor_plan on book_floor_plan.floor_plan_id=floor_plan_seats.floor_id WHERE CURDATE() BETWEEN book_floor_plan.start_date AND book_floor_plan.end_date ";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count=count($result);	
	return($count);
	
	
}
public function get_total_complaints(){
 $sql = "select complaints.* from complaints WHERE  complaints.dateadded=CURDATE() AND parent_id='0'";
	         
	$query=$this->db->query($sql);
	$result= $query->result_array();
	$count=count($result);
	return($count);	
}
public function get_client_list(){
    $sql="select user.* from user where user.userTypeId='ut4'AND user.status='1' AND user.city_id='cfd849d5-ec69-2d' ";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count=count($result);
	return($count);	
	
}
public function get_occupancy_list(){
    $sql="select book_locker_room.*,locker_room.city from book_locker_room left join locker_room on book_locker_room.locker_room_id=locker_room.locker_id WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date AND locker_room.city='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select book_game_room.*,game_room.city from book_game_room left join game_room on book_game_room.game_room_id=game_room.game_id WHERE CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date AND game_room.city='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select book_conference_room.*,conference_room.city from book_conference_room LEFT JOIN conference_room on book_conference_room.conference_room_id=conference_room.conference_id AND conference_room.city='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select book_meeting_room.*,meeting_room.city from book_meeting_room LEFT JOIN meeting_room on book_meeting_room.meeting_room_id=meeting_room.meeting_id AND meeting_room.city='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
		
	
}
public function get_service_list(){
    $sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date AND request_conceirge_service.city_id='cfd849d5-ec69-2d' ";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded AND request_courier_service.city_id='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded AND request_food_service.city_id='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date AND request_stuff_service.city_id='cfd849d5-ec69-2d'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);	
	
}
public function get_complaint_list(){
	$sql = "select complaints.* from complaints WHERE  complaints.dateadded=CURDATE() AND parent_id='0' AND complaints.city_id='cfd849d5-ec69-2d'";
	         
	$query=$this->db->query($sql);
	$result= $query->result_array();
	$count=count($result);
	return($count);	
	
}
public function get_client_result($location_id,$city_id){
	
	
	if($city_id!='' && $location_id=='0'){
	
 $sql="select user.* from user where user.userTypeId='ut4'AND user.status='1' AND user.city_id='".$city_id."'";
}else if($city_id!='' && $location_id!='0'){
$sql="select user.* from user where user.userTypeId='ut4'AND user.status='1' AND user.location_id='".$location_id."' AND user.city_id='".$city_id."'";		
}

$query=$this->db->query($sql);
$result=$query->result_array();	
$count=count($result);
//echo $count;
return($count);		
	
	
}

public function get_occupancy_result($location_id,$city_id,$room){
if($city_id!='' && $location_id=='0' && $room==''){
	
  $sql="select book_locker_room.*,locker_room.city from book_locker_room left join locker_room on book_locker_room.locker_room_id=locker_room.locker_id WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date AND locker_room.city='".$city_id."'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select book_game_room.*,game_room.city from book_game_room left join game_room on book_game_room.play_room_id=game_room.game_id WHERE CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date AND game_room.city='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select book_conference_room.*,conference_room.city from book_conference_room LEFT JOIN conference_room on book_conference_room.conference_room_id=conference_room.conference_id AND conference_room.city='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select book_meeting_room.*,meeting_room.city from book_meeting_room LEFT JOIN meeting_room on book_meeting_room.meeting_room_id=meeting_room.meeting_id AND meeting_room.city='".$city_id."' ";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
}	

 if($city_id!='' && $location_id!='0' && $room==''){
	
  $sql="select book_locker_room.*,locker_room.city from book_locker_room left join locker_room on book_locker_room.locker_room_id=locker_room.locker_id WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date AND locker_room.city='".$city_id."' AND locker_room.location='".$location_id."'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select book_game_room.*,game_room.city from book_game_room left join game_room on book_game_room.play_room_id=game_room.game_id WHERE CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date AND game_room.city='".$city_id."'AND game_room.location='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select book_conference_room.*,conference_room.city from book_conference_room LEFT JOIN conference_room on book_conference_room.conference_room_id=conference_room.conference_id AND conference_room.city='".$city_id."' AND conference_room.location='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select book_meeting_room.*,meeting_room.city from book_meeting_room LEFT JOIN meeting_room on book_meeting_room.meeting_room_id=meeting_room.meeting_id AND meeting_room.city='".$city_id."' AND meeting_room.location='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
}	

if($city_id!='' && $location_id!='0' && $room!=''){
	
	if($room=='conference'){
	$sql="select book_conference_room.*,conference_room.city from book_conference_room LEFT JOIN conference_room on book_conference_room.conference_room_id=conference_room.conference_id AND conference_room.city='".$city_id."' AND conference_room.location='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
    return ($count3);
}
if($room=='locker'){
	$sql="select book_locker_room.*,locker_room.city from book_locker_room left join locker_room on book_locker_room.locker_room_id=locker_room.locker_id WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date AND locker_room.city='".$city_id."' AND locker_room.location='".$location_id."'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	 return ($count1);
}
	
	if($room=='game'){
	$sql="select book_game_room.*,game_room.city from book_game_room left join game_room on book_game_room.play_room_id=game_room.game_id WHERE CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date AND game_room.city='".$city_id."'AND game_room.location='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	return($count2);
}
if($room=='meeting'){
	$sql="select book_meeting_room.*,meeting_room.city from book_meeting_room LEFT JOIN meeting_room on book_meeting_room.meeting_room_id=meeting_room.meeting_id AND meeting_room.city='".$city_id."' AND meeting_room.location='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	return($count4);
}
	
}


if($city_id!='' && $location_id=='0' && $room!=''){
	
	if($room=='conference'){
	$sql="select book_conference_room.*,conference_room.city from book_conference_room LEFT JOIN conference_room on book_conference_room.conference_room_id=conference_room.conference_id AND conference_room.city='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
    return ($count3);
}
if($room=='locker'){
	$sql="select book_locker_room.*,locker_room.city from book_locker_room left join locker_room on book_locker_room.locker_room_id=locker_room.locker_id WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date AND locker_room.city='".$city_id."'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	 return ($count1);
}
	
	if($room=='game'){
	$sql="select book_game_room.*,game_room.city from book_game_room left join game_room on book_game_room.play_room_id=game_room.game_id WHERE CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date AND game_room.city='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	return($count2);
}
if($room=='meeting'){
	$sql="select book_meeting_room.*,meeting_room.city from book_meeting_room LEFT JOIN meeting_room on book_meeting_room.meeting_room_id=meeting_room.meeting_id AND meeting_room.city='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	return($count4);
}
	
}
	
	
if($city_id=='' && $location_id=='0' && $room!=''){
	
	if($room=='conference'){
	$sql="select book_conference_room.*,conference_room.city from book_conference_room LEFT JOIN conference_room on book_conference_room.conference_room_id=conference_room.conference_id";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
    return ($count3);
}
if($room=='locker'){
	$sql="select book_locker_room.*,locker_room.city from book_locker_room left join locker_room on book_locker_room.locker_room_id=locker_room.locker_id WHERE CURDATE() BETWEEN book_locker_room.start_date AND book_locker_room.end_date";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	 return ($count1);
}
	
	if($room=='game'){
	$sql="select book_game_room.*,game_room.city from book_game_room left join game_room on book_game_room.play_room_id=game_room.game_id WHERE CURDATE() BETWEEN book_game_room.start_date AND book_game_room.end_date";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	return($count2);
}
if($room=='meeting'){
	$sql="select book_meeting_room.*,meeting_room.city from book_meeting_room LEFT JOIN meeting_room on book_meeting_room.meeting_room_id=meeting_room.meeting_id";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	return($count4);
}
	
}		
}

public function get_service_result($location_id,$city_id,$request){
if($city_id!='' && $location_id=='0' && $request==''){
	
  $sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date AND request_conceirge_service.city_id='".$city_id."' ";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded AND request_courier_service.city_id='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded AND request_food_service.city_id='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date AND request_stuff_service.city_id='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
}	

 if($city_id!='' && $location_id!='0' && $request==''){
	
   $sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date AND request_conceirge_service.city_id='".$city_id."' AND request_conceirge_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded AND request_courier_service.city_id='".$city_id."' AND request_courier_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	
	$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded AND request_food_service.city_id='".$city_id."' AND request_food_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);	
	
	$sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date AND request_stuff_service.city_id='".$city_id."' AND request_stuff_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	
	$count_all=$count1+$count2+$count3+$count4;
	return($count_all);
}	

if($city_id!='' && $location_id!='0' && $request!=''){
	
	if($request=='conceirge'){
	$sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date AND request_conceirge_service.city_id='".$city_id."' AND request_conceirge_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	return($count1);
}
if($request=='courier'){
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded AND request_courier_service.city_id='".$city_id."' AND request_courier_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	 return ($count2);
}
	
	if($request=='food'){
$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded AND request_food_service.city_id='".$city_id."' AND request_food_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);
	return($count3);
}
if($request=='staff'){
    $sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date AND request_stuff_service.city_id='".$city_id."' AND request_stuff_service.location_id='".$location_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	return($count4);
}
	
}


if($city_id!='' && $location_id=='0' && $request!=''){
	
	if($request=='conceirge'){
	 $sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date AND request_conceirge_service.city_id='".$city_id."' ";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	return($count1);
}
if($request=='courier'){
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded AND request_courier_service.city_id='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	 return ($count2);
}
	
	if($request=='food'){
$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded AND request_food_service.city_id='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);
	return($count3);
}
if($request=='staff'){
    $sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date AND request_stuff_service.city_id='".$city_id."'";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	return($count4);
}
	
}
	
	
if($city_id=='' && $location_id=='0' && $request!=''){
	
	if($request=='conceirge'){
	 $sql="select request_conceirge_service.* from request_conceirge_service WHERE CURDATE() BETWEEN request_conceirge_service.start_date AND request_conceirge_service.end_date";
	$query=$this->db->query($sql);
    $result=$query->result_array();	
	$count1=count($result);
	return($count1);
}
if($request=='courier'){
	$sql="select request_courier_service.* from  request_courier_service where CURDATE() = request_courier_service.dateAdded";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count2=count($result);
	 return ($count2);
}
	if($request=='food'){
$sql="select request_food_service.* from request_food_service where CURDATE() = request_food_service.dateAdded";
	$query=$this->db->query($sql);
	$result=$query->result_array();
	$count3=count($result);
	return($count3);
}
if($request=='staff'){
    $sql="select request_stuff_service.* from request_stuff_service WHERE CURDATE() BETWEEN request_stuff_service.start_date AND request_stuff_service.end_date";
	$query=$this->db->query($sql);
	$result=$query->result_array();	
	$count4=count($result);
	return($count4);
}
	
}	
	
}
public function get_complaint_result($location_id,$city_id){

	if($city_id!='' && $location_id=='0'){
	
 $sql="select complaints.* from complaints where dateadded=CURDATE() AND parent_id='0' AND city_id='".$city_id."'";
}else if($city_id!='' && $location_id!='0'){
$sql="select complaints.* from complaints where dateadded=CURDATE() AND parent_id='0' AND location_id='".$location_id."' AND city_id='".$city_id."'";		
}
$query=$this->db->query($sql);
$result=$query->result_array();	
$count=count($result);
return($count);		
		
	
}
public function get_discount_data(){
$sql="select discounts.*,user.FirstName,user.LastName,company.company_name from discounts LEFT JOIN user on discounts.added_by=user.userId LEFT JOIN company on company.id=discounts.company_id";	
$query=$this->db->query($sql);
$result=$query->result_array();	
return($result);		
}
public function	get_discount_info($appid){
	
	$sql="select discounts.*,user.FirstName,user.LastName,company.company_name from discounts LEFT JOIN user on discounts.added_by=user.userId LEFT JOIN company on company.id=discounts.company_id WHERE discounts.id='".$appid."' ";	
	
$query=$this->db->query($sql);
$result=$query->result_array();
return($result);	
   }
 public function  update_discount_info($appid,$appdata){
	$this->db->where('id',$appid);
	$this->db->update('discounts',$appdata); 
	 
 }
 public function get_seat_result($location_id,$city_id,$business_id){
$sql="select book_floor_plan.id from book_floor_plan left join floor_plan_seats on 
floor_plan_seats.floor_id=book_floor_plan.floor_plan_id left join floor_plan on 
floor_plan.floor_id=floor_plan_seats.floor_id WHERE 
floor_plan.city_id='".$city_id."' AND floor_plan.location_id='".$location_id."' 
AND floor_plan.business_id='".$business_id."' AND (CURDATE() BETWEEN book_floor_plan.start_date AND book_floor_plan.end_date) GROUP BY book_floor_plan.id";	
$query=$this->db->query($sql);
$result=$query->result_array();	
$count=count($result);
return($count);	 
	 
 }
}

