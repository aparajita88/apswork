<?php

class login extends MY_Model {
	

    public function __construct() {
		session_start();
        parent::__construct();
        $this->load->database();
    }
    
     
    public function getforgetPassTemplate()
    {
    	$this->db->where('emailId', '56bc379e-fab0-ea');
		$query=$this->db->get('email_templates');
		return $query->result_array();
    }


	public function login($data)
	{
		$this->db->select('u.*');
		$this->db->from('user u');
		$this->db->where('u.userName =', $data['username']);
		$this->db->where('u.password =', md5($data['password']));
		$this->db->where('u.status =', (int)1);
		$query = $this->db->get();
		
		$num_of_rows = $query->num_rows();
		
		if($num_of_rows >0){
			$result = $query->row_array();
			$this->session->set_userdata('userTypeId', $result['userTypeId']);
			$this->session->set_userdata('userId', $result['userId']);
			$this->session->set_userdata('userName', $result['userName']);
			$this->session->set_userdata('userEmail', $result['userEmail']);
			$this->session->set_userdata('userProfileName', $result['userProfilename']);

			if($result['company_id']!=''){
				$this->session->set_userdata('company_id', $result['company_id']);	
			}
			$result['image'] = base_url().'assets/uploads/images/thumbnails/'.(($result['image']!='')?$result['image']:'NoProfileImage.png');
			if(!file_exists($result['image'])){
				$result['image'] = base_url().'assets/uploads/images/thumbnails/NoProfileImage.png';
			}
			$this->session->set_userdata('userImg', $result['image']);
			$userId = $result['userId'];
			$userTypeId = $result['userTypeId'];
            
			$this->db->select('u_t.*');
			$this->db->from('user_type u_t');
			$this->db->where('u_t.userTypeId', $userTypeId);
			$query = $this->db->get();
			$result1 = $query->row_array();
			$this->session->set_userdata('userTypeName', $result1['userTypeName']);
			return  $userId;
		}else{
			return (int)0;
		}
	}

	public function getUserProfile($userId){
		
		if($userId==""){
			redirect(base_url()); exit;
		}
		$data = array();
		$this->db->select('u.*,cities.cityId,cities.name as c_name,locations.locationId,locations.name as l_name,company.id,company.company_name,company.address');
		$this->db->from('user u');
		$this->db->join('cities', 'u.city_id=cities.cityId', 'left');
		$this->db->join('locations', 'u.location_id=locations.locationId', 'left');
		$this->db->join('company', 'u.company_id=company.id', 'left');
		$this->db->where('u.userId =', $userId);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
	public function getvendorProfile($userId){
		
		
		$data = array();
		$this->db->select('vendor.*');
		$this->db->from('vendor');
	    $this->db->where('vendor.id =', $userId);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
	
	function checkEmail($email){
		$data = array();
		$this->db->select('user.*');
		$this->db->from('user');
		$this->db->where('user.userEmail =', $email);
		$query = $this->db->get();
		return $query->num_rows();	
	}
	
	function commonUpdate($tableName, $data, $where){
		foreach($where as $key => $value){
			$this->db->where($key, $value);
		}
		return $this->db->update($tableName, $data);
	}
	function get_staff_List(){
	$userTypeId = array('ut1','ut2','ut3', 'ut4','ut11');
    $this->db->select('user.*,user_type.userTypeName,locations.name as l_name,cities.name as c_name');
	$this->db->from('user');
	$this->db->join('user_type', 'user_type.userTypeId=user.userTypeId', 'left');
	$this->db->join('locations', 'locations.locationId=user.location_id', 'left');
	$this->db->join('cities', 'cities.cityId=user.city_id', 'left');
    $this->db->where_not_in('user.userTypeId', $userTypeId);
	$query = $this->db->get();
	
	return $query->result_array();
	
	}
	function get_vendor_List(){
	$this->db->select('vendor.*');
	$this->db->from('vendor');
	$this->db->where(array('vendor.deleted'=>'0'));
	$query = $this->db->get();
	return $query->result_array();
	
	}
	function get_staff_types(){
	$userTypeId = array('ut1','ut2','ut3', 'ut4','ut11');
	$this->db->select('user_type.*');	
	$this->db->from('user_type');	
	$this->db->where_not_in('user_type.userTypeId', $userTypeId);
	$query = $this->db->get();
	
	return $query->result_array();	
	}
	function get_all_staff_credit(){
	$userTypeId = array('ut7','ut5','ut10', 'ut2');
	$this->db->select('creditnote_staff.*,user_type.userTypeName');	
	$this->db->from('creditnote_staff');	
	$this->db->join('user_type', 'user_type.userTypeId=creditnote_staff.userTypeId', 'left');
	$this->db->where_in('creditnote_staff.userTypeId', $userTypeId);
	$query = $this->db->get();
	
	return $query->result_array();	
	}
	function get_staff_credit($id){
     $data = array();
	$this->db->select('creditnote_staff.*');
	$this->db->from('creditnote_staff');
	$this->db->where('creditnote_staff.userTypeId =', $id);
	$query = $this->db->get();
	return $query->result_array();	


	}
	
}
?>
