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
					'password'=>$this->input->post('user_pass'),
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
		$query="SELECT * FROM at_assistants";
		$q=$this->db->query($query);
		return $q->result();
	}
	
	function get_where($table,$where=1,$single=false,$order='us.id desc',$paging=false,$num=10,$offset=0){
	
		//$query="SELECT *  FROM users where ".$where." AND user_type='user' order by $order LIMIT $offset , $num";
		$query="SELECT us.id,us.fname,us.lname,us.email,dept.dept_name,ass.assist_fname as assist FROM at_employee us,at_assistants ass,at_department dept where ".$where." and dept.id=us.department_id and ass.id=us.assistant_id order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
		//$query="SELECT *  FROM users  WHERE ".$where;
		$query="SELECT * FROM at_employee us,at_assistants ass,at_department dept where ".$where." and dept.id=us.department_id and ass.id=us.assistant_id  ";
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
	function download_get_employee_detail_where($id,$srch_date){
		$res=strpos($srch_date,".");
		if(!empty($res))
		{
		$srch_date=explode("-",$srch_date);
		$start_date=$srch_date[0];
		$end_date=$srch_date[1];
		$fromtime=explode(".",$start_date);
		$totime=explode(".",$end_date);
		$srh_start_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
		$srh_end_date=$totime[2]."-".$totime[0]."-".$totime[1];
			$query="select * FROM at_jobs WHERE emp_id=".$id ." and payment_approval_status='1' and created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
			$query="select * FROM at_jobs WHERE emp_id=".$id ." and payment_approval_status='1' ";
		}
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}	
	function get_employee_detail_where($where=1,$offset=0,$id,$start_date,$end_date){
		if(empty($start_date))
		{
			$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status='1'";
		}
		else
		{
			$fromtime=explode("/",$start_date);
			$totime=explode("/",$end_date);
			$srh_start_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
			$srh_end_date=$totime[2]."-".$totime[0]."-".$totime[1];
			echo $query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status='1' and created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
		
	}
}

?>