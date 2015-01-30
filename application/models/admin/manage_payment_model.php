<?php
/*
	purpose:model to manage Drugs pages
	author: Nitin Saluja
*/
class Manage_payment_model extends CI_Model
{
	function rows_completed($where='1'){
		$query="SELECT * FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id  and job.job_status=3";
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	
	function get_where($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
	
		 $query="SELECT job.*,emp.fname FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id and job.job_status=3 order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function rows_pending_approval($where='1'){
		$query="SELECT * FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id  and job.payment_approval_status='0'";
		/*$query="SELECT * FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id  and job.payment_approval_status='0' and job.job_status='3'";*/
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	
	function view_pending_approval($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
	
		/*$query="SELECT job.*,emp.fname FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id and job.payment_approval_status='0' and job.job_status='3' order by $order LIMIT $offset , $num";*/
		$query="SELECT job.*,emp.fname,emp.lname FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id and job.payment_approval_status='0' order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function rows_approved_jobs($where='1'){
		$query="SELECT * FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id  and job.payment_approval_status='1'";
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	
	function view_approved_jobs($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
	
		$query="SELECT job.*,emp.fname,emp.lname  FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id and job.payment_approval_status='1' order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
		
	function approve($id){
				$data=array();
				$data['payment_approval_status']='1';
				$this->db->where('id',$id);
				$this->db->update('at_jobs',$data);
				return true;
	}
	
	function reject($id){
				$data=array();
				$data['payment_approval_status']='0';
				$this->db->where('id',$id);
				$this->db->update('at_jobs',$data);
				return true;
	}
}

?>
