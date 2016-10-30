<?php
class Creditnote_model extends MY_Model {
	
public function __construct(){    
	parent::__construct();		
	$this->load->database(); 
}
public function get_user_bycompany($invoice_id){
$this->db->select("user.FirstName,user.LastName,user.userEmail,locations.name as l_name,cities.name as c_name");
	$this->db->from('invoices');
	$this->db->join('company','company.id=invoices.customerId');
	$this->db->join('user','company.id=user.company_id');
	$this->db->join('locations','locations.locationId=user.location_id');
	$this->db->join('cities','cities.cityId=user.city_id');
	$this->db->where('invoices.id',$invoice_id);
	$this->db->where('user.Isprimary','1');
	$query=$this->db->get();
        return $query->result_array();

}
public function getInvoicecreditnote($id){
$this->db->select("creditnote_invoice_item.id as c_id,creditnote_invoice_item.creditnote_amount,creditnote_invoice_item.credit_type,creditnote_invoice_item.description as c_description,creditnote_invoice_item.invoice_no as invoice_number,creditnote_invoice_item.isApproved,invoice_items.*");
$this->db->from('creditnote_invoice_item');
$this->db->join('invoice_items','creditnote_invoice_item.invoice_item_id=invoice_items.id');
$this->db->where('creditnote_invoice_item.invoice_id',$id);
$query=$this->db->get();
return $query->result_array();

}
public function get_companyby_location($city){
$this->db->select('user.*,company.company_name');
			$this->db->from('user');
			$this->db->join('company','company.id=user.company_id');
			$this->db->where("user.userTypeId = 'ut4'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
		$this->db->where('company.city_id',$city);
	        $query=$this->db->get();
	        $temp_ut4 = $query->result_array();	
	        $this->db->select('user.*');
			$this->db->from('user');
			$this->db->where("user.userTypeId = 'ut11'");
	        $this->db->where('user.status', 1);
	        $this->db->where('user.Isprimary', 1);
		$this->db->where('user.city_id',$city);
	        $query=$this->db->get();
	        $temp_ut11_temp = $query->result_array();
	        $temp_ut11 = array();
	        foreach ($temp_ut11_temp as $key => $value) {
	        	$temp_ut11[] = $value;
	        	$temp_ut11[$key]['company_name'] = 'Individual'; 
	        }
	        return array_merge($temp_ut4,$temp_ut11);
	}
public function get_invoice_byclient($id){
        $this->db->select("invoices.*");
		$this->db->from('invoices');
		$this->db->where('invoices.customerId',$id);
		$this->db->where('invoices.status',1);
		$query=$this->db->get();
		return $query->result_array();	
	
}
public function getInvoiceById($invoice_id){
		$this->db->select("invoices.*");
		$this->db->from('invoices');
		$this->db->where('invoices.id',$invoice_id);
		$this->db->where('invoices.status',1);
		$query=$this->db->get();
		return $query->result_array()[0];
}
public function getInvoiceItems($invoice_id){
			$this->db->select("invoice_items.*,invoices.invoice_number");
			$this->db->from('invoice_items');
			$this->db->join('invoices','invoices.id=invoice_items.invoice_id');
			$this->db->where('invoice_items.invoice_id',$invoice_id);
			$query=$this->db->get();
			$inv = array();
			foreach($query->result_array() as $index=>$item){
				$this->db->select($item['table_name'].".*");
				$this->db->from($item['table_name']);
				$this->db->where($item['table_name'].'.id',$item['row_id']);
				$queryItem=$this->db->get();
				if(!empty($queryItem->result_array())){
					$inv[] = array_merge($item,array('service_details'=>$queryItem->result_array()[0]));
				}else{
					$inv[] = array_merge($item,array('service_details'=>array()));
				}
				
			}
			return $inv;
	}
public function getCreditInvoiceItems($amnt,$pcg,$type_amnt,$type_pcg){
	$this->db->select("invoice_items.*,invoices.invoice_number,invoices.publish_date,creditnote_invoice_item.id as c_id,creditnote_invoice_item.item_price,
	creditnote_invoice_item.creditnote_amount,creditnote_invoice_item.credit_type,creditnote_invoice_item.description as c_description,creditnote_invoice_item.dateAdded,creditnote_invoice_item.isApproved,company.company_name");
	$this->db->from('company');
	$this->db->join('invoices','invoices.customerId=company.id');
	$this->db->join('invoice_items','invoices.id=invoice_items.invoice_id');
	$this->db->join('creditnote_invoice_item','invoice_items.id=creditnote_invoice_item.invoice_item_id');
	$this->db->where('creditnote_invoice_item.creditnote_amount != "" AND creditnote_invoice_item.credit_type != ""');
	$this->db->where('creditnote_invoice_item.creditnote_amount <= '.$amnt.' AND creditnote_invoice_item.creditnote_amount >'.$type_amnt.' AND creditnote_invoice_item.credit_type = 2');
	$this->db->or_where('creditnote_invoice_item.creditnote_amount <='.$pcg.' AND creditnote_invoice_item.creditnote_amount >'.$type_pcg.' AND  creditnote_invoice_item.credit_type = 1');
	$query=$this->db->get();		
	$inv = array();
	foreach($query->result_array() as $index=>$item){
		$this->db->select($item['table_name'].".*");
		$this->db->from($item['table_name']);
		$this->db->where($item['table_name'].'.id',$item['row_id']);
		$queryItem=$this->db->get();
		if(!empty($queryItem->result_array())){
			$inv[] = array_merge($item,array('service_details'=>$queryItem->result_array()[0]));
		}else{
			$inv[] = array_merge($item,array('service_details'=>array()));
		}
		
	}
	return $inv;
}		
	
public function getCompanyDetails($company_id){
	$this->db->select("company.*,cities.name as cityName,locations.name as locationName");
	$this->db->from('company');
	$this->db->join('cities','cities.cityId=company.city_id');
	$this->db->join('locations','locations.locationId=company.location_id');
	$this->db->where('company.id',$company_id);
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
public function get_credit_listing_byinvoiceid($invoiceid){
    $query=$this->db->get_where('creditnote_invoice_item',array('invoice_id'=>$invoiceid));
    return $query->result_array();
 }
 public function get_creditinfo_bycreditid($creditid){
 	$this->db->select("creditnote_invoice_item.*,invoices.invoice_number,invoice_items.*");
	$this->db->from('creditnote_invoice_item');
	$this->db->join('invoice_items','invoice_items.id=creditnote_invoice_item.invoice_item_id');
	$this->db->join('invoices','invoices.id=invoice_items.invoice_id');
	$this->db->where('creditnote_invoice_item.id',$creditid);
	$query=$this->db->get();
	$inv = array();
			foreach($query->result_array() as $index=>$item){
				$this->db->select($item['table_name'].".*");
				$this->db->from($item['table_name']);
				$this->db->where($item['table_name'].'.id',$item['row_id']);
				$queryItem=$this->db->get();
				if(!empty($queryItem->result_array())){
					$inv[] = array_merge($item,array('service_details'=>$queryItem->result_array()[0]));
				}else{
					$inv[] = array_merge($item,array('service_details'=>array()));
				}
				
			}
			return $inv;
 }
 public function get_business_location($floor_plan_id){
 	$this->db->select('location_id,city_id');
 	$this->db->from('floor_plan');
 	$this->db->where('floor_id',$floor_plan_id);
 	$query=$this->db->get();
 	return $query->result_array();

 }
}
