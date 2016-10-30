<?php
class Areadirector extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('complaints/complaints_model');
	    $this->load->model('receptionist/receptionist_listing');
	    $this->load->model('client/client_model');
	    $this->load->model('rooms/rooms_model');
	    $this->load->model('areadirector_model');
	    $this->load->model('location/location_model', 'lm'); 
	   	$this->load->helper('common');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
		$this->load->model('invoice/invoice_model');
		
	}
 	public function index(){
		$this->session->sess_destroy();
		$this->load->view('areadirector_login');
	}
  	public function dashBoard(){
		authenticate(array('ut10'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$city_id=$data['userData']['city_id'];
		$data['booking_info']=$this->areadirector_model->get_seat_booking_info($city_id);
		$i=0;
		foreach($data['booking_info'] as $bkinfo){
			$bkinfodata=json_decode($bkinfo['booking_detailes']);
			for($k=0;$k<count($bkinfodata);$k++){
				$expseatinfo=explode(":",$bkinfodata[$k]);
				$seatinfo=$this->areadirector_model->get_seat_title($expseatinfo[0]);
				$seatidarr[$k]=$seatinfo[0]['Title'];
			}
			$data['booking_info'][$i]['title']=json_encode($seatidarr);
			$i++;
		}
        $this->load->view("areadirector_dashboard",$data);	
   	}
 	public function approved_seat_book_byareadirector(){
		if($_POST)
		{
			$appid = $_POST['appid'];
			$appdata=array(
			'Is_approved_ad'=>'1',
			'approved_by_ad'=>$this->session->userdata("userId"),
			'date_approved_ad'=>date('y-m-d h:i:s')
			);
			$data['update_floar_seat_info']=$this->areadirector_model->seat_book_info($appid,$appdata);	
		}  
 	}
 	public function reject_seat_book_byareadirector($appid){
		$appdata=array(
		'Is_approved_ad'=>'2',
		'approved_by_ad'=>$this->session->userdata("userId"),
		'date_approved_ad'=>date('y-m-d h:i:s')
		);
		$result=$this->areadirector_model->seat_book_info($appid,$appdata);	

 		if($result=='1')
		   {
				$this->session->set_flashdata('item',"You have successfully Deleted.");
				redirect(base_url().'index.php/areadirector/dashBoard');
		   }
	}
 	public function client_list(){
	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$city_id=$data['userData']['city_id'];
		$arr=array(
		'userTypeId'=>'ut4',
		'city_id'=>$city_id
		
		);
		$data['query']=$this->areadirector_model->get_client_List($city_id);
	    $this->load->view('areadirector_client_list',$data);
   	}
   	public function edit_client($id){
	    authenticate(array('ut10','ut5','ut7'));
		$userId = $this->session->userdata("userId");
		$data['userData'] = $this->login->getUserProfile($userId);
	    $data['userinfo'] = $this->login->getUserProfile($id);
		$data['cities']=$this->lm->getcities();
		$data['location']=$this->lm->getlocationbycity($data['userinfo']['cityId']);
     	if (isset($_POST) && (!empty($_POST)))
	 	{
				$arr = array(
				'FirstName' => $_POST['first_name'],
				'LastName'=>$_POST['last_name'],
				'location_id'=>$_POST['location'],
				 'city_id'=>$_POST['city'],
				'userProfilename'=>$_POST['userProfilename'],
				
				 'phone'=>$_POST['phone'],
				 'address'=>$_POST['address'],
				 'userEmail'=>$_POST['staff_email'],
				 'userName'=>$_POST['staff_email'],
				'dateModified'=>date('Y-m-d h:i:s')
				);
						if($_FILES['ListeeTypeImage']['name']!="")
					{	
						$imageid=$this->input->post('image_id');	
						$image=$this->doUpload('ListeeTypeImage',$imageid);	
						$data1=array(						
										'image'=>$image,									
									);
						$result1 = update_tbl('user','userId',$id,$data1);
		 
					}																													
				$result = update_tbl('user','userId',$id,$arr);
			if($result == 1)
			{
				$this->session->set_flashdata('edit',"You have successfully upadded.");
			    redirect(base_url().'index.php/areadirector/client_list');
			}
			else
			{
				$this->session->set_flashdata('edit',"Your updation is not completed.");
			    redirect(base_url().'index.php/areadirector/edit_client/'.$id);
			}       
      	}      
    		$this->load->view("edit_client",$data);
	}
	public function doUpload($fieldName,$imageid){
	
		if($_FILES[$fieldName]['name']!=""){ 
			$value = $_FILES[$fieldName]['name'];
			
			$config = array(
			'file_name' => $imageid,
			 'encrypt_name' => 'FALSE',
			'allowed_types' => 'jpg|jpeg|gif|png',
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
	public function	finance_list(){

	    $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$location=$data['userData']['location_id'];
		$city=$data['userData']['city_id'];
		$data['query']=$this->areadirector_model->get_revenue_List($location,$city);
        $data['location']=$this->lm->getAlllocation();
		$this->load->view('finance_list',$data);	
	}
	public function	 searchlocationrevenue(){
		if($_POST)
		{
				$location = $_POST['location'];
				$city=$_POST['city'];
				$date=$_POST['date'];
				$date=explode("_",$date);
				$month=$date[0];
				$year=$date[1];
				
			
			$data['get_revenue_byLocation']=$this->areadirector_model->get_revenue_byLocation($location,$city,$month,$year);	
			if($data['get_revenue_byLocation'][0]['MySum']!='0' && $data['get_revenue_byLocation'][0]['MySum']!=''){
				echo money_format('%i',$data['get_revenue_byLocation'][0]['MySum']);
			}else{
				echo 'Not available';
			}
		}
	}
	public function approved_discount_byareadirector(){
		$book_floor_id=$this->input->post('appid');
		$data['book_floor_data']=$this->areadirector_model->get_book_floor_plan_byid($book_floor_id);
		$this->load->view('vapproved_discount_by_ad',$data);
	}
	public function discount_amount_byareadirector(){
		$id=$this->input->post('appid');
		$amount=$this->input->post('amount');
		$discount_data=array(
			'Is_approved_ad'=>2,
			'total_price'=>$amount
			);
		$this->areadirector_model->discount_amount($discount_data,$id);
	}
	public function analytics(){
	 authenticate(array('ut10'));
	        $userId = $this->session->userdata("userId");
			$userTypeId = $this->session->userdata("userTypeId");
			$data['userData'] = $this->login->getUserProfile($userId);
			$data['cities']=$this->lm->getcities();
		         $this->load->view("analytics",$data);	
		
	}
	public function search_analytics(){
		if (isset($_POST) && (!empty($_POST))){
			$city=$this->input->post('city');
			$location=$this->input->post('location');
			$business=$this->input->post('business');
			$start_date=$this->input->post('start_date');
			$end_date=$this->input->post('end_date');
			$cat=$this->input->post('cat');
			$sub=$this->input->post('sub');
			$analytics=$this->input->post('analytics');
			if($cat=='sal' && $sub=='sal_0' && $analytics=='0'){
				$leads_gnrtd=$this->areadirector_model->leads_gnrtd($start_date,$end_date,$city,$location);
				if (count($leads_gnrtd) > 0) {
					$html = '<tr><td colspan="1"><b>Source</b> </td><td colspan="1"><b>No Of leads Generated</b> </td></tr>';
					foreach($leads_gnrtd as $val){
						$html.= '<tr>
			          		<td colspan="1">'.$val['source'].'</td><td colspan="1">'.$val['total'].'</td>
			        	</tr>';
					}
					echo $html;	
				} else {
					$html = '<tr><td colspan="1"><b>Source</b> </td><td colspan="1"><b>No Of leads Generated</b> </td></tr>';
					$html.='<tr><td colspan="5"><b>No Data</b> </td></tr>';
					echo $html;	
				}		
			}else if($cat=='sal' && $sub=='sal_0' && $analytics=='0'){
				$leads_gnrtd=$this->areadirector_model->enq_tour($start_date,$end_date,$city,$location);
				if (count($leads_gnrtd) > 0) {
					$html = '<tr><td colspan="1"><b>Source</b> </td><td colspan="1"><b>No Of leads Generated</b> </td></tr>';
					foreach($leads_gnrtd as $val){
						$html.= '<tr>
			          		<td colspan="1">'.$val['source'].'</td><td colspan="1">'.$val['total'].'</td>
			        	</tr>';
					}
					echo $html;	
				} else {
					$html = '<tr><td colspan="1"><b>Source</b> </td><td colspan="1"><b>No Of leads Generated</b> </td></tr>';
					$html.='<tr><td colspan="5"><b>No Data</b> </td></tr>';
					echo $html;	
				}		
			}else if($cat=='sal' && $sub=='sal_0' && $analytics=='1'){
				$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
				$total_enq =$this->areadirector_model->total_enq($start_date,$end_date,$city,$location);
				$total_tour=($total_tour > 0 ? $total_tour : '0'); ;
				$total_enq=($total_enq > 0 ? $total_enq : '0');
				if($total_enq>0){
				$pcg=($total_tour/($total_enq*100));
				}else{
				$pcg='0';	
				}
				$pcg = ($pcg > 0 ? $pcg : '0'); 
					$html = '<tr>
			          		<td colspan="1"><b>Enquiry to Tour percentage:</b> </td><td colspan="1">'.round($pcg,2).'%</td>
			        	</tr>';
				echo $html;
			}else if($cat=='sal' && $sub=='sal_0' && $analytics=='2'){
				$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
				$v_agg=$this->areadirector_model->virtual_agg($start_date,$end_date,$city,$location,$business);
				$p_agg=$this->areadirector_model->private_agg($start_date,$end_date,$city,$location,$business);
				$total_agg=$v_agg+$p_agg;
				if ($total_tour > 0 && $total_agg > 0 ) {
					$html = '<tr>
			          		<td colspan="1"><b>Tour : Deal Conversion: </b> </td><td colspan="1"> '.$total_tour.':'.$total_agg.'</td>
			        	</tr>';
				echo $html;
					}
				 else {
					$html='<tr><td colspan="1"><b>No Data</b> </td></tr>';
					echo $html;	
				}		
			}else if($cat=='sal' && $sub=='sal_0' && $analytics=='3'){
				$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
				$p_agg=$this->areadirector_model->private_agg($start_date,$end_date,$city,$location,$business);
				if($total_tour>0){
				$total_agg=($p_agg/$total_tour)*100;	
				}else{
				$total_agg='0';	
				}
				if ($total_tour > 0 && $total_agg > 0 ) {
					$html = '<tr>
			          		<td colspan="1"><b>Tour : Office Deal %Conversion: </b> </td><td colspan="1"> '.$total_tour.':'.round($total_agg,2).'%</td>
			        	</tr>';
					echo $html;
				}else {
					$html='<tr><td colspan="1"><b>No Data</b> </td></tr>';
					echo $html;	
				}	
			}else if($cat=='sal' && $sub=='sal_0' && $analytics=='4'){
				$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
				$v_agg=$this->areadirector_model->virtual_agg($start_date,$end_date,$city,$location,$business);
				$total_agg=($v_agg/$total_tour)*100;
				if ($total_tour > 0 && $total_agg > 0 ) {
					$html = '<tr>
			          		<td colspan="1"><b>Tour : VO % Conversation: </b> </td><td colspan="1"> '.$total_tour.':'.round($total_agg,2).'%</td>
			        	</tr>';
				echo $html;
					}
				 else {
					$html='<tr><td colspan="1"><b>No Data</b> </td></tr>';
					echo $html;	
				}
			}else if($cat=='sal' && $sub=='sal_0' && $analytics=='5'){
				$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
				$v_agg=$this->areadirector_model->virtual_agg($start_date,$end_date,$city,$location,$business);
				$p_agg=$this->areadirector_model->private_agg($start_date,$end_date,$city,$location,$business);
				if ($v_agg > 0 || $p_agg > 0) {
					$html = '<tr>
			          		<td colspan="1"><b>Tour : Product(PO): </b> </td><td colspan="1"> '.$total_tour.':'.$v_agg.'</td>
			        	</tr>';
					$html.= '<tr>
			          		<td colspan="1"><b>Tour : Product(VO): </b> </td><td colspan="1"> '.$total_tour.':'.$p_agg.'</td>
			        	</tr>';
					echo $html;
				}else{
					$html='<tr><td colspan="1"><b>No Data</b> </td></tr>';
					echo $html;	
				}
			}
		}
	}
	public function search_analytics_pdf($city = '',$location = '',$business = '',$start_date = '',$end_date = '',$cat = '',$sub = '',$analytics = ''){
		$city 		= $city;
		$location 	= $location;
		$business 	= $business;
		$start_date = $start_date;
		$end_date 	= $end_date;
		$cat 		= $cat;
		$sub 		= $sub;
		$analytics 	= $analytics;
		$this->db->select("cities.name");
		$this->db->from('cities');
		$this->db->where('cities.cityId',$city);
		$query=$this->db->get();
        $data['city_name'] = $query->row();
        $this->db->select("locations.name");
		$this->db->from('locations');
		$this->db->where('locations.locationId',$location);
		$query=$this->db->get();
        $data['location_name'] = $query->row();
        $this->db->select("business_centers.businessName");
		$this->db->from('business_centers');
		$this->db->where('business_centers.business_id',$business);
		$query=$this->db->get();
        $data['business_name'] = $query->row();
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;
		$html = '';
		if($cat=='sal' && $sub=='sal_0' && $analytics=='0'){
			$leads_gnrtd=$this->areadirector_model->leads_gnrtd($start_date,$end_date,$city,$location);
			if (count($leads_gnrtd) > 0) {
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Source</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Of leads Generated</b> </td></tr>';
				foreach($leads_gnrtd as $val){
					$html.= '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['source'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['total'].'</td>
		        	</tr>';
				}	
			} else {
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Source</b> </td><td colspan="1"><b>No Of leads Generated</b> </td></tr>';
				$html.='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';	
			}		
		}else if($cat=='sal' && $sub=='sal_0' && $analytics=='0'){
			$leads_gnrtd=$this->areadirector_model->enq_tour($start_date,$end_date,$city,$location);
			if (count($leads_gnrtd) > 0) {
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Source</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Of leads Generated</b> </td></tr>';
				foreach($leads_gnrtd as $val){
					$html.= '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['source'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['total'].'</td>
		        	</tr>';
				}
			} else {
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Source</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Of leads Generated</b> </td></tr>';
				$html.='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';
			}		
		}else if($cat=='sal' && $sub=='sal_0' && $analytics=='1'){
			$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
			$total_enq =$this->areadirector_model->total_enq($start_date,$end_date,$city,$location);
			$total_tour=($total_tour > 0 ? $total_tour : '0'); ;
			$total_enq=($total_enq > 0 ? $total_enq : '0');
			if($total_enq>0){
			$pcg=($total_tour/($total_enq*100));
			}else{
			$pcg='0';	
			}
			$pcg = ($pcg > 0 ? $pcg : '0'); 
				$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Enquiry to Tour percentage:</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.round($pcg,2).'%</td>
		        	</tr>';
		}else if($cat=='sal' && $sub=='sal_0' && $analytics=='2'){
			$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
			$v_agg=$this->areadirector_model->virtual_agg($start_date,$end_date,$city,$location,$business);
			$p_agg=$this->areadirector_model->private_agg($start_date,$end_date,$city,$location,$business);
			$total_agg=$v_agg+$p_agg;
			if ($total_tour > 0 && $total_agg > 0 ) {
				$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Tour : Deal Conversion: </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"> '.$total_tour.':'.$total_agg.'</td>
		        	</tr>';
				}
			 else {
				$html='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';
			}		
		}else if($cat=='sal' && $sub=='sal_0' && $analytics=='3'){
			$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
			$p_agg=$this->areadirector_model->private_agg($start_date,$end_date,$city,$location,$business);
			if($total_tour>0){
			$total_agg=($p_agg/$total_tour)*100;	
			}else{
			$total_agg='0';	
			}
			if ($total_tour > 0 && $total_agg > 0 ) {
				$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Tour : Office Deal %Conversion: </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"> '.$total_tour.':'.round($total_agg,2).'%</td>
		        	</tr>';
			}else {
				$html='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';
			}	
		}else if($cat=='sal' && $sub=='sal_0' && $analytics=='4'){
			$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
			$v_agg=$this->areadirector_model->virtual_agg($start_date,$end_date,$city,$location,$business);
			$total_agg=($v_agg/$total_tour)*100;
			if ($total_tour > 0 && $total_agg > 0 ) {
				$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Tour : VO % Conversation: </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"> '.$total_tour.':'.round($total_agg,2).'%</td>
		        	</tr>';
				}
			 else {
				$html='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';
			}
		}else if($cat=='sal' && $sub=='sal_0' && $analytics=='5'){
			$total_tour=$this->areadirector_model->total_tour($start_date,$end_date,$city,$location);
			$v_agg=$this->areadirector_model->virtual_agg($start_date,$end_date,$city,$location,$business);
			$p_agg=$this->areadirector_model->private_agg($start_date,$end_date,$city,$location,$business);
			if ($v_agg > 0 || $p_agg > 0) {
				$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Tour : Product(PO): </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"> '.$total_tour.':'.$v_agg.'</td>
		        	</tr>';
				$html.= '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Tour : Product(VO): </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"> '.$total_tour.':'.$p_agg.'</td>
		        	</tr>';
			}else{
				$html='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';	
			}
		}
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['html_pdf'] = $html;
		$pdf = $this->load->view('pdf_analytics', $data, true);
		ini_set('memory_limit','32M');
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetTitle("Smartworks - Analytics");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->WriteHTML($pdf,2);
		$mpdf->Output('Smartworks_analytics_'.date('d_M_Y').'.pdf','D');
		exit;
	}
	/*************Invoice Part start here****************/
	public function all_bills(){
		authenticate(array('ut10'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['table_header_date'] = 'Date';
		$data['table_header_amount'] = 'Amount';
		$data['table_header_description'] = 'Description';
		$data['table_header_action'] = 'Action';
		$flag 	= $this->uri->segment(2);
		$com_id = $this->uri->segment(3);
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'Invoices';
			$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut4 = $query->result_array();	
	        $this->db->select('user.*');
			$this->db->from('user');
			$this->db->where("user.userTypeId = 'ut11'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut11_temp = $query->result_array();
	        $temp_ut11 = array();
	        foreach ($temp_ut11_temp as $key => $value) {
	        	$temp_ut11[] = $value;
	        	$temp_ut11[$key]['company_name'] = 'Individual'; 
	        }
	        $data['userlist'] = array_merge($temp_ut4,$temp_ut11);
			if($com_id != ''){
				$company_id = base64_decode(base64_decode($com_id));
				$data['invoice'] = $this->invoice_model->getInvoice($company_id,$flag);
				$this->load->view("all_bills",$data);
			}else{
				$this->load->view("user_list",$data);
			}
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function account_statements(){
		authenticate(array('ut10'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['acc_statement'] = array();
		if($data['userData']['can_view_bill'] == 1){
			$data['table_heading'] = 'Invoices';
			$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut4 = $query->result_array();	
	        $this->db->select('user.*');
			$this->db->from('user');
			$this->db->where("user.userTypeId = 'ut11'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
	        $query=$this->db->get();
	        $temp_ut11_temp = $query->result_array();
	        $temp_ut11 = array();
	        foreach ($temp_ut11_temp as $key => $value) {
	        	$temp_ut11[] = $value;
	        	$temp_ut11[$key]['company_name'] = 'Individual'; 
	        }
	        $data['userlist'] = array_merge($temp_ut4,$temp_ut11);
			if ($this->input->post()){
				$data['com_id'] 	= $this->input->post('com_id');
				$ud = explode('|++|', $this->input->post('com_id'));
		        $data['userDetails'] = $this->login->getUserProfile($ud[1]);
				$data['start_date'] = $this->input->post('start_date');
				$temp_start_date 	= explode('-', $data['start_date']);
				$data['end_date']	= $this->input->post('end_date');
				$temp_end_date 		= explode('-', $data['end_date']);
				//-------------------------------------------------------
				$starting_balance = $this->invoice_model->get_starting_balance($ud[0],$temp_start_date);
				$starting_balance = ($starting_balance!= '') ? $starting_balance : 0;
				$data['acc_statement']['staring_balance'] 		= $starting_balance;
				//------------------------------------------------------
				$record_invoices 		= $this->invoice_model->get_invoices($ud[0],$temp_start_date,$temp_end_date);
				$record_payment_online 	= array();
				$record_payment_offline = array();
				$record_credit_notes 	= array();

				$sub_invoice_array 		= array();
				$sub_onpay_array 		= array();
				$sub_offpay_array 		= array();
				$sub_credit_note_array 	= array();
				foreach ($record_invoices as $key => $value) {
					$return_data_online = $this->invoice_model->get_payments_online($value['id'],$temp_start_date,$temp_end_date);
					if(count($return_data_online) != 0 && !empty($return_data_online)){
						$record_payment_online[] = $return_data_online;
					}

					$return_data_offline = $this->invoice_model->get_payments_offline($temp_start_date,$temp_end_date);
					if(count($return_data_offline) != 0 && !empty($return_data_offline)){
						$record_payment_offline = $return_data_offline;
					}

					$return_data_credit_notes = $this->invoice_model->get_credit_notes($temp_start_date,$temp_end_date);
					if(count($return_data_credit_notes) != 0 && !empty($return_data_credit_notes)){
						$record_credit_notes = $return_data_credit_notes;
					}
				}
				foreach ($record_invoices as $key => $value) {
					$sub_invoice_array[] = array('p_date'=>$value['publish_date'],'t_type'=>'Invoice','t_number'=>$value['invoice_number'],'t_status'=>'debit','t_amount'=>$value['total_amount']); 
				}
				foreach ($record_payment_online as $row) {
					foreach ($row as $key => $value) {
						$sub_onpay_array[] = array('p_date'=>$value['niceDate'],'t_type'=>'Online Payment','t_number'=>$value['Transaction_Reference_No'],'t_status'=>'paid','t_amount'=>($value['Amount']/100)); 
					}
				}
				foreach ($record_payment_offline as $key => $value) {
					$sub_offpay_array[] = array('p_date'=>$value['niceDate'],'t_type'=>'Payment','t_number'=>$value['invoice_number'],'t_status'=>'credit','t_amount'=>$value['Amount']); 
				}
				foreach ($record_credit_notes as $key => $value) {
					$sub_credit_note_array[] = array('p_date'=>$value['dateApproved'],'t_type'=>'Credit','t_number'=>$value['invoice_no'],'t_status'=>'credit','t_amount'=>$value['creditnote_amount']); 
				}
				$main_array = array_merge($sub_invoice_array,$sub_onpay_array,$sub_offpay_array,$sub_credit_note_array);
				$name = 'p_date';
			   	usort($main_array, function ($a, $b) use(&$name){return strtotime($a[$name]) - strtotime($b[$name]);});
			   	$last_array = array();
			   	$temp_amnt = $starting_balance;
			   	foreach ($main_array as $key => $value) {
			   			$last_array[] = $value;
			   			if($value['t_status'] == 'debit'){
			   				$temp_amnt = $temp_amnt - $value['t_amount'];
			   				$last_array[$key]['t_outstanding'] = $temp_amnt;
			   			}elseif ($value['t_status'] == 'credit') {
			   				$temp_amnt = $temp_amnt + $value['t_amount'];
			   				$last_array[$key]['t_outstanding'] = $temp_amnt;
			   			}elseif ($value['t_status'] == 'paid') {
			   				$temp_amnt = $temp_amnt + $value['t_amount'];
			   				$last_array[$key]['t_outstanding_credit'] = $temp_amnt;
			   				$temp_amnt = $temp_amnt - $value['t_amount'];
			   				$last_array[$key]['t_outstanding_debit'] = $temp_amnt;
			   			}
			   	}
			   	$ending_array = end($last_array);
				$data['acc_statement']['ending_balance'] 		= $ending_array['t_outstanding'];
				$data['acc_statement']['ending_balance_date']	= $ending_array['p_date'];
			   	$reversed_main_array = array_reverse($last_array, true);
			   	$starting_array = end($reversed_main_array);
			   	$data['acc_statement']['staring_balance_date']	= $starting_array['p_date'];
				$data['acc_statement']['invoice'] = $reversed_main_array;
			}
			$data['table_heading'] = 'Statement of Accounts';
			$this->load->view("account_statement",$data);
		}else{
			exit("You are not authorize to access this page");
		}
	}
	public function generate_invoice_html_view($invid = '',$com_id = ''){
		authenticate(array('ut10'));
		if($invid == ''){
			die('Not accessable this page');
		}elseif($com_id == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($invid));
		$company_id = base64_decode(base64_decode($com_id));
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['title'] = 'Smartworks - Invoice';
		$data['company'] = $this->invoice_model->getCompanyDetails($company_id);
		$data['invoice'] = $this->invoice_model->getInvoiceById($invoice_id);
		$this->db->select("locations.email");
		$this->db->from('locations');
		$this->db->where('locations.locationId',$data['company']['location_id']);
		$query=$this->db->get();
		if(!empty($query->result_array())){
			$data['community_manager'] = $query->result_array()[0]['email'];
		}else{
			$data['community_manager'] = '';
		}
		if(empty($data['invoice'])){
			die('Not accessable this page');
		}
		$data['discount'] = $this->invoice_model->getDiscountById($invoice_id);
		$data['invoice_items'] = $this->invoice_model->getInvoiceItems($invoice_id);
		$this->load->view('invoice/html_view_first', $data);
		$this->load->view('invoice/html_view_second', $data);
		$this->load->view('invoice/html_view_third', $data);
		$this->load->view('invoice/html_view_fourth', $data);
	}
	public function generate_invoice_pdf($invid = '',$com_id = ''){
		authenticate(array('ut10'));
		if($invid == ''){
			die('Not accessable this page');
		}elseif($com_id == ''){
			die('Not accessable this page');
		}
		$invoice_id = base64_decode(base64_decode($invid));
		$company_id = base64_decode(base64_decode($com_id));
		$data['logo_img'] = $this->gallery_path_url.'logo.png';
		$data['company'] = $this->invoice_model->getCompanyDetails($company_id);
		$data['invoice'] = $this->invoice_model->getInvoiceById($invoice_id);
		$this->db->select("locations.email");
		$this->db->from('locations');
		$this->db->where('locations.locationId',$data['company']['location_id']);
		$query=$this->db->get();
		if(!empty($query->result_array())){
			$data['community_manager'] = $query->result_array()[0]['email'];
		}else{
			$data['community_manager'] = '';
		}
		if(empty($data['invoice'])){
			die('Not accessable this page');
		}
		$data['discount'] = $this->invoice_model->getDiscountById($invoice_id);
		$data['invoice_items'] = $this->invoice_model->getInvoiceItems($invoice_id);
		$html = $this->load->view('invoice/pdf_html_first', $data, true);
		$html1 = $this->load->view('invoice/pdf_html_second', $data, true);
		$html3 = $this->load->view('invoice/pdf_html_third', $data, true);
		$html4 = $this->load->view('invoice/pdf_html_fourth', $data, true);
		ini_set('memory_limit','32M');
		//$this->load->library('pdf');
		//$mpdf = $this->pdf->load();
		include_once APPPATH.'/third_party/mpdf60/mpdf.php';
		$mpdf=new mPDF('c','A4','','',0,0,5,5,5,5);
		$mpdf->SetDisplayMode('fullpage');
		$mpdf->SetTitle("Smartworks - Invoice");
		$mpdf->SetAuthor("Smartworks Co.");
		$mpdf->WriteHTML($html,2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($html1,2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($html3,2);
		$mpdf->AddPage();
		$mpdf->WriteHTML($html4,2);
		//$mpdf->debug = true;
		$mpdf->Output('Smartworks_'.date('d_M_Y').'.pdf','I');
		exit;
	}
	/*************Invoice Part start here****************/
	public function center_dashBoard(){
		authenticate(array('ut10'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
        $data['location']=$this->lm->getlocationbycity($data['userData']['city_id']); 
		$data['cities']=$this->lm->getcities();
		$data['business_data']=$this->client_model->getbusinessbyuserlocation($data['userData']['city_id'],$data['userData']['location_id']);
		$data['room_data_conference']=$this->rooms_model->getbusinesslocation($data['business_data'][0]['business_id'],'conference');
		$data['room_data_meeting']=$this->rooms_model->getbusinesslocation($data['business_data'][0]['business_id'],'meeting');
		$data['room_data_day']=$this->rooms_model->getbusinesslocation($data['business_data'][0]['business_id'],'dayoffice');
		$data['mainArray'] = array('Conference Room' => $data['room_data_conference'],'Meeting Room' => $data['room_data_meeting'],'Day office'=>$data['room_data_day']);
		$book_data['bookingdate']=date('d-m-Y');
		$book_data['bookingid']=$data['room_data_conference'][0]['id'];
		$book_data['bookingtype']="Conference Room";
		$booking_listing=$this->receptionist_listing->get_bookdata_bydate($book_data);
		foreach($booking_listing as $bklist){
			$booking_status=$this->receptionist_listing->get_check_info_byid($bklist['id']);
			$booking_details_arr=json_decode($bklist['booking_details']);
				if($bklist['book_for']<>$bklist['company_id']){
					$clientname=$bklist['FirstName']." ".$bklist['LastName']."(".$bklist['company_name'].")";
				}
			    else{
			    	$clientname=$bklist['FirstName']." ".$bklist['LastName']."(Individual)";
			    }
			
			if(!empty($booking_details_arr->$book_data['bookingdate'])){
				foreach($booking_details_arr->$book_data['bookingdate'] as $k=>$v){
					$timestamp = strtotime($v) + 60*60;
					$start_time=date('h:i A',strtotime($v));
	                $time = date('h:i A', $timestamp);
	                $checkstatus=array(
	                	'booking_id'=>$bklist['id'],
	                	'booking_date'=>date('Y-m-d',strtotime($book_data['bookingdate'])),
	                	'start_time'=>$start_time,
	                	'end_time'=>$time
	                	);
					$checking_status=$this->receptionist_listing->get_checkinstatus_forbooking($checkstatus);
					if(count($checking_status)>0){
                    	$status=$checking_status[0]['status'];
                    }else{
                    	$status=0;
                    }
						$booking_data[]=array(
						'id'=>$bklist['id'],
						'table'=>'book_conference_room',
						'date'=>$book_data['bookingdate'],
						'start_time'=>$start_time,
						'end_time'=>$time,
						'Room'=>$bklist['name'],
						'client'=>$clientname,
						'status'=>$status
						);
								
			    }
			}
			

		}
		if(empty($booking_data)){
			$data['book_data']="";
		}else{
			$data['book_data']=$booking_data;
		}

	   $this->load->view('center_dashBoard',$data);
	  }
}
