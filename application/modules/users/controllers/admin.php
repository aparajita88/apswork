<?php
class admin extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('login');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
	}

	public function doAdminLogin(){ // for admin login
		$data = array();
		$data['username'] = $this->input->post("username");
		$data['password'] = $this->input->post("password");
		$uesrId = $this->login->login($data);
	    $userTypeName = $this->session->userdata("userTypeName");
		if($uesrId=="0"){
			print_r("0"."-"."0"); exit;
		}else if($uesrId!="0" && $userTypeName=="vendor" ){
			print_r("1"."-"."ut3"); exit;
		}else if($uesrId!="0" && $userTypeName=="DirectClient" ){
		print_r("1"."-"."ut4"); exit;	
		}else if ($uesrId!="0" && $userTypeName=="Administrator" ){
		print_r("1"."-"."ut1"); exit;		
		}else if($uesrId!="0" && $userTypeName=="Receptionist"){
			print_r("1"."-"."ut5"); exit;
		}else if($uesrId!="0" && $userTypeName=="Ituser"){
			print_r("1"."-"."ut6"); exit;
		}else if($uesrId!="0" && $userTypeName=="Manager"){
			print_r("1"."-"."ut7"); exit;
		}else if($uesrId!="0" && $userTypeName=="Concierge"){
			print_r("1"."-"."ut8"); exit;
		}else if($uesrId!="0" && $userTypeName=="Pantry"){
			print_r("1"."-"."ut9"); exit;
		}else if($uesrId!="0" && $userTypeName=="Owner"){
			print_r("1"."-"."ut2"); exit;
		}
		else if($uesrId!="0" && $userTypeName=="AreaDirector"){
			print_r("1"."-"."ut10"); exit;
		}
		else if($uesrId!="0" && $userTypeName=="IndirectClient"){
			print_r("1"."-"."ut11"); exit;
		}
		else if($uesrId!="0" && $userTypeName=="ISTuser"){
			print_r("1"."-"."ut12"); exit;
		}
		
	}
	
	public function dashBoard(){ // admin dashboard
		authenticate(array('ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($userId!="" && $userTypeId=="ut1"){
		$this->load->view("admin_dashboard", $data);
		
		}else if($userId!="" && $userTypeId=="ut4"){
		$this->load->view("client/virtual_assistant", $data);
		}
		
		else if($userId!="" && $userTypeId=="ut3"){
		$this->load->view("vendor/vendor_dashboard", $data);
		}
	}
	
	public function updateProfile(){ //client,staff profile updation
		authenticate(array('ut1','ut2','ut3','ut4','ut5','ut6','ut7','ut8','ut9','ut10','ut11','ut12'));
		$img 						= $this->doUpload("profile_image");
		$userId 					= $this->session->userdata('userId');  
		$data['FirstName']			= $this->input->post('first_name');
		$data['LastName']			= $this->input->post('last_name');
		$data['userProfilename']	= $data['FirstName']."-".$data['LastName'];
		if($img!='') $data['image']	= $img;
		$data['modifiedBy']			= $userId;
		$data['dateMOdified']		= gmdate('Y-m-d H:i:s');
		$data['userEmail']			=$this->input->post('email');
		$data['userName'] 			= $this->input->post('email'); 
		/////----------- UPDATING USER TABLE---------////////
		print_r($data); exit;
		if($this->login->commonUpdate('user', $data, array("userId"=>$userId))){

			/////-----------UPDATING USER PROFILE TABLE-----------//////
			$data=array();
			$data['address1']		= $this->input->post('address');
			$data['address2']		= $this->input->post('address2');
			$data['phone']			= $this->input->post('phone');
			$data['cityId']			= $this->input->post('city');
			$data['stateId']		= $this->input->post('state');
			$data['countryId']		= $this->input->post('country');
			$data['zipCode']		= $this->input->post('post_code');
			$data['dateModified']   = gmdate('Y-m-d H:i:s');
			$data['modifiedBy']		= $userId;
			if($this->login->commonUpdate('user_profile', $data, array("userId"=>$userId))){
				redirect(base_url().'index.php/users/admin/dashBoard?status=updateprofile_success');
			}else{
				redirect(base_url().'index.php/users/admin/dashBoard?status=updateprofile_error');
			}
		}else{
			redirect(base_url().'index.php/users/admin/dashBoard?status=updateprofile_error');
		}
	}

	public function doUpload($fieldName, $defaultImageFieldName = "false"){
		authenticate(array('ut1','ut2','ut3','ut4','ut5'));
		if($_FILES[$fieldName]['name']!=""){ 
			$value = $_FILES[$fieldName]['name'];
			$config = array(
			'file_name' => $this->session->userdata('userId'),
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path.'/full',
			'max_size' => 2000
			);
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($fieldName)) {
				echo $this->upload->display_errors(); exit();
			}else{
				$flag=1;
				$image_data = $this->upload->data();
				$this->load->library('image_lib');
				$upName=$image_data['file_name'];
				
				$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/thumbnails',
				'maintain_ration' => true,
				'width' => 200,
				'height' => 200
				);

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/medium',
				'maintain_ration' => true,
				'width' => 520,
				'height' => 480
				);

				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();

				$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/small',
				'maintain_ration' => true,
				'width' => 150,
				'height' => 150
				);
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$this->image_lib->clear();
			}
			$img=$upName;
		}else{
			$img=$this->input->post($defaultImageFieldName);
		}	
		return $img;
	}

	public function isEmailAvailable(){
		authenticate(array('ut1','ut2','ut3','ut4','ut5'));
		$isEdit = $this->input->post('isEdit');
		$actual_email = $this->session->userdata('userEmail');
		$input_email = $this->input->post('email');
		
		if($isEdit && ($actual_email!='' && $input_email!='' && $actual_email==$input_email)){
			print_r("1"); exit;
		}else{
			print_r($this->user->isEmailAvailable($input_email)); exit;
		}
	}
	
	
	
}
?>
