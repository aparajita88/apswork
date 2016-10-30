<?php
class Cms extends MY_Controller {
	public function __construct() {
		parent::__construct();
		//$this->load->model('login_model');
		$this->load->helper('form','url'); 
		$this->load->model('users/login');
		$this->load->model('cms_model');
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/cms');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/cms/';
	}

   public function email_template_list(){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['templates']= $this->cms_model->get_email_templates();
		
		$this->load->view('email_template_list',$data);
		
	}
	public function edit_email_template($id='')
	{
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($_POST)
		{
		    $templateId = $_POST['templateId'];
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['attiributespeName']);
			//print_r($_POST); exit;
			$arr = array(
				'title' => $_POST['attiributespeName'],
				'slug' => $slug,
				'subject' => $_POST['subject'],
				'description' => $_POST['desc'],
				'ModifiedBy' => $this->session->userdata('userId'),
				'dateModified' => date('Y-m-d H:i:s')
				);
			//print_r($arr);
			//exit;
		    $result = $this->cms_model->editTemplate($arr,$templateId);
			
			$this->session->set_flashdata('item','Template updated successfully');
			
			redirect('index.php/cms/email_template_list');
		}
		else{
			$data['template'] = $this->cms_model->getTemplatebyId($id);
			$this->load->view('cms/edit_email_template',$data);	
		}
	}
	public function add_email_template(){
	authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		if($_POST)
		{
		    $tamplate_id = substr(create_guid(),0,16);
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['attiributespeName']);
			//print_r($_POST); exit;
			$arr = array(
				'emailId' => $tamplate_id,
				'title' => $_POST['attiributespeName'],
				'slug' => $slug,
				'subject'=>$_POST['subject'],
				'description' => $_POST['desc'],
				'addedBy' => $this->session->userdata('userId'),
				'deleted' => 0,
				'dateAdded' => date('Y-m-d H:i:s'),
				'status' => 1);
		    $result = $this->cms_model->addTemplate($arr);
			$this->session->set_flashdata('item','New Template added successfully');
			//$this->load->view('cms/category_list',$data);
			redirect('index.php/cms/email_template_list');
		}else{
		
		$this->load->view('add_email_template',$data);
		}
	}
		public function templateview(){
		$template_id=$this->input->post('template_id');
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['template']=$this->cms_model->getTemplatebyId($template_id);
		
		
		
		$this->load->view('view_template',$data);	
	}
	public function privacy_policy(){
		$var='privacy policy';
		$data['cms_content']= $this->cms_model->get_cms_content($var);
		$data['title'] = $data['cms_content'][0]['title'];
		$this->load->view('privacy_policy',$data);
		
	}
	
	public function our_mission(){
		$var='OUR MISSION';
		$data['cms_content']= $this->cms_model->get_cms_content($var);
		//print_r($data['cms_content']);
		$data['title'] = $data['cms_content'][0]['title'];
		$data['meta_key'] = $data['cms_content'][0]['meta_keywords'];
		$this->load->view('our_mission',$data);
		
	}
	public function faq(){
		$var='faq';
		$data['cms_content']= $this->cms_model->get_cms_content($var);
		$data['title'] = $data['cms_content'][0]['title'];
		$this->load->view('faq',$data);
		
	}
	public function cmsimage_upload(){
        if(move_uploaded_file($_FILES["upload"]["tmp_name"],"cms_image/" . $_FILES["upload"]["name"])){
			echo "file uploaded";
		}else{
			echo "file not uploaded";
		}
	}
	public function browse(){
	    $data['dir'] = $_GET['dir'];
	    $this->load->view('page_image',$data);
	}
	public function get_subcategories_forcategory(){
		$id = $_POST['id'];
		$data['get_subcategories_forcategory']= $this->cms_model->get_subcategories_forcategory($id);
		
			if($data['get_subcategories_forcategory']!=""){
			//if($status == 1)
			//{
				//echo '<a class="demo-basic" onclick="change_page_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			//}
			//else
			//{
				//echo '<a class="demo-basic" onclick="change_page_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			//}	
		 foreach($data['get_subcategories_forcategory'] as $key=>$value) {
		echo '<option value="'.$value['pageCategoryId'].'">'.$value['pageCategoryName'].'</option>'; 
			}
			
			
		}	
			
	}
	
	public function add_category()
	{
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		authenticate();
		if($_POST)
		{
		    $cat_id = substr(create_guid(),0,16);
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['attiributespeName']);
			//print_r($_POST); exit;
			$arr = array(
				'pageCategoryId' => $cat_id,
				'pageCategoryName' => $_POST['attiributespeName'],
				'slug' => $slug,
				'categoryDescription' => $_POST['desc'],
				'ownerId' => $this->session->userdata('userId'),
				'addedBy' => $this->session->userdata('userId'),
				'deleted' => 0,
				'dateAdded' => date('Y-m-d H:i:s'),
				'status' => 1);
		    $result = $this->cms_model->addCategory($arr);
			//echo $result;
			$data['categories'] = $this->cms_model->getCategory();
			$this->session->set_flashdata('item','New category added successfully');
			//$this->load->view('cms/category_list',$data);
			redirect('index.php/cms/list_page_category');
		}
		else{
			$this->load->view('cms/add_page_category',$data);	
		}
	}
	public function add_subpage_category(){
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		authenticate();
		if($_POST)
		{
		    $cat_id = substr(create_guid(),0,16);
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['subpagecategory']);
			//print_r($_POST); exit;
			$arr = array(
				'pageCategoryId' => $cat_id,
				'pageCategoryName' => $_POST['subpagecategory'],
				'parentCategoryId'=>$_POST['category'],
				'slug' => $slug,
				'categoryDescription' => $_POST['desc'],
				'ownerId' => $this->session->userdata('userId'),
				'addedBy' => $this->session->userdata('userId'),
				'deleted' => 0,
				'dateAdded' => date('Y-m-d H:i:s'),
				'status' => 1);
		    $result = $this->cms_model->addCategory($arr);
			//echo $result;
			$data['categories'] = $this->cms_model->getCategory();
			$this->session->set_flashdata('item','New category added successfully');
			//$this->load->view('cms/category_list',$data);
			
			redirect('index.php/cms/list_subpage_category');
		}
		else{
			$data['categories'] = $this->cms_model->getCategory();
			$this->load->view('cms/add_subpage_category',$data);	
		}
	}
	public function list_subpage_category(){
		 authenticate(array('ut6','ut1'));
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		
		$data['categories'] = $this->cms_model->getsubCategory();
		$this->load->view('cms/list_subpage_category',$data);	
		
	}
	public function list_page_category()
	{
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		
		$data['categories'] = $this->cms_model->getCategory();
		$this->load->view('cms/category_list',$data);
	}
	public function chengestatus()
	{
		 authenticate(array('ut6','ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status,
				'ModifiedBy' => $this->session->userdata('userId'),
				'dateModified' => date('Y-m-d H:i:s')
				);
		    $result = $this->cms_model->editCategory($arr,$id);
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_page_category_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_page_category_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_category($id='')
	{
		 authenticate(array('ut6','ut1'));
		if($id)
		{
			$result = $this->cms_model->deleteCategory($id);
			$this->session->set_flashdata('item', 'Category deleted successfully');
			redirect('index.php/cms/list_subpage_category');
		}
	}
	
	
	public function edit_category($id='')
	{
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		authenticate();
		if($_POST)
		{
		    $cat_id = $_POST['categoryId'];
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['attiributespeName']);
			//print_r($_POST); exit;
			$arr = array(
				'pageCategoryName' => $_POST['attiributespeName'],
				'slug' => $slug,
				'categoryDescription' => $_POST['desc'],
				'ModifiedBy' => $this->session->userdata('userId'),
				'dateModified' => date('Y-m-d H:i:s')
				);
		    $result = $this->cms_model->editCategory($arr,$cat_id);
			//echo $result;
			$data['categories'] = $this->cms_model->getCategory();
			$this->session->set_flashdata('item','Category updated successfully');
			//$this->load->view('cms/category_list',$data);
			redirect('index.php/cms/list_page_category');
		}
		else{
			$data['category'] = $this->cms_model->getCategorybyId($id);
			$this->load->view('cms/edit_page_category',$data);	
		}
	}
	public function edit_sub_category($id='')
	{
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		authenticate();
		if($_POST)
		{
		    $cat_id = $_POST['categoryId'];
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['attiributespeName']);
			//print_r($_POST); exit;
			$arr = array(
				'pageCategoryName' => $_POST['attiributespeName'],
				'parentCategoryId'=>$_POST['category'],
				'slug' => $slug,
				'categoryDescription' => $_POST['desc'],
				'ModifiedBy' => $this->session->userdata('userId'),
				'dateModified' => date('Y-m-d H:i:s')
				);
		    $result = $this->cms_model->editCategory($arr,$cat_id);
			//echo $result;
			$data['categories'] = $this->cms_model->getCategory();
			$this->session->set_flashdata('item','Category updated successfully');
			//$this->load->view('cms/category_list',$data);
			redirect('index.php/cms/list_subpage_category');
		}
		else{
			$data['categories'] = $this->cms_model->getCategory();
			$data['category'] = $this->cms_model->getCategorybyId($id);
			$this->load->view('cms/edit_subpage_category',$data);	
		}
	}
	
	
	public function add_page()
	{
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		authenticate();
		if($_POST)
		{
			$pid = substr(create_guid(),0,16);
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($this->input->post('name')));
			if($_FILES['pageImage']['size'] > 0)
			{
				$config = array(
					'file_name' => $pid,
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => $this->gallery_path.'/full',
					'max_size' => 2000
				);
			
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('pageImage')) {
						 // return the error message and kill the script
						echo $this->upload->display_errors(); die();
				}
				else
				{
					$config = array();
					$image_data = $this->upload->data();
					$upName=$image_data['file_name'];
					/*####################### Thumbnails ################################*/
					$config = array(
						'source_image' => $image_data['full_path'],
						'new_image' => $this->gallery_path . '/thumbs',
						'maintain_ration' => true,
						'width' => 150,
						'height' => 150
					);
					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					/*####################### Medium ################################*/
					$config = array();
					$config = array(
						'source_image' => $image_data['full_path'],
						'new_image' => $this->gallery_path . '/medium',
						'maintain_ration' => true,
						'width' => 520,
						'height' => 480
					);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
				}
			}
			else{
				$upName = '';
			}
			if($_FILES['pageHeaderImage']['size'] > 0)
			{
				$config = array(
					'file_name' => $pid.'_page_header',
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => $this->gallery_path.'/full',
					'max_size' => 2000,
				);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('pageHeaderImage')) {
					 // return the error message and kill the script
					echo $this->upload->display_errors(); die();
				}
				else
				{
					$config = array();
					$image_data = $this->upload->data();
					$upHeaderName=$image_data['file_name'];
				}
			}
			else{
				$upHeaderName = '';
			}
			$arr = array(
				'pageId' => $pid,
				'categoryId' => $this->input->post('category'),
				'subpage_categoryid'=> $this->input->post('sub_page_category'),
				'title' => $this->input->post('name'),
				'slogan' => $this->input->post('slogan'),
				'slug' => $slug,
				'content' => $this->input->post('content'),
				'meta_keywords' => $this->input->post('metaKeys'),
				'meta_description' => $this->input->post('metaDesc'),
				'image' => $upName,
				'page_header_image' => $upHeaderName,
				'AssignedUserId' => $this->session->userdata('userId'),
				'deleted' => 0,
				'dateAdded' => date('Y-m-d H:i:s'),
				'status' => 1);
		    $result = $this->cms_model->addPage($arr);
			$this->session->set_flashdata('item','New page added successfully');
			redirect('index.php/cms/list_page');
		}
		else{
			$data['categories'] = $this->cms_model->getCategory();
			$data['sub_page_categories'] = $this->cms_model->getsubpageCategory();
			$this->load->view('cms/add_page',$data);	
		}
	}
	
	
	public function edit_page($id='') {
		authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		authenticate();
		if($_POST)
		{
			$pid = $this->input->post('pageid');
			$image=$this->cms_model->getPagebyId($pid);
			$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($this->input->post('name')));
			if($_FILES['pageImage']['size'] > 0)
			{
		    	$img=$image[0]['image'];
		    	$img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/full/'.$img;		   
		    	$img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/medium/'.$img;
		    	$img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/thumbs/'.$img;
			   if(file_exists($img4)) {
				   unlink($img1);
				   unlink($img2);
				   unlink($img3);
				   unlink($img4);
			   }	
				$config = array(
					'file_name' => $pid,
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => $this->gallery_path.'/full',
					'max_size' => 2000,
				);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('pageImage')) {
				 	// return the error message and kill the script
					echo $this->upload->display_errors(); die();
				}
				else
				{
					$config = array();
					$image_data = $this->upload->data();
					$upName=$image_data['file_name'];
					/*####################### Thumbnails ################################*/
					$config = array(
						'source_image' => $image_data['full_path'],
						'new_image' => $this->gallery_path . '/thumbs',
						'maintain_ration' => true,
						'width' => 150,
						'height' => 150
					);
					$this->load->library('image_lib', $config);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					/*####################### Medium ################################*/
					$config = array();
					$config = array(
						'source_image' => $image_data['full_path'],
						'new_image' => $this->gallery_path . '/medium',
						'maintain_ration' => true,
						'width' => 520,
						'height' => 480
					);
					$this->image_lib->initialize($config);
					$this->image_lib->resize();
					
				}
			}
			else{
				$upName = $this->input->post('imgCurrent');
			}
			if($_FILES['pageHeaderImage']['size'] > 0)
			{
				if($image[0]['page_header_image'] != ''){
		    		$img_page_header=$image[0]['page_header_image'];
		    		$page_header_img=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/full/'.$img_page_header;	
		    	}
		    	if(file_exists($page_header_img)) {
				   unlink($page_header_img);
			    }
				$config = array(
					'file_name' => $pid.'_page_header',
					'allowed_types' => 'jpg|jpeg|gif|png',
					'upload_path' => $this->gallery_path.'/full',
					'max_size' => 2000,
				);
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if ( ! $this->upload->do_upload('pageHeaderImage')) {
					 // return the error message and kill the script
					echo $this->upload->display_errors(); die();
				}
				else
				{
					$config = array();
					$image_data = $this->upload->data();
					$upHeaderName=$image_data['file_name'];
				}
			}
			else{
				$upHeaderName = $this->input->post('imgCurrentHeader');
			}
			$arr = array(
				'categoryId' => $this->input->post('category'),
				'subpage_categoryId'=>$this->input->post('sub_category'),
				'title' => $this->input->post('name'),
				'slogan' => $this->input->post('slogan'),
				'slug' => $slug,
				'content' => $this->input->post('content'),
				'meta_keywords' => $this->input->post('metaKeys'),
				'meta_description' => $this->input->post('metaDesc'),
				'image' => $upName,
				'page_header_image' => $upHeaderName,
				'AssignedUserId' => $this->session->userdata('userId'),
				'deleted' => 0,
				'dateAdded' => date('Y-m-d H:i:s'),
				'status' => 1);
		    $result = $this->cms_model->editPage($arr,$pid);
			$this->session->set_flashdata('item','page updated successfully');
			redirect('index.php/cms/list_page');
		}
		else{
		    if($id != '')
			{
				$data['sub_page_categories'] = $this->cms_model->getsubpageCategory();
				$data['categories'] = $this->cms_model->getCategory();
				$data['page'] = $this->cms_model->getPagebyId($id);
				$this->load->view('cms/edit_page',$data);	
			}
		}
	}
	public function list_page()
	{   
		 authenticate(array('ut6','ut1'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		
		
		$data['pages'] = $this->cms_model->getAllPage();
		$data['categories'] = $this->cms_model->getCategory();
		$data['title']='adm';
		$this->load->view('cms/page_list',$data);
	}
	public function get_pages_bycategory(){
		 authenticate(array('ut6','ut1'));
	$id = $_POST['id'];
		$data['get_pages_bycategory']= $this->cms_model->get_pages_bycategory($id);
		//print_r($data['get_pages_bycategory']);
			if($data['get_pages_bycategory']!=""){
			//if($status == 1)
			//{
				//echo '<a class="demo-basic" onclick="change_page_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			//}
			//else
			//{
				//echo '<a class="demo-basic" onclick="change_page_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			//}	
		 foreach($data['get_pages_bycategory'] as $key=>$value) {
		
			}
			
			
		}		
		
	}
	public function chengepagestatus()
	{
		 authenticate(array('ut6','ut1'));
		if($_POST)
		{
			$id = $_POST['_id'];
			$status = 1-$_POST['_status'];
			$arr = array(
				'status' => $status,
				'ModifiedBy' => $this->session->userdata('userId'),
				'dateModified' => date('Y-m-d H:i:s')
				);
		    $result = $this->cms_model->editPage($arr,$id);
			if($status == 1)
			{
				echo '<a class="demo-basic" onclick="change_page_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Active </a>';
			}
			else
			{
				echo '<a class="demo-basic" onclick="change_page_status(\''.$id.'\',\''.$status.'\')" href="javascript:void(0)" title="Active"> Inactive </a>';
			}
		}
	}
	public function delete_page($id='')
	{
		 authenticate(array('ut6','ut1'));
		if($id)
		{
		    $image=$this->cms_model->getPagebyId($id);
		    $img=$image[0]['image'];
		    $img1=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/full/'.$img;
		    $img3=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/medium/'.$img;
		    $img4=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/thumbs/'.$img;
		    if($image[0]['page_header_image'] != ''){
	    		$img_page_header=$image[0]['page_header_image'];
	    		$page_header_img=$_SERVER["DOCUMENT_ROOT"].'/assets/uploads/cms/full/'.$img_page_header;	
	    	}
	    	if(file_exists($page_header_img)) {
			   unlink($page_header_img);
		    }
		   if(file_exists($img4)) {
			   unlink($img1);
			   unlink($img3);
			   unlink($img4);
			   
	 		$result = $this->cms_model->deletePage($id); 
		
			} else {
			echo "The file does not exist";
			}
			$this->session->set_flashdata('item', 'Page deleted successfully');
			redirect('index.php/cms/list_page');
		}
	
	
	
}
}
?>
