<?php
/*
	purpose:model to manage employees
	author: Nitin Saluja
*/
class Manage_category_model extends CI_Model
{
	function add_category(){
	      
		$data=array();
		$data['cat_name']=$this->input->post('cat_name');
                // pr($data); die;
		$this->db->insert('job_category',$data);
		
        return true;		
	}	
	function userEmail($user_id){
		$this->db->where('id',$user_id);
		$row=$this->db->get('at_employee')->row_object();
		return $row;
	}
		function update_category($id=""){
		if($id!=""){
		$data=array('cat_name'=>$this->input->post('cat_name'));
			$this->db->where('id',$id);
			$this->db->update('job_category',$data);		
			if($this->db->affected_rows()>0){
				return true;
				//pr($data); die;
			}else{
				return false;
			}
		}
	}

	function get_all_departments()
	{
		$query="SELECT id, cat_name from job_category";
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
		 $query="SELECT id, cat_name from job_category where $where order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
		//$query="SELECT *  FROM users  WHERE ".$where;
		$query="SELECT * FROM job_category where ".$where."   ";
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	
	function get_category($id=""){
	if(empty($id))
	{
		$query="SELECT *  FROM job_category";
	}
	else
	{
		$query="SELECT *  FROM job_category WHERE id=".$id;
	}
		
		
		$q=$this->db->query($query);
		//pr($q->result()); die;
		return $q->result();
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