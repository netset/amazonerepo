<?php
/*
	purpose:model to manage Drugs Categories
	author: Nitin Saluja
*/
class Manage_job_model extends CI_Model
{
	function add_job(){
					$data=array();
					if($this->input->post('job_opt')==0)
					{
						$query="SELECT max(id) as num FROM at_jobs";
						$q=$this->db->query($query);
						$res=$q->result();
						$job_num=$res[0]->num+1;
						$query1="SELECT * FROM at_jobs where job_num=$job_num";
						$q1=$this->db->query($query1);
						if($q1->num_rows()>0){
							$job_num=$job_num+1;
						}
						$data['job_num']=$job_num;
					}
					else
					{
						$data['job_num']=$this->input->post('job_name');
					}
					$data['job_num_option']=$this->input->post('job_opt');
					$data['job_hours']=$this->input->post('job_time');
					$data['job_descr']=$this->input->post('job_desc');
					$data['emp_id']=$this->input->post('job_assign');
					$data['job_status']=1;
					//var_dump($data);die;
		$this->db->insert('at_jobs',$data);
		if($this->db->insert_id()>0){
			if($this->input->post('job_assist1')!='' && $this->input->post('job_time1')!='')
			{
				$data1=array();
				$data1['job_id']=$this->db->insert_id();
				$data1['assistant_id']=$this->input->post('job_assist1');
				$data1['hours']=$this->input->post('job_time1');
				if($this->db->insert('at_assistant_in_job',$data1))
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return true;
			}
		}else{
			return false;
		}		
	}	
	
	
		function update_job($id="",$fileName){
		if($id!=""){
					$data=array();
					if($this->input->post('job_opt')==0)
					{
						$query="SELECT max(id) as num FROM at_jobs";
						$q=$this->db->query($query);
						$res=$q->result();
						$job_num=$res[0]->num+1;
						$query1="SELECT * FROM at_jobs where job_num=$job_num";
						$q1=$this->db->query($query1);
						if($q1->num_rows()>0){
							$job_num=$job_num+1;
						}
						$data['job_num']=$job_num;
					}
					else
					{
						$data['job_num']=$this->input->post('job_name');
					}
					$data['job_num_option']=$this->input->post('job_opt');
					$data['job_hours']=$this->input->post('job_time');
					$data['job_descr']=$this->input->post('job_desc');
					$data['emp_id']=$this->input->post('job_assign');
					$data['job_status']=1;
					$this->db->where('id',$id);
					$this->db->update('at_jobs',$data);	
			if($this->input->post('job_assist1')!='' && $this->input->post('job_time1')!='')
			{
				$data1=array();
				$data1['job_id']=$this->db->insert_id();
				$data1['assistant_id']=$this->input->post('job_assist1');
				$data1['hours']=$this->input->post('job_time1');
				$this->db->where('id',$id);
				$this->db->update('at_assistant_in_job',$data1);
				return true;
			}
			else
			{
				return true;
			}			
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
	
	function default_assistant(){
		$query="SELECT *  FROM at_default_setting where id='2'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}	
	}
	function get_where($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
	
		$query="SELECT job.*,emp.fname FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id order by $order LIMIT $offset , $num";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
		//$query="SELECT *  FROM categories  WHERE ".$where;
		$query="SELECT * FROM at_jobs as job,at_employee as emp where ".$where." and emp.id=job.emp_id ";
		
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	function get_job($id=""){
		$query="SELECT job.*,emp.fname FROM at_jobs as job,at_employee as emp where job.id=$id and emp.id=job.emp_id";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function check_job_no($job_no){
		$query="SELECT * FROM at_jobs where job_num=$job_no";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
		$out="<span style='color:red;'>Already exist</span>";
			return $out;
		}else{
		$out="<span style='color:green;'>Available</span>";
			return $out;
		}
	}
	
	function get_job_assist($id=""){
		$query="SELECT assist.*,emp.fname FROM at_assistant_in_job as assist,at_employee as emp where assist.job_id=$id and assist.assistant_id=emp.id";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}

	function get_active_categories(){
		$this->db->where('status','1');
		$query = $this->db->get('categories');
		return $query->num_rows();
	}
	function get_deactive_categories(){
		$this->db->where('status','0');
		$query = $this->db->get('categories');
		return $query->num_rows();
	}
	
	function delete_drugs($ids)
    {
		if(count($ids)>0)
		{
			foreach($ids as $id)
			{

						$this->db->where('cat_id',$id);
						$this->db->delete('drugs');
						
						$this->session->set_flashdata('status', '<div class="msg">Successfully deleted.</div>');

			}
		}
	}
}

?>
