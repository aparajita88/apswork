<?php

class concierge_login extends MY_Model {
	

    public function __construct() {
		//session_start();
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
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
		//$this->db->join('user_profile up', 'u.userId=up.userId', 'left outer');
		//$this->db->where('u.userTypeId =', $data['usertype']);
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
			$this->session->set_userdata('userPhone', $result['phone']);
			$this->session->set_userdata('userProfileName', $result['userProfilename']);
			$result['image'] = base_url().'assets/uploads/images/thumbnails/'.(($result['image']!='')?$result['image']:'NoProfileImage.png');
			if(!file_exists($result['image'])){
				$result['image'] = base_url().'assets/uploads/images/thumbnails/NoProfileImage.png';
			}
			$this->session->set_userdata('userImg', $result['image']);

			$userId = $result['userId'];
			$userTypeId = $result['userTypeId'];

			$this->db->select('u_t.*');
			$this->db->from('user_type u_t');
			$this->db->where('u_t.userTypeId =', $userTypeId);
			$query = $this->db->get();
			$result = $query->row_array();

			$this->session->set_userdata('userTypeName', $result['userTypeName']);
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
		$this->db->select('u.*,cities.cityId,cities.name as c_name,locations.locationId,locations.name as l_name');
		$this->db->from('user u');
		//$this->db->join('user_profile up', 'u.userId=up.userId', 'left outer');
		$this->db->join('cities', 'u.city_id=cities.cityId', 'left');
		$this->db->join('locations', 'u.location_id=locations.locationId', 'left');
		$this->db->where('u.userId =', $userId);
		$query = $this->db->get();
		$data = $query->row_array();
		
		//$data['image'] = base_url().'assets/uploads/images/thumbnails/'.(($data['image']!='')?$data['image']:'NoProfileImage.png');
		//print_r($data['image']); exit;
		//if(!file_exists($data['image'])){
			//$data['image'] = base_url().'assets/uploads/images/thumbnails/NoProfileImage.png';
		//}
		return $data;
	}	
}
?>
