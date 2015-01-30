<?php   
class Web_service_model extends CI_Model  {
	function  __construct()  {
    	parent::__construct();
	}
	/* customer registration model start here */
	function register($uname,$email,$pwd)
	{
	
	        $data['user_name']=$uname;
		$data['email']=$email;
		$data['password']=md5($pwd);
		$this->db->insert('users',$data);
		if($this->db->insert_id()>0){ 
			return $this->db->insert_id();
		}
		else
		{
 			return false;
		}
	}
	
	function addFriend($friend_name,$fb_id){
		$this->db->where('fb_id',$fb_id);
        $this->db->delete('friends'); 
	//	$data['fb_id']=$fb_id;
		//$data['name']=$friend_name;
		//$this->db->insert('friends',$data);
	}
	
	function reg_fb($data)
	{	
		$data2=array();
		
		if(@$detail=$this->check_fb_user($data->email))
		{
			$data2['id']=$detail[0]->id;
			$data2['type']='2';
			$data2['email']=@$data->email;
			$data2['user_name']=$detail[0]->user_name;
			return $data2;
		}
		else{
    			$data1=array();
	        	$data1['user_name']=$data->first_name;
			$data1['email']="";
			$data1['fb_id']=$data->id;
			$this->db->where('fb_id',$data->id);
            $this->db->delete('users');
			$this->db->insert('users',$data1);
			if($this->db->insert_id()>0){
			
				$data2['id']=$this->db->insert_id();
				$data2['email']=@$data->email;
				$data2['user_name']=$data->first_name;
				$data2['type']='1';
				return $data2;
			}
			else
			{
 				return false;
			}
		}	
	}
	
	
	
	function check_fb_user($fb_email)
	{
		$query="SELECT * FROM users WHERE email='".$fb_email."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}
	}
	
	function get_user_detail($id){	
		$query="SELECT id,IF(LENGTH(image)>0, CONCAT('". base_url() ."public/uploads/',image), '') as image,user_name FROM users WHERE id=$id";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->row();
		}else{
			return false;
		}		
	}
	
	
	

	
	function userEmail($email){
		$query="Select id,email,user_name from users WHERE email='". $email ."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
     	        	$row  = $q->row_object();
			return $row;
		}else{
			return false;
		}

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
	
	function updateForgot($email_id=''){
		if($email_id!=''){
			$password=$this->genRandomString();
			$data=array('password'=>md5($password));
			$this->db->where('email',$email_id);
			$this->db->update('users',$data);
			//$this->db->update('service_registration',$data);
			return $password;
		}
	}
	

}



/* -------------------------------------End of file--------------------------------------------*/
