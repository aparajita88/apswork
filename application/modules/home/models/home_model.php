<?php
class home_model extends MY_Model {
    public function __construct() {
    	parent::__construct();
      	$this->load->database();
    }
	function get_subscription(){
		$this->db->select('subscription.*');	
		$this->db->from('subscription');	
		$this->db->where('subscription.status', 1);
		$this->db->order_by("subscription.price","asc");
		$query = $this->db->get();
		return $query->result_array();		
	}
	function my_subscription($user_id){
		$this->db->select('subscription.Id,subscription.name,subscription.orderId,user.userId,user.UserSubscriptionId,user.UserSubscriptiondate');	
		$this->db->from('subscription');	
		$this->db->join('user', 'user.UserSubscriptionId = subscription.Id');
		$this->db->where('user.userId =', $user_id);
		$query = $this->db->get();
		return $query->result_array();		
	}
	function get_result($uid,$sid){
		$first_day_of_month = date('Y-m-01');
	    $last_day_of_month =date('Y-m-t 23:59:59');
	    $this->db->select('user.UserSubscriptionId,user.UserSubscriptiondate');	
		$this->db->from('user');	
		$this->db->where(array('user.UserSubscriptiondate'=>date('Y-m-d'),'user.userId'=>$uid));
		$query = $this->db->get();	
		$subid_array= $this->my_subscription($uid);
		$subid=$subid_array[0]['UserSubscriptionId'];
		if($sid==$subid){
			if(empty($query->result_array())){
				$this->db->select('user.UserSubscriptionId');	
				$this->db->from('user');
				$this->db->where(array('user.UserSubscriptiondate >='=>$first_day_of_month,'user.UserSubscriptiondate <='=>$last_day_of_month,'user.userId'=>$uid));
				$query = $this->db->get();
			}
		}
    	return $query->result_array();	
	}
	function get_membership_number(){
	    $this->db->select('membership_number.*');	
		$this->db->from('membership_number');	
		$query = $this->db->get();
		$query->result_array();
		$membernum_array=$query->result_array();
	    $num= $membernum_array[0]['current_number']+1;
		$data=array('current_number'=>$num);
	    $this->db->where('id','8e61fe8a-8fb1-7c');
	    $this->db->update('membership_number',$data);
	    return $num;		
	}
}
?>
