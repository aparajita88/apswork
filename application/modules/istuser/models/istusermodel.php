<?php
class istusermodel extends MY_Model {
    public function __construct() {
		
        	parent::__construct();
         $this->load->database();
         $this->load->library('session');
    }
    public function user_info(){
		$query=$this->db->get('registered_user');
		return $query->result_array();
	}
	public function display_user_data($eml){
		$query=$this->db->get_where('registered_user',array('userEmail'=>$eml));
		return $query->result_array();
	}
	public function eml_autocompletef($eml){
		$this->db->select('FirstName,LastName,userEmail');
		$this->db->from('registered_user');
        $this->db->like('FirstName', $eml,'after');
        $query=$this->db->get();
        return $query->result();
	}
	public function eml_autocompletel($eml){
		$this->db->select('FirstName,LastName,userEmail');
		$this->db->from('registered_user');
        $this->db->like('LastName', $eml,'after');
        $query=$this->db->get();
        return $query->result();
	}
	public function addEnquiry($dt){
		if(!empty($dt)){
			$this->db->insert('registered_user',$dt);
			return true;
		}else{
			return false;
		}	
	}
	public function updEnquiry($uid,$dt){
		if(!empty($dt)){
			$this->db->where('userId',$uid);
			$this->db->update('registered_user',$dt);
			return true;
		}else{
			return false;
		}
	}
	public function addNeedAnalysis($dt,$uid){
		$this->db->where('registered_user_id', $uid);
		$this->db->from('need_analysis');
		$count = $this->db->count_all_results();
		if(!empty($dt) && $count == 0){
			$this->db->insert('need_analysis',$dt);
			return true;
		}else{
			return false;
		}	
	}
}
