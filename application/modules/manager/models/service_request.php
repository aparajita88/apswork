<?php

class service_request extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
    public function get_service($legal_data){
	   $this->db->select("request_stuff_service.*,company.company_name,cities.name as cites,locations.name as location");
	   $this->db->from('request_stuff_service');
	   $this->db->join('company','company.id=request_stuff_service.company_id');
	   $this->db->join('cities','cities.cityId=request_stuff_service.city_id');
	   $this->db->join('locations','locations.locationId=request_stuff_service.location_id');
	   $this->db->where('request_stuff_service.city_id',trim($legal_data['city']));
	   $this->db->where('request_stuff_service.location_id',trim($legal_data['location']));
	   $query=$this->db->get();
	   return $query->result_array();
	   
	}
	public function get_service_type(){
		$this->db->select('stuff_type');
		$this->db->from('request_stuff_service');
		$this->db->group_by('stuff_type');
		$query=$this->db->get();
		return $query->result_array();
	}
	public function get_courier_service($legal_data){
	   $this->db->select("request_courier_service.*,company.company_name,cities.name as cites,locations.name as location,courier_types.name as courier");
	   $this->db->from('request_courier_service');
	   $this->db->join('company','company.id=request_courier_service.company_id');
	   $this->db->join('cities','cities.cityId=request_courier_service.city_id');
	   $this->db->join('locations','locations.locationId=request_courier_service.location_id');
	   $this->db->join('courier_types','courier_types.id=request_courier_service.courier_type');
	   $this->db->where('request_courier_service.city_id',trim($legal_data['city']));
	   $this->db->where('request_courier_service.location_id',trim($legal_data['location']));
	   $query=$this->db->get();
	   return $query->result_array();
	   
	}
	public function get_request_of_type($legal_data,$type){
		 $this->db->select("request_stuff_service.*,company.company_name,cities.name as cites,locations.name as location");
	   $this->db->from('request_stuff_service');
	   $this->db->join('company','company.id=request_stuff_service.company_id');
	   $this->db->join('cities','cities.cityId=request_stuff_service.city_id');
	   $this->db->join('locations','locations.locationId=request_stuff_service.location_id');
	   $this->db->where('request_stuff_service.city_id',trim($legal_data['city']));
	   $this->db->where('request_stuff_service.location_id',trim($legal_data['location']));
	   $this->db->where('stuff_type',$type);
	   $query=$this->db->get();
	   return $query->result_array();
	}
	public function get_request_of_id($legal_data,$appid){
		
	   $this->db->select("request_stuff_service.*,company.company_name,cities.name as cites,locations.name as location");
	   $this->db->from('request_stuff_service');
	   $this->db->join('company','company.id=request_stuff_service.company_id');
	   $this->db->join('cities','cities.cityId=request_stuff_service.city_id');
	   $this->db->join('locations','locations.locationId=request_stuff_service.location_id');
	   $this->db->where('request_stuff_service.id',$appid);
	   $query=$this->db->get();
	   return $query->result_array();
		
	}
	public function get_courier_request_of_id($legal_data,$appid){
		
	   $this->db->select("request_courier_service.*,company.company_name,cities.name as cites,locations.name as location,courier_types.name as courier");
	   $this->db->from('request_courier_service');
	   $this->db->join('company','company.id=request_courier_service.company_id');
	   $this->db->join('cities','cities.cityId=request_courier_service.city_id');
	   $this->db->join('locations','locations.locationId=request_courier_service.location_id');
	   $this->db->join('courier_types','courier_types.id=request_courier_service.courier_type');
	   $this->db->where('request_courier_service.id',$appid);
	   $query=$this->db->get();
	   return $query->result_array();
		
	}
	public function get_request_client_info($appid,$tbname){
		if($tbname=='request_stuff_service'){
			$this->db->select('*');
		    $this->db->from('request_stuff_service');
		    $this->db->join('user','request_stuff_service.requested_by=user.userId');
		    $this->db->where('request_stuff_service.id',$appid);
		    $query=$this->db->get();
		    return $query->result_array();
		}else if($tbname=='request_courier_service'){
			$this->db->select('*');
			$this->db->from('request_courier_service');
			$this->db->join('user','request_courier_service.requested_by=user.userId');
			$this->db->where('request_courier_service.id',$appid);
			$query=$this->db->get();
			return $query->result_array();

		}
		
	}
	public function set_approved_request($appdata,$appid,$invoice_id,$invoice_data,$invoice_item_data,$tbname){
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices',$invoice_data);
		$this->db->insert('invoice_items',$invoice_item_data);
		if($tbname=="request_stuff_service"){
			$this->db->where('id',$appid);
			$this->db->update('request_stuff_service',$appdata);
		}else if($tbname=="request_courier_service"){
			$this->db->where('id',$appid);
			$this->db->update('request_courier_service',$appdata);
		}
	}
	public function set_reject_request($appdata,$appid,$tbname){
		if($tbname=="request_stuff_service"){
			$this->db->where('id',$appid);
			$this->db->update('request_stuff_service',$appdata);
		}else if($tbname=="request_courier_service"){
			$this->db->where('id',$appid);
			$this->db->update('request_courier_service',$appdata);
		}
		
	}
	public function get_invoice_by_custid($custid){
		$query=$this->db->get_where('invoices',array('customerId'=>$custid));
		return $query->result_array();
		
	}
	public function get_client_List($location_id){
	$this->db->select('u.*,user_type.userTypeName,locations.name as l_name,cities.name as c_name,company.company_name');
	$this->db->join('user_type', 'user_type.userTypeId=u.userTypeId', 'left');
	$this->db->join('company','u.company_id=company.id', 'left');
	$this->db->join('locations', 'locations.locationId=u.location_id', 'left');
	$this->db->join('cities', 'cities.cityId=u.city_id', 'left');
	$query=$this->db->get_where('user u ',array('u.userTypeId'=>'ut4','u.location_id'=>$location_id));
  
	
	return $query->result_array(); 	
		
	}
	public function getInvoice_formanager($location_id){
	    
	    $this->db->select('invoices.*,company.company_name,company.address');
	 $this->db->from('invoices');
	$this->db->join('company', 'invoices.customerId=company.id', 'left');
	$this->db->join('locations', 'locations.locationId=company.location_id', 'left');
	$this->db->join('cities', 'cities.cityId=company.city_id', 'left');
	$this->db->where('company.location_id',$location_id);
	$this->db->where('invoices.status',1);
	$this->db->where('company.status',1);
	$this->db->where('YEAR(invoices.invoice_date) = YEAR(NOW() - INTERVAL 1 MONTH)');
	$this->db->where('MONTH(invoices.invoice_date) = MONTH(NOW() - INTERVAL 1 MONTH)');
	$query = $this->db->get();
  
	
	if(!empty($query->result_array())){
			return $query->result_array();	
		}else{
			return array();
		}
		
		
}
	public function getInvoiceById($invoice_id){
		
			$this->db->select("invoices.*");
			$this->db->from('invoices');
			$this->db->where('invoices.id',$invoice_id);
			$this->db->where('invoices.status',1);
			$query=$this->db->get();
			if(!empty($query->result_array())){
				return $query->result_array()[0];	
			}else{
				return array();
			}
			
	}
	public function getInvoiceItems($invoice_id){
			$this->db->select("invoice_items.*");
			$this->db->from('invoice_items');
			$this->db->where('invoice_items.invoice_id',$invoice_id);
			$query=$this->db->get();
			$inv = array();
			foreach($query->result_array() as $index=>$item){
				$this->db->select($item['table_name'].".*");
				$this->db->from($item['table_name']);
				$this->db->where($item['table_name'].'.id',$item['row_id']);
				$queryItem=$this->db->get();
				$inv[] = array_merge($item,array('service_details'=>$queryItem->result_array()[0]));
			}
			return $inv;
	}
	public function getCompanyDetails($invoice_id){
		$this->db->select("company.*,cities.name as cityName,locations.name as locationName");
		$this->db->from('company');
		$this->db->join('invoices','invoices.customerId=company.id');
		$this->db->join('cities','cities.cityId=company.city_id');
		$this->db->join('locations','locations.locationId=company.location_id');
		$this->db->where('invoices.id',$invoice_id);
		$this->db->where('company.status','1');
		$query=$this->db->get();
		$com = $query->result_array();
		
		return $com[0];
	}
	public function getFoodServiceDetails($fsid){
		$this->db->select("cafe_types.*");
		$this->db->from('cafe_types');
		$this->db->where('cafe_types.id',$fsid);
		$this->db->where('cafe_types.status','1');
		$query=$this->db->get();
		$fd = $query->result_array();
		return $fd[0];
	}
	public function getDiscountById($invoice_id){
			$this->db->select("discounts.*");
			$this->db->from('discounts');
			$this->db->where('discounts.invoice_id',$invoice_id);
			$this->db->where('discounts.status',1);
			$query=$this->db->get();
			if(!empty($query->result_array())){
				return $query->result_array()[0];
			}else{
				return array();
			}		
	}
	public function getDueAmaount($company_id,$date){
		$this->db->select("invoices.*");
		$this->db->from('invoices');
		$this->db->where('invoices.customerId',$company_id);
		$this->db->where('invoices.status',1);
		$this->db->where('YEAR(invoices.invoice_date) = YEAR("'.$date.'"- INTERVAL 1 MONTH)');
		$this->db->where('MONTH(invoices.invoice_date) = MONTH("'.$date.'" - INTERVAL 1 MONTH)');
		$query=$this->db->get();
		if(!empty($query->result_array())){
				return $query->result_array()[0];	
		}else{
			return array();
		}
	}
    public function getallclient(){
    	$this->db->select('user.*,company.id as company_id,company.company_name');
        $this->db->from('user');
        $this->db->join('company','user.company_id=company.id','right');
        $this->db->where('userTypeId','ut4');
        $this->db->where('Isprimary','1');
        $query=$this->db->get();
        return $query->result_array();
    }
    public function getallindividualclient(){
    	$query=$this->db->get_where('user',array('userTypeId'=>'ut11','Isprimary'=>'1'));
    	return $query->result_array();
    }
    public function get_invoice_byclient($custid){
    	$this->db->select('*');
    	$this->db->from('invoices');
    	$this->db->where('customerId',$custid);
    	$this->db->where('total_amount > paid_amount');
    	$this->db->where('status','1');
    	$query=$this->db->get();
    	return $query->result_array();
    }
    public function get_invoice_byid($invoice_id){
    	$query=$this->db->get_where('invoices',array('id'=>$invoice_id));
    	return $query->result_array();
    }
    public function manual_amount_paid($payment_data,$invoice_update,$invoice_id){
    	$this->db->insert('payment',$payment_data);
    	$this->db->where('id',$invoice_id);
    	$this->db->update('invoices',$invoice_update);
    }
    public function get_company_info($customer_id){
    	$query=$this->db->get_where('company',array('id'=>$customer_id));
    	return $query->result_array();
    }
    public function payment_bypaymentid($payment_id){
    	$query=$this->db->get_where('payment',array('paymentId'=>$payment_id));
    	return $query->result_array();
    }
}
?>
