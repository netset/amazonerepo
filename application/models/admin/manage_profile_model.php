<?php
/*
	purpose:model to manage Admin
	author: Nitin Saluja
*/
class Manage_profile_model extends CI_Model
{

	function get_user($id=""){
		$this->db->where('id',$id);
		$data=$this->db->get('users')->row_object();
		return $data;
	}
	function update_user($id="",$image=''){
		if($id!=""){
			$data=array('first_name'=>$this->input->post('user_first_name'),
					'last_name'=>$this->input->post('user_last_name'),		
			                'email_id'=>$this->input->post('user_email')
			                );
					if(!empty($_FILES['image']['name']))	
					{
						$data['image']=$image;
						
					}
			$this->db->where('id',$id);
			$this->db->update('users',$data);		
			if($this->db->affected_rows()>0){
					if(!empty($_FILES['image']['name']))	
					{
						$this->session->set_userdata('pic_name',$image);
					}
				return true;
			}else{
				return false;
			}
		}
	}
}

?>