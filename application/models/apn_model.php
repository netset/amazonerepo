<?php   
class apn_model extends CI_Model  {
	function  __construct()  {
    	parent::__construct();
	} 

    // functionto get user divice id
    function get_iphone_user_service($user_id)
    {
        $query="select id,device_id,badge from users where id ='".$user_id."'";
	$q=$this->db->query($query);
	if($q->num_rows()>0){
		return $q->result();
	}else{
		return false;
	}
    }
    
    // function to update badge
    function update_badge($badge,$deviceToken)
    {
     	$query = "update users set badge = '".$badge."' where device_id = '".$deviceToken."'";
        $result=mysql_query($query);
	if (mysql_affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }	
}
