<?php   
class Admin_model extends CI_Model  {
	function  __construct()  {
    	parent::__construct();
	} 
 
	function loginProcess()
	{   
     	$email_id = $this->input->post('email_id');
	    $password = $this->input->post('password');
     	$this->db->where(array("email_id"=>$email_id,"password"=>$password));
    	$query = $this->db->get('users');
     	$data  = $query->row_object();
		$this->session->set_userdata('admin_id',$data->id);
		$this->session->set_userdata('pic_name',$data->image);
		
	}
	
 	function changePassword($id,$password,$table='users')
	{
		 $data = array('password' => $password,
					   'email_id '=>$this->input->post('email'));
		 $this->db->where('id', $id);
		 $this->db->update($table, $data);
		 $this->session->set_userdata('success','<div class="msg">Your password has been successfully changed</div>');
		 redirect(base_url().'admin/login/welcome');
	}
   
	function get_result($id='')
	{
		$query="SELECT * FROM users where id= ".$id;
		$q=$this->db->query($query);
		return $q->result_array();
	}
	function userEmail(){
		$this->db->where('email',$this->input->post('txtEmail'));
		$row=$this->db->get('at_employee')->row_object();
		return $row;
	}
	
	function genRandomString()
	{
		$length = 8;
		$characters = "0123456789abcdefghijklmnopqrstuvwxyz";
		$string = '';    
		for($p=0; $p < $length; $p++){
			$st=mt_rand(0, 30);
			$string .= $characters[$st];
		}
		return $string;
	}
	
	function updateForgot($id=''){
		if($id!=''){
			$password=$this->genRandomString();
			$data=array('password'=>$password);
			$this->db->where('id',$id);
			$this->db->update('at_employee',$data);
			if($this->db->affected_rows()>0){
				return $password;
			}else{
				return false;
			}
		}
	}
	
	function add_setting(){
	
		$data=array('field_name'=>"assistent",
					'default_value'=>$this->input->post('assist'));
		$this->db->insert('at_default_setting',$data);
		if($this->db->insert_id()>0){
			$data1=array('field_name'=>"department",
					'default_value'=>$this->input->post('depart'));
			$this->db->insert('at_default_setting',$data1);
			if($this->db->insert_id()>0){
			}else{
			return false;
			}
		}else{
			return false;
		}		
	}		
	function update_setting(){
		$data=array('default_value'=>$this->input->post('assist'));
			$this->db->where('id','2');
			$this->db->update('at_default_setting',$data);	
			$data1=array('default_value'=>$this->input->post('depart'));
			$this->db->where('id','1');
			$this->db->update('at_default_setting',$data1);	
	}	
	
	
	function get_all_departs(){	
		$query="SELECT *  FROM at_department";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}
	}
	
	function get_all_employees(){
		$query="SELECT *  FROM at_employee";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}	
	}
	
		function get_setting(){
		$query="SELECT *  FROM at_default_setting";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}
	}
}

/* -------------------------------------End of file--------------------------------------------*/