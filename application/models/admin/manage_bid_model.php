<?php
/*
	purpose:model to manage Bids
	author: Nitin Saluja
*/
class Manage_bid_model extends CI_Model
{
	
	function get_where($table,$where=1,$single=false,$order='id desc',$paging=false,$num=10,$offset=0){
	
	
		$query="SELECT A.id,A.job_id,job_title,A.cover_letter,deleivery_date,bid_amount,A.cust_id as owner_id,A.first_name as owner,A.sp_id,u.first_name as sp_name FROM (SELECT ja.*,job_title,cust_id,us.first_name FROM job_applications as ja LEFT JOIN jobs as j ON ja.job_id=j.id LEFT JOIN users as us ON cust_id=us.id) A LEFT JOIN users as u ON A.sp_id=u.id where $where order by $order LIMIT $offset , $num ";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	function rows($where='1'){
	 	 $query="SELECT A.id FROM (SELECT ja.*,job_title,cust_id,us.first_name FROM job_applications as ja LEFT JOIN jobs as j ON ja.job_id=j.id LEFT JOIN users as us ON cust_id=us.id) A LEFT JOIN users as u ON A.sp_id=u.id WHERE $where";
		
		$q=$this->db->query($query);
		return $q->num_rows();
	}
	function get_bid($id=""){
	 $query="SELECT A.id,A.job_id,cat_name,job_title,budget,A.cover_letter,deleivery_date,bid_amount,A.cust_id as owner_id,A.first_name as owner,A.sp_id,u.first_name as sp_name,job_status,is_hired FROM (SELECT ja.*,job_title,job_cat,cust_id,us.first_name,budget,job_status FROM job_applications as ja LEFT JOIN jobs as j ON ja.job_id=j.id LEFT JOIN users as us ON cust_id=us.id) A LEFT JOIN users as u ON A.sp_id=u.id LEFT JOIN job_category as jc ON job_cat=jc.id where A.id='".$id."'";
		//echo $query="select j.*,jc.cat_name from jobs as j LEFT JOIN job_category as jc ON j.job_cat=jc.id where j.id='".$id."'";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->result();
		}else{
			return array();
		}
	}
	
	function get_total_bids(){
		$query="SELECT *  FROM job_applications";
		$q=$this->db->query($query);
		if($q->num_rows()>0){
			return $q->num_rows();
		}else{
			return 0;
		}
	}
	

	
}

?>
