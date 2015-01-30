<?php
/*
	purpose:model to manage employees
	author: Nitin Saluja
*/
class Manage_user_model extends CI_Model
{
	function add_user(){
	
	
					$data=array();
					$data['first_name']=$this->input->post('first_name');
					$data['last_name']=$this->input->post('last_name');
					$data['email_id']=$this->input->post('email_id');
					$data['address']=$this->input->post('address');
					$data['occupation']=$this->input->post('occupation');		
					$data['role']=$this->input->post('role');
					$data['mobile']=$this->input->post('mobile');
			                $data['password']=$this->input->post('password');
					$data['about']=$this->input->post('about');
					
					$data['work_history']=$this->input->post('work_history');
					$data['training']=$this->input->post('training');
					$data['experience']=$this->input->post('experience');
					$data['cat_id']=$this->input->post('cat_name');
					//pr($data); die;
		if($this->db->insert('users',$data))
		{
			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['mailtype'] = 'text';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;
			$this->email->initialize($config);
			$this->email->from('webpaandu@gmail.com', 'Admin');
			$this->email->to($data['email_id']);
			$this->email->subject('Sign Up');
			
	$mess="Hi, \n \tYour Account has been created successfully \n \tEmailID : ".$data['email_id']." \n \tPassword : ".$data['password'];
			$this->email->message($mess);
			if(!$this->email->send())
			{
$this->session->set_flashdata('status', '<div class="msg">'.'User has been added. But mail not sent'.'</div>');
				redirect(base_url()."admin/manage_user/listing");	
			}
		}
			
		return  true;
		
	}
	
	
function update_user($id=""){
 
		if($id!=""){
			
		
					$data=array();
					
					$data['first_name']=$this->input->post('first_name');
					$data['last_name']=$this->input->post('last_name');
					$data['email_id']=$this->input->post('email_id');
					$data['address']=$this->input->post('address');
					$data['occupation']=$this->input->post('occupation');
					$data['role']=$this->input->post('role');
					$data['mobile']=$this->input->post('mobile');
					$data['password']=$this->input->post('password');
				   
					$data['about']=$this->input->post('about');
					$data['work_history']=$this->input->post('work_history');
					$data['training']=$this->input->post('training');
					$data['experience']=$this->input->post('experience');
					$data['cat_id']=$this->input->post('cat_name');
					
					
					$this->db->where('id',$id);
					$this->db->update('users',$data);	
					if($this->db->affected_rows()>0){
				return true;
				}else{
				return false;
				}
			
				
					
	}
	}
	
	

	
	function get_where($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
		 $query="SELECT id,first_name, last_name, email_id, address,mobile, occupation, role FROM users where $where AND id !=1 order by $order LIMIT $offset , $num ";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
	  $query="SELECT id FROM users  where $where AND id !=1 ";
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	
	
	function get_user($id=""){
	
		 $query="select us.*,jg.cat_name from users as us LEFT JOIN job_category as jg ON us.cat_id=jg.id where us.id='".$id."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function check_job_no($job_no){
		$query="SELECT *  FROM at_customers  WHERE job_no='".$job_no."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
		$out="<span style='color:red;'>Already exist</span>";
			return $out;
		}else{
		$out="<span style='color:green;'>Available</span>";
			return $out;
		}
	}
	
	
	function get_total_users($role=0){
		if($role == 0)
		{
			$whr=1;	
		}
		else
		{		
			$whr="role=".$role;
		}
		$query="SELECT *  FROM users  WHERE $whr ";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->num_rows();
		}else{
			return 0;
		}
	}

}

?>