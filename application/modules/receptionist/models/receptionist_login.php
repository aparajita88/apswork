<?php

class receptionist_login extends MY_Model {
	

    public function __construct() {
		
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
		$this->db->join('cities', 'u.city_id=cities.cityId', 'left');
		$this->db->join('locations', 'u.location_id=locations.locationId', 'left');
		$this->db->where('u.userId =', $userId);
		$query = $this->db->get();
		$data = $query->row_array();
		return $data;
	}
	function updatereminder($data,$evntid){
		$this->db->where('event_id',$evntid);
		$this->db->update('client_event',$data);
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
	public function get_client_event($clntstr){
		$sql="SELECT `client_event`.* ,`FirstName`,`LastName`,`phone`FROM (`client_event`) JOIN `user` ON `client_event`.`createdby` = `user`.`userId`
WHERE `client_event`.`is_shared` = '1' AND user.userTypeId='ut4' AND `client_event`.`createdby`IN $clntstr";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	public function get_client_event_byeventid($evntid){
		
		$this->db->select('client_event.*');
		$this->db->from('client_event');
		$this->db->where('event_id',$evntid);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	
}
?>
