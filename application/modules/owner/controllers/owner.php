<?php
class Owner extends MY_Controller {
	
	var $gallery_path;
	var $gallery_path_url;
	
	public function __construct() {
		parent::__construct();
	//	authenticate();
		$this->load->helper('url');
	    $this->load->model('users/login');
	    $this->load->model('complaints/complaints_model');
	    $this->load->model('areadirector/areadirector_model');
	    $this->load->model('owner_model');
	    $this->load->model('location/location_model', 'lm');
	    $this->load->helper('common');
		$this->load->helper('form'); 
		$this->gallery_path = realpath(APPPATH . '../assets/uploads/images');
		$this->gallery_path_url = $this->config->item('base_url').'assets/uploads/images/';
		$this->video_gallery_path = realpath(APPPATH . '../assets/uploads');
	//	$this->load->library('session');
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
		if($cat=='op' && $sub=='op_0' && $analytics=='0'){
			$total_ws=$this->owner_model->total_ws($business,$start_date,$end_date);
			$total_ws = ($total_ws[0]->no_of_people > 0 ? $total_ws[0]->no_of_people : '0'); 
			$html = '<tr>
		          		<td colspan="1"><b>Total No of Ws:</b> </td><td colspan="1">'.$total_ws.'</td>
		        	</tr>';
			echo $html;
		}else if($cat=='op' && $sub=='op_0' && $analytics=='1'){
			$total_ws_booked=$this->owner_model->total_ws_booked($business,$start_date,$end_date);
			$total_ws_booked = ($total_ws_booked > 0 ? $total_ws_booked : '0'); 
			$html = '<tr>
		          		<td colspan="1"><b>Number of occupied WS:</b> </td><td colspan="1">'.$total_ws_booked.'</td>
		        	</tr>';
			echo $html;
		}else if($cat=='op' && $sub=='op_0' && $analytics=='2'){
			$total_ws=$this->owner_model->total_ws($business,$start_date,$end_date);
			$total_ws_booked=$this->owner_model->total_ws_booked($business,$start_date,$end_date);
			$total_ws_booked_occupancy = (($total_ws_booked/($total_ws[0]->no_of_people))*100);
			$total_ws_booked_occupancy = ($total_ws_booked_occupancy > 0 ? $total_ws_booked_occupancy : '0'); 
			$html = '<tr>
		          		<td colspan="1"><b>Occupancy percentage in terms of Office and WS:</b> </td><td colspan="1">'.round($total_ws_booked_occupancy,2).'%</td>
		        	</tr>';
			echo $html;
		}else if($cat=='op' && $sub=='op_0' && $analytics=='3'){
			$total_ws=$this->owner_model->total_ws($business,$start_date,$end_date);
			$total_price=$this->owner_model->total_price($business);
			$avg_price=(($total_price['price'])/$total_ws[0]->no_of_people);
			$avg_price=	($avg_price > 0 ? $avg_price : '0');
			$html = '<tr>
		          		<td colspan="1"><b>Average Price per WS: </b> </td><td colspan="1">INR '.round($avg_price,2).'</td>
		        	</tr>';
			echo $html;
		}else if($cat=='op' && $sub=='op_0' && $analytics=='4'){
			$total_vo_office=$this->owner_model->total_vo_office($business);
			$total_vo_office=($total_vo_office > 0 ? $total_vo_office : '0');
			$html = '<tr>
		          		<td colspan="1"><b>Total number of Virtual Office: </b> </td><td colspan="1">'.$total_vo_office.'</td>
		        	</tr>';
			echo $html;	
		}else if($cat=='op' && $sub=='op_0' && $analytics=='5'){
			$total_vo_office_booked=$this->owner_model->total_vo_office_booked($business);
			if (count($total_vo_office_booked) > 0) {
				$html = '<tr><td colspan="1"><b>Duration</b> </td><td colspan="1"><b>Start Date</b> </td><td colspan="1"><b>End Date</b> </td>
				<td colspan="1"><b>Customers</b> </td></tr>';
				foreach($total_vo_office_booked as $val){
					$start_date = strtotime($val->start_date);
		            $end_date = strtotime($val->end_date);
				    $datediff = $end_date - $start_date;
				    $duration = floor($datediff/(60*60*24));
					$html.= '<tr>
		          		<td colspan="1">'.$duration.' days</td><td colspan="1">'.$val->start_date.'</td><td colspan="1">'.$val->end_date.'</td><td colspan="1">'.ucfirst($val->FirstName).' '.ucfirst($val->LastName).'('.$val->company_name.')</td>
		        	</tr>';
			}
			echo $html;	
			}else{
				$html = '<tr><td colspan="1"><b>Duration</b> </td><td colspan="1"><b>Start Date</b> </td><td colspan="1"><b>End Date</b> </td>
				<td colspan="1"><b>Customers</b> </td></tr>';
				$html.='<tr><td colspan="4"><b>No Data</b> </td></tr>';
				echo $html;	
			}
	  	}else if($cat=='op' && $sub=='op_1' && $analytics=='0'){
			$total_revenue=$this->owner_model->total_revenue($business,$start_date,$end_date);	
			$html = '<tr><td colspan="1"><b>Room Types</b> </td><td colspan="1" style="text-align:left;"><b>Revenue (INR)</b> </td></tr>';
			foreach($total_revenue['rooms'] as $value){
				foreach($value as $key => $val){
				$html.= '<tr>
	          		<td colspan="1">'.$key.'</td><td colspan="1" style="text-align:left;">'.$val.'</td></tr>';
	          	}
			}
			$html.= '<tr>
	          		<td colspan="1"><b>Total Revenue</b></td><td colspan="1" style="text-align:left;">'.$total_revenue['total'].'</td></tr>';
			echo $html;	
			exit;
		}else if($cat=='op' && $sub=='op_1' && $analytics=='1'){
	    	$occupancy_percentage=$this->owner_model->occupancy_percentage($business,$start_date,$end_date);	
			echo $occupancy_percentage;
			exit;
	    }else if($cat=='op' && $sub=='op_1' && $analytics=='2'){
		    $enquiery=$this->owner_model->enquiery($start_date,$end_date);	
			$enquiery=($enquiery > 0 ? $enquiery : '0');
			$html = '<tr>
		          		<td colspan="1"><b>No. Of Enquiry for the above mentioned services: </b> </td><td colspan="1">'.$enquiery.'</td>
		        	</tr>';
			echo $html;	
		}else if($cat=='op' && $sub=='op_2' && $analytics=='0'){
	        $customers=$this->owner_model->get_customers($start_date,$end_date,$city,$location);
	        $customers_individual=$this->owner_model->get_customers_individual($start_date,$end_date,$city,$location);
			if (count($customers) > 0) {
				$html = '<tr><td colspan="1"><b>Customer Name</b> </td><td colspan="1"><b>Address</b> </td><td colspan="1"><b>Phone Number</b> </td>
				<td colspan="1"><b>Email Address</b> </td><td colspan="1"><b>Type Of Customer</b> </td></tr>';
				foreach($customers as $val){
					if(isset($val['types']))
					{
						$types = implode(',', $val['types']);
					}else{
						$types = '';
					}
					$html.= '<tr>
		          		<td colspan="1">'.ucfirst($val['FirstName']).' '.ucfirst($val['LastName']).'('.$val['company_name'].')</td><td colspan="1">'.$val['address'].'</td><td colspan="1">'.$val['phone'].'</td><td colspan="1">'.$val['userEmail'].'</td><td colspan="1">'.$types.'</td>;
		        	</tr>';
				}
				foreach($customers_individual as $val){
					if(isset($val['types']))
					{
						$types = implode(',', $val['types']);
					}else{
						$types = '';
					}
					$html.= '<tr>
		          		<td colspan="1">'.ucfirst($val['FirstName']).' '.ucfirst($val['LastName']).'(Individual)</td><td colspan="1">'.$val['address'].'</td><td colspan="1">'.$val['phone'].'</td><td colspan="1">'.$val['userEmail'].'</td><td colspan="1">'.$types.'</td>;
		        	</tr>';
				}
				echo $html;	
			}else{
				$html = '<tr><td colspan="1"><b>Customer Name</b> </td><td colspan="1"><b>Address</b> </td><td colspan="1"><b>Phone Number</b> </td>
				<td colspan="1"><b>Email Address</b> </td><td colspan="1"><b>Type Of Customer</b> </td></tr>';
				$html.='<tr><td colspan="5"><b>No Data</b> </td></tr>';
				echo $html;	
			}
		}

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
			}else{
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
			}else{
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
				}
			 else {
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
		if($cat=='op' && $sub=='op_0' && $analytics=='0'){
			$total_ws=$this->owner_model->total_ws($business,$start_date,$end_date);
			$total_ws = ($total_ws[0]->no_of_people > 0 ? $total_ws[0]->no_of_people : '0'); 
			$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Total No of Ws:</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$total_ws.'</td>
		        	</tr>';
		}else if($cat=='op' && $sub=='op_0' && $analytics=='1'){
			$total_ws_booked=$this->owner_model->total_ws_booked($business,$start_date,$end_date);
			$total_ws_booked = ($total_ws_booked > 0 ? $total_ws_booked : '0'); 
			$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Number of occupied WS:</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$total_ws_booked.'</td>
		        	</tr>';
		}else if($cat=='op' && $sub=='op_0' && $analytics=='2'){
			$total_ws=$this->owner_model->total_ws($business,$start_date,$end_date);
			$total_ws_booked=$this->owner_model->total_ws_booked($business,$start_date,$end_date);
			$total_ws_booked_occupancy = (($total_ws_booked/($total_ws[0]->no_of_people))*100);
			$total_ws_booked_occupancy = ($total_ws_booked_occupancy > 0 ? $total_ws_booked_occupancy : '0'); 
			$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Occupancy percentage in terms of Office and WS:</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.round($total_ws_booked_occupancy,2).'%</td>
		        	</tr>';
		}else if($cat=='op' && $sub=='op_0' && $analytics=='3'){
			$total_ws=$this->owner_model->total_ws($business,$start_date,$end_date);
			$total_price=$this->owner_model->total_price($business);
			$avg_price=(($total_price['price'])/$total_ws[0]->no_of_people);
			$avg_price=	($avg_price > 0 ? $avg_price : '0');
			$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Average Price per WS: </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">INR '.round($avg_price,2).'</td>
		        	</tr>';
		}else if($cat=='op' && $sub=='op_0' && $analytics=='4'){
			$total_vo_office=$this->owner_model->total_vo_office($business);
			$total_vo_office=($total_vo_office > 0 ? $total_vo_office : '0');
			$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Total number of Virtual Office: </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$total_vo_office.'</td>
		        	</tr>';
		}else if($cat=='op' && $sub=='op_0' && $analytics=='5'){
			$total_vo_office_booked=$this->owner_model->total_vo_office_booked($business);
			if (count($total_vo_office_booked) > 0) {
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Duration</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Start Date</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>End Date</b> </td>
				<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Customers</b> </td></tr>';
				foreach($total_vo_office_booked as $val){
					$start_date = strtotime($val->start_date);
		            $end_date = strtotime($val->end_date);
				    $datediff = $end_date - $start_date;
				    $duration = floor($datediff/(60*60*24));
					$html.= '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$duration.' days</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val->start_date.'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val->end_date.'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.ucfirst($val->FirstName).' '.ucfirst($val->LastName).'('.$val->company_name.')</td>
		        	</tr>';
				}	
			}else{
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Duration</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Start Date</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>End Date</b> </td>
				<td colspan="1"><b>Customers</b> </td></tr>';
				$html.='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';
			}
	  	}else if($cat=='op' && $sub=='op_1' && $analytics=='0'){
			$total_revenue=$this->owner_model->total_revenue($business,$start_date,$end_date);	
			$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Room Types</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Revenue (INR)</b> </td></tr>';
			foreach($total_revenue['rooms'] as $value){
				foreach($value as $key => $val){
				$html.= '<tr>
	          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$key.'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val.'</td></tr>';
	          	}
			}
			$html.= '<tr>
	          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Total Revenue</b></td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$total_revenue['total'].'</td></tr>';	
		}else if($cat=='op' && $sub=='op_1' && $analytics=='1'){
	    	$occupancy_percentage=$this->owner_model->occupancy_percentage($business,$start_date,$end_date);	
			$occupancy_percentage;
	    }else if($cat=='op' && $sub=='op_1' && $analytics=='2'){
		    $enquiery=$this->owner_model->enquiery($start_date,$end_date);	
			$enquiery=($enquiery > 0 ? $enquiery : '0');
			$html = '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No. Of Enquiry for the above mentioned services: </b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$enquiery.'</td>
		        	</tr>';
		}else if($cat=='op' && $sub=='op_2' && $analytics=='0'){
	        $customers=$this->owner_model->get_customers($start_date,$end_date,$city,$location);
	        $customers_individual=$this->owner_model->get_customers_individual($start_date,$end_date,$city,$location);
			if (count($customers) > 0 || count($customers_individual)) {
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Customer Name</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Address</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Phone Number</b> </td>
				<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Email Address</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Type Of Customer</b> </td></tr>';
				foreach($customers as $val){
					if(isset($val['types']))
					{
						$types = implode(',', $val['types']);
					}else{
						$types = '';
					}
					$html.= '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.ucfirst($val['FirstName']).' '.ucfirst($val['LastName']).'('.$val['company_name'].')</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['address'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['phone'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['userEmail'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$types.'</td>;
		        	</tr>';
				}

				foreach($customers_individual as $val){
					if(isset($val['types']))
					{
						$types = implode(',', $val['types']);
					}else{
						$types = '';
					}
					$html.= '<tr>
		          		<td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.ucfirst($val['FirstName']).' '.ucfirst($val['LastName']).'(Individual)</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['address'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['phone'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$val['userEmail'].'</td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;">'.$types.'</td>;
		        	</tr>';
				}
			}else{
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Customer Name</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Address</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Phone Number</b> </td>
				<td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Email Address</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Type Of Customer</b> </td></tr>';
				$html.='<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Data</b> </td></tr>';
			}
		}
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
				$html = '<tr><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>Source</b> </td><td colspan="2" style="padding:15px; border: 1px solid #dddddd;"><b>No Of leads Generated</b> </td></tr>';
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
public function get_subcat(){
	$val=$this->input->post('value');
    $data['sub_cat_op']=array('Office and Virtual Office','MR/VC/CR/TR/DO','Address Listing');
    $data['sub_cat_sal']=array('Sales');
		if($val!=''){
			echo '<option value="">Select Sub Category</option>';
		if($val=='op')
		{
			foreach($data['sub_cat_op'] as $key=>$value)
			{
				echo '<option value="op_'.$key.'">'.$value.'</option>'; 
			}			
		}elseif($val=='sal'){
            foreach($data['sub_cat_sal'] as $key=>$value)
			{
				echo '<option value="sal_'.$key.'">'.$value.'</option>'; 
			}
		}else{
			echo '<option value="0">No Sub Category</option>';
			
		}
	}else{
		echo '<option value="0">No Sub Category</option>';
	}
}
public function get_analytics(){
$val=$this->input->post('value');
$data['analytics_office']=array('Total number of WS','Number of occupied WS','Occupancy percentage in terms of Office and WS','Average Price per WS','Total number of Virtual Office','Term and Tenure of customers');
$data['analytics_rooms']=array('Revenue','Occupancy Percentage','No. Of Enquiry for the above mentioned services');
$data['analytics_address']=array('Customer Details');
$data['analytics_sales']=array('Leads Generated with source','Enquiry to Tour percentage','Tour : Deal Conversion','Tour : Office Deal %Conversion','Tour : VO % Conversation','Tour to Product');
	if($val!=''){
		echo '<option value="">Select Analytics</option>';
		if($val=='op_0'){
			foreach($data['analytics_office'] as $key=>$value){
				echo '<option value="'.$key.'">'.$value.'</option>'; 
			}			
		}elseif($val=='op_1'){
            foreach($data['analytics_rooms'] as $key=>$value){
				echo '<option value="'.$key.'">'.$value.'</option>'; 
			}
		}elseif($val=='op_2'){
            foreach($data['analytics_address'] as $key=>$value){
				echo '<option value="'.$key.'">'.$value.'</option>'; 
			}
		}elseif($val=='sal_0'){
            foreach($data['analytics_sales'] as $key=>$value){
				echo '<option value="'.$key.'">'.$value.'</option>'; 
			}
		}else{
			echo '<option value="0">No Analytics Available</option>';
		}
	}else{
		echo '<option value="0">No Analytics Available</option>';
	}

}
 public function test_header(){
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$this->load->view('test_header',$data);
	}
 
public function analytics(){
 authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['cities']=$this->lm->getcities();
	         $this->load->view("analytics",$data);	
	
}
 public function index(){
		$this->session->sess_destroy();
		$this->load->view('owner_login');
	}



     public function dashBoard(){
		  authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['total_clients']= $this->owner_model->get_clients_count_details();
		$data['total_occupancy']= $this->owner_model->get_total_occupancy();
		$data['total_services']=$this->owner_model->get_total_services();
		$data['total_seats']=$this->owner_model->get_total_seats();
		$data['total_complaints']=$this->owner_model->get_total_complaints();
		$this->load->view("owner_dashboard",$data);	
       }
       
        public function client_list(){
	    authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['total_client']= $this->owner_model->get_client_list();
		$data['cities']=$this->lm->getcities();	
        $this->load->view("client_list",$data);	
       }
           public function occupancy_list(){
	    authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['total_occupancy']= $this->owner_model->get_occupancy_list();
		$data['cities']=$this->lm->getcities();	
        $this->load->view("occupancy_list",$data);	
       }
     public function service_list(){
	    authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['total_service']= $this->owner_model->get_service_list();
		$data['cities']=$this->lm->getcities();	
        $this->load->view("service_list",$data);	
       }
        public function seats_list(){
	    authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['total_seats']= $this->owner_model->get_total_seats();
		$data['cities']=$this->lm->getcities();	
        $this->load->view("seats_list",$data);	
       }
       public function complaint_list(){
	    authenticate(array('ut2'));
        $userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['total_complaints']= $this->owner_model->get_complaint_list();
		$data['cities']=$this->lm->getcities();	
        $this->load->view("complaint_list",$data);	
       }
       
   public function get_result(){
	    authenticate(array('ut2'));
	   	if($_POST)
		{
			$location_id = $_POST['location_id'];
			$city_id = $_POST['city_id'];
			
	$result_client= $this->owner_model->get_client_result($location_id,$city_id);
	echo $result_client;   
 }  
   } 
   
 public function get_result_occupancy(){
	  authenticate(array('ut2'));
   	if($_POST)
		{
			$location_id = $_POST['location_id'];
			$city_id = $_POST['city_id'];
			$room=$_POST['room'];
			
	$result_occupancy= $this->owner_model->get_occupancy_result($location_id,$city_id,$room);
	echo $result_occupancy;   
 } 	 
	 
	 
	 
 }
 public function get_result_services(){
	  authenticate(array('ut2'));
   	if($_POST)
		{
			$location_id = $_POST['location_id'];
			$city_id = $_POST['city_id'];
			$request=$_POST['request'];
			
	$result_services= $this->owner_model->get_service_result($location_id,$city_id,$request);
	echo $result_services;   
 } 	 
	 
	 
	 
 }
 public function get_result_seats(){
	  authenticate(array('ut2'));
if($_POST)
		{
			$location_id = $_POST['location_id'];
			$city_id = $_POST['city_id'];
			$business_id=$_POST['business_id'];
			
	$result_seats= $this->owner_model->get_seat_result($location_id,$city_id,$business_id);
	echo $result_seats;   	 
	 
 }
}
 public function get_result_complaints(){
	  authenticate(array('ut2'));
	if($_POST)
		{
			$location_id = $_POST['location_id'];
			$city_id = $_POST['city_id'];
			
			
	$result_complaints= $this->owner_model->get_complaint_result($location_id,$city_id);
	echo $result_complaints;   	 
	 
 }
	
}	

public function discounts_list(){
        authenticate(array('ut2'));
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['discount_data']=$this->owner_model->get_discount_data();	
		$this->load->view('owner_discounts_list',$data);
}
	
	
public function apprequest(){
		authenticate(array('ut2'));
		$appid=$this->input->post('appid');
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['isApproved']=$this->input->post('isApproved');
		$data['discount_info']=$this->owner_model->get_discount_info($appid);
		$this->load->view('request_discounts',$data);
	
}	
public function appview(){
authenticate(array('ut2'));
		$appid=$this->input->post('appid');
		
		$userId = $this->session->userdata("userId");
		$userTypeId = $this->session->userdata("userTypeId");
		$data['userData'] = $this->login->getUserProfile($userId);
		$data['discount_info']=$this->owner_model->get_discount_info($appid);
		
		
		
		$this->load->view('view_request_discounts',$data);	
	
}
public function	reject_discount(){
	 authenticate(array('ut2'));
if($_POST)
		{
			$appid = $_POST['appid'];
			
			$appdata=array(
		'IsApproved'=>'2',
		'approvedBy'=>$this->session->userdata("userId"),
		'dateApproved'=>date('y-m-d h:i:s')
		);
		
$data['update_discount_info']=$this->owner_model->update_discount_info($appid,$appdata);		
}
}
public function	approved_discount(){
	 authenticate(array('ut2'));
	if($_POST)
		{
			$appid = $_POST['appid'];
			
			$appdata=array(
		'IsApproved'=>'1',
		'approvedBy'=>$this->session->userdata("userId"),
		'dateApproved'=>date('y-m-d h:i:s')
		);
		
$data['update_discount_info']=$this->owner_model->update_discount_info($appid,$appdata);	
}
}
	
	
	
	
}
