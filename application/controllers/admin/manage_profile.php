<?php
/*
	purpose: controller to manage all opertion performed for Admin managenment	
	author: Nitin Saluja
*/
class Manage_profile extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/manage_profile_model');
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}
	
	
	function add_profile($id='1'){
            $data['title']='Edit Admin Profile';
		
		if($this->input->post()){				
			/* form validation */
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_first_name','First Name','required|trim|xss_clean|alpha_dash|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_last_name','Last Name','trim|xss_clean|alpha_dash|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_email','Email','required|trim|valid_email');
			if($this->form_validation->run() == FALSE){
				$data['user_first_name']=$this->input->post('user_first_name');
				$data['user_last_name']=$this->input->post('user_last_name');
				$data['user_email']=$this->input->post('user_email');		
				$data['image']="admin/employee/add_profile";
			}else{   /* validation ends */
					if(!empty($_FILES['image']['name']))
					{
						$data1=array();
						$config['upload_path'] = './public/uploads/';
						$config['allowed_types'] = 'jpg|png|gif|jpeg';	
						$config['max_size']	= '10000';
						$config['image_width'] = '100';
						$config['image_height'] = '100';
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('image'))
						{
							$error = array('error' => $this->upload->display_errors());				
						}
						else
						{
							$img = array('upload_data' => $this->upload->data());	
						}
					}
					if($this->manage_profile_model->update_user($id,@$img['upload_data']['file_name'])){
						$this->session->set_flashdata('status', '<div class="msg">'.'Admin Information has been Updated Successfully'.'</div>');
					}else{
							$this->session->set_flashdata('status', '<div class="error">'.'You did not make any change'.'</div>');
					}
					redirect(base_url()."admin/login/welcome");
					
			}
			
		}else{	
		
			if($id!=''){			
				$data['result']=$this->manage_profile_model->get_user($id);				
			}
			$data['file']="admin/employee/add_profile";	
		}
		$data['file']="admin/employee/add_profile";	
		$this->load->view('admin/template',$data);
	}
	
}
?>