<?php

/**
	* Login Controller Class
	* @date 06-11-2012
	* @Purpose:This controller handles all the functionalities regarding Admin management.
	* @author     Nitin Saluja
	
**/
?>
<?php 
	class Login extends CI_Controller{
		function __construct()
			{
				parent::__construct();
				$this->load->model('admin/admin_model');    
				$this->load->model('admin/manage_user_model');
				$this->load->model('admin/manage_job_model');
				$this->load->model('admin/manage_bid_model');
				$this->load->model('admin/manage_employee_model');
                                $this->load->model('admin/manage_payment_model');
		   	}
     
	     
		function index()
			{ 
				ob_start();
				$data['title'] = 'Login';
				$data['file'] = 'admin/login/login';
				$cookusername=$this->input->cookie('username', false);
				$cookpass=$this->input->cookie('password', false);
				if(!empty($cookusername) || !empty($cookpass) )
				{
					$data['cookusername'] = "$cookusername";
					$data['cookpass'] = "$cookpass";
				}

				$this->load->helper(array('url','form'));
				$this->load->helper('cookie');
				$this->load->library('form_validation');
				$this->form_validation->set_error_delimiters('', '');
				$this->form_validation->set_rules('username','username','trim|required');
				$this->form_validation->set_rules('password','Password','trim|required');
						
				if ($this->form_validation->run() == FALSE){
						$data['log_username']=$this->input->post('ususernamername');
						$data['log_password']=$this->input->post('password');
					$this->load->view('admin/login/login',$data);
				}else{

						if($this->checkUserinfo($this->input->post('username'), $this->input->post('password')) == TRUE){
							$username=$this->input->post('username');
							$password=$this->input->post('password');
							$remember = $this->input->post('remember');
							$this->admin_model->loginProcess();
							if(!empty($remember))
							{
								$cookie = array(
										'name'   => 'email',
										'value'  => "$username",
										'expire' => '86500',
										'secure' => false
										);
								$cookie1 = array(
										'name'   => 'password',
										'value'  => "$password",
										'expire' => '86500',
										'secure' => false
										);
								$this->input->set_cookie($cookie);
								$this->input->set_cookie($cookie1);
							}
							
							//echo base_url();die;
							redirect(base_url().'admin/login/welcome');
						}else{
		
						
							$this->load->vars('error', 'Username or Password does not exist.');
							$data['error'] = 'Username or Password does not exist.';
							$this->load->view('admin/login/login',$data);
						} 
				 }
			}
	 
		function logout()
	        {	
				$this->session->sess_destroy();
				//$this->session->sess_create();
				//$this->session->set_flashdata('success','<div class="msg">You have successfully logged out</div>');
				redirect(base_url().'admin/login');
	        }
	        
		function checkUserEmail($email)
			{
				$this->form_validation->set_message('checkUserEmail', 'Questa email non esiste !!');
				$this->db->where(array('email'=>$email,'status'=>'1'));
				$this->db->where_in('type', 'A');
				$query = $this->db->get('users');
				if ($query->num_rows() > 0) { 
					return TRUE; 
				}else{
					return FALSE; 
				}  
			}

		function checkUserinfo($username,$password)
			{
				$this->db->where(array('email_id'=>$username, 'password' => $password));
				$query = $this->db->get('users');
				if ($query->num_rows() > 0) {
					 return TRUE; 
				}else{
					 return FALSE; 
				}  
			}
		#_________________________________________________________________________#

    /**
  
    * @Method : change_password
    * @Purpose: This function is to change admin password.
    * @Param: none
    * @Return: none 
    **/
		function change_password(){
			$id = $this->session->userdata('admin_id');
			if($id=='')
			{ 
				redirect(base_url().'admin/login');
			}
			$this->load->vars(array('title'=>'Change Password'));
			$this->load->helper(array('url','form'));
			$data['title'] = 'Change Password';
			$data['file']='admin/login/change_password';
			$this->load->helper(array('url','form'));
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('', '');
			$this->form_validation->set_rules('oldpassword','Old Password','trim|required|callback_checkPassword|xss_clean');
			$this->form_validation->set_rules('newpassword','New Password','trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('passconf','Confirm Password','trim|required|matches[newpassword]');
			if ($this->form_validation->run() == FALSE) 
			{		
				$data['oldpassword']=$this->input->post('oldpassword');
				$data['newpassword']=$this->input->post('newpassword');	
				$data['passconf']=$this->input->post('passconf');	
				$data['result']=$this->admin_model->get_result($id);
			    $this->load->view('admin/template',$data);
	
			}
			else 
			{
			  $this->load->model('admin_model');
			  $id = $this->session->userdata('admin_id');
			  $password = $this->input->post('newpassword');
			  $this->admin_model->changePassword($id,$password);
			  
			}
  }
  
	function checkPassword ($password)
	{
		$cpass = $password;
		 $id = $this->session->userdata('admin_id');
		  $this->db->where('id', $id);
        $query = $this->db->get('users');
		    $res = $query->row_array();			
		
        if ($res['password']==$cpass) 
        { 
		
              return TRUE; 
        } 
        else 
        { 
   		  $this->form_validation->set_message('checkPassword', 'Password doesnot exists.');
			return FALSE; 
        } 
      
                   
 	} 
	
	function welcome(){
		if($this->session->userdata('admin_id')==''){ 
			redirect(base_url().'admin/login');
		}
		$data['title']='Welcome Administrator';
		$data['file']='admin/welcome';
		$this->load->view('admin/template',$data);
	} 
	
	function setting($id=''){
	
		$data['title']='Default Setting';
	    $data['file']="admin/setting/setting";	
		if($this->input->post()){	
			/* form validation */
			$this->load->library('form_validation');
			$this->form_validation->set_rules('depart','Department','required|trim|xss_clean');
			$this->form_validation->set_rules('assist','Assistent','required|trim|xss_clean');
			$data['departments']=$this->admin_model->get_all_departs();					
			$data['employee']=$this->admin_model->get_all_employees();					
			if($this->form_validation->run() == FALSE){
				$data['depart']=$this->input->post('depart');
				$data['assist']=$this->input->post('assist');
				$data['file']="admin/setting/setting";	
			}else{ 
			/* validation ends */
					//var_dump($this->input->post());	die;		
					$res=$this->admin_model->get_setting();	
					if(!empty($res)){			
						if($this->admin_model->update_setting()){
							$this->session->set_flashdata('status', '<div class="msg">'.'Default Settings has been Updated Successfully'.'</div>');
						}else{
							$this->session->set_flashdata('status', '<div class="msg">'.'You did not make any change'.'</div>');
						}			
					}	
					else
					{
						if($this->admin_model->add_setting()){					
							$this->session->set_flashdata('status', '<div class="msg">'.'Default Settings has been Added Successfully'.'</div>');
						}else{				
							$this->session->set_flashdata('status', '<div class="error">'.'Problem Adding'.'</div>');
						}
					}					

					
				redirect(base_url()."admin/manage_drug/listing");
			
			}
			
		}else{	
			$res=$this->admin_model->get_setting();	
			if(!empty($res)){			
				$data['result']=$this->admin_model->get_setting();				
			}
			$data['departments']=$this->admin_model->get_all_departs();					
			$data['employee']=$this->admin_model->get_all_employees();	
		}
		$this->load->view('admin/template',$data);
	}
	
	function forgotpassword(){
		if($_POST){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtEmail','Email','required|valid_email|trim|xss_clean');
                        $this->form_validation->set_error_delimiters('<span>', '</span>');
			if($this->form_validation->run()==false){
				$data['txtEmail']=$this->input->post();
			}else{
				$user=$this->admin_model->userEmail();
				
				if(is_object($user)){
					
					$password=$this->admin_model->updateForgot($user->id);
					$this->load->library('email');
					$config['protocol'] = 'sendmail';
					$config['mailtype'] = 'text';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;

					$this->email->initialize($config);
					$this->email->from('test@temptestserver.org');
					$this->email->to($this->input->post('txtEmail'));					
					$this->email->subject('Password Recovery');
					echo $res="Hi $user->fname, \n \t ".'<p>Your password is '.$password.' </p><p>Thanks</p><p>Savaria Team</p>';die;
					
					$this->email->message($res);
					if (!$this->email->send())
					{
						echo $this->email->print_debugger();
					} else{
						$data['status']="<div style='color:green;  margin-left:180px; padding-top:10px;'>Email has been sent successfully.</div>";
					}
					
				}else{
					$data['status']="<div style='color:red;  margin-left:180px; padding-top:10px;'>Email does not exists</div>";
				}
			}
		}
		$data['title']='Forgot Password';
		$data['file']="admin/login/forgotpassword";
		
		$this->load->view("admin/template",$data);
	}
	
}