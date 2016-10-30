<?php
class Cron_model extends MY_Model {	
	public function __construct(){
		parent::__construct();
	    $this->load->database(); 
	}
	function get_current_invoice_by_staus(){
		$query=$this->db->get_where('invoices',array('status'=>0));
		return $query->result_array()[0];	
	}
	function update_current_invoice_by_staus($invoice_id,$invoice_data){
		$this->db->where('id',$invoice_id);
		$this->db->update('invoices',$invoice_data);	
	}
}
