<?php
class user extends MY_Model {
	
	var $adminEmail;
    public function __construct() {
		parent::__construct();
		$this->load->model('login/login_model');
		$this->adminEmail = 'info@sworks.co.in';
        $this->load->database(); 
   	}
     

	
	public function sendMail($to, $form, $subject, $message, $cc='', $bcc=''){
		$form = ($form!='') ? $form : $this->adminEmail;
		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
	    $this->load->library('email', $config);
		$this->email->initialize($config);		
		$this->email->from($form, 'smartworks');
		$this->email->to($to);
        $this->email->subject($subject);
		$this->email->message($message);
     
		if($this->email->send()){
			return 'send';
		}else{
			return 'error';
		} 

	}
	
	public function isEmailAvailable($email){
		$this->db->select('userId');
		$this->db->where('userEmail =', $email);
		$this->db->where('userTypeId =', 'ut4');
		$this->db->from('user');
		$query = $this->db->get();
		$userId = $query->row_array();
		
		if(isset($userId['userId']) && $userId['userId']!=''){
			return 0;
		}else{
			return 1;
		}
	}
	
	
	public function sendContactUs($data){
		$subject = "New mail from smartworks contact us";
		$message = "First Name: ".$data['first_name'];
		$message .= "<br>";
		$message .= "Last Name: ".$data['last_name'];
		$message .= "<br>";
		$message .= "E-mail: ".$data['email'];
		$message .= "<br>";
		$message .= "Phone: ".$data['phone'];
		$message .= "<br>";
		$message .= "Message: ".$data['message'];
		$message .= "<br>";
		$message .= "<br>";
		$message .= "Thank you."; 
        $message .= "<br>";
        $message .="Smartworks Business Center";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From:'.$data['email']. "\r\n";
        if(mail($this->adminEmail,$subject,$message,$headers)){
		return 1;	
		}else{
		return 0;	
		}  
	    }
	
	
	public function subscribeEmail($email){
		 $user_info=$this->login_model->getuserdetailsBytype('ut12');
		 $email_template_id='48f80948-96aa-bc';
		 $email_template = $this->login_model->getEmailTemplate($email_template_id);
		 $body = $email_template['description'];
		 $from_email='sworks_team@sworks.co.in'; // should change with smartworks team
         $from_name=ucfirst('Team Smartworks');
	  		/*User Payment Mail Function*/
		$this->load->library('email');
		$this->email->set_newline("\r\n");
		$this->email->from($from_email,$from_name);
		$this->email->to($email);
		$this->email->cc($user_info['userEmail']); 
		$this->email->subject($email_template['subject']);
		$this->email->message($body);
		$this->email->send();
		return 1;
		
	}
	public function getusers()
	{
	    $userId=$this->session->userdata("userId");
	    $userTypeId = $this->session->userdata("userTypeId");
	    $data['userData'] = $this->login->getUserProfile($userId);
		$sql="SELECT registered_user.*,locations.name as l_name,cities.name as c_name FROM registered_user left join cities on cities.cityId=registered_user.cityId left join locations on locations.locationId=registered_user.locationId";
		$query=$this->db->query($sql);
		return $query->result_array();
	}
	
	public function delete($table='',$id='',$column_name='')
	{
		$result = $this->db->delete($table, array($column_name => $id)); 
		return $result;
	}
	
	public function getdetails($uId)
	{
		
	    $sql="SELECT registered_user.*,need_analysis.company_name FROM registered_user left join need_analysis on need_analysis.registered_user_id=registered_user.userId WHERE registered_user.userId='".$uId."'";
		$query=$this->db->query($sql);
	    return $query->result_array();	
	}
	
	public function update_user($id,$data)
	{
		
		$this->db->where('userId', $id);
		$this->db->update('registered_user', $data);

	}
}
?>
