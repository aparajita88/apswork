<?php
class Vendor extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('complaints/complaints_model');
	    $this->load->model('Vendor_model');
	    $this->load->helper('common');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
	
	}



 public function add_classified()
	{
		 authenticate(array('ut3'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		
	
		
		if (isset($_POST) && (!empty($_POST))){
			$classifiedid=create_guid();
		
			$data=array(
						'classifiedId'=>$classifiedid,
						'classifiedName'=>$this->input->post('classifieds_name'),
						'classifiedUserId'=>$userId,
						'ownerId'=>$this->session->userdata('userId'),
						'address'=>$this->input->post('address'),
						'street_address'=>$this->input->post('street_address'),
						'slug'=>str_replace(" ","-",$this->input->post('classifieds_name')),
						'days'=>$this->input->post('days'),
						'state'=>$this->input->post('state'),
						'pincode'=>$this->input->post('zip'),
						'cityId'=>$this->input->post('city'),
						'countryId'=>$this->input->post('country'),
						'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
						'maxPrice'=>$this->input->post('maxPrice'),
						'minPrice'=>$this->input->post('minPrice'),
						'status'=>'1',
						'shortDescription'=>$this->input->post('shortDescription'),
						'longDescription'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateAdded'=>gmdate('Y-m-d H:i:s')
						);
			
			$imageid=create_guid();
		    $image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!=""){
				
			$result = insert_into_tbl('classifieds',$data);	
			$data1=array(
			
			'id'=>$imageid,
			'serviceId'=>$classifiedid,
			'imageName'=>$image,
			'isdefault'=>'1',
			'deleted'=>'0',
			'dateAdded'=>gmdate('Y-m-d H:i:s'),
			'primaryImage'=>'1',
			'status'=>'1'
			);
			
			$result1 = insert_into_tbl('service_images',$data1);
			$this->session->set_flashdata('edit',"You have successfully added.");
			redirect(base_url().'index.php/vendor/vendor_dashboard');
		}else{
		redirect(base_url().'index.php/vendor/add_classified',$data);	
		}
			
			
	}
	
	$this->load->view("add_classified",$data);
}

public function doUpload($fieldName,$imageid){
	
		if($_FILES[$fieldName]['name']!=""){ 
			$value = $_FILES[$fieldName]['name'];
			
			$config = array(
			'file_name' => $imageid,
			 'encrypt_name' => 'FALSE',
			'allowed_types' => 'jpg|jpeg|gif|png|pdf',
			'upload_path' => $this->gallery_path.'/full',
			'max_size' => 2000
			
			);
			
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload($fieldName)) {
				$error = $this->upload->display_errors();
			   $this->session->set_flashdata('item_error',$error);
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
				$img=$upName;
				return $img;
			}
			
		}else{
			
		}	
		
	}






     public function vendor_dashboard(){
		  authenticate(array('ut3'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['count_classified']= $this->Vendor_model->get_classified_count_details($userId);
		$data['count_complaints']= $this->complaints_model->get_all_complaints($userId);
		$data['count_classified']=count($data['count_classified']);
		$data['count_complaints']=count($data['count_complaints']);
		$data['classified']= $this->Vendor_model->get_classified_details($userId,'10');
		$this->load->view("vendor_dashboard",$data);	
       }
       
        public function office_list(){
			  authenticate(array('ut3'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$limit='10';
		$data['classified']= $this->Vendor_model->get_classified_details($userId,$limit);
        $this->load->view("office_list",$data);	
       }
       
       
    public function edit_classified($classified_id)
       { 
		     authenticate(array('ut3'));
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['classified']= $this->Vendor_model->get_classified($classified_id);
      
     if (isset($_POST) && (!empty($_POST))){
 		
			$data=array(
					   
						'classifiedUserId'=>$userId,
						'ownerId'=>$this->session->userdata('userId'),
						'address'=>$this->input->post('address'),
						'street_address'=>$this->input->post('street_address'),
						'slug'=>str_replace(" ","-",$this->input->post('classifieds_name')),
						'days'=>$this->input->post('days'),
						'state'=>$this->input->post('state'),
						'pincode'=>$this->input->post('zip'),
						'cityId'=>$this->input->post('city'),
						'countryId'=>$this->input->post('country'),
						'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
						'maxPrice'=>$this->input->post('maxPrice'),
						'minPrice'=>$this->input->post('minPrice'),
						'status'=>'1',
						'shortDescription'=>$this->input->post('shortDescription'),
						'longDescription'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateModified'=>date('Y-m-d h:i:s')
						);
						
				$result = update_tbl('classifieds','classifiedId',$classified_id,$data);
				
				if($result == 1)
				{
				$this->session->set_flashdata('edit',"You have successfully upadded.");
			     redirect(base_url().'index.php/vendor/edit_classified/'.$classified_id);

			}else{
				$this->session->set_flashdata('edit',"Your updation is not completed.");
			     redirect(base_url().'index.php/vendor/edit_classified/'.$classified_id);
			}
       
      } 
   
   
   
   
    $this->load->view("edit_classified",$data);
}
 public function delete_classified($id)
   {
	     authenticate(array('ut3'));
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

  public function statusChangeClassified($classifiedid,$val)
	{
		  authenticate(array('ut3'));
           
		$result=$this->Vendor_model->statusChangeClassified($classifiedid,$val);
		echo $result;
		
	}
	
	public function add_classified_images($classified_id){
	  authenticate(array('ut3'));	
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['classified']= $this->Vendor_model->get_classified($classified_id);
	$data['res']= $this->Vendor_model->get_classified_images($classified_id);	
	if($this->input->post("sub_image"))
	{
		   
		   
		   
			   
	   if($_FILES['service_img']['name'] != "")
	   {
		   
		   $pth = $this->gallery_path.'/full';
		   $pth_thumb = $this->gallery_path.'/thumbnails';
		   
		   $config['upload_path'] = $this->gallery_path.'/full';
		   $config['allowed_types'] = 'gif|jpg|jpeg|png';
		   $config['encrypt_name'] = TRUE;	
		   $this->load->library('upload', $config);
			$this->upload->initialize($config);  
		  
		   if($this->upload->do_upload('service_img') == False)
		   {
			   
			   $error = $this->upload->display_errors();
			   $this->session->set_flashdata('item_error',$error);
		   }
		   else{
			   
			   $uploadedfile = $upld_dt = array('upload_data' => $this->upload->data());
			   $flname = $upld_dt['upload_data']['file_name'];
			   $original_width=$upld_dt['upload_data']['image_width'];
			   $original_height=$upld_dt['upload_data']['image_height'];
			   $thumb_w=150;
			   $thumb_h=150;
			   $config1 = array(
							   'image_library' => 'gd2',
							   'source_image' => $this->gallery_path.'/full/'.$flname, //get original image
							   'new_image' => $this->gallery_path.'/small/', //save as new image //need to create thumbs first
							   'maintain_ratio' => true,
							   'quality'=>'90%',
							   'width' => $thumb_w,
							   'height' => $thumb_h
								
							 );
			   $this->load->library('image_lib');
			   $this->image_lib->initialize($config1);
			   $this->image_lib->resize(); //generating thumb
			   if (!$this->image_lib->resize()) {
				  $error = $this->image_lib->display_errors();
				$this->session->set_flashdata('item_error',$error); 
				   
			   }
			   $this->image_lib->clear();
			   
			    $thumb_w=200;
			   $thumb_h=200;
			   $config2 = array(
							   'image_library' => 'gd2',
							   'source_image' => $this->gallery_path.'/full/'.$flname, //get original image
							   'new_image' => $this->gallery_path.'/thumbnails/', //save as new image //need to create thumbs first
							   'maintain_ratio' => FALSE,
							    'width' => $thumb_w,
							   'height' => $thumb_h,
							  
							   'quality'=>'90%'
																		
							 );
			   
			   $this->load->library('image_lib');
			   $this->image_lib->initialize($config2);
			   $this->image_lib->resize(); //generating thumb
			   if (!$this->image_lib->resize()) {
				   $error = $this->image_lib->display_errors();
				$this->session->set_flashdata('item_error',$error); 
			   }
			   $this->image_lib->clear();
			   
				
				
				
			   $thumb_w=520;
			   $thumb_h=480;
			   $config3 = array(
							   'image_library' => 'gd2',
							   'source_image' => $this->gallery_path.'/full/'.$flname, //get original image
							   'new_image' => $this->gallery_path.'/medium/', //save as new image //need to create thumbs first
							   'maintain_ratio' => FALSE,
							    'width' => $thumb_w,
							   'height' => $thumb_h,
							   
							   'quality'=>'90%'
																		
							 );
			  
			   
			   $this->load->library('image_lib');
			   $this->image_lib->initialize($config3);
			   $this->image_lib->resize(); //generating thumb
			   if (!$this->image_lib->resize()) {
				   $error = $this->image_lib->display_errors();
				$this->session->set_flashdata('item_error',$error); 
			   }
			   $this->image_lib->clear();
			   
				
				
				
										   
			   
						   
			   $data=array(
						   'id'=>create_guid(),
						   'serviceId'=>$classified_id,
						   'imageName'=>$flname,'isdefault'=>'1',
						   'deleted'=>'0',
							'dateAdded'=>date('Y-m-d H:i:s'),
							'primaryImage'=>'0',
							'status'=>'1'
						  );
			   $result = insert_into_tbl('service_images',$data);
			   if($result)
			   {
				 $this->session->set_flashdata('edit',"You have successfully uploded.");
			    redirect(base_url().'index.php/vendor/add_classified_images/'.$classified_id);
			   }
			   
		   }
	   
	   }
					
						
	   redirect(base_url().'index.php/vendor/add_classified_images/'.$classified_id);
	}
		
	else{
	
	 $this->load->view("add_classified_images",$data);		
	}	
	}
	
	
	

		public function delete_classified_image($sid,$id)
	{
		  authenticate(array('ut3'));
		  authenticate(array('ut3'));
		 $data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('service_images','id',$id,$data);
		  
		
		if($result)
		{
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/vendor/add_classified_images/'.$sid);
		}
	}
	
	 public function changeimageorder(){
		
		  authenticate(array('ut3'));
			
				
			$def = explode('_',$this->input->post('def_chng'));
			
			
			     $data = array(
							   
							   "primaryImage" => "0"
							 
							   );
				$result = update_tbl('service_images','serviceId',$def[0],$data);
			 
				 $data = array(
							   
							   "primaryImage" => "1"
							 
							   );
				$result = update_tbl('service_images','id',$def[1],$data);
				if($result)
				{
					$this->session->set_flashdata('edit',"You have successfully updated.");
					echo  $def[1];
				}
			 
		
		
	}
	
	
	public function add_classified_video($classified_id){
	  authenticate(array('ut3'));	
	$userId = $this->session->userdata("userId");
	$data['userData'] = $this->login->getUserProfile($userId);
    $data['classified']= $this->Vendor_model->get_classified($classified_id);
	$data['res']= $this->Vendor_model->get_classified_videos($classified_id);	
	
	
	if($this->input->post("sub_video"))
	{
		
	
			   
	   if($_FILES['service_video']['name'] != "")
	   {
		   $flname=$_FILES['service_video']['name'];
		   $config['encrypt_name'] = TRUE;	
		   $config['file_name'] =$flname;
           $config['upload_path'] = $this->video_gallery_path.'/videos';
		   $config['allowed_types'] = 'mp4|mp4|3gp|mpg|ogg';
		 
          $config['upload_max_filesize']='20M';
		   $this->load->library('upload', $config);
		
		  
		   if($this->upload->do_upload('service_video') == False)
		   {
			   
			   $error = $this->upload->display_errors();
			   $this->session->set_flashdata('item_error',$error);
		   }
		   else{
			    $uploadedfile = $upld_dt = array('upload_data' => $this->upload->data());
			   $flname = $upld_dt['upload_data']['file_name'];
			    
						   
			   $data=array(
						   'id'=>create_guid(),
						   'classifiedID'=>$classified_id,
						   'addedby'=>$userId,
						   'videoName'=>$flname,'isdefault'=>'1',
						   'deleted'=>'0',
							'dateAdded'=>date('Y-m-d h:i:s'),
							'primaryvideo'=>'0',
							'status'=>'1'
						  );
			   $result = insert_into_tbl('classified_videos',$data);
			   if($result)
			   {
				 $this->session->set_flashdata('edit',"You have successfully uploded.");
			    redirect(base_url().'index.php/vendor/add_classified_video/'.$classified_id);
			   }
			   
		   }
		    $this->session->set_flashdata('item_error',"Video is not uploded.");
		    redirect(base_url().'index.php/vendor/add_classified_video/'.$classified_id);
	   
	   }
					
					
	   redirect(base_url().'index.php/vendor/add_classified_video/'.$classified_id);
	}
		
	else{
	
	 $this->load->view("add_classified_video",$data);		
	}	
	}
	
		public function delete_classified_video($cid,$id)
	{
		
		  authenticate(array('ut3'));
		 $data=array(
					'deleted'=>'1'
					);
		$result = update_tbl('classified_videos','id',$id,$data);
		  
		
		if($result)
		{
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/vendor/add_classified_video/'.$cid);
		}
	}
	
	public function changevideoorder(){
		  authenticate(array('ut3'));
		
			
				
			$def = explode('_',$this->input->post('def_chng'));
		
			
			     $data = array(
							   
							   "primaryvideo" => "0"
							 
							   );
				$result = update_tbl('classified_videos','classifiedID',$def[0],$data);
			 
				 $data = array(
							   
							   "primaryvideo" => "1"
							 
							   );
				$result = update_tbl('classified_videos','id',$def[1],$data);
				if($result)
				{
					$this->session->set_flashdata('edit',"You have successfully updated.");
					echo  $def[1];
				}
			 
		
		
	}
	
	
}
