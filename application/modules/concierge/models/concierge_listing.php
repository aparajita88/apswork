<?php

class concierge_listing extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
	
	public function getServiceRequests($cityId){
		$this->db->select("request_conceirge_service.*,company.company_name");
		$this->db->from('request_conceirge_service');
		$this->db->join('company','company.id=request_conceirge_service.company_id');
		$this->db->where('request_conceirge_service.city_id',$cityId);
		//$this->db->where('request_conceirge_service.status','1');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function details($sid,$reqtype){
		if($reqtype=='Flight' || $reqtype=='Train' || $reqtype=='Bus' || $reqtype=='Cab'){
			$this->db->select("request_conceirge_service.*,cities.name as cityName,locations.name as locationName");
		$this->db->from('request_conceirge_service');
		$this->db->join('cities','cities.cityId=request_conceirge_service.city_id');
		$this->db->join('locations','locations.locationId=request_conceirge_service.location_id');
		$this->db->where('request_conceirge_service.id',$sid);
		$query=$this->db->get();
		return $query->result_array();
	}else if($reqtype=="Hotel"){
			$this->db->select("request_conceirge_hotel.*,company.company_name");
			$this->db->from('request_conceirge_hotel');
			$this->db->join('company','company.id=request_conceirge_hotel.company_id');
			$this->db->where('request_conceirge_hotel.Id',$sid);
			$query=$this->db->get();
			return $query->result_array();
		}
		else if($reqtype=="Movie" || $reqtype=="Restaurant" || $reqtype=="Event" || $reqtype=="Experience"){
			$this->db->select("request_conceirge_booking.*,company.company_name");
			$this->db->from('request_conceirge_booking');
			$this->db->join('company','company.id=request_conceirge_booking.company_id');
			$this->db->where('request_conceirge_booking.Id',$sid);
			$query=$this->db->get();
			return $query->result_array();
		}
		
	}
	public function approve_request($data){
		authenticate(array('ut8'));
		$rid = $data['requestId'];
		$ReqTableName = 'request_conceirge_service';
		$comid = $data['comid'];
		
		// data for Table: invoice table
		$invoiceData = $this->get_invoice_by_comid($comid);
		$invoiceId = $invoiceData[0]['id'];
		$invoicePrice=$invoiceData[0]['sub_total']+$data['price'];
        $invoiceData=array(
        'sub_total'=>$invoicePrice
        );
		$this->db->where('id',$invoiceId);
		$this->db->update('invoices',$invoiceData);
		
		// data for Table: invoice_items
		$invoice_item_data=array(
        'id'=>substr(create_guid(),0,16),
        'invoice_id'=>$invoiceId,
        'description'=>$data['serviceDesc'],
        'quantity'=>'1',
        'unit_price'=>$data['price'],
        'total'=>$data['price'],
		'table_name'=> $ReqTableName,
		'row_id'=> $rid
        );
		$this->db->insert('invoice_items',$invoice_item_data);
		// data for Table: request_conceirge_service
        $appdata=array(
        'is_approved'=>'1',
		'approvedBy'=>$data['userId'],
        'dateApproved'=>date('Y-m-d h:i:s'),
        'price'=>$data['price'],
        'dateModified'=>date('Y-m-d h:i:s')
        );
        if($data['reqtype']=='Flight' || $data['reqtype']=='Train' || $data['reqtype']=='Bus' || $data['reqtype']=='Cab'){
        	$this->db->where('id', $rid);
		    $this->db->update('request_conceirge_service', $appdata);
        }else if($data['reqtype']=='Hotel'){
        	$this->db->where('Id', $rid);
		    $this->db->update('request_conceirge_hotel', $appdata);
        }else if($data['reqtype']=='Movie' || $data['reqtype']=='Restaurant' || $data['reqtype']=='Event' || $data['reqtype']=='Experience'){
        	$this->db->where('Id', $rid);
		    $this->db->update('request_conceirge_booking', $appdata);
        }
		
		
		return true;
		
	}
	public function getUserProfile_by_service($serviceId,$reqtype){
	 if($reqtype=="travel"){
		$this->db->select("request_conceirge_service.*,user.FirstName,user.LastName,user.userEmail");
		$this->db->from('request_conceirge_service');
		$this->db->join('user','user.userId=request_conceirge_service.requested_by');
		$this->db->where('request_conceirge_service.id',$serviceId);
		//$this->db->where('request_conceirge_service.transport_type',$reqtype);
		$query=$this->db->get();
		return $query->result_array();
		}
		else if($reqtype=="hotel"){
			$this->db->select("request_conceirge_hotel.*,user.FirstName,user.LastName,user.userEmail");
		$this->db->from('request_conceirge_hotel');
		$this->db->join('user','user.userId=request_conceirge_hotel.requested_by');
		$this->db->where('request_conceirge_hotel.Id',$serviceId);
		$query=$this->db->get();
		return $query->result_array();
		}
		else if($reqtype=="booking"){
			$this->db->select("request_conceirge_booking.*,user.FirstName,user.LastName,user.userEmail");
		$this->db->from('request_conceirge_booking');
		$this->db->join('user','user.userId=request_conceirge_booking.requested_by');
		$this->db->where('request_conceirge_booking.Id',$serviceId);
		$query=$this->db->get();
		return $query->result_array();
		}   
	    
	    
	}
	public function reject_request($serviceId,$reqtype){
		$appdata=array(
		  'is_approved'=>'2'
		);
		if($reqtype=='travel'){
			$this->db->where('id',$serviceId);
			$this->db->update('request_conceirge_service',$appdata);
	    }
	    else if($reqtype=='hotel'){
	    	$this->db->where('Id',$serviceId);
			$this->db->update('request_conceirge_hotel',$appdata);
	    }else if($reqtype=='booking'){
	    	$this->db->where('Id',$serviceId);
			$this->db->update('request_conceirge_booking',$appdata);
	    }
		return true;
	}
	function get_invoice_by_comid($comid){
		$query=$this->db->get_where('invoices',array('customerId'=>$comid)); // this 'customerId' is actually companyId
		return $query->result_array();
		
	}
	public function get_request_service_bytype($reqtype,$city_id){
		if($reqtype=="Train" || $reqtype=="Bus" || $reqtype=="Flight" || $reqtype=="Cab"){
			$this->db->select("request_conceirge_service.*,company.company_name");
		$this->db->from('request_conceirge_service');
		$this->db->join('company','company.id=request_conceirge_service.company_id');
		$this->db->where('request_conceirge_service.city_id',$city_id);
		$this->db->where('request_conceirge_service.transport_type',$reqtype);
		$query=$this->db->get();
		return $query->result_array();
		}
		else if($reqtype=="Hotel"){
			$this->db->select("request_conceirge_hotel.*,company.company_name");
		$this->db->from('request_conceirge_hotel');
		$this->db->join('company','company.id=request_conceirge_hotel.company_id');
		$this->db->where('request_conceirge_hotel.city_id',$city_id);
		$query=$this->db->get();
		return $query->result_array();
		}
		else if($reqtype=="Movie" || $reqtype=="Restaurant" || $reqtype=="Event" || $reqtype=="Experience"){
			$this->db->select("request_conceirge_booking.*,company.company_name");
		$this->db->from('request_conceirge_booking');
		$this->db->join('company','company.id=request_conceirge_booking.company_id');
		$this->db->where('request_conceirge_booking.city_id',$city_id);
		$this->db->where('request_conceirge_booking.booking_type',$reqtype);
		$query=$this->db->get();
		return $query->result_array();
		}
	}
}
?>
