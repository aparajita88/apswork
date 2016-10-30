<?php
class Business extends MY_Controller {

	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('users/user');
		$this->load->model('business_model');
		$this->load->model('location/location_model', 'lm');
		$this->load->model('login/login_model');
		$this->load->model('manager/booking_info');
	   	$this->load->helper('common');
		$this->load->helper('form'); 
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
		
	}
	public function add_business_video($business_id){
	  	authenticate(array('ut6','ut1'));	
		$userId = $this->session->userdata("userId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['business']= $this->business_model->get_business($business_id);
		$data['res']= $this->business_model->get_business_videos($business_id);	
		if($this->input->post("sub_video"))
		{	   
		   if($_FILES['service_video']['name'] != "")
		   {
			   $flname=$_FILES['service_video']['name'];
			   $config['encrypt_name'] = TRUE;	
			   $config['file_name'] =$flname;
	           $config['upload_path'] = $this->video_gallery_path.'/videos';
			   $config['allowed_types'] = '*';
			 
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
							   'businessID'=>$business_id,
							   'addedby'=>$userId,
							   'videoName'=>$flname,'isdefault'=>'1',
							   'deleted'=>'0',
								'dateAdded'=>date('Y-m-d h:i:s'),
								'primaryvideo'=>'0',
								'status'=>'1'
							  );
				   $result = insert_into_tbl('business_videos',$data);
				   if($result)
				   {
					 $this->session->set_flashdata('edit',"You have successfully uploded.");
				    redirect(base_url().'index.php/business/add_business_video/'.$business_id);
				   }
				   
			   }
			    $this->session->set_flashdata('item_error',$error);
			    redirect(base_url().'index.php/business/add_business_video/'.$business_id);
		   
		   }
						
						
		   redirect(base_url().'index.php/business/add_business_video/'.$business_id);
		}else{
		 $this->load->view("add_business_video",$data);		
		}	
	}
	public function delete_business_video($cid,$id)
	{
		authenticate(array('ut6','ut1'));	
	   	$video=$this->business_model->get_business_video($cid,$id);
	    $video=$video[0]['videoName'];
	    $video=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/videos/'.$video;
	   	if(file_exists($video)) {
		   	unlink($video);
		   	delete_tbl('business_videos','id',$id);
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
		 redirect(base_url().'index.php/business/add_business_video/'.$cid);
		}
	}
	public function changevideoorder(){
	 	authenticate(array('ut6','ut1'));	
		$def = explode('_',$this->input->post('def_chng'));
		$data = array("primaryvideo" => "0");
		$result = update_tbl('business_videos','businessID',$def[0],$data);
	 	$data = array("primaryvideo" => "1");
		$result = update_tbl('business_videos','id',$def[1],$data);
		if($result)
		{
			$this->session->set_flashdata('edit',"You have successfully updated.");
			echo  $def[1];
		}	
	}
	public function delete_business_image($sid,$id)
	{
		authenticate(array('ut1','ut6'));
		$image=$this->business_model->get_business_image($sid,$id);
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
			   delete_tbl('business_images','id',$id);
			  
		
			$this->session->set_flashdata('edit',"You have successfully Deleted.");
			 redirect(base_url().'index.php/business/add_business_images/'.$sid);
		}
	}
	public function changeimageorder(){
		
		  authenticate(array('ut1','ut6'));
			$def = explode('_',$this->input->post('def_chng'));
			
			     $data = array(
							   
							   "primaryImage" => "0"
							 
							   );
				$result = update_tbl('business_images','businessId',$def[0],$data);
			 
				 $data = array(
							   
							   "primaryImage" => "1"
							 
							   );
				$result = update_tbl('business_images','id',$def[1],$data);
				if($result)
				{
					$this->session->set_flashdata('edit',"You have successfully updated.");
					echo  $def[1];
				}
	}
	public function add_business_images($business_id){
	  	authenticate(array('ut1','ut6'));	
		$userId = $this->session->userdata("userId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['business']= $this->business_model->get_business($business_id);
		$data['res']= $this->business_model->get_business_images($business_id);	
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
								   //'master_dim' => 'height',
								   //'master_dim' => 'width',
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
							   'businessId'=>$business_id,
							   'imageName'=>$flname,'isdefault'=>'1',
							   'deleted'=>'0',
								'dateAdded'=>date('Y-m-d H:i:s'),
								'primaryImage'=>'0',
								'status'=>'1'
							  );
				   $result = insert_into_tbl('business_images',$data);
				   if($result)
				   {
					 $this->session->set_flashdata('edit',"You have successfully uploded.");
				    redirect(base_url().'index.php/business/add_business_images/'.$business_id);
				   }
				   
			   }
		   }				
		   redirect(base_url().'index.php/business/add_business_images/'.$business_id);
		}
		else{
			$this->load->view("add_business_images",$data);		
		}	
	}
 	public function add_business()
	{
	 	authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['cities']=$this->lm->getcities();
	    $data['vendor']=$this->business_model->getvendor();
		if (isset($_POST) && (!empty($_POST))){
			$business_id=create_guid();
		    $business_id= substr($business_id,0,16);
			if($this->input->post('vendor_user_id')!=''){
				$ownerId=$this->input->post('vendor_user_id');
			}else{
				$ownerId=$this->session->userdata("userId");
			}
			$data=array(
			            'business_id'=>$business_id,
			           	'ownerId'=>$ownerId,
						'businessName'=>$this->input->post('business_name'),
						'address'=>$this->input->post('address'),
						'street_address'=>$this->input->post('street_address'),
						'slug'=>str_replace(" ","-",$this->input->post('business_name')),
						'days'=>$this->input->post('days'),
						'state'=>$this->input->post('state'),
						'pincode'=>$this->input->post('zip'),
						'cityId'=>$this->input->post('city'),
						'locationId'=>$this->input->post('location'),
						'countryId'=>$this->input->post('country'),
						'latitude' => $this->input->post('latitude'),
                        'longitude' => $this->input->post('longitude'),
						'status'=>'1',
						'shortDescription'=>$this->input->post('shortDescription'),
						'longDescription'=>$this->input->post('desc'),
						'addedBy'=>$this->session->userdata('userId'),
						'dateModified'=>date('Y-m-d H:i:s')
						);

		
			
			$imageid=create_guid();
			$imageid= substr($imageid,0,16);
			
			$image=$this->doUpload('ListeeTypeImage',$imageid);
			if($image!=""){
				$result = insert_into_tbl('business_centers',$data);
				$id=create_guid();
			    $id= substr($id,0,16);
	            $d=array(
	                     'Id'=>$id,
				         'business_id'=>$business_id
				        );
				$r=	insert_into_tbl('floor_plan_service',$d);
				$data1=array(
				
				'id'=>$imageid,
				'businessId'=>$business_id,
				'imageName'=>$image,
				'isdefault'=>'1',
				'deleted'=>'0',
				'dateAdded'=>date('Y-m-d H:i:s'),
				'primaryImage'=>'1',
				'status'=>'1'
				);
				
				$result1 = insert_into_tbl('business_images',$data1);
				//$data['userData'] = $this->login->getUserProfile($userId);
				$this->session->set_flashdata('edit',"You have successfully added.");
				redirect(base_url().'index.php/business/manage_business_centers');
			}else{
				redirect(base_url().'index.php/business/add_business',$data);	
			}
		}
		$this->load->view("add_business",$data);
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

				//$this->load->library('image_lib', $config);
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
    public function manage_business_centers()
	{
		authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['business']=$this->business_model->getbusiness($userId);
		$data['cities']=$this->lm->getcities();
		$this->load->view('business_list', $data);		
	}
	public function virtual_attributes_list($id)
	{
		authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['business_name']= $this->business_model->get_business($id);
		$data['office']= $this->business_model->get_office_list($id);
		$this->load->view('virtual_attributes_list', $data);		
	}
	public function set_virtualoffice(){
	    $virtual_id=$_POST['id'];
	    $this->session->unset_userdata('newdata');	
	    $newdata = array('virtual_office_id'=> $virtual_id);
		$this->session->set_userdata('newdata', $newdata);	
		print_r ($this->session->userdata('newdata'));
		exit;
	}
	public function voffice_agreement(){
        authenticate(array('ut1','ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$session_user_data = $this->session->userdata['newdata'];
		$data['v_id']=$session_user_data['virtual_office_id'];
		$data['b_id']=$this->business_model->get_businessdetailesbyvid($data['v_id']);
        $this->load->view('voffice_agreement', $data);
	}
	public function change_business_bylocation(){
		authenticate(array('ut1','ut6'));
		$locationid=$_POST['id'];
		$data['result']=$this->business_model->getlocationcity($locationid);	
		$this->load->view("change_room_bylocation",$data);
	}
	public function getvirtualofficeBybusiness(){
	    authenticate(array('ut1','ut7'));
		$businessid=$_POST['id'];
	    $data['result']=$this->business_model->getvirtualofficeBybusiness($businessid);	
		$this->load->view("ajax_voffice",$data);
    }
    public function send_vofficeagreement(){
    	$id=substr(create_guid(),0,16);
		$agrement_data=array(
			'id'=>$id,
			'agreement_date'=>date('Y-m-d',strtotime($this->input->post('agreement_date'))),
			'reference_number'=>$this->input->post('reference'),
			'v_id'=>$this->input->post('v_id'),
			'b_id'=>$this->input->post('b_id'),
			'booked_for'=>$this->input->post('userId'),
			'first_month_fee'=>$this->input->post('first_month_fee'),
			'registration_fee'=>$this->input->post('registration_fee'),
			'service_retainer'=>$this->input->post('service_retainer'),
			'monthly_payment'=>$this->input->post('monthly_payment'),
			'total_price'=>$this->input->post('total_price'),
			'start_date'=>date('Y-m-d',strtotime($this->input->post('start'))),
			'end_date'=>date('Y-m-d',strtotime($this->input->post('end'))),
			'comment'=>$this->input->post('comments'),
			'booked_by'=>$this->session->userdata("userId"),
			'dateAdded'=>date('Y-m-d h:i:s'),
			'Isclient'=>$this->input->post('Isclient'),
			'company_name'=>$this->input->post('company_name'),
			);
		$this->db->insert('booking_virtual_office',$agrement_data);
		$data_dl=array(						
		      'company'=>$this->input->post('company_name'),									
		       );
		update_tbl('registered_user','userId',$this->input->post('userId'),$data_dl);
		$url=base_url().'business/voffice_agreement_view/'.$id;
		$contname=$this->input->post('contname');
		$email=$this->input->post('email');
		$email_template_id='9326d0d6-d4be-38';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $body = str_replace('[client fullname]',$contname,$body);
		 $body = str_replace('[url]',$url,$body);
		
		 $from_email='sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($email); //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		echo 'You have successfully send the agreement';
	}
	public function voffice_agreement_view($id){
		$data['bid'] = $id;
		$data['view']=$this->business_model->get_voffice_view_detsiles($id);
		if($data['view'][0]['Isclient']=='0'){
			$data['registered_user_info']=	$this->user->getdetails($data['view'][0]['booked_for']);
		}else{
			$data['client_user_info']=$this->login->getUserProfile($data['view'][0]['booked_for']);	
		}
		$this->load->view('voffice_agreement_view', $data);
	}
	public function voffice_agreement_view_print($id){
		$data['view']=$this->business_model->get_voffice_view_detsiles($id);
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['tick'] = $this->gallery_path_url.'tick-box.png';
		if($data['view'][0]['Isclient']=='0'){
			$data['registered_user_info']=	$this->user->getdetails($data['view'][0]['booked_for']);
		}else{
			$data['client_user_info']=$this->login->getUserProfile($data['view'][0]['booked_for']);	
		}
		$html = $this->load->view('voffice_agreement_view_pdf', $data, true);
		ini_set('memory_limit','32M');
		$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetTitle("Smartworks :: Virtual office agreement");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->WriteHTML($html,2);
		$attachment_name = 'Smartworks_virtual_office_agreement'.date('d_M_Y').'.pdf'; // pdf attachment file name
		$pdfname = $attachment_name;
	    $mpdf->Output($pdfname,'D'); // D for direct download and I for open in browser
	}
	public function accept_vofficeagreement(){
		$booking_id=$this->input->post('booking_id');
		$userId=$this->input->post('userId');
		$company_name=$this->input->post('company_id');
		$data['view']=$this->business_model->get_voffice_view_detsiles($booking_id);
		$booked_for=$data['view'][0]['booked_for'];
		
		if($this->input->post('is_client')=='0'){
			$data['info']=$this->user->getdetails($booked_for);
			$cmp=$this->business_model->chk_company($company_name);
			if(count($cmp)!='0'){
            $c_id=$cmp[0]['id'];
			}else{
			$c_id=substr(create_guid(),0,16);	
			$c_array=array(
               'id'=> $c_id,
			   'company_name'=>$company_name,
			   'company_account_no'=>rand(1000000,9999999),
				'address'=>$data['info'][0]['street'],
				'city_id'=>$data['info'][0]['cityId'],
		        'location_id'=>$data['info'][0]['locationId'],
		        'added_by'=>$this->session->userdata("userId"),
		        'date_added'=>date('Y-m-d h:i:s'),
		         'status'=>'1'
				);
			$this->db->insert('company',$c_array);
			}
			$data['info']=$this->user->getdetails($booked_for);
			$password=$this->get_random_password();
			$inputArray=array(
			   'userId'=> $data['info'][0]['userId'],
			   'userEmail'=>$data['info'][0]['userEmail'],
			   'userName'=>$data['info'][0]['userEmail'],
				'password'=>md5($password),
				'userTypeId'=>'ut4',
				'FirstName'=>$data['info'][0]['FirstName'],
				'LastName'=>$data['info'][0]['LastName'],
				'gender'=>$data['info'][0]['gender'],
			        'location_id'=>$data['info'][0]['locationId'],
				'city_id'=>$data['info'][0]['cityId'],
				 'phone'=>$data['info'][0]['phone'],
				 'company_id'=>$c_id,
				 'is_company'=>'1',
				 'can_view_bill'=>'1',
                                 'dateAdded'=>date('Y-m-d H:i:s'),
				 'Isprimary'=>'1',
				'addedBy'=>$this->session->userdata("userId")
			);			
			$this->db->insert('user',$inputArray);
			$profileArray=array(
				'userProfileId'=>substr(create_guid(),0,16),	
			 	'userId'=> $data['info'][0]['userId'],	
			);
			$this->db->insert('user_profile',$profileArray);
			$data_dl=array(						
		       'deleted'=>'1',									
		       );
			update_tbl('registered_user','userId',$data['info'][0]['userId'],$data_dl);
			$in_id=substr(create_guid(),0,16);
			$invoice_insert_data=array(
				'id'=>$in_id,
				'invoice_number'=>rand(10000000,99999999),
				'invoice_date'=>date('Y-m-d'),
				'customerId'=>$c_id,
				'sub_total'=>$data['view'][0]['total_price'],
			);
			$this->booking_info->add_invoice($invoice_insert_data);
			$invoice_item_data=array(
				'id'=>substr(create_guid(),0,16),
				'invoice_id'=>$in_id,
				'description'=>'voffice_booking',
				'quantity'=>'1',
				'unit_price'=>$data['view'][0]['total_price'],
				'total'=>$data['view'][0]['total_price'],
				'table_name'=>'booking_virtual_office',
				'row_id'=>$data['view'][0]['id'],
			);
			$this->db->insert('invoice_items',$invoice_item_data);
		}else{
			$data['info_client']=$this->login->getUserProfile($data['view'][0]['booked_for']);
			$invoice_data=$this->business_model->get_invoice_by_comid($data['info_client']['company_id']);
			$invoice_id=$invoice_data[0]['id'];
			$invoice_price=$invoice_data[0]['sub_total']+$data['view'][0]['total_price'];
         	$invoice_data=array(
				'sub_total'=>$invoice_price
			);
		 	$invoice_item_data=array(
				'id'=>substr(create_guid(),0,16),
				'invoice_id'=>$invoice_id,
				'description'=>'voffice_booking',
				'quantity'=>'1',
				'unit_price'=>$data['view'][0]['total_price'],
				'total'=>$data['view'][0]['total_price'],
				'table_name'=>'booking_virtual_office',
				'row_id'=>$data['view'][0]['id'],
			);
			$this->business_model->process_request($invoice_id,$invoice_data,$invoice_item_data);
		}
		$data1=array(						
		'isApproved'=>$this->input->post('isApproved'),									
		);
		$result = update_tbl('booking_virtual_office','id',$booking_id,$data1);
		//$url='<a href="'.base_url().'business/voffice_agreement_view/'.$booking_id.'</a>';
		$url='<a href="'.base_url().'business/voffice_agreement_view/'.$booking_id.'">'.base_url().'business/voffice_agreement_view/'.$booking_id.'</a>';
		$data['user_info']=$this->login->getUserProfile($data['view'][0]['booked_by']);	
		$ad_info=$this->business_model->getadinfo($data['user_info']['city_id']);
		$email_template_id='9f37bd95-a95c-94';
		$email_template = $this->login_model->getEmailTemplate($email_template_id);
		$body = $email_template['description'];
		$body = str_replace('[location manager full name]',$data['user_info']['FirstName']." ".$data['user_info']['LastName'],$body);
		if($this->input->post('is_client')=='0'){
			$body = str_replace('[client fullname]',$data['info'][0]['FirstName']." ".$data['info'][0]['LastName'],$body);
		}else{
			$body = str_replace('[client fullname]',$data['info_client']['FirstName']." ".$data['info_client']['LastName'],$body);	
		}
		$body = str_replace('[url]',$url,$body);
		$from_email='sworks.co.in'; // should change with smartworks team
		$from_name=ucfirst('Team Smartworks');
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($data['user_info']['userEmail']);
		//$this->email->cc($ad_info[0]['userEmail']);
		 //$inputArray['email']
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		echo 'You have successfully accept the agreement';	
	}
	public function voffice_booking_listing()
	{
		authenticate(array('ut1','ut7'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
		$data['voffice']=$this->business_model->voffice_booking_listing();
		$this->load->view('voffice_booking_listing', $data);		
	}
	function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
	    {
	        $length = rand($chars_min, $chars_max);
	        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
	        if($include_numbers) {
	            $selection .= "1234567890";
	        }
	        if($include_special_chars) {
	            $selection .= "!@\"#$%&[]{}?|";
	        }

	        $password = "";
	        for($i=0; $i<$length; $i++) {
	            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
	            $password .=  $current_letter;
	        }                

	      return $password;
	    }
		
	    public function edit_business($business_id)
	    { 
			 authenticate(array('ut1','ut6'));
		$userId = $this->session->userdata("userId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['business']= $this->business_model->get_business($business_id);
	    $data['cities']=$this->lm->getcities(); 
	    $data['location']=$this->lm->getlocationbycity($data['business'][0]['cityId']);
	    $data['vendor']=$this->business_model->getvendor();
	     if (isset($_POST) && (!empty($_POST)))
		 {
	 		//print_r($_POST);
	 		//exit;
	 		if($this->input->post('vendor_user_id')!=''){
							$ownerId=$this->input->post('vendor_user_id');
						}else{
							$ownerId=$this->session->userdata("userId");
						}
				$data=array(
						   
							'businessName'=>$this->input->post('businesss_name'),					
							'ownerId'=>$ownerId,
							'address'=>$this->input->post('address'),
							'street_address'=>$this->input->post('street_address'),
							'slug'=>str_replace(" ","-",$this->input->post('business_name')),
							'state'=>$this->input->post('state'),
							'pincode'=>$this->input->post('zip'),
							'cityId'=>$this->input->post('city'),
							'locationId'=>$this->input->post('location'),
							'countryId'=>$this->input->post('country'),
							'latitude' => $this->input->post('latitude'),
	                        'longitude' => $this->input->post('longitude'),
							'status'=>'1',
							'shortDescription'=>$this->input->post('shortDescription'),
							'longDescription'=>$this->input->post('desc'),
							'addedBy'=>$this->session->userdata('userId'),
							'dateModified'=>date('Y-m-d H:i:s')
							);	
							if($_FILES['ListeeTypeImage']['name']!="")
						{
							$image=$this->business_model->get_business($business_id);
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
							$result1 = update_tbl('business_images','id',$imageid,$data1);
			 
						}																													
					$result = update_tbl('business_centers','business_id',$business_id,$data);
					
				if($result == 1)
				{
					$this->session->set_flashdata('edit',"You have successfully upadded.");
				    redirect(base_url().'index.php/business/manage_business_centers/');
				}
				else
				{
					$this->session->set_flashdata('edit',"Your updation is not completed.");
				    redirect(base_url().'index.php/business/edit_business/'.$business_id);
				}       
	      }    
	     
	    $this->load->view("edit_business",$data);
	}
	public function voffice(){
		authenticate(array('ut7','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['location']=$this->lm->getAlllocation();
		$this->load->view('business/voffice',$data);
	}
	public function add_business_attributes($id){
		authenticate(array('ut7','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['business_name']= $this->business_model->get_business($id);
		if($_POST)
		{
		    $business_id = $_POST['business_id'];
			$int=array();
			 $v=explode(",",$_POST['internet_cost']);
			 foreach($v as $val){
				$s=explode(":",$val);
           		$int[trim($s[0])] = trim($s[1]);	
			 }
			$a=json_encode($int);
			 
			$arr = array(
				'floor_cost' => $_POST['floor_cost'],
				'bookself_cost'=>$_POST['bookself_cost'],
				'internal_storage_cost' => $_POST['internal_storage_cost'],
				'phone_cost'=>$_POST['phone_cost'],
                'wifi_cost'=>$_POST['wifi_cost'],
                'internet_cost'=>$a,
                'dateModified'=>date('Y-m-d H:i:s')
				);
			 
			 $table='floor_plan_service';	
			 $pid='business_id';
		     $result = $this->lm->editPage($pid,$arr,$business_id,$table);
			
			
			$this->session->set_flashdata('item','Attributes updated successfully');
		
			redirect('index.php/business/add_business_attributes/'.$id,$data);
		}
		else{
			
			$data['business']=$this->business_model->get_business_attributes($id);	
			$this->load->view('business/add_business_attributes',$data);	
		}		
	}
	public function edit_virtual_office($id){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($_POST)
		{
		   $id=$_POST['id'];
			 
			$arr = array(
				'name' => $_POST['name'],
				'details'=>$_POST['details'],
				'price' => $_POST['price'],
				'onetime_price'=>$_POST['onetime_price'],
				'css_class'=>$_POST['css_class']
				);
			 
			 $table='virtual_office';	
			 $pid='id';
		     $result = $this->lm->editPage($pid,$arr,$id,$table);
			
			
			$this->session->set_flashdata('item','Attributes updated successfully');
		
			redirect('index.php/business/edit_virtual_office/'.$id,$data);
		}
		else{
			
			$data['virtual_office']=$this->business_model->get_virtual_office_bybusinessId($id);	
			$this->load->view('business/edit_virtual_office',$data);	
		}		
	}
	public function add_virtual_attributes($b_id){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['business_name']= $this->business_model->get_business($b_id);
		if($_POST)
		{
		    $business_id = $_POST['business_id'];
		    $re=$this->business_model->check_virtual_no($business_id);
		    $p=count($re);
		    if($p<5){
				$id=create_guid();
			    $id= substr($id,0,16);
				 
				$arr = array(
					'id' => $id,
					'business_id'=>$business_id,
					'name' => $_POST['name'],
					'details'=>$_POST['details'],
	                                'price'=>$_POST['price'],
					'onetime_price'=>$_POST['onetime_price'],                         
	                                'css_class'=>$_POST['css_class']                 
					);
				 $result = insert_into_tbl('virtual_office',$arr);
			     $this->session->set_flashdata('item','office added successfully');
			
				redirect('index.php/business/virtual_attributes_list/'.$b_id,$data);
			}else{
			    $this->session->set_flashdata('item','Already 5 virtual offices added for this business center');
			    redirect('business/add_virtual_attributes/'.$b_id,$data);	
			}
		}else{
			$this->load->view('business/add_virtual_attributes',$data);	
		}		
	}
	public function delete_business($id)
	{
		 authenticate(array('ut1','ut6'));
		   $data=array(
						'deleted'=>'1'
						);
			$result = update_tbl('business_centers','business_id',$id,$data);
			  
		   if($result)
		   {
			    $image=$this->business_model->get_business($id);
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
				   delete_tbl('business_images','businessId',$id);
				  
			
				} else {
				echo "The file does not exist";
				}
				$this->session->set_flashdata('edit',"You have successfully Deleted.");
				 redirect(base_url().'index.php/business/manage_business_centers/');
		   }
	}
	public function changeBusinessStatus()
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
		    $result = $this->business_model->edittable($pid,$arr,$id,$table);
		
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="changeBusinessStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="changeBusinessStatus(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}			
	}
}
