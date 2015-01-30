<?php
/*
purpose: Controller to manage all operation performed for messages managenment	
author: Aman Phull
Dated: 23 oct, 2013
*/
class Manage_message extends CI_Controller
{
    function __construct()
    {
        //error_reporting(E_ERROR);
        parent::__construct();
        $this->load->model('admin/manage_message_model');
        $this->load->model('web_service_model');
        if ($this->session->userdata('admin_id') == '') {
            redirect(base_url() . 'admin/login');
        }
    }
    
    
    
    function listing($offset = 0, $order = 'id', $srt = 'desc')
    {
	
        $data['title'] = 'Manage Messages';
        
        $data['order'] = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
        
        $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $this->uri->segment(8);
        
        $whr = "1";
        
        if ($srch != '') {
            
            $whr = "$field like '%$srch%'";
            
        }
        
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_message_model->rows($whr);       
        else
            $total_rows = $this->manage_message_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_message/listing';
        
        $config['total_rows'] = $total_rows;
        
        $config['per_page'] = '10';
        
        $config['uri_segment'] = '4';
        
        $config['full_tag_open']  = "<ul class='paginationControl'>";
        $config['full_tag_close'] = "</ul>";
        $config['next_link']      = "Next";
        $config['next_tag_open']  = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_link']      = "Prev";
        $config['prev_tag_open']  = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['cur_tag_open']   = "<li class='selected'><a href='javascript:void(0)'>";
        $config['cur_tag_close']  = "</a></li>";
        $config['num_tag_open']   = "<li>";
        $config['num_tag_close']  = "</li>";
        
        $this->pagination->initialize($config);
        
        $data['result']  = $this->manage_message_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['listing'] = 'listing';
        $data['file']    = "admin/message/listing";
        
        $this->load->view("admin/template", $data);
    }
    ////////for ordering///////////
    
    function list_ordering($offset, $order, $srt)
    {
        $data['title'] = 'Manage Messages';
        
        $data['order'] = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
        
        $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $whr = "1";
        
        if ($srch != '') {
            $whr = "$field like '%$srch%'";
        }
        
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_message_model->rows($whr);        
        else
            $total_rows = $this->manage_message_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_message/listing_ordering';
        
        $config['total_rows'] = $total_rows;
        
        $config['per_page'] = '10';
        
        $config['uri_segment'] = '4';
        
        $config['full_tag_open']  = "<ul class='paginationControl'>";
        $config['full_tag_close'] = "</ul>";
        $config['next_link']      = "Next";
        $config['next_tag_open']  = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_link']      = "Prev";
        $config['prev_tag_open']  = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['cur_tag_open']   = "<li class='selected'><a href='javascript:void(0)'>";
        $config['cur_tag_close']  = "</a></li>";
        $config['num_tag_open']   = "<li>";
        $config['num_tag_close']  = "</li>";
        
        $this->pagination->initialize($config);
        
        $data['result']  = $this->manage_message_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['listing'] = 'list_ordering';
        $data['file']    = "admin/message/listing";
        
        $this->load->view("admin/template", $data);
    }
/**************************
Message Listing Functionality
********************/ 
    function listing_search($offset = 0, $order = 'id', $srt = 'desc')
    {
        $data['title']   = 'Manage Messages';
        $data['listing'] = 'listing_search';
        $data['order']   = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        if (isset($_POST['srch']) && isset($_POST['field'])) {
            
            $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
            $this->session->set_userdata('searchvalue', $srch);
            $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $this->uri->segment(7);
            $this->session->set_userdata('searchfield', $field);
            
        } else {
            $data['srch'] = $srch = $this->session->userdata('searchvalue');
            
            $data['field'] = $field = $this->session->userdata('searchfield');
            
        }
        
        if ($srch != '') {
            
            $whr = "$field like '%$srch%'";
            
        }
        
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_message_model->rows($whr);
        
        else
            $total_rows = $this->manage_message_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_message/listing_search';
        
        $config['total_rows'] = $total_rows;
        
        $config['per_page'] = '10';
        
        $config['uri_segment'] = '4';
        
        $config['full_tag_open']  = "<ul class='paginationControl'>";
        $config['full_tag_close'] = "</ul>";
        $config['next_link']      = "Next";
        $config['next_tag_open']  = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_link']      = "Prev";
        $config['prev_tag_open']  = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['cur_tag_open']   = "<li class='selected'><a href='javascript:void(0)'>";
        $config['cur_tag_close']  = "</a></li>";
        $config['num_tag_open']   = "<li>";
        $config['num_tag_close']  = "</li>";
        
        $this->pagination->initialize($config);
        
        $data['result'] = $this->manage_message_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        
        $data['file'] = "admin/message/listing";
        $this->load->view("admin/template", $data);
    }


  function message_detail($id)
    {

        $data['title']  = 'Message Detail';
        $data['result'] = $this->manage_message_model->get_message($id);
       
          $data['file'] = "admin/message/message_detail";
        $this->load->view('admin/pop/template', $data);
        
    }

/****************************************
Add Message Functionality Module
*****************************************/

    function add_message($id = '')
    {
   
        $id = $this->uri->segment(4);
       
        if ($id == '') {
            $data['title'] = 'Send Message';
           $data['user'] = $this->manage_message_model->get_user($id);
        } else {
            $data['title'] = 'Edit Message';
            $data['user'] = $this->manage_message_model->get_user($id);
        }
         

        if ($this->input->post()) {
            	
            /* form validation */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean|min_length[3]|max_length[15]');
            $this->form_validation->set_rules('first_name', 'Receiver', 'required|trim|xss_clean');
            //$this->form_validation->set_rules('message_time', 'message_time', 'required|trim|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                 $data['message'] = $this->input->post('message');
                 $data['first_name']   = $this->input->post('first_name');
                //$data['message_time']   = $this->input->post('message_time');
                $data['file'] = "admin/message/add_message";
                
            }
            
            else {
                
                 if ($id != '') {
                    
                    if ($this->manage_message_model->update_message($id)) {
                        $this->session->set_flashdata('status', '<div class="msg">' . 'Job Information has been Updated Successfully' . '</div>');
                    } else {
                        $this->session->set_flashdata('status', '<div class="error">' . 'Problem Updating' . '</div>');
                    }
                } else {
                    
                    if ($this->manage_message_model->add_message()) {
                        $this->session->set_flashdata('status', '<div class="msg">' . 'message has been send Successfully' . '</div>');
                    } else {
                        $this->session->set_flashdata('status', '<div class="error">' . 'Problem Adding' . '</div>');
                    }
                }
                redirect(base_url() . "admin/manage_message/listing");
            }
            
        } else {
            if ($id != '') {
                
                $data['result'] = $this->manage_message_model->get_message($id);
                
                
            }
            
            $data['file'] = "admin/message/add_message";
            
        }
            
    // pr($data);die;
        
        $this->load->view('admin/template', $data);
    }
/*****************************************
Email Sending MOdule
******************************************/
     function send_email($id = NULL)
    {
 
    	 $id= $this->input->post("email_id");
     	$message= $this->input->post("message");
      	      $data['title'] = 'Send Email';
      	      
      	      $data['user'] = $this->manage_message_model->get_email($id);
          if ($this->input->post()) {
            /* form validation */
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email_id', 'Name', 'required|trim|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'required|trim|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                 $data['message'] = $this->input->post('message');
                 $data['email_id']   = $this->input->post('email_id');           
            }
     	    else {

		if(mail("$id",'webpaandu@gmail.com',"$message"))
		{
		
$data['status']=$this->session->set_flashdata('status', '<div class="msg">' . 'Email has been send Successfully' . '</div>');
		}else{
$data['status']=$this->session->set_flashdata('status', '<div class="error">' . 'Problem Sending' . '</div>');
		}
		redirect(base_url() . "admin/manage_message/listing");	

	}
	}
	
	        $data['file'] = "admin/message/send_email";
	     //pr($data);
	        $this->load->view('admin/template', $data);
   	}
    
    
    
    
  function delete($id='')
	{
		if($id!=''){
			$_POST['IDs']=array($id);
			$_POST['action']='delete';
		}	
		
		$this->manage_message_model->doAction('messages');

	}
    
    
  
    
   //Sending Push Notification on android device
   function send_push_notification($user_id,$message){
   // $user_id = "86";
   // $message = 'Hello';  
      $device_id_android = $this->web_service_model->get_iphone_user_service($user_id); 
      $deviceToken[] = $device_id_android[0]->android_device_id;	
	//$deviceToken[]="APA91bEaSUlbZYZSNv4U5Pa31itOJjOR_Y6oS8OS0mqmR5qGf4VVwkOIQKQvcQcdepDUvhjLdAPwWvEQk-7VeZvdencX3pxPMPOFQ-dHsHwoIRFEMtIQRRNR_s2HYZPricN-hK3IrP31xTZP8KA2_fSEwr51NW0ABxgLZvMrs5Vh8m4955NjlxU";
 if(!empty($device_id_android[0]->android_device_id)){
 
   $count_badge  = $device_id_android[0]->badge+1; 
    // $count_badge ='1';
         $this->web_service_model->update_badge($count_badge,$user_id);
         $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' =>  $deviceToken,
            'data' => array("message" => $message,"badge"=>$count_badge,"user_id"=>$user_id)
                   );
      
        $headers = array(
            'Authorization: key= AIzaSyABNcpVJKW2eOgzGZ1Dd2V8lJbaST6PMcQ',
            'Content-Type: application/json'
        );
        //print_r($headers);
        // Open connection
        $ch = curl_init();
 
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
 
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 
        // Disabling SSL Certificate support temporarly
       // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_FTP_SSL, CURLFTPSSL_TRY);  
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $fields ) );
 
        // Execute post
        $result = curl_exec($ch);
       // pr($result); die;
        if ($result === FALSE) {
          //  die('Curl failed: ' . curl_error($ch));
            return false;
        }
 
        // Close connection
        curl_close($ch);
      
       return true;
        }
    }  
    
         
               // function to send push notifications on iphone device
                  function push_iphone()
		  { 
		       
		       $user_id = '152';
		       $message ='hello';
		       $badge = '1';
		       $deviceToken="7e6d7c2e28b25fce49a51039f63f426f9ef132baea8a745fb34613dafa873da5";
		        //$device_id = $this->web_service_model->get_iphone_user_service($user_id); 
                       // $deviceToken = $device_id[0]->iphone_device_id;                              
			//$badge   = $device_id[0]->badge+1;   	
			  
			   
		         //   if(!empty($device_id[0]->iphone_device_id))
                          //  { 
                           
                         //   $this->web_service_model->update_badge($badge,$user_id);
			       // Put your private key's passphrase here:
                         $passphrase = '!@#$%^&*()';
			   			    
                                     $ctx = stream_context_create();
                                   $pem_data = file_get_contents('public/PushchatKey.pem'); 
                                   stream_context_set_option($ctx, 'ssl', 'local_cert', $pem_data);
                                   stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);

                           //$fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err,
                         // .. $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx); 
                       $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
                            
if (!$fp)
{
exit("Failed to connect: $err $errstr".PHP_EOL);
}
else
{
//echo 'Connected to APNS' . PHP_EOL;

// Create the payload body
$body['aps'] = array(
                     'alert' => $message,
                     'sound' => 'default',
                     'badge' => $badge,
                     'user_id'=>$user_id
                     );

// Encode the payload as JSON
$payload = json_encode($body);

// Build the binary notification
$msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

// Send it to the server
 $result = fwrite($fp, $msg, strlen($msg));
pr($result); die;
if (!empty($result))
{
return true;
}
else
{
return false;
}
socket_close($fp);
fclose($fp);
}			
			
//}
}
    
}
/* End of file */


?>