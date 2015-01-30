<?php
/*
	purpose:model to manage Drugs Categories
	author: Nitin Saluja
*/
class Manage_job_model extends CI_Model
{
	function add_job(){
	
	
					$data=array();
					$data['job_title']=$this->input->post('job_title');
					$data['job_detail']=$this->input->post('job_detail');
					$data['country']=$this->input->post('country');
					$data['state']=$this->input->post('state');
					$data['comments']=$this->input->post('comments');		
					$data['job_cat']=$this->input->post('cat_name');
					$data['budget']=$this->input->post('budget');
					
					$data['cust_id']=$this->session->userdata('admin_id');
					$data['created_date']=date('Y-m-d');
				        $date=explode("/",$this->input->post('end_date'));
					$data['end_date']=$date[2]."-".$date[1]."-".$date[0];							 
		$this->db->insert('jobs',$data);
		 
		return  true;
		
	}
	function get_employee_detail($cus_id){
		$query="SELECT *  FROM users where id=$cus_id";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}	
	}	
	
		function update_job($id=""){
		if($id!=""){
			
		
					$data=array();
					
					$data['job_title']=$this->input->post('job_title');
					$data['job_detail']=$this->input->post('job_detail');
					$data['country']=$this->input->post('country');
					$data['state']=$this->input->post('state');
					$data['comments']=$this->input->post('comments');
					$data['job_cat']=$this->input->post('cat_name');
					$data['job_status']=$this->input->post('job_status');
					$data['budget']=$this->input->post('budget');
					$data['created_date']=$this->input->post('created_date');
				        $date=explode("/",$this->input->post('end_date'));
					$data['end_date']=$date[0]."-".$date[1]."-".$date[2];
					
					
					//pr($data); die;
					$this->db->where('id',$id);
					$this->db->update('jobs',$data);	
					if($this->db->affected_rows()>0){
				return true;
				}else{
				return false;
				}
			
				
					
	}
	}
	
	function get_where($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
	
		$query="SELECT t.id,t.job_title,t.country,t.file, t.state, t.job_detail, t.end_date,t.Budget,t.job_status,t.cust_id,us.first_name, p.cat_name FROM jobs as t LEFT JOIN job_category as p ON p.id=t.job_cat LEFT JOIN users as us ON t.cust_id=us.id where $where order by $order LIMIT $offset , $num ";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
		 $query="SELECT t.id,t.job_title,t.country,t.file, t.state, t.job_detail, t.end_date,t.Budget,t.job_status,t.cust_id,us.first_name, p.cat_name FROM jobs as t LEFT JOIN job_category as p ON p.id=t.job_cat LEFT JOIN users as us ON t.cust_id=us.id WHERE $where";
		
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	function get_job($id=""){
	 $query="select j.*,jc.cat_name,COUNT(ja.job_id) as total_bids from jobs as j LEFT JOIN job_category as jc ON j.job_cat=jc.id LEFT JOIN job_applications ja ON j.id=ja.job_id where j.id='".$id."' GROUP BY ja.job_id ";
		//echo $query="select j.*,jc.cat_name from jobs as j LEFT JOIN job_category as jc ON j.job_cat=jc.id where j.id='".$id."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function get_category($id=""){
		$query="SELECT *  FROM job_category";
		$q=$this->db->query($query);
		//pr($q->result()); die;
		return $q->result();
		
	}
	function get_status($id=""){
		$query="SELECT *  FROM job_category";
		$q=$this->db->query($query);
		//pr($q->result()); die;
		return $q->result();
		
	}
	
	function get_total_category(){
		$query="SELECT *  FROM job_category";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->num_rows();
		}else{
			return 0;
		}
		
	}
	
	
	function get_total_jobs($role=3){
		if($role == 3)
		{
			$whr=1;	
		}
		else
		{		
			$whr="job_status=".$role;
		}
		$query="SELECT *  FROM jobs  WHERE $whr ";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->num_rows();
		}else{
			return 0;
		}
	}
	
}

?>