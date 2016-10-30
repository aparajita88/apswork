<?php
class Rooms extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	     $this->load->model('rooms_model');
	     $this->load->model('location/location_model', 'lm');
	     $this->load->model('business/business_model');
	     $this->load->helper('common');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
	
	}



 public function add_meeting()
 {		 
	    authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['business']=$this->rooms_model->get_business();
	if (isset($_POST) && (!empty($_POST)))
	{
			$meeting_id=create_guid();
		    $meeting_id= substr($meeting_id,0,16);
			$data=array(
						'meeting_id'=>$meeting_id,
						'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'location'=>$this->input->post('location'),
						'city'=>$this->input->post('city'),	
						'start_time'=>$this->input->post('start_time'),
						'end_time'=>$this->input->post('end_time'),
						'time_slot'=>$this->input->post('time_slot'),
						'price'=>$this->input->post('price'),
						'status'=>'1',
						'deleted'=>'0',
						'dateModified'=>date('Y-m-d H:i:s'),
						'description'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateAdded'=>date('Y-m-d H:i:s')
						);	
					
			
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			$image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!="")
			{
				$result = insert_into_tbl('meeting_room',$data);	
				$data1=array(
				
				'id'=>$imageid,
				'room_id'=>$meeting_id,
				'roomtype'=>'meeting',
				'imageName'=>$image,
				'isdefault'=>'1',
				'deleted'=>'0',
				'dateAdded'=>date('Y-m-d H:i:s'),				
				'status'=>'1'
				);				
				$result1 = insert_into_tbl('rooms_images',$data1);
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/meeting_room_list');
		    }
			else
			{
				redirect(base_url().'index.php/rooms/add_meeting',$data);	
			}						
	}
	
	$data['cities']=$this->lm->getcities();
	$this->load->view("add_meeting",$data);
 }
 public function add_day_office(){
	
   authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['business']=$this->rooms_model->get_business();
	if (isset($_POST) && (!empty($_POST)))
	{
			$meeting_id=create_guid();
		    $meeting_id= substr($meeting_id,0,16);
			$data=array(
						'dayoffice_id'=>$meeting_id,
						'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'location'=>$this->input->post('location'),																	
						'city'=>$this->input->post('city'),	
						//'days'=>$this->input->post('days'),														
						'start_time'=>$this->input->post('start_time'),
						'end_time'=>$this->input->post('end_time'),
						'time_slot'=>$this->input->post('time_slot'),
						'price'=>$this->input->post('price'),
						'status'=>'1',
						'deleted'=>'0',
						'dateModified'=>date('Y-m-d H:i:s'),
						'description'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateAdded'=>date('Y-m-d H:i:s')
						);	
			
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			$image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!="")
			{
				$result = insert_into_tbl('day_office',$data);	
				$data1=array(
				
				'id'=>$imageid,
				'room_id'=>$meeting_id,
				'roomtype'=>'dayoffice',
				'imageName'=>$image,
				'isdefault'=>'1',
				'deleted'=>'0',
				'dateAdded'=>date('Y-m-d H:i:s'),				
				'status'=>'1'
				);				
				$result1 = insert_into_tbl('rooms_images',$data1);
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/day_office_list');
		    }
			else
			{
				redirect(base_url().'index.php/rooms/add_day_office',$data);	
			}						
	}
	
	$data['cities']=$this->lm->getcities();
	$this->load->view("add_day_office",$data);	
	
 }
 public function add_conference()
 {
		 authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['business']=$this->rooms_model->get_business();		
		if (isset($_POST) && (!empty($_POST))){
			
			$conference_id=create_guid();
		    $conference_id= substr($conference_id,0,16);
		    
			$data=array(
						'conference_id'=>$conference_id,
						'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'location'=>$this->input->post('location'),
						'city'=>$this->input->post('city'),
						'start_time'=>$this->input->post('start_time'),
						'end_time'=>$this->input->post('end_time') ,
						'time_slot'=>$this->input->post('time_slot'),
						'price'=>$this->input->post('price'),
						'status'=>'1',
						'deleted'=>'0',
						'dateModified'=>date('Y-m-d H:i:s'),
						'description'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateAdded'=>date('Y-m-d H:i:s')
						);
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			$image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!=""){
				
			$result = insert_into_tbl('conference_room',$data);	
			$data1=array(
			
			'id'=>$imageid,
			'room_id'=>$conference_id,
			'roomtype'=>'conference',
			'imageName'=>$image,
			'isdefault'=>'1',
			'deleted'=>'0',
			'dateAdded'=>date('Y-m-d H:i:s'),
			
			'status'=>'1'
			);
			
			$result1 = insert_into_tbl('rooms_images',$data1);
			$this->session->set_flashdata('edit',"You have successfully added.");
			redirect(base_url().'index.php/rooms/conference_room_list');
		}else{
		redirect(base_url().'index.php/rooms/add_conference',$data);	
		}
			
			
	}
	$data['cities']=$this->lm->getcities();
	$this->load->view("add_conference",$data);
}
public function add_subscription_type()
 {
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);	
	
	if (isset($_POST) && (!empty($_POST)))
	{
		
			$id=create_guid();
		    $id= substr($id,0,16);
			$data=array(
						'Id'=>$id,
						'name'=>$this->input->post('name'),
						'price'=>$this->input->post('price'),
						'addedBy'=>$this->session->userdata("userId"),
					    'status'=>'1',
						
					
						'dateAdded'=>date('Y-m-d H:i:s')
						);
						$result = insert_into_tbl('subscription',$data);												
			
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/subscription_list');
		    }
									
	
	
	
	$this->load->view("add_subscription_type",$data); 
	 
 }
public function add_game_types()
 {
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);	
	if (isset($_POST) && (!empty($_POST)))
	{
	        $id=create_guid();
		    $id= substr($id,0,16);
			$data=array(
						'id'=>$id,
						'name'=>$this->input->post('name'),
						'addedBy'=>$this->session->userdata("userId"),
						'status'=>'1',
						'deleted'=>'0',
					
						'dateAdded'=>date('Y-m-d H:i:s')
						);
						$result = insert_into_tbl('game_types',$data);											
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/game_types_list');
		    }
									
	
	
	
	$this->load->view("add_game_types",$data); 
	 
 }
 public function add_courier_types()
 {
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);	
	if (isset($_POST) && (!empty($_POST)))
	{
			$id=create_guid();
		    $id= substr($id,0,16);
			$data=array(
						'id'=>$id,
						'name'=>$this->input->post('name'),
						'addedBy'=>$this->session->userdata("userId"),
						'status'=>'1',
						'deleted'=>'0',
					
						'dateAdded'=>date('Y-m-d H:i:s')
						);
						$result = insert_into_tbl('courier_types',$data);											
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/courier_types_list');
		    }
									
	
	
	
	$this->load->view("add_courier_types",$data); 
	 
 }
 
  public function add_concierge_types()
 {
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);	
	if (isset($_POST) && (!empty($_POST)))
	{
			$id=create_guid();
		    $id= substr($id,0,16);
			$data=array(
						'id'=>$id,
						'name'=>$this->input->post('name'),
						'addedBy'=>$this->session->userdata("userId"),
						'status'=>'1',
						'deleted'=>'0',
				        'dateAdded'=>date('Y-m-d H:i:s')
						);
						$result = insert_into_tbl('concierge_types',$data);											
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/concierge_types_list');
		    }
									
	
	
	
	$this->load->view("add_concierge_types",$data); 
	 
 }
 
  public function add_cafe_types()
 {
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);	
	$data['cafe_type']=$this->rooms_model->getcafecategory();	
	if (isset($_POST) && (!empty($_POST)))
	{
	
			$id=create_guid();
		    $id= substr($id,0,16);
		    $cafe_id= $this->input->post('cafe_id');
		    if($cafe_id=='1'){
				$cafe_id='';
		}
				$supported_image = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);
 		
        if($_FILES['cafe_image']['name']!=""){
        	$ext = strtolower(pathinfo($_FILES['cafe_image']['name'], PATHINFO_EXTENSION)); // Using 
        	$imgname=$id.".".$ext;
if (in_array($ext, $supported_image)) {
	
    if(move_uploaded_file($_FILES['cafe_image']['tmp_name'],'assets/uploads/images/cafe_image/'.$imgname)){

    	echo 'file uploaded';
    }
    else{
    	echo 'file not uploaded';
    }
    }
 else {
    $this->session->set_flashdata('edit',"Your image file should be jpg,gif,jpeg or png type.");
	redirect(base_url().'index.php/rooms/add_cafe_types/'.$id);
}
        }else{
        $imgname='';	
        }
			$data=array(
						'id'=>$id,
						'city_id'=>$this->input->post('city'),
						'location_id'=>$this->input->post('location'),
						'name'=>$this->input->post('name'),
						'price'=>$this->input->post('price'),
						'parent_id'=>$cafe_id,
						'addedBy'=>$this->session->userdata("userId"),
						'image'=>$imgname,					
						'status'=>'1',
						'deleted'=>'0',
					
						'dateAdded'=>date('Y-m-d H:i:s')
						);
						$result = insert_into_tbl('cafe_types',$data);												
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/cafe_types_list');
		    }
									
	
	$data['location']=$this->lm->getlocationbycity($data['userData']['city_id']);
	$data['cities']=$this->lm->getcities();
	$this->load->view("add_cafe_types",$data); 
	 
 }
  public function game_types_list(){
	    authenticate(array('ut6','ut1'));
	  
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['game_types']=$this->rooms_model->get_allgame_types();	
		$this->load->view('game_types_list', $data);		 
	 
 }
   public function subscription_list(){
	    authenticate(array('ut6','ut1'));
	  
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['subscription']=$this->rooms_model->get_all_subscription();
		$this->load->view('subscription_list', $data);		 
	 
 }
  public function courier_types_list(){
	    authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['courier_types']=$this->rooms_model->get_allcourier_types();
		$this->load->view('courier_types_list', $data);		 
	 
 }
public function concierge_types_list(){
	    authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['concierge_types']=$this->rooms_model->get_allconcierge_types();
		$this->load->view('concierge_types_list', $data);		 
	 
 }
public function cafe_types_list(){
	    authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['cafe_types']=$this->rooms_model->get_allcafe_subtypes();	
		$this->load->view('cafe_types_list', $data);		 
	 
 }

 public function add_game()
 {		 authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['all_game_types']=$this->rooms_model->all_game_types();
	if (isset($_POST) && (!empty($_POST)))
	{
			$game_id=create_guid();
		    $game_id= substr($game_id,0,16);
		    $game_type=$this->input->post('chkbox');
		    $str = implode (",", $game_type);
			$data=array(
						'game_id'=>$game_id,
						'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
					    'game_type'=>$str,
						'location'=>$this->input->post('location'),	
						'city'=>$this->input->post('city'),	
						'price'=>$this->input->post('price'),
						'status'=>'1',
						'deleted'=>'0',
						'dateModified'=>date('Y-m-d H:i:s'),
						'description'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateAdded'=>date('Y-m-d H:i:s')
						);										
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			$image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!="")
			{
				$result = insert_into_tbl('game_room',$data);	
				$data1=array(
				
				'id'=>$imageid,
				'room_id'=>$game_id,
				'roomtype'=>'game',
				'imageName'=>$image,
				'isdefault'=>'1',
				'deleted'=>'0',
				'dateAdded'=>date('Y-m-d H:i:s'),				
				'status'=>'1'
				);				
				$result1 = insert_into_tbl('rooms_images',$data1);
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/games_room_list');
		    }
			else
			{
				redirect(base_url().'index.php/rooms/add_game',$data);	
			}						
	}
	
	$data['cities']=$this->lm->getcities();
	$this->load->view("add_game",$data);
 }
 
 public function add_locker()
 {		 authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		
	if (isset($_POST) && (!empty($_POST)))
	{
			$locker_id=create_guid();
		    $locker_id= substr($locker_id,0,16);
		     $game_type=$this->input->post('chkbox');
		  
		    $str = implode (",", $game_type);
		 
			$data=array(
						'locker_id'=>$locker_id,
						'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'locker_type'=>$str,
						'location'=>$this->input->post('location'),							
						'price'=>$this->input->post('price'),
						'status'=>'1',
						'deleted'=>'0',
						'dateModified'=>date('Y-m-d H:i:s'),
						'description'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateAdded'=>date('Y-m-d H:i:s')
						);												
			
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			$image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!="")
			{
				$result = insert_into_tbl('locker_room',$data);	
				$data1=array(				
				'id'=>$imageid,
				'room_id'=>$locker_id,
				'roomtype'=>'locker',
				'imageName'=>$image,
				'isdefault'=>'1',
				'deleted'=>'0',
				'dateAdded'=>date('Y-m-d H:i:s'),				
				'status'=>'1'
				);				
				$result1 = insert_into_tbl('rooms_images',$data1);
				
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/rooms/locker_room_list');
		    }
			else
			{
				redirect(base_url().'index.php/rooms/add_locker',$data);	
			}						
	}
	
	$data['cities']=$this->lm->getcities();
	$this->load->view("add_locker",$data);
 }

 public function doUpload($fieldName,$imageid)
 {
	
		if($_FILES[$fieldName]['name']!="")
		{ 
			$value = $_FILES[$fieldName]['name'];
			
			$config = array(
			'file_name' => $imageid,
			 'encrypt_name' => 'FALSE',
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $this->gallery_path.'/full'
					
			);
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($fieldName))
			{
				$error = $this->upload->display_errors();
			   $this->session->set_flashdata('item_error',$error);
				
			}
			else
			{
				$flag=1;
				$image_data = $this->upload->data();
				$this->load->library('image_lib');
				$upName=$image_data['file_name'];
				
				$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $this->gallery_path . '/thumbnails',
				'maintain_ration' => true,
				'width' => 100,
				'height' => 100
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
				$img=$upName;
				return $img;
			}
			
		}else{
			
		}	
		//return $img
	}



public function conference_room_list(){
	
	    authenticate(array('ut1','ut6'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['confrence_rooms']= $this->rooms_model->get_conference_rooms();
		$data['cities']=$this->lm->getcities();
		$this->load->view("conference_rooms",$data);		
	
	
}

	public function meeting_room_list()
	{
		 authenticate(array('ut1','ut6'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['meeting_rooms']= $this->rooms_model->get_meeting_rooms();
		$data['cities']=$this->lm->getcities();
        $this->load->view("meeting_rooms",$data);		
	}
	public function day_office_list()
	{
		 authenticate(array('ut1','ut6'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['day_rooms']= $this->rooms_model->get_day_offices();
		$data['cities']=$this->lm->getcities();
        $this->load->view("day_office_list",$data);		
	}
	
	public function games_room_list()
	{
		 authenticate(array('ut1','ut6'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['game_rooms']= $this->rooms_model->get_game_rooms();
		$data['cities']=$this->lm->getcities();
        $this->load->view("game_rooms",$data);		
	}

	public function locker_room_list()
	{
		 authenticate(array('ut1','ut6'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['locker_room']= $this->rooms_model->get_locker_rooms();
		$data['cities']=$this->lm->getcities();
        $this->load->view("locker_room",$data);		
	}

     public function vendor_dashboard(){
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['classified']= $this->Vendor_model->get_classified_details($userId);
		$this->load->view("vendor_dashboard",$data);	
       }
       
    
 public function edit_meeting_room($meeting_id)
 {	
	  authenticate(array('ut1','ut6'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['meeting_room']= $this->rooms_model->get_meeting_room($meeting_id);
    $data['business']=$this->rooms_model->getbuisnessbylocationcity($data['meeting_room'][0]['city'],$data['meeting_room'][0]['location']);
    $data['cities']=$this->lm->getcities();
    $data['location']=$this->lm->getlocationbycity($data['meeting_room'][0]['city']);
	 if (isset($_POST) && (!empty($_POST)))
	 {  
 		
			$data=array(
					   	'meeting_id'=>$meeting_id,
					   	'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'location'=>$this->input->post('location'),		
						'city'=>$this->input->post('city'),				
						'start_time'=>$this->input->post('start_time'),
						'end_time'=>$this->input->post('end_time'),
						'time_slot'=>$this->input->post('time_slot'),	
						'price'=>$this->input->post('price'),				
						'dateModified'=>date('Y-m-d H:i:s')																		
						);
						
					if($_FILES['ListeeTypeImage']['name']!="")
					{	
							$image=$this->rooms_model->get_meeting_room($meeting_id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   
		   }
						
						$imageid=$this->input->post('image_id');	
						$image=$this->doUpload('ListeeTypeImage',$imageid);	
						$data1=array(						
										'imageName'=>$image,									
									);
						$result1 = update_tbl('rooms_images','id',$imageid,$data1);
		 
					}
				$result = update_tbl('meeting_room','meeting_id',$meeting_id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/meeting_room_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_meeting_room/'.$meeting_id);
				}
       
      } 
   
   
  
   
    $this->load->view("edit_meeting_room",$data);
    
 }
 public function edit_day_office($day_id)
 {	
	  authenticate(array('ut1','ut6'));
    $userId = $this->session->userdata("userId");
    $data['userData'] = $this->login->getUserProfile($userId);
    $data['day_office']= $this->rooms_model->get_day_office($day_id);
    $data['business']=$this->rooms_model->getbuisnessbylocationcity($data['day_office'][0]['city'],$data['day_office'][0]['location']);
    $data['cities']=$this->lm->getcities();
    $data['location']=$this->lm->getlocationbycity($data['day_office'][0]['city']);
 
	 if (isset($_POST) && (!empty($_POST)))
	 {  
 		
			$data=array(
					   	'dayoffice_id'=>$day_id,
					   	'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'location'=>$this->input->post('location'),		
						'city'=>$this->input->post('city'),				
						'start_time'=>$this->input->post('start_time'),
						'end_time'=>$this->input->post('end_time'),
						'time_slot'=>$this->input->post('time_slot'),	
						'price'=>$this->input->post('price'),				
						'dateModified'=>date('Y-m-d H:i:s')																		
						);
						
					if($_FILES['ListeeTypeImage']['name']!="")
					{	
							$image=$this->rooms_model->get_day_office($day_id);
							
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		   
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   
		   }
						
						$imageid=$this->input->post('image_id');	
						$image=$this->doUpload('ListeeTypeImage',$imageid);	
						$data1=array(						
										'imageName'=>$image,									
									);
						$result1 = update_tbl('rooms_images','id',$imageid,$data1);
						
		 
					}
				$result = update_tbl('day_office','dayoffice_id',$day_id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/day_office_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_day_office/'.$day_id);
				}
       
      } 
   
   
   
    $this->load->view("edit_day_office",$data);
    
 }
 public function edit_conference_room($conference_id)
 {
	 authenticate(array('ut1','ut6'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['conference_room']= $this->rooms_model->get_conference_room($conference_id);
    $data['business']=$this->rooms_model->getbuisnessbylocationcity($data['conference_room'][0]['city'],$data['conference_room'][0]['location']);
    $data['cities']=$this->lm->getcities();
    $data['location']=$this->lm->getlocationbycity($data['conference_room'][0]['city']);
      
     if (isset($_POST) && (!empty($_POST))){
 		
			$data=array(
					   
						'conference_id'=>$conference_id,
						'description'=>$this->input->post('desc'),
						'location'=>$this->input->post('location'),
						'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'city'=>$this->input->post('city'),
					     'start_time'=>$this->input->post('start_time'),
						'end_time'=>$this->input->post('end_time'),
						'time_slot'=>$this->input->post('time_slot'),	
						'price'=>$this->input->post('price'),
						'dateModified'=>date('Y-m-d H:i:s')
						);
						
					if($_FILES['ListeeTypeImage']['name']!=""){	
						$image=$this->rooms_model->get_conference_room($conference_id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   
		   }
						
					$imageid=$this->input->post('image_id');	
					$image=$this->doUpload('ListeeTypeImage',$imageid);	
					$data1=array(
			
			
			'imageName'=>$image,
			
			
			
			);
		    $result1 = update_tbl('rooms_images','id',$imageid,$data1);
				}
				$result = update_tbl('conference_room','conference_id',$conference_id,$data);
				
			
				if($result == 1)
				{
				$this->session->set_flashdata('edit',"You have successfully upadded.");
			     redirect(base_url().'index.php/rooms/conference_room_list');

			}else{
				$this->session->set_flashdata('edit',"Your updation is not completed.");
			     redirect(base_url().'index.php/rooms/edit_conference_room/'.$conference_id);
			}
       
      } 
   
   

   
    $this->load->view("edit_conference_room",$data);
    
 }
 
  public function edit_game_room($game_id)
 {	
	  authenticate(array('ut1','ut6'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['game_room']= $this->rooms_model->get_game_room($game_id);
    $data['cities']=$this->lm->getcities();
    $data['location']=$this->lm->getlocationbycity($data['game_room'][0]['city']);
    $data['business']=$this->rooms_model->getbuisnessbylocationcity($data['game_room'][0]['city'],$data['game_room'][0]['location']);
     $data['all_game_types']=$this->rooms_model->all_game_types(); 
     if (isset($_POST) && (!empty($_POST)))
	 {  
 		
 		 $game_type=$this->input->post('chkbox');
		    $str = implode (",", $game_type);
			$data=array(
					   	'game_id'=>$game_id,
					   	'name'=>$this->input->post('name'),
						'business_id'=>$this->input->post('business'),
						'description'=>$this->input->post('desc'),
						'game_type'=>$str,
						'location'=>$this->input->post('location'),		
						'city'=>$this->input->post('city'),
						'price'=>$this->input->post('price'),					
						'dateModified'=>date('Y-m-d H:i:s')																		
						);
						
					if($_FILES['ListeeTypeImage']['name']!="")
					{	
			$image=$this->rooms_model->get_game_room($game_id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   
		   }
						$imageid=$this->input->post('image_id');	
						$image=$this->doUpload('ListeeTypeImage',$imageid);	
						$data1=array(						
										'imageName'=>$image,									
									);
						$result1 = update_tbl('rooms_images','id',$imageid,$data1);
		 
					}
				$result = update_tbl('game_room','game_id',$game_id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/games_room_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_game_room/'.$game_id);
				}
       
      } 
   
   
  
   
    $this->load->view("edit_game_room",$data);
    
 }
 public function edit_game_types($id)
 {	
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['game_types']= $this->rooms_model->get_game_types($id);
    $data['vendor']=$this->business_model->getvendor();	
      
     if (isset($_POST) && (!empty($_POST)))
	 {  
		 	if($this->input->post('vendor_user_id')!=''){
						$ownerId=$this->input->post('vendor_user_id');
					}else{
						$ownerId=$this->session->userdata("userId");
					}
 		
			$data=array(
						
						'name'=>$this->input->post('name'),
						'ModifiedBy'=>$this->session->userdata("userId"),
						'ownerId'=>$ownerId,															
					
						
					
						'dateModified'=>date('Y-m-d H:i:s')
						);
						
				$result = update_tbl('game_types','id',$id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/game_types_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_game_types/'.$id);
				}
       
      } 
   
   
   
   
    $this->load->view("edit_game_types",$data);
    
 }
 public function edit_subscription_type($id)
 {	
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['subscription_type']= $this->rooms_model->get_subscription_type($id);
   
      
     if (isset($_POST) && (!empty($_POST)))
	 {  
		 
 		
			$data=array(
						
						'name'=>$this->input->post('name'),
						'price'=>$this->input->post('price'),
						'ModifiedBy'=>$this->session->userdata("userId"),
																				
					
						
					
						'dateModified'=>date('Y-m-d H:i:s')
						);
						
				$result = update_tbl('subscription','id',$id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/subscription_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_subscription_type/'.$id);
				}
       
      } 
   
   

   
    $this->load->view("edit_subscription_type",$data);
    
 }
public function edit_courier_types($id)
 {	
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['courier_types']= $this->rooms_model->get_courier_types($id);
   //$	
      
     if (isset($_POST) && (!empty($_POST)))
	 {  
		 
			$data=array(
						
						'name'=>$this->input->post('name'),
						'ModifiedBy'=>$this->session->userdata("userId"),
					    'dateModified'=>date('Y-m-d H:i:s')
						);
						
				$result = update_tbl('courier_types','id',$id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/courier_types_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_courier_types/'.$id);
				}
       
      } 
   
  
   
    $this->load->view("edit_courier_types",$data);
    
 }
 public function edit_concierge_types($id)
 {	
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['concierge_types']= $this->rooms_model->get_concierge_types($id);
 
      
     if (isset($_POST) && (!empty($_POST)))
	 {  

			$data=array(
						
						'name'=>$this->input->post('name'),
						'ModifiedBy'=>$this->session->userdata("userId"),
						'dateModified'=>date('Y-m-d H:i:s')
						);
						
				$result = update_tbl('concierge_types','id',$id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/concierge_types_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_concierge_types/'.$id);
				}
       
      } 
   
   
   
   
    $this->load->view("edit_concierge_types",$data);
    
 }
public function edit_cafe_types($id)
 {	
	  authenticate(array('ut6','ut1'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['cafe_types']= $this->rooms_model->get_cafe_types($id);
    $data['cafe_type']=$this->rooms_model->getcafecategory();	
  	
      
     if (isset($_POST) && (!empty($_POST)))
	 {  
		 	
 		$supported_image = array(
    'gif',
    'jpg',
    'jpeg',
    'png'
);
 		$imgname=$this->input->post('hid_cafe_img');
        if($_FILES['cafe_image']['name']!=""){
        	$ext = strtolower(pathinfo($_FILES['cafe_image']['name'], PATHINFO_EXTENSION)); // Using 
        	$imgname=$id.".".$ext;
        	$old_image=$this->input->post('hid_cafe_img');
        	
			if (in_array($ext, $supported_image)) {
				if($this->input->post('hid_cafe_img')!=""){
			            $img=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/cafe_image/'.$old_image;
			    		if(file_exists($img)){
						               
			                unlink($img);
			    			if(move_uploaded_file($_FILES['cafe_image']['tmp_name'],'assets/uploads/images/cafe_image/'.$imgname)){

			    	echo 'file uploaded';
			    }
			    else{
			    	echo 'file not uploaded';
			    }
			    		}
			    	}else{
			    		if(move_uploaded_file($_FILES['cafe_image']['tmp_name'],'assets/uploads/images/cafe_image/'.$imgname)){

			    	echo 'file uploaded';
			    }
			    else{
			    	echo 'file not uploaded';
			    }
			    	}
			    
			    }
			 else {
			    $this->session->set_flashdata('edit',"Your image file should be jpg,gif,jpeg or png type.");
				redirect(base_url().'index.php/rooms/edit_cafe_types/'.$id);
			}
        }
 		$cafe_id= $this->input->post('cafe_id');
		    if($cafe_id=='1'){
				$cafe_id='';
		}
		 $price= $this->input->post('price');
		    if($price==""){
				$price='';
		}
		
			$data=array(
						
					 	'name'=>$this->input->post('name'),
					 	'city_id'=>$this->input->post('city'),
						'location_id'=>$this->input->post('location'),
					 	'price'=>$price,
					    'parent_id'=>$cafe_id,
						'ModifiedBy'=>$this->session->userdata("userId"),
						'image'=>$imgname,
						'dateModified'=>date('Y-m-d H:i:s')
						);		
				$result = update_tbl('cafe_types','id',$id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/cafe_types_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_cafe_types/'.$id);
				}
       
      } 
   
   
   
    $data['location']=$this->lm->getlocationbycity($data['cafe_types'][0]['city_id']);
	$data['cities']=$this->lm->getcities();
    $this->load->view("edit_cafe_types",$data);
    
 }

public function edit_locker_room($locker_id)
 {	
	  authenticate(array('ut1','ut6'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['locker_room']= $this->rooms_model->get_locker_room($locker_id);
    $data['cities']=$this->lm->getcities();
    $data['location']=$this->lm->getlocationbycity($data['locker_room'][0]['city']);
    $data['business']=$this->rooms_model->getbuisnessbylocationcity($data['locker_room'][0]['city'],$data['locker_room'][0]['location']); 
     if (isset($_POST) && (!empty($_POST)))
	 {  
		  $game_type=$this->input->post('chkbox');
		    $str = implode (",", $game_type);
 		
			$data=array(
					   	'locker_id'=>$locker_id,
					   	'name'=>$this->input->post('name'),
						'description'=>$this->input->post('desc'),
						'locker_type'=>$str,
						'location'=>$this->input->post('location'),		
						'city'=>$this->input->post('city'),
						'price'=>$this->input->post('price'),			
						'dateModified'=>date('Y-m-d H:i:s')																		
						);
						
					if($_FILES['ListeeTypeImage']['name']!="")
					{	
						$image=$this->rooms_model->get_locker_room($locker_id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   
		   }
						$imageid=$this->input->post('image_id');	
						$image=$this->doUpload('ListeeTypeImage',$imageid);	
						$data1=array(						
										'imageName'=>$image,									
									);
						$result1 = update_tbl('rooms_images','id',$imageid,$data1);
		 
					}
				$result = update_tbl('locker_room','locker_id',$locker_id,$data);
				
			
				
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
					 redirect(base_url().'index.php/rooms/locker_room_list');

				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
					redirect(base_url().'index.php/rooms/edit_locker_room/'.$locker_id);
				}
       
      } 
   
   
  
   
    $this->load->view("edit_locker_room",$data);
    
 } 
 
 public function delete_classified($id)
 {
	 
	   $data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('classifieds','classifiedId',$id,$data);
		  
	   if($result)
	   {
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/vendor/vendor_dashboard');
	   }
 }
 
public function delete_meeting_room($id)
{
	 authenticate(array('ut1','ut6'));
	$data=array(
					'deleted'=>'1'
				);
	$result = update_tbl('meeting_room','meeting_id',$id,$data);
	
		  
	   if($result)
	   {
		    $image=$this->rooms_model->get_meeting_room($id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/full/'.$img;
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img1)) {
			 
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   delete_tbl('rooms_images','room_id',$id);
			
		
			} else {
			echo "The file does not exist";
			}
		    
		   
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/meeting_room_list');
	   }		
} 
 public function delete_day_office($id)
{
	 authenticate(array('ut1','ut6'));
	$data=array(
					'deleted'=>'1'
				);
	$result = update_tbl('day_office','dayoffice_id',$id,$data);
	
		  
	   if($result)
	   {
		    $image=$this->rooms_model->get_day_office($id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/full/'.$img;
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/smartworks/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img1)) {
			 
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   delete_tbl('rooms_images','room_id',$id);
			
		
			} else {
			echo "The file does not exist";
			}
		    
		   
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/day_office_list');
	   }		
} 
public function delete_conference_room($id)
{
	 authenticate(array('ut1','ut6'));
	$data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('conference_room','conference_id',$id,$data);
		  
	    if($result)
	   {
		    $image=$this->rooms_model->get_conference_room($id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   delete_tbl('rooms_images','room_id',$id);
			  
		
			} else {
			echo "The file does not exist";
			}
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/conference_room_list');
	   }		
}

public function delete_game_types($id)
{
	 authenticate(array('ut6','ut1'));
	$data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('game_types','id',$id,$data);
		  
	   if($result)
	   {
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/game_types_list');
	   }		
}
public function delete_courier_types($id)
{
	 authenticate(array('ut6','ut1'));
	$data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('courier_types','id',$id,$data);
		  
	   if($result)
	   {
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/courier_types_list');
	   }		
}
public function delete_concierge_types($id)
{
	 authenticate(array('ut6','ut1'));
	$data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('concierge_types','id',$id,$data);
		  
	   if($result)
	   {
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/concierge_types_list');
	   }		
}
public function delete_cafe_types($id)
{
	 authenticate(array('ut6','ut1'));
	
	$data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('cafe_types','id',$id,$data);
		 $result1= update_tbl('cafe_types','parent_id',$id,$data);
	   if($result)
	   {
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/cafe_types_list');
	   }		
}
public function delete_game_room($id)
{
	 authenticate(array('ut1','ut6'));
	$data=array(
					'deleted'=>'1'
				);
	$result = update_tbl('game_room','game_id',$id,$data);
		  
	    if($result)
	   {
		    $image=$this->rooms_model->get_game_room($id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   delete_tbl('rooms_images','room_id',$id);
			  
		
			} else {
			echo "The file does not exist";
			}
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/games_room_list');
	   }		
}

public function delete_locker_room($id)
{
	 authenticate(array('ut1','ut6'));
	$data=array(
					'deleted'=>'1'
				);
	$result = update_tbl('locker_room','locker_id',$id,$data);
		  
	      if($result)
	   {
		    $image=$this->rooms_model->get_locker_room($id);
		    $img=$image[0]['imageName'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/full/'.$img;
		   
		    $img2=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/small/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/images/thumbnails/'.$img;
		    
		   if(file_exists($img4)) {
			  
			   unlink($img1);
			   unlink($img2);
			   unlink($img3);
			   unlink($img4);
			   delete_tbl('rooms_images','room_id',$id);
			  
		
			} else {
			echo "The file does not exist";
			}
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/rooms/locker_room_list');
	   }		
}

  
	
	
	
	

	
	
	 
	
	
	public function getlocationbycity()
	{
		
		$cityid=$_POST['id'];
		
	    $data['location']=$this->lm->getlocationbycity($cityid);	
		
		if(!empty($data['location']))
		{
			echo '<option value="0">Select Location</option>';
			foreach($data['location'] as $key=>$value)
			{
				echo '<option value="'.$value['locationId'].'">'.$value['name'].'</option>'; 
			}			
		}else{
			
			echo '<option value="0">No Location Available</option>';
		}	
			
	}
	
	public function getBusinessByLocation()
	{
		$location_id=$_POST['id'];
		$cityid=$_POST['city'];
		
	    $data['business']=$this->rooms_model->getbuisnessbylocationcity($cityid,$location_id);	
	
		if(!empty($data['business']))
		{
			echo '<option value="0">Select Business</option>';
			foreach($data['business'] as $key=>$value)
			{
				echo '<option value="'.$value['business_id'].'">'.$value['businessName'].'</option>'; 
			}			
		}else{
			echo '<option value="0">No Business Centers</option>';
			
		}	
			
	}
	
	public function change_room_bybusiness(){
	
	    $business_id=$_POST['id'];
	    $roomtype=$_POST['roomtype'];
	    $data['result']=$this->rooms_model->getbusinesslocation($business_id,$roomtype);			
			
		if($roomtype=='conference'){
		$data['edit']='edit_conference_room';
		$data['delete']='delete_conference_room';
		}else if($roomtype=='meeting'){
			$data['edit']='edit_meeting_room';
			$data['delete']='delete_meeting_room';
			
		}else if($roomtype=='locker'){
			$data['edit']='edit_locker_room';
			$data['delete']='delete_locker_room';
			
		}
		else if($roomtype=='game'){
			$data['edit']='edit_game_room';
			$data['delete']='delete_game_room';
			
		}else if($roomtype=='dayoffice'){
			$data['edit']='edit_day_office';
			$data['delete']='delete_day_office';
			
		}
		 $this->load->view("change_room_bylocation",$data);		
	}

	public function changeroomStatus()
	{
		 authenticate(array('ut1','ut6'));
		
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];		
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->rooms_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changeroomStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changeroomStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
	
	
	public function changegametypeStatus()
	{
		 authenticate(array('ut6','ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];
					
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->rooms_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changegametypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changegametypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
		public function changesubscriptionStatus()
	{
		 authenticate(array('ut6','ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];
					
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->rooms_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changesubscriptionStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changesubscriptionStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
	public function changecouriertypeStatus()
	{
		 authenticate(array('ut6','ut1'));
		
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];
					
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->rooms_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changecouriertypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changecouriertypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
	public function changeconciergetypeStatus()
	{
		 authenticate(array('ut6','ut1'));
		
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];
					
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->rooms_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changeconciergetypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changeconciergetypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
	public function changecafetypeStatus()
	{
		 authenticate(array('ut6','ut1'));
		
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$table=$_POST['_table'];
			$pid=$_POST['_pid'];
					
			$arr = array(
				'status' => $status,
				
				'dateModified' => date('Y-m-d H:i:s')
				);								
		    $result = $this->rooms_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changecafetypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changecafetypeStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
}
