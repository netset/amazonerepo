<?php
/*
	purpose:model to manage employees
	author: Nitin Saluja
*/
class Manage_report_model extends CI_Model
{
///////////start employee listing report//////////////		
	function get_where($table,$where=1,$single=false,$order,$paging=false,$num=10,$offset=0){
		//$query="SELECT *  FROM users where ".$where." AND user_type='user' order by $order LIMIT $offset , $num";
		//echo $query="SELECT us.id,us.fname,us.lname,us.email,dept.dept_name,ass.fname as assist FROM at_employee us,at_employee ass,at_department dept where ".$where." and dept.id=us.department_id and ass.id=us.assistant_id order by $order LIMIT $offset , $num";
		//$query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job WHERE ".$where." and emp.id=job.emp_id and job.payment_approval_status=1 group by job.emp_id  LIMIT $offset , $num";
		$picker=$this->input->post('picker');
		if(!empty($picker))
		{
		$end_date=$this->input->post('picker');
		$start_date=$this->input->post('picker1');
		$totime=explode("/",$start_date);
		$fromtime=explode("/",$end_date);
		$srh_end_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
		$srh_start_date=$totime[2]."-".$totime[0]."-".$totime[1];
		$query="SELECT emp.fname,job.*,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where ".$where." and emp.id=job.emp_id and job.payment_approval_status=1 and job.approve_date BETWEEN '". $srh_end_date ."' AND '". $srh_start_date."' group by job.emp_id order by $order LIMIT $offset , $num";
		}
		else
		{
		$query="SELECT emp.fname,job.*,sum(job.job_hours) as total,sum(job.job_mins) as total_min ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where ".$where." and emp.id=job.emp_id and job.payment_approval_status=1 group by job.emp_id order by $order LIMIT $offset , $num";
		}
		
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
		function rows($where='1'){
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
		$query="SELECT emp.fname,sum(job.job_hours) as total FROM at_employee emp,at_jobs job where ".$where." and emp.id=job.emp_id and job.payment_approval_status=1 and job.approve_date BETWEEN '". $Start_date ."' AND '". $srh_end_date."' group by job.emp_id ";
	
		}
		else
		{
		 $query="SELECT emp.fname,sum(job.job_hours) as total FROM at_employee emp,at_jobs job where ".$where." and emp.id=job.emp_id and job.payment_approval_status=1 group by job.emp_id ";
		}
		$q=$this->db->query($query);
		return $q->num_rows();
	}
///////////start employee listing report/////////////	

	
///////////start employee detail//////////////		
	function get_employee_detail_where($where=1,$num=10,$offset=0,$id,$srch_date){
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
		$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status=1 and approve_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' LIMIT 0 , $num";
		}
		else
		{
/* 		$end_date=date("Y-m-d");
		$fromtime=explode("-",$end_date);
		$today = mktime(0,0,0,$fromtime[1],$fromtime[2],$fromtime[0]);
		$hour   = date("H",$today);
		$minute = date("i",$today);
		$second = date("s",$today);
		$month  = date("m",$today);
		$day    = date("d",$today);
		$year   = date("Y",$today);
		$Start_date=date("Y-m-d",mktime($hour,$minute,$second,$month,$day-14,$year));  */
		//$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status=1 and approve_date BETWEEN '". $Start_date ."' AND '". $end_date."' LIMIT 0 , $num";
		$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status=1 LIMIT 0 , $num";
		}
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	

	function employee_detail_rows($where='1',$id,$srch_date){
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
		$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status=1 and approve_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
/* 		$end_date=date("Y-m-d");
		$fromtime=explode("-",$end_date);
		$today = mktime(0,0,0,$fromtime[1],$fromtime[2],$fromtime[0]);
		$hour   = date("H",$today);
		$minute = date("i",$today);
		$second = date("s",$today);
		$month  = date("m",$today);
		$day    = date("d",$today);
		$year   = date("Y",$today);
		$Start_date=date("Y-m-d",mktime($hour,$minute,$second,$month,$day-14,$year));  */
			//$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status=1 and approve_date BETWEEN '". $Start_date ."' AND '". $end_date."' ";
			$query="select * FROM at_jobs WHERE ".$where." and emp_id=".$id ." and payment_approval_status=1 ";
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
		$query="select * FROM at_jobs WHERE payment_approval_status=1 and approve_date BETWEEN '". $Start_date ."' AND '". $end_date."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
///////////////////////////
	function get_pdf_emp_result($id,$srch_date){
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
			$query="select * FROM at_jobs WHERE emp_id=".$id ." and payment_approval_status=1 and approve_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' ";
		}
		else
		{
			$query="select * FROM at_jobs WHERE emp_id=".$id ." and payment_approval_status=1 ";
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
			echo $query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.fname like '%".$srch_date[0]."%' and emp.id=job.emp_id and job.payment_approval_status=1 and job.approve_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' group by job.emp_id";
			}
			else
			{
			 $query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.fname like '%".$srch_date[0]."%' and emp.id=job.emp_id and job.payment_approval_status=1 group by job.emp_id";
			}
		}else if(!empty($res))
		{
			$fromtime=explode(".",$start_date);
			$totime=explode(".",$end_date);
			$srh_start_date=$fromtime[2]."-".$fromtime[0]."-".$fromtime[1];
			$srh_end_date=$totime[2]."-".$totime[0]."-".$totime[1];
			$query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.id=job.emp_id and job.payment_approval_status=1 and job.approve_date BETWEEN '". $srh_start_date ."' AND '". $srh_end_date."' group by job.emp_id";
		
		}
		else
		{
			$query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.id=job.emp_id and job.payment_approval_status=1 group by job.emp_id";
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
		$query="SELECT emp.fname,job.*,sum(job.job_hours) as total ,count(job.job_num) as total_job FROM at_employee emp,at_jobs job where emp.id=job.emp_id and job.payment_approval_status=1 and job.approve_date BETWEEN '". $Start_date ."' AND '". $end_date."' group by job.emp_id";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
}

?>
