<?php

class pantry_listing extends MY_Model {
	

    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
	
	public function getServiceRequests($cityId){
		$this->db->select("request_food_service.*,company.company_name");
		$this->db->from('request_food_service');
		$this->db->join('company','company.id=request_food_service.company_id');
		$this->db->where('request_food_service.city_id',$cityId);
		$query=$this->db->get();
		$dataArray= $query->result_array();
		
		$finalData=array();
		$decodeData=array();
		foreach($dataArray as $data){
			
			$final['order'] = array();
			$final['id'] = $data['id'];
			
			$decodeData = json_decode($data['detailes'], true);
			
			foreach($decodeData as $var){
			$cat = $this->get_parent_cat_det_by_id($var['cat']);
			$order['order_type'] = $cat[0]['name'];
			$expsubcat=explode("|",$var['sub_cat']);
			$expsubcatprice=explode("|",$var['qty']);
			for($ex=0;$ex<count($expsubcat);$ex++){
				$subCat = $this->get_sub_cat_det_by_id($var['cat'],$expsubcat[$ex]);
				
			$order['order_details'][$ex] = (string)$subCat[0]['name'];
			$order['unit_price'][$ex] = (float)$subCat[0]['price'];
			$order['order_qty'][$ex] = (int)$expsubcatprice[$ex];
			$order['order_total_price'][$ex] = (float)($subCat[0]['price']*$expsubcatprice[$ex]);
			
			}
			$final['order'][] = $order;
			unset($order);
			}
			$final['is_approved'] = $data['is_approved'];
			$final['approvedBy'] = $data['approvedBy'];
			$final['dateApproved'] = $data['dateApproved'];
			$final['dateAdded'] = $data['dateAdded'];
			$final['company_id'] = $data['company_id'];
			$final['company_name'] = $data['company_name'];
			$finalData[] = $final;
		}
		return $finalData;
	}
	function get_parent_cat_det_by_id($id){
		$this->db->select("cafe_types.*");
		$this->db->from('cafe_types');
		$this->db->where('cafe_types.id',$id);
		$this->db->where('cafe_types.parent_id','');
		$this->db->where('cafe_types.price','');
		$query=$this->db->get();
		return $query->result_array();
	}
	function get_sub_cat_det_by_id($pid,$id){

		$this->db->select("cafe_types.*");
		$this->db->from('cafe_types');
		$this->db->where('cafe_types.id',$id);
		$this->db->where('cafe_types.parent_id',$pid);
		$query=$this->db->get();
		return $query->result_array();
	}
	
	public function details($sid){
		$this->db->select("request_food_service.*,company.company_name");
		$this->db->from('request_food_service');
		$this->db->join('company','company.id=request_food_service.company_id');
		$this->db->where('request_food_service.id',$sid);
		$query=$this->db->get();
		$data= $query->result_array();
		$final['order'] = array();
		$final['id'] = $data[0]['id'];
		$decodeData = json_decode($data[0]['detailes'], true);
		foreach($decodeData as $var){
		$cat = $this->get_parent_cat_det_by_id($var['cat']);	
		$order['order_type'] = $cat[0]['name'];
		$expsubcat=explode("|",$var['sub_cat']);
		$expsubcatprice=explode("|",$var['qty']);
		$subprice=0;
			for($ex=0;$ex<count($expsubcat);$ex++){
				$subCat = $this->get_sub_cat_det_by_id($var['cat'],$expsubcat[$ex]);
			$order['order_details'][$ex] = (string)$subCat[0]['name'];
			$order['unit_price'][$ex] = (float)$subCat[0]['price'];
			$order['order_qty'][$ex] = (int)$expsubcatprice[$ex];
			$subprice=$subprice+(float)($subCat[0]['price']*$expsubcatprice[$ex]);
			 		
			}
			$order['order_total_price']=$subprice;
		$final['order'][] = $order;
		unset($order);
		}
		$final['is_approved'] = $data[0]['is_approved'];
		$dateAdded = (strtotime($data[0]['dateAdded']) ? date('d/m/Y',strtotime($data[0]['dateAdded'])) : 'Not yet' );
		$dateApproved = (strtotime($data[0]['dateApproved']) ? date('d/m/Y',strtotime($data[0]['dateApproved'])) : 'Not yet' );
		$final['dateAdded'] = $dateAdded;
		$final['dateApproved'] = $dateApproved;
		$final['company_id'] = $data[0]['company_id'];
		$final['company_name'] = $data[0]['company_name'];			
		return $final;
	}
	public function approve_request($data){
		$rid = $data['requestId'];
		$ReqTableName = 'request_food_service';

		$comid = $data['comid'];
		
		// data for Table: invoice table
		$invoiceData = $this->get_invoice_by_comid($comid);
		$invoiceId = $invoiceData[0]['id'];
		$invoicePrice=$invoiceData[0]['sub_total']+$data['totalPrice'];
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
        'unit_price'=>$data['totalPrice'],
        'total'=>$data['totalPrice'],
		'table_name'=> $ReqTableName,
		'row_id'=> $rid
        );
		$this->db->insert('invoice_items',$invoice_item_data);
		// data for Table: request_conceirge_service
        $appdata=array(
        'is_approved'=>'1',
		'approvedBy'=>$data['userId'],
        'dateApproved'=>date('Y-m-d h:i:s'),
        'price'=>$data['totalPrice'],
        'dateModified'=>date('Y-m-d h:i:s')
        );
		$this->db->where('id', $rid);
		$this->db->update('request_food_service', $appdata);
		
		return true;
		
	}
	function get_invoice_by_comid($comid){
		$query=$this->db->get_where('invoices',array('customerId'=>$comid)); // this 'customerId' is actually companyId
		return $query->result_array();
		
	}
	public function reject_request($serviceId){

		$appdata=array(
		  'is_approved'=>'2'
		);
		
			$this->db->where('id',$serviceId);
			$this->db->update('request_food_service',$appdata);
	   
	
	}
}
?>
