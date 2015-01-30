                                                                    <?php
/*
purpose:Model to manage messages
author: Aman phull
Dated: 23 Oct, 2013
*/
class Manage_message_model extends CI_Model
{
    function add_message($data)
    {
   
        $data = array();
       $data['sender_id']=$this->session->userdata('admin_id');
       $data['receiver_id']=$this->input->post('first_name');
       $data['message']=$this->input->post('message');
       $data['message_time']=date('Y-m-d h:i:s');
       //pr($data); die;
       
        $this->db->insert('messages', $data);
        return true;
    }
    function send_email($data)
    {
   
        $data = array();
       $data['sender_id']=$this->session->userdata('admin_id');
       $data['receiver_id']=$this->input->post('email_id');
        $data['message']=$this->input->post('message');
       
       
        $this->db->insert('messages', $data);
       //pr($data);
        return true;
    }
    
    
    function get_where($table, $where = 1, $single = false, $order = 'id desc', $paging = false, $num = 10, $offset = 0)
    {
        
       $query="SELECT A.*,B.first_name as receiver FROM (SELECT m.*,us.first_name as sender FROM `messages` as m LEFT JOIN users as us ON m.sender_id=us.id) A LEFT JOIN users as B ON A.receiver_id=B.id where $where order by $order LIMIT $offset , $num";

        $q     = $this->db->query($query);
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
    }
    function rows($whr = 1)
    {
        
        $query = "SELECT  A.*,B.first_name as receiver FROM (SELECT m.*,us.first_name as sender FROM `messages` as m LEFT JOIN users as us ON m.sender_id=us.id) A LEFT JOIN users as B ON A.receiver_id=B.id where $whr";
        $q     = $this->db->query($query);
        return $q->num_rows();
    }
    function get_message($id = "")
    {
         $query = "SELECT  A.*,B.first_name as receiver FROM (SELECT m.*,us.first_name as sender FROM `messages` as m LEFT JOIN users as us ON m.sender_id=us.id) A LEFT JOIN users as B ON A.receiver_id=B.id where A.id =".$id;
        $q = $this->db->query($query);
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return array();
        }
        
    }
    
   //
   function userEmail(){
		$this->db->where('email_id',$this->input->post('email_id'));
		$row=$this->db->get('users')->row_object();
		return $row;
	}
   
   
   
     function get_user($id = "")
    {
        $query = "SELECT id, first_name, email_id  FROM users";
        $q     = $this->db->query($query);
        //pr($q->result()); die;
        return $q->result();
        
    }
    
     function get_email($id = "")
    {
        $query = "SELECT id,first_name, email_id  FROM users WHERE id!=".$this->session->userdata('admin_id');
        $q     = $this->db->query($query);
        //pr($q->result()); die;
        return $q->result();
        
    }
    function getall_messages($id = "")
    {
        $query = "SELECT *  FROM messages";
        $q     = $this->db->query($query);
        //pr($q->result()); die;
        return $q->result();
        
    }
    
    
    function update_message($id = "")
    {
        if ($id != "") {
            $data = array(
                'message' => $this->input->post('message'),
                'description'=> $this->input->post('description')
            );
            $this->db->where('id', $id);
            $this->db->update('messages', $data);
            return true;
        }
        
        
        
    }
    
 /*function delete($id = '')
    {
        if ($id != '') {
            $_POST['IDs']    = array(
                $id
            );
            $_POST['action'] = 'delete';
        }
        //var_dump($_REQUEST);die;
        $this->manage_job_model->doAction('messages');
    }*/
    
    
     // functionto get user divice id
    function get_iphone_user_service($user_id)
    {
        $query="select iphone_device_id from users where user_id ='".$user_id."'";
        $q=$this->db->query($query);
        return $q->result();
    
    }
    
    // function to update badge
    function update_badge($badge,$deviceToken)
    {
     $query = "update users set badge = '".$badge."' where iphone_device_id = '".$deviceToken."'";
        $q     = $this->db->query($query);
		if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    
    }
}

?>