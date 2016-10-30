<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

function get_country() {
		$CI = & get_instance();
		$CI->db->order_by('country_nm','ASC');
		$result = $CI->db->get('countries');
		if($result) {
			return $result;
		} 
	}
	function get_country_by_id($id) {
		$CI = & get_instance();
		$CI->db->where('id',$id);
		$result = $CI->db->get('countries');
		if($result) {
			return $result;
		} 
	}
function get_county() {
	$CI = & get_instance();
	$CI->db->order_by('county_nm','ASC');
	$result = $CI->db->get('county');
	if($result) {
		return $result;
	} 
}
function get_counties($id) {
	$CI = & get_instance();
	$CI->db->where('country_id',$id);
	$CI->db->order_by('county_nm','ASC');
	$result = $CI->db->get('county');
	if($result) {
		return $result;
	} 
}
function get_town() {
		$CI = & get_instance();
		$CI->db->order_by('town_nm','ASC');
		$result = $CI->db->get('town');
		if($result) {
			return $result;
		} 
	}
	function get_towns($id) {
		$CI = & get_instance();
		$CI->db->where('county_id',$id);
		$CI->db->order_by('town_nm','ASC');
		$result = $CI->db->get('town');
		if($result) {
			return $result;
		} 
	}
function get_occation($tbl,$colum1,$val1,$colum2,$val2,$colum3,$val3,$order_by,$order){
        $CI = & get_instance();
		$CI->db->where($colum1 , $val1);
		$CI->db->where($colum2 , $val2);
		$CI->db->where($colum3 , $val3);
		$CI->db->order_by($order_by,$order);
		$result = $CI->db->get($tbl);
		if($result) {
			return $result;
		} 
	}
	function get_service($tbl,$colum1,$val1,$colum2,$val2,$colum3,$val3,$colum4,$order_by,$order){
        $CI = & get_instance();
		$CI->db->where($colum1 , $val1);
		$CI->db->where($colum2 , $val2);
		$CI->db->where($colum3 , $val3);
		$CI->db->where($colum4,'');
		$CI->db->order_by($order_by,$order);
		$result = $CI->db->get($tbl);
		if($result) {
			return $result;
		} 
	}
	function get_subservice($tbl,$colum1,$val1,$colum2,$val2,$colum3,$val3,$colum4,$val4,$order_by,$order){
        $CI = & get_instance();
		$CI->db->where($colum1 , $val1);
		$CI->db->where($colum2 , $val2);
		$CI->db->where($colum3 , $val3);
		$CI->db->where($colum4,$val4);
		$CI->db->order_by($order_by,$order);
		$result = $CI->db->get($tbl);
		if($result) {
			return $result;
		} 
	}
	function insert_into_tbl($tbl,$data){
		$CI = & get_instance();
		$CI->db->insert($tbl , $data);
		$result = $CI->db->affected_rows();
	
		return  $result;
		
	}
	function update_tbl($tbl,$column,$id,$data){
		$CI = & get_instance();
		$CI->db->where($column,$id);
		$CI->db->update($tbl , $data);
		$result = $CI->db->affected_rows();
	
		return  $result;
		
	}
	function delete_tbl($tbl,$column,$id){
		$CI = & get_instance();
		$CI->db->where($column,$id);
		$CI->db->delete($tbl);
		$result = $CI->db->affected_rows();
	
		return  $result;
		
	}
	
	function vendor_login_check() {
    $CI = & get_instance();
    $userId = $CI->session->userdata("userId");
    $userEmail = $CI->session->userdata("userEmail");
    if (empty($userId) && empty($userEmail)) {
        echo "<script>window.parent.location.href='".$CI->config->item('base_url')."vendor'</script>";
    }
	function get_profile_info($id){
		$CI = & get_instance();
		$CI->db->where('userId',$id);
		$result = $CI->db->get('user');
		if($result) {
			return $result;
		} 
				
	}
	function get_tbl_order_by($tbl,$order_by,$order)
	{
		 $CI = & get_instance();
		 $CI->db->order_by($order_by,$order);
		 $result = $CI->db->get($tbl);
		 return $result;
 	}
   function get_row_by_id($tbl,$id,$val)
	{
		 $CI = & get_instance();
		 $CI->db->where($id,$val);
		 $result = $CI->db->get($tbl);
		 return $result;
 	}
	function get_tbl_order_by_or_id($tbl,$id,$val,$order_by,$order)
	{
		 $CI = & get_instance();
		 $CI->db->order_by($order_by,$order);
		 $CI->db->where($id,$val);
		 $result = $CI->db->get($tbl);
		 return $result;
 	}
    function get_user_profile_info($uId){
		$CI = & get_instance();
		$CI->db->where('userId',$uId);
		$result = $CI->db->get('user_profile');
			return $result;
		
				
	}
	function get_tbl_order_by_deleted($tbl,$order_by,$order)
	{
		 $CI = & get_instance();
		 $CI->db->where('deleted','0');
		 $CI->db->order_by($order_by,$order);
		 $result = $CI->db->get($tbl);
		 return $result;
 	}
	function get_user_profile_info_by_eamil($email){
		$CI = & get_instance();
		$CI->db->where('userEmail',$email);
		$result = $CI->db->get('user');
		if($result) {
			return $result;
		} 
				
	} 
}

	
	
