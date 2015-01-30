<?php
/*
	purpose:model to manage reports
	author: Nitin Saluja
*/
class Manage_new_report_model extends CI_Model
{
///////////start employee listing report//////////////		
	function get_where($table,$where=1,$single=false,$order,$paging=false,$num=10,$offset=0,$where1=1){
		$picker=$this->input->post('picker');
		if(!empty($picker))
		{
		$end_date=$this->input->post('picker');
		$start_date=$this->input->post('picker1');
		$totime=explode("/",$start_date);
		$fromtime=explode("/",$end_date);
		$srh_end_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
		$srh_start_date=$totime[2]."-".$totime[0]."-".$totime[1];

		$query="SELECT emp.id as emp_id,emp.fname, emp.lname,emp.role,IFNULL(job.total,0) as total,IFNULL(job.total_min,0) as total_min, IFNULL(job.total_job,0) as total_job FROM at_employee as emp LEFT JOIN ( SELECT job.emp_id,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job,job.created_date,job.payment_approval_status FROM at_jobs as job WHERE ".$where." AND created_date BETWEEN '". $srh_end_date ."' AND '". $srh_start_date."' AND job.payment_approval_status='1' GROUP BY job.emp_id ) as job ON emp.id=job.emp_id UNION SELECT ass.id as emp_id,ass.assist_fname as fname, ass.assist_lname as lname,ass.role,IFNULL(job.total,0) as total,IFNULL(job.total_min,0) as total_min, IFNULL(job.total_job,0) as total_job FROM at_assistants as ass LEFT JOIN ( SELECT job.emp_id,sum(job.hours) as total,sum(job.mins) as total_min ,count(job.job_num) as total_job,job.created_date FROM (SELECT aaj.assistant_id as emp_id,aaj.hours,aaj.mins,aj.job_num,
aj.created_date,aj.payment_approval_status FROM `at_assistant_in_job` as aaj LEFT JOIN at_jobs as aj ON aj.id=aaj.job_id ) as job WHERE ".$where1." AND created_date BETWEEN '". $srh_end_date ."' AND '". $srh_start_date."' AND job.payment_approval_status='1' GROUP BY job.emp_id ) as job ON ass.id=job.emp_id  ORDER BY $order LIMIT $offset , $num";
		
		}
		else
		{
		$query="SELECT emp.id as emp_id,emp.fname, emp.lname,emp.role,IFNULL(job.total,0) as total,IFNULL(job.total_min,0) as total_min, IFNULL(job.total_job,0) as total_job FROM at_employee as emp LEFT JOIN ( SELECT job.emp_id,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_jobs as job WHERE ".$where." AND job.payment_approval_status='1' GROUP BY  job.emp_id ) as job ON emp.id=job.emp_id UNION SELECT ass.id as emp_id,ass.assist_fname as fname, ass.assist_lname as lname,ass.role,IFNULL(job.total,0) as total,IFNULL(job.total_min,0) as total_min, IFNULL(job.total_job,0) as total_job FROM at_assistants as ass LEFT JOIN ( SELECT job.emp_id,sum(job.hours) as total,sum(job.mins) as total_min ,count(job.job_num) as total_job FROM (SELECT aaj.assistant_id as emp_id,aaj.hours,aaj.mins,aj.job_num FROM `at_assistant_in_job` as aaj LEFT JOIN at_jobs as aj ON aj.id=aaj.job_id ) as job where ".$where1." GROUP BY job.emp_id ) as job ON ass.id=job.emp_id ORDER BY $order LIMIT $offset , $num";

		}
		
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
		function rows($where='1',$where1='1'){
		$picker=$this->input->post('picker');
		if(!empty($picker))
		{
		$end_date=$this->input->post('picker');
		$fromtime=explode("/",$end_date);
		$srh_end_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
		$today = mktime(0,0,0,$fromtime[0],$fromtime[1],$fromtime[2]);
		$hour   = date("H",$today);
		$minute = date("i",$today);
		$second = date("s",$today);
		$month  = date("m",$today);
		$day    = date("d",$today);
		$year   = date("Y",$today);
		$Start_date=date("Y-m-d",mktime($hour,$minute,$second,$month,$day-14,$year));
		$query="SELECT job.emp_id,emp.fname,emp.role,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where ".$where." and emp.id=job.emp_id and job.created_date BETWEEN '". $Start_date ."' AND '". $srh_end_date."' and job.payment_approval_status='1' group by job.emp_id UNION SELECT ass_job.assistant_id as emp_id,ass.assist_fname as fname,ass.role as role,sum(ass_job.hours) as total,sum(ass_job.mins) as total_min,count(ass_job.id) as total_job
FROM at_assistant_in_job as ass_job,at_assistants as ass,at_jobs as jobi where ".$where1." and ass_job.assistant_id=ass.id and ass_job.job_id=jobi.id and jobi.created_date BETWEEN '". $Start_date ."' AND '". $srh_end_date."' and jobi.payment_approval_status='1' group by ass_job.assistant_id";
	
		}
		else
		{
		$query="SELECT job.emp_id,emp.fname,emp.role,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where ".$where." and emp.id=job.emp_id and job.payment_approval_status='1' group by job.emp_id UNION SELECT ass_job.assistant_id as emp_id,ass.assist_fname as fname,ass.role as role,sum(ass_job.hours) as total,sum(ass_job.mins) as total_min,count(ass_job.id) as total_job
FROM at_assistant_in_job as ass_job,at_assistants as ass,at_jobs as jobi where ".$where1." and ass_job.assistant_id=ass.id and ass_job.job_id=jobi.id and jobi.payment_approval_status='1' group by ass_job.assistant_id";
		}
		$q=$this->db->query($query);
		return $q->num_rows();
	}
///////////start employee listing report/////////////	

	
///////////start employee detail//////////////		
	function get_employee_detail_where($where=1,$offset=0,$id,$srch_date,$role){
	if($role==1)
	{ 
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
		$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status='1' and created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
		$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status='1'";
		}
	}
	else
	{
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
		$query="select job.job_num,job.created_date,job.job_descr,ass_job.hours as job_hours,ass_job.mins as job_mins,job.approve_date,job.payment_approval_status FROM at_jobs as job,at_assistant_in_job as ass_job WHERE ".$where." and ass_job.assistant_id=".$id ." and job.payment_approval_status='1' and ass_job.job_id=job.id and job.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."'";
		}
		else
		{
		echo $query="select job.job_num,job.created_date,job.job_descr,ass_job.hours as job_hours,ass_job.mins as job_mins,job.approve_date,job.payment_approval_status FROM at_jobs as job,at_assistant_in_job as ass_job WHERE ".$where." and ass_job.assistant_id=".$id ." and job.payment_approval_status='1' and ass_job.job_id=job.id ";
		}
	}
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
		
	}
	

	function employee_detail_rows($where='1',$id,$srch_date,$role){
	if($role==1)
	{
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
		$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
			$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." ";
		}
	}
	else
	{
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
		$query="select * FROM at_jobs as job,at_assistant_in_job as ass_job WHERE ".$where." and ass_job.assistant_id=".$id ." and ass_job.job_id=job.id and job.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
		$query="select * FROM at_jobs as job,at_assistant_in_job as ass_job WHERE ".$where." and ass_job.assistant_id=".$id ." and ass_job.job_id=job.id ";
		}
	}
		$q=$this->db->query($query);
		return $q->num_rows();
	}
///////////employee detail//////////////	
///////////////genearate pdf//////////////
	function generate_report_pdf(){
 		$end_date=date("Y-m-d");
		$fromtime=explode("-",$end_date);
		$today = mktime(0,0,0,$fromtime[1],$fromtime[2],$fromtime[0]);
		$hour   = date("H",$today);
		$minute = date("i",$today);
		$second = date("s",$today);
		$month  = date("m",$today);
		$day    = date("d",$today);
		$year   = date("Y",$today);
		$Start_date=date("Y-m-d",mktime($hour,$minute,$second,$month,$day-14,$year));
		$query="select * FROM at_jobs WHERE created_date BETWEEN '". $Start_date ."' AND '". $end_date."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
///////////////////////////
	function get_pdf_emp_result($id,$role,$srch_date){
		$res=strpos($srch_date,".");
	if($role==1)
	{
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
	}
	else
	{
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
		$query="select job.job_num,job.created_date,job.job_descr,ass_job.hours as job_hours,ass_job.mins as job_mins FROM at_jobs as job,at_assistant_in_job as ass_job WHERE ass_job.assistant_id=".$id ." and job.payment_approval_status='1' and ass_job.job_id=job.id and job.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
		$query="select job.job_num,job.created_date,job.job_descr,ass_job.hours as job_hours,ass_job.mins as job_mins FROM at_jobs as job,at_assistant_in_job as ass_job WHERE ass_job.assistant_id=".$id ." and job.payment_approval_status='1' and ass_job.job_id=job.id ";
		}
	}

		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}	
	function get_download_pdf_emp_result($srch_date){
		$res=strpos($srch_date,".");
		$srch_date=explode("-",$srch_date);
		$start_date=$srch_date[1];
		$end_date=$srch_date[2];

		if(!empty($srch_date[0]))
		{
			if(!empty($res))
			{

			$fromtime=explode(".",$start_date);
			$totime=explode(".",$end_date);
			$srh_start_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
			$srh_end_date=$totime[2]."-".$totime[0]."-".$totime[1];
			$query="SELECT emp.fname,emp.lname,emp.role,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.fname like '%".$srch_date[0]."%' and emp.id=job.emp_id and job.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' and job.payment_approval_status='1' group by job.emp_id UNION SELECT ass.assist_fname as fname,ass.assist_lname as lname,ass.role as role,sum(ass_job.hours) as total,sum(ass_job.mins) as total_min,count(ass_job.id) as total_job
FROM at_assistant_in_job as ass_job,at_assistants as ass,at_jobs as jobi where ass.assist_fname like '%".$srch_date[0]."%' and ass_job.assistant_id=ass.id and ass_job.job_id=jobi.id and jobi.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' and jobi.payment_approval_status='1' group by ass_job.assistant_id order by fname";
			}
			else
			{
			$query="SELECT emp.fname,emp.lname,emp.role,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.fname like '%".$srch_date[0]."%' and emp.id=job.emp_id and job.payment_approval_status='1' group by job.emp_id UNION SELECT ass.assist_fname as fname,ass.assist_lname as lname,ass.role as role,sum(ass_job.hours) as total,sum(ass_job.mins) as total_min,count(ass_job.id) as total_job
FROM at_assistant_in_job as ass_job,at_assistants as ass,at_jobs as jobi where ass.assist_fname like '%".$srch_date[0]."%' and ass_job.assistant_id=ass.id and ass_job.job_id=jobi.id and jobi.payment_approval_status='1' group by ass_job.assistant_id order by fname";
			}
		}else if(!empty($res))
		{

			$fromtime=explode(".",$start_date);
			$totime=explode(".",$end_date);
			$srh_start_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
			$srh_end_date=$totime[2]."-".$totime[0]."-".$totime[1];
 		$query="SELECT emp.fname,emp.lname,emp.role,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.id=job.emp_id and job.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' and job.payment_approval_status='1' group by job.emp_id UNION SELECT ass.assist_fname as fname,ass.assist_lname as lname,ass.role as role,sum(ass_job.hours) as total,sum(ass_job.mins) as total_min,count(ass_job.id) as total_job
FROM at_assistant_in_job as ass_job,at_assistants as ass,at_jobs as jobi where ass_job.assistant_id=ass.id and ass_job.job_id=jobi.id and jobi.created_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' and jobi.payment_approval_status='1' group by ass_job.assistant_id order by fname"; 

		
		}
		else
		{
	$query="SELECT emp.fname,emp.lname,emp.role,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.id=job.emp_id and job.payment_approval_status='1' group by job.emp_id UNION SELECT ass.assist_fname as fname,ass.assist_lname as lname,ass.role as role,sum(ass_job.hours) as total,sum(ass_job.mins) as total_min,count(ass_job.id) as total_job
FROM at_assistant_in_job as ass_job,at_assistants as ass,at_jobs as jobi where ass_job.assistant_id=ass.id and ass_job.job_id=jobi.id and jobi.payment_approval_status='1' group by ass_job.assistant_id order by fname";
		}
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function automatic_pdf_report(){
 		$end_date=date("Y-m-d");
		$to_time=explode("-",$end_date);
		$today = mktime(0,0,0,$to_time[1],$to_time[2],$to_time[0]);
		$hour   = date("H",$today);
		$minute = date("i",$today);
		$second = date("s",$today);
		$month  = date("m",$today);
		$day    = date("d",$today);
		$year   = date("Y",$today);
		$Start_date=date("Y-m-d",mktime($hour,$minute,$second,$month,$day-14,$year));
		$query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.id=job.emp_id and job.created_date BETWEEN '". $Start_date ."' AND '". $end_date."' group by job.emp_id";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function employee_name($id,$role){
	if($role==1)
	{
		$query="SELECT id,fname,lname FROM at_employee where id=".$id;
	}else
	{
		$query="SELECT id,assist_fname as fname,assist_lname as lname FROM at_assistants where id=".$id;
	}
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function get_report3($where,$where1){
	$query="SELECT DISTINCT(A.id) as id ,A.company_name,A.job_no,A.total+B.total as grand_total,A.total_min+B.total_min as grand_total_min,A.total_count+B.total_count as grand_total_count FROM (SELECT id,company_name,job_no,IFNULL(total,0) as total,IFNULL(total_mins,0) as total_min,IFNULL(count,0) as total_count FROM at_customers as custom LEFT JOIN ( SELECT at_jobs.job_num,SUM(at_jobs.job_hours) as total,SUM(at_jobs.job_mins) as total_mins,COUNT(*) as count FROM at_customers LEFT JOIN at_jobs ON at_customers.job_no = at_jobs.job_num WHERE $where GROUP BY at_jobs.job_num) jobs ON custom.job_no = jobs.job_num) as A
LEFT JOIN ( SELECT id,company_name,job_no,IFNULL(total,0) as total,IFNULL(total_mins,0) as total_min,IFNULL(count,0) as total_count FROM at_customers as custom LEFT JOIN ( SELECT aj.job_num,SUM(aaj.hours) as total,SUM(aaj.mins) as total_mins,COUNT(*) as count FROM at_jobs as aj INNER JOIN at_assistant_in_job as aaj ON aj.id=aaj.job_id WHERE $where1 GROUP BY aj.job_num) jobs ON custom.job_no = jobs.job_num )as B
ON A.job_no=B.job_no";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function get_report4($job,$where){
	$query="SELECT aj.job_num,ac.company_name,aj.created_date,ass.assist_fname as fname,ass.assist_lname as lname,ass.role,aaj.hours,aaj.mins FROM `at_assistant_in_job` as aaj LEFT JOIN at_jobs as aj ON aj.id=aaj.job_id LEFT JOIN at_assistants as ass ON aaj.assistant_id=ass.id LEFT JOIN at_customers ac ON aj.job_num=ac.job_no WHERE aj.job_num=$job AND $where UNION SELECT aj.job_num,ac.company_name,aj.created_date,emp.fname,emp.lname,emp.role,aj.job_hours as hours,aj.job_mins as mins FROM at_jobs as aj LEFT JOIN at_employee as emp ON aj.emp_id=emp.id LEFT JOIN at_customers ac ON aj.job_num=ac.job_no WHERE aj.job_num=$job AND $where ORDER BY created_date ";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}	
	function get_job_detail($job_num){
	 $query="SELECT * FROM at_customers WHERE job_no=".$job_num;
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return false;
		}
	}
}

?>
