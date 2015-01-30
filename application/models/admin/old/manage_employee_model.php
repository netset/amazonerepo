<?php
/*
	purpose:model to manage employees
	author: Nitin Saluja
*/
class Manage_employee_model extends CI_Model
{
	function add_employee($data){
		$data=array('fname'=>$this->input->post('user_first_name'),
					'lname'=>$this->input->post('user_last_name'),
					'username'=>$this->input->post('user_name'),
					'password'=>md5($this->input->post('user_pass')),
					'email'=>$this->input->post('user_email'),	
					'department_id'=>$this->input->post('user_depart'),
					'assistant_id'=>$this->input->post('user_assist'));
		$this->db->insert('at_employee',$data);
		if($this->db->insert_id()>0){
			return true;
		}else{
			return false;
		}		
	}	
		function userEmail($user_id){
		$this->db->where('id',$user_id);
		$row=$this->db->get('at_employee')->row_object();
		return $row;
	}
		function update_employee($id=""){
		if($id!=""){
		$data=array('fname'=>$this->input->post('user_first_name'),
					'lname'=>$this->input->post('user_last_name'),
					'username'=>$this->input->post('user_name'),
					'email'=>$this->input->post('user_email'),	
					'department_id'=>$this->input->post('user_depart'),
					'assistant_id'=>$this->input->post('user_assist'));
			$this->db->where('id',$id);
			$this->db->update('at_employee',$data);		
			if($this->db->affected_rows()>0){
				return true;
			}else{
				return false;
			}
		}
	}

	function get_all_departments()
	{
		$query="SELECT id,dept_name FROM at_department ";
		$q=$this->db->query($query);
		return $q->result();
	}
	
		function get_all_assistants()
	{
		$query="SELECT * FROM at_employee where id!='1' ";
		$q=$this->db->query($query);
		return $q->result();
	}
	
	function get_where($table,$where=1,$single=false,$order='us.id desc',$paging=false,$num=10,$offset=0){
	
		//$query="SELECT *  FROM users where ".$where." AND user_type='user' order by $order LIMIT $offset , $num";
		$query="SELECT us.id,us.fname,us.lname,us.email,dept.dept_name,ass.fname as assist FROM at_employee us,at_employee ass,at_department dept where ".$where." and dept.id=us.department_id and ass.id=us.assistant_id order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
		//$query="SELECT *  FROM users  WHERE ".$where;
		$query="SELECT us.id,us.fname,us.lname,us.email,dept.dept_name,ass.fname as assist FROM at_employee us,at_employee ass,at_department dept where ".$where." and dept.id=us.department_id and ass.id=us.assistant_id  ";
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	function get_employee($id=""){
		$this->db->where('id',$id);
		$data=$this->db->get('at_employee')->row_object();
		return $data;
	}

	function get_active_users(){
		$this->db->where('status','1');
		$query = $this->db->get('users');
		return $query->num_rows();
	}
	function get_deactive_users(){
		$this->db->where('status','0');
		$query = $this->db->get('users');
		return $query->num_rows();
	}
}

?>
