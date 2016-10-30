<?php
class office_agreement_data extends MY_Model{
	public function book_floor_plan_info($bookingid){
		$this->db->select('*');
		$this->db->from('book_floor_plan');
		$this->db->join('private_office_agreement','book_floor_plan.id=private_office_agreement.book_floor_plan_id');
		$this->db->where('book_floor_plan.id',$bookingid);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function businessdata_byfloorplan($floor_plan_id){
		$this->db->select('*');
		$this->db->from('floor_plan');
		$this->db->join('business_centers','floor_plan.business_id=business_centers.business_id');
		$this->db->where('floor_plan.floor_id',$floor_plan_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function client_info($book_for,$is_client){
		if($is_client==0){
			$query=$this->db->get_where('registered_user',array('userId'=>$book_for));
			return $query->result_array();
		}else if($is_client==1){
			$query=$this->db->get_where('user',array('userId'=>$book_for));
			return $query->result_array();
		}
	}
	public function company_info($companyid){
		$query=$this->db->get_where('company',array('id'=>$companyid));
		return $query->result_array();
	}
	public function book_for_client_info($book_for_client,$is_client){
		if($is_client==0){
			$query=$this->db->get_where('registered_user',array('userId'=>$book_for_client));
			return $query->result_array();
		}else if($is_client==1){
			$query=$this->db->get_where('user',array('userId'=>$book_for_client));
			return $query->result_array();
		}
	}
	public function register_user_deleted($register_user_deleted,$userid,$new_client_data,$invoice_data,$book_floor_plan_data_for_client,$book_floor_plan_id){
		$this->db->where('userId',$userid);
		$this->db->update('registered_user',$register_user_deleted);
		$this->db->insert('user',$new_client_data);
		$this->db->insert('invoices',$invoice_data);
		$this->db->where('id',$book_floor_plan_id);
		$this->db->update('book_floor_plan',$book_floor_plan_data_for_client);
	}
	public function book_for_company_info($company){
		$query=$this->db->get_where('company',array('company_name'=>$company));
		return $query->result_array();
	}
	public function invoice_info($company_id){
		$query=$this->db->get_where('invoices',array('customerId'=>$company_id));
		return $query->result_array();
	}
	public function invoice_update_after_agreement($book_floor_plan_data,$book_floor_plan_id,$invoice_data,$invoice_id,$invoice_item_data){
		$this->db->where('id',$book_floor_plan_id);
		$this->db->update('book_floor_plan',$book_floor_plan_data);
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices',$invoice_data);
		$this->db->insert('invoice_items',$invoice_item_data);
	}
	public function manager_info($book_for){
		$query=$this->db->get_where('user',array('userId'=>$book_for,'userTypeId'=>'ut7'));
		return $query->result_array();
	}
	public function get_region($city_id){
		$this->db->select('region_id');
		$this->db->from('user');
		$this->db->where('city_id',$city_id);
		$query=$this->db->get();
		return $query->result_array();
	}
	public function ad_info($region){
		$query=$this->db->get_where('user',array('region_id'=>$region));
		return $query->result_array();
	}
	public function rejectagreement($book_floor_plan_data,$book_floor_plan_id){
		$this->db->where('id',$book_floor_plan_id);
		$this->db->update('book_floor_plan',$book_floor_plan_data);
	}
	public function company_exist($company){
		$query=$this->db->get_where('company',array('company_name'=>$company));
		return $query->result_array();
	}
	public function add_company($company_data){
		$this->db->insert('company',$company_data);
	}
}