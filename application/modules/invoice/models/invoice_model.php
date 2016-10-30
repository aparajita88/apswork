<?php
class Invoice_model extends MY_Model {	
	public function __construct(){    
		parent::__construct();		
		$this->load->database(); 
	}
	
	public function getInvoice($company_id,$flag){
		if($flag == 'current_bill'){
			$this->db->select("invoices.*");
			$this->db->from('invoices');
			$this->db->where('invoices.customerId',$company_id);
			$this->db->where('invoices.status',1);
			$this->db->where('YEAR(invoices.invoice_date) = YEAR(NOW() - INTERVAL 1 MONTH)');
			$this->db->where('MONTH(invoices.invoice_date) = MONTH(NOW() - INTERVAL 1 MONTH)');
			$query=$this->db->get();
			if(!empty($query->result_array())){
				return $query->result_array();	
			}else{
				return array();
			}
		}elseif($flag == 'old_bills'){
			$this->db->select("invoices.*");
			$this->db->from('invoices');
			$this->db->where('invoices.customerId',$company_id);
			$this->db->where('invoices.status',1);
			$this->db->where('invoices.invoice_date <= ( NOW( ) - INTERVAL 2 MONTH )');
			$query=$this->db->get();
			return $query->result_array();
		}elseif($flag == 'overdue_bills'){
			$this->db->select("invoices.*");
			$this->db->from('invoices');
			$this->db->where('invoices.customerId',$company_id);
			$this->db->where('invoices.status',1);
			$this->db->where('invoices.invoice_date <= ( NOW( ) - INTERVAL 2 MONTH )');
			$this->db->where('invoices.total_amount != invoices.paid_amount');
			$query=$this->db->get();
			return $query->result_array();
		}elseif($flag == 'all_bills'){
			$this->db->select("invoices.*");
			$this->db->from('invoices');
			$this->db->where('invoices.customerId',$company_id);
			$this->db->where('invoices.status',1);
			$this->db->order_by('publish_date', 'desc');
			$query=$this->db->get();
			return $query->result_array();
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
	public function getDiscountById($invoice_id){
			$this->db->select("discounts.*");
			$this->db->from('discounts');
			$this->db->where('discounts.invoice_id',$invoice_id);
			//$this->db->where('discounts.IsApproved',1);
			$this->db->where('discounts.status',1);
			$query=$this->db->get();
			if(!empty($query->result_array())){
				return $query->result_array()[0];
			}else{
				return array();
			}		
	}
	public function reqInvoiceDiscount($inv_data){
			$discount_data=array(
	        'id'=>substr(create_guid(),0,16),
			'company_id'=>$inv_data['userData']['company_id'],
	        'invoice_id'=>$inv_data['invoice_id'],
	        'discounts'=>$inv_data['discount'],
	        'added_by'=>$inv_data['userData']['userId'],
	        'dateAdded'=>date('Y-m-d h:i:s'),
	        'IsApproved'=>0,
			'deleted'=> 0,
			'details'=> 'apply for discount',
			'status'=> 1
	        );
			$this->db->insert('discounts',$discount_data);
			return ($this->db->affected_rows() > 0) ? true : false;
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
	public function getFloorPlanDetails($fpid){
		/*$this->db->select("floor_plan.*");
		$this->db->from('floor_plan');
		$this->db->where('floor_plan.floor_id',$fpid);
		//$this->db->where('floor_plan.status','1');
		$query=$this->db->get();
		$fd = $query->result_array();
		return $fd[0];*/
	}
	function get_starting_balance($company_id,$temp_start_date){
		$this->db->select("sum(total_amount - paid_amount) as standing_bal");
		$this->db->from('invoices');
		$this->db->where('invoices.customerId',$company_id);
		$this->db->where('invoices.status',1);
		$this->db->where('YEAR(publish_date) <= '.$temp_start_date[1].' AND MONTH(publish_date) < '.$temp_start_date[0].'');
		$query = $this->db->get();
		return $query->result_array()[0]['standing_bal'];
	}
	function get_invoices($company_id,$temp_start_date,$temp_end_date){
		$this->db->select("invoices.*,total_amount - paid_amount as due_amt");
		$this->db->from('invoices');
		$this->db->where('invoices.customerId',$company_id);
		$this->db->where('invoices.status',1);
		$this->db->where('YEAR(publish_date) between '.$temp_start_date[1].' and '.$temp_end_date[1].' AND MONTH(publish_date) between '.$temp_start_date[0].' and '.$temp_end_date[0].' ');
		$this->db->order_by('publish_date', 'asc');
		$query=$this->db->get();
		return $query->result_array();
	}
	function get_payments_online($invoice_id,$temp_start_date,$temp_end_date){
		$this->db->_protect_identifiers=false;
		$this->db->select("payment.*, DATE_FORMAT(payment.orderDate,'%Y-%m-%d') AS niceDate, invoice_items.invoice_id");
		$this->db->from('payment');
		$this->db->join('invoice_items','payment.invoice_item_number = invoice_items.id');
		$this->db->where('payment.orderStatus','S');
		$this->db->where('payment.invoice_id','');
		$this->db->where('invoice_items.invoice_id',$invoice_id);
		$this->db->where('YEAR(payment.orderDate) between '.$temp_start_date[1].' and '.$temp_end_date[1].' AND MONTH(payment.orderDate) between '.$temp_start_date[0].' and '.$temp_end_date[0].' ');
		$this->db->order_by('payment.orderDate', 'asc');
		$query=$this->db->get();
		$this->db->_protect_identifiers=true;
		$query->result_array();
		return $query->result_array();
	}
	function get_payments_offline($temp_start_date,$temp_end_date){
		$this->db->_protect_identifiers=false;
		$this->db->select("payment.*, DATE_FORMAT(payment.orderDate,'%Y-%m-%d') AS niceDate , invoices.invoice_number");
		$this->db->from('payment');
		$this->db->join('invoices','payment.invoice_id = invoices.id');
		$this->db->where('payment.orderStatus','S');
		$this->db->where('payment.invoice_id != ""');
		$this->db->where('YEAR(payment.orderDate) between '.$temp_start_date[1].' and '.$temp_end_date[1].' AND MONTH(payment.orderDate) between '.$temp_start_date[0].' and '.$temp_end_date[0].' ');
		$this->db->order_by('payment.orderDate', 'asc');
		$query=$this->db->get();
		$this->db->_protect_identifiers=true;
		$query->result_array();
		return $query->result_array();
	}
	function get_credit_notes($temp_start_date,$temp_end_date){
		$this->db->select("creditnote_invoice_item.*");
		$this->db->from('creditnote_invoice_item');
		$this->db->where('creditnote_invoice_item.isApproved',1);
		$this->db->where('YEAR(creditnote_invoice_item.dateApproved) between '.$temp_start_date[1].' and '.$temp_end_date[1].' AND MONTH(creditnote_invoice_item.dateApproved) between '.$temp_start_date[0].' and '.$temp_end_date[0].' ');
		$this->db->order_by('creditnote_invoice_item.dateApproved', 'asc');
		$query=$this->db->get();
		$query->result_array();
		return $query->result_array();
	}
}
