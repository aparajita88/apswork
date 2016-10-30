<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  class Complaints extends MY_Controller {
 
 	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('vendor/vendor_model');
        $this->load->model('complaints_model');
	    $this->load->helper('common');
	    $this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
	
	
	
	}



public function view_complaints($complain_id) {
	 authenticate(array('ut1','ut3','ut4','ut5','ut7','ut10','ut11'));
	 $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['view']= $this->vendor_model->get_complaints_details($userId, $complain_id);
		$this->load->view('view_complaints', $data);
}


public function create($clas_id,$com_id) {
	
$data['title'] = 'reply complaints';
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);	
	
	
	
	
  if($this->input->post('submit'))
  {
$classified_id = $this->uri->segment(3);
$complain_id = $this->uri->segment(4);

$subject = $this->input->post('subject',TRUE);

$message = $this->input->post('message',TRUE);
$complain_id1=create_guid();
$reply = array(

'complain_id'=>$complain_id1,

'parent_id' =>$complain_id, 

'classified_id'=>$classified_id,

'subject' => $subject,

'message' => $message,
  
'addedBy'=>$this->session->userdata('userId'),
'status'=>'1',

'dateAdded'=>date('Y-m-d h:i:s')
 	



);

$this->db->insert('complaints',$reply);

redirect('index.php/complaints/view_complaints/'.$complain_id);

}

$data['posts'] = $this->vendor_model->get_subject($com_id); 

$this->load->view('create', $data);



}





   public function index(){
   authenticate(array('ut1','ut3','ut4','ut5','ut7','ut10','ut11','ut2'));
   $data['title'] = 'complaints';
   $userId = $this->session->userdata("userId");
   $userTypeId = $this->session->userdata("userTypeId");
   $data['userData'] = $this->login->getUserProfile($userId);
    if($userTypeId=="ut2"){
	
		$data['complaints'] = $this->complaints_model->get_all_complaints('');
   }
  else if($userTypeId=="ut5"){
	 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->get_all_complaints($clntstr);
   }
    else if($userTypeId=="ut7"){
	
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->get_all_complaints($clntstr);
		
	 }else if($userTypeId=="ut10"){
		 $legal_data=array(
		
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_areadirector($legal_data); 
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->get_all_complaints($clntstr);
		
		 
	 }
	else{	
      $data['complaints'] = $this->complaints_model->get_all_complaints($userId);
  }
      
      
      $this->load->view('complaints',$data);
      
      }
		
		public function add_complaints(){
			 authenticate(array('ut1','ut3','ut4','ut5','ut7','ut10','ut11'));
			
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	
		
		if($_POST)
		{
		    $complain_id = substr(create_guid(),0,16);
			$arr = array(
				'complain_id' => $complain_id,
				'parent_id' =>'0',
				'city_id' => $data['userData']['city_id'],
				'location_id' => $data['userData']['location_id'],
				'subject' => $this->input->post('subject'),
				'complaint_type'=>$this->input->post('type'),
				'message'=>$this->input->post('content'),
				
				'addedBy' => $this->session->userdata('userId'),
				'deleted' => 0,
				'dateAdded' => date('Y-m-d h:i:s'),
				'status' => 0);
		        insert_into_tbl('complaints',$arr);
			
			
			$this->session->set_flashdata('item','Your Complain is added successfully');
		
			redirect('index.php/complaints/index');
		}
		else{
			$this->load->view('add_complaints',$data);
		}	
		}
		
 public function search_complaints_bydate(){
	  authenticate(array('ut1','ut3','ut4','ut5','ut7','ut10','ut11','ut2'));
	  $data['title'] = 'complaints';
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
	 if($_POST)
		{
		$start_date=date("Y-m-d", strtotime($this->input->post('start_date')));
		$end_date=date("Y-m-d", strtotime($this->input->post('end_date')));
		if($userTypeId=="ut4"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		
		$data['complaints'] = $this->complaints_model->search_complaints_bydate($userId,$start_date,$end_date);
		
	 }
		else if($userTypeId=="ut2"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		
		$data['complaints'] = $this->complaints_model->search_complaints_bydate('',$start_date,$end_date);
		
	 }
		else if($userTypeId=="ut7"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->search_complaints_bydate($clntstr,$start_date,$end_date);
		
	 }
	 else if($userTypeId=="ut5"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->search_complaints_bydate($clntstr,$start_date,$end_date);
		
	 }
	else if($userTypeId=="ut10"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_areadirector($legal_data);
		
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->search_complaints_bydate($clntstr,$start_date,$end_date);
		
	 }
	else{	
      $data['complaints']=$this->complaints_model->search_complaints_bydate($userId,$start_date,$end_date);
  }
	    
	   
	   
	$this->load->view('complaints',$data);
}
 }
public function getbycomplaintstatus(){
	 authenticate(array('ut1','ut3','ut4','ut5','ut7','ut10','ut11','ut2'));
	  $userId = $this->session->userdata("userId");
	  $userTypeId = $this->session->userdata("userTypeId");
	if($_POST)
		{
			$status = $_POST['status'];

			if($userTypeId=="ut4"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		
		$data['complaints'] = $this->complaints_model->search_complaints_bystatus($userId,$status);
		
	 }
	else if($userTypeId=="ut2"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		
		$data['complaints'] = $this->complaints_model->search_complaints_bystatus('',$status);
		
	 }
	 else if($userTypeId=="ut5"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->search_complaints_bystatus($clntstr,$status);
		
	 }
			else if($userTypeId=="ut7"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		'location'=>$data['userData']['location_id'],
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_manager($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->search_complaints_bystatus($clntstr,$status);
		
	 }
	 		else if($userTypeId=="ut10"){
		 $data['userData'] = $this->login->getUserProfile($userId);
		 $legal_data=array(
		
		'city'=>$data['userData']['city_id']
		);
		$client_list=$this->complaints_model->get_client_for_areadirector($legal_data);
		$clntstr="(";
		$cnt=0;
		foreach($client_list as $clntlst){
			$clntstr.="'".$clntlst['userId']."'";
			if($cnt<(count($client_list)-1)){
				$clntstr.=",";
			}
			$cnt++;
		}
		$clntstr.=")";
		$data['complaints'] = $this->complaints_model->search_complaints_bystatus($clntstr,$status);
		
	 }
	else{	
      $data['complaints']=$this->complaints_model->search_complaints_bystatus($userId,$status);
  }
			 
			
	
$this->load->view('ajax_status_complaints',$data);	
}
}
		public function get_classified_name($userId){
	
	$sql = "select classifieds.*, complaints.* from classifieds LEFT JOIN complaints ON 
	classifieds.classifiedId = complaints.classified_id  WHERE  parent_id='0' 
	and classifieds.ownerId='".$userId."' ORDER BY complaints.dateAdded DESC";
	$query=$this->db->query($sql);
	return $result=$query->result_array();	
}

public function close_complaints($complaint_id){
	$complaint_data=array(
	                'status'=>'1'
	                );
	$this->complaints_model->set_close_complaint($complaint_id,$complaint_data);
	@redirect(base_url()."index.php/complaints");
}


    
  public function get_subject($complain_id) {
	    $userId = $this->session->userdata("userId");
	  
		$userTypeId = $this->session->userdata("userTypeId");
		
		$data['userData'] = $this->login->getUserProfile($userId);
		
   $data['posts'] = $this->Vendor_model->get_subject($complain_id); 
   
  
		
        $this->load->view('create', $data);
 }

 public function delete_complaints($id){
	authenticate(array('ut1','ut3','ut4','ut5','ut7','ut10','ut11'));	
	$data['title'] = 'complaints';
	$userId = $this->session->userdata("userId");
	$userTypeId = $this->session->userdata("userTypeId");
	$data['userData'] = $this->login->getUserProfile($userId);
 if($id != ''){
$this->db->where('complain_id',(int)$id)->delete('complaints');
$data['complaints'] = $this->complaints_model->get_all_complaints($userId);
$this->load->view('complaints',$data);
}
 }
	
     
 }
