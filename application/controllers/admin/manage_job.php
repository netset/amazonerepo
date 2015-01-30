<?php
/*
purpose: controller to manage all opertion performed for Category managenment	
author: Nitin Saluja
*/
class Manage_job extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/manage_job_model');
        if ($this->session->userdata('admin_id') == '') {
            redirect(base_url() . 'admin/login');
        }
    }
    function listing($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'Manage Jobs';
        
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
            $total_rows = $this->manage_job_model->rows($whr);
        
        else
            $total_rows = $this->manage_job_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_job/listing';
        
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
        
        $data['result'] = $this->manage_job_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/job/listing";
        //pr($data);
        $this->load->view("admin/template", $data);
    }
    
    
    function listing_search($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'Manage Jobs';
        
        $data['order'] = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        if (isset($_POST['srch']) && isset($_POST['field'])) {
            
            $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
            $this->session->set_userdata('searchvalue', $srch);
            $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $this->uri->segment(8);
            $this->session->set_userdata('searchfield', $field);
            
            
        } else {
            $data['srch'] = $srch = $this->session->userdata('searchvalue');
            
            $data['field'] = $field = $this->session->userdata('searchfield');
            
        }
        
        $whr = "1";
        
        if ($srch != '') {
         
        if($field=='t.job_status')
        {
        	 
        	if($srch=='completed')
       	 	{
        	
      	 	  $whr = "$field=2";
      		  }
	        elseif($srch=='inprogress')
       		 {
       		  $whr = "$field=1";
      		  }
      		  else
      		  {
      		   $whr = "$field=0";
      		  }
        }
        else
        {
       	  $whr = "$field like '%$srch%'";
        }
        
            
          
            
        }
        
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_job_model->rows($whr);
        
        else
            $total_rows = $this->manage_job_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_job/listing_search';
        
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
        
        $data['result'] = $this->manage_job_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/job/listing";
        $this->load->view("admin/template", $data);
    }
    
    ////////for ordering///////////
    
    function list_ordering($offset, $order, $srt)
    {
        $data['title'] = 'Manage Jobs';
        
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
            $total_rows = $this->manage_job_model->rows($whr);
        
        else
            $total_rows = $this->manage_job_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_job/listing';
        
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
        
        $data['result'] = $this->manage_job_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        
        $data['file'] = "admin/job/listing";
        $this->load->view("admin/template", $data);
    }
    
    
    
    
    
    //////////////////
    function job_detail($id)
    {
        $data['title']  = 'Job Detail';
        $data['result'] = $this->manage_job_model->get_job($id);
        
        $data['file'] = "admin/job/job_detail";
        //var_dump($data);
        $this->load->view('admin/pop/template', $data);
       
    }
    
    
    
    function add_job($id = '')
    {

        $this->load->model('admin/manage_job_model');
        if ($id == '') {
            $data['title']    = 'Add Job';
          
             $data['category'] = $this->manage_job_model->get_status($id);
        } else {
            $data['title']    = 'Edit Job';
            $data['category'] = $this->manage_job_model->get_category($id);
          
        }
   // pr($data['category']);
        
        if ($this->input->post()) {
            /* form validation */
                        
  //pr($data);die;
            $this->load->library('form_validation');
            $this->form_validation->set_rules('job_title', 'job title', 'required|trim|xss_clean');
            $this->form_validation->set_rules('job_detail', 'job detail', 'required|trim|xss_clean');
            $this->form_validation->set_rules('country', 'country', 'required|trim|xss_clean');
            $this->form_validation->set_rules('state', 'state', 'required|trim|xss_clean');
            $this->form_validation->set_rules('budget', 'Budget', 'required|trim|xss_clean');
            $this->form_validation->set_rules('comments', 'comments', 'required|trim|xss_clean');
            $this->form_validation->set_rules('cat_name', 'category', 'required|trim|xss_clean');
            $this->form_validation->set_rules('end_date', 'end date', 'required|trim|xss_clean');
           // $this->form_validation->set_rules('created_date', 'created_date', 'required|trim|xss_clean');
        
           // pr($data);die;
            if ($this->form_validation->run() == FALSE) {
                $this->input->post('end_date');
                $data['job_title']  = $this->input->post('job_title');
                $data['job_detail'] = $this->input->post('job_detail');
                $data['country']    = $this->input->post('country');
                $data['comments']   = $this->input->post('comments');
                $data['state']      = $this->input->post('state');
                $data['budget']     = $this->input->post('budget');
                $data['cat_name']   = $this->input->post('cat_name');
                $data['end_date']   = $this->input->post('end_date');
              // $data['created_date']   = $this->input->post('created_date');
                $data['file']       = "admin/job/add_job";
              	
            } else {
                /* validation ends */
                
                if ($id != '') {
                    
                    if ($this->manage_job_model->update_job($id)) {
                        $this->session->set_flashdata('status', '<div class="msg">' . 'Job Information has been Updated Successfully' . '</div>');
                    } else {
                        $this->session->set_flashdata('status', '<div class="error">' . 'Problem Updating' . '</div>');
                    }
                } else {
                    
                    if ($this->manage_job_model->add_job()) {
                        $this->session->set_flashdata('status', '<div class="msg">' . 'Job has been added Successfully' . '</div>');
                    } else {
                        $this->session->set_flashdata('status', '<div class="error">' . 'Problem Adding' . '</div>');
                    }
                }
                redirect(base_url() . "admin/manage_job/listing");
            }
            
        } else {
            if ($id != '') {
                
                $data['result'] = $this->manage_job_model->get_job($id);
              
                
            }
            
            $data['file'] = "admin/job/add_job";
            
        }
    //pr($data);
        $this->load->view('admin/template', $data);
    }
    
    
    function delete($id = '')
    {
        if ($id != '') {
             $_POST['IDs']    = array(
                $id
            );
            $_POST['action'] = 'delete';
        }
        //var_dump($_REQUEST);die;
        $this->manage_job_model->doAction('jobs');
    }
    
    
    
    /* not used */
    function view_completed_jobs()
    {
        $data['result'] = $this->manage_job_model->view_completed();
        //var_dump($data['result']);
 
        $data['file'] = "admin/job/add_job";
        $this->load->view('admin/template', $data);
    }
    
    function complete_listing($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'Completed Jobs';
        
        $data['order'] = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
        
        $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $this->uri->segment(8);
        
        $whr = "1";
        
        if ($srch != '') {
            
            $whr = "$field like '%$srch%'";
            
        }
        $whr = "t.job_status=2";
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_job_model->rows($whr);
        
        else
            $total_rows = $this->manage_job_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_job/listing';
        
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
        
        $data['result'] = $this->manage_job_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/job/complete_listing";
        //pr($data);
        $this->load->view("admin/template", $data);
    }
    
    
    function view_pending_jobs_for_approval()
    {
        $data['result'] = $this->manage_job_model->view_pending_approval();
        //var_dump($data['result']);
      
        $data['file'] = "admin/job/add_job";
        $this->load->view('admin/template', $data);
    }
    
    
    
     function pending_listing($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'Pending Jobs';
        
        $data['order'] = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
        
        $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $this->uri->segment(8);
        
        $whr = "1";
        
        if ($srch != '') {
            
            $whr = "$field like '%$srch%'";
            
        }
        $whr = "t.job_status=0";
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_job_model->rows($whr);
        
        else
            $total_rows = $this->manage_job_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_job/listing';
        
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
        
        $data['result'] = $this->manage_job_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/job/complete_listing";
        //pr($data);
        $this->load->view("admin/template", $data);
    }
    function view_approved_jobs()
    {
        $data['result'] = $this->manage_job_model->view_approved_jobs();
        //var_dump($data['result']);

        $data['file'] = "admin/job/add_job";
        $this->load->view('admin/template', $data);
    }
    
     function inprogress_listing($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'InProgress Jobs';
        
        $data['order'] = $order;
        
        $data['asc'] = $srt;
        
        $data['pasc'] = $srt == 'asc' ? 'desc' : 'asc';
        
        $data['srch'] = $srch = isset($_POST['srch']) ? ($this->input->post('srch') != '' ? $this->input->post('srch') : '') : $this->uri->segment(7);
        
        $data['field'] = $field = isset($_POST['field']) ? ($this->input->post('field') != '' ? $this->input->post('field') : '') : $this->uri->segment(8);
        
        $whr = "1";
        
        if ($srch != '') {
            
            $whr = "$field like '%$srch%'";
            
        }
        $whr = "t.job_status=1";
        $table = '';
        
        if (isset($whr) and $whr != '')
            $total_rows = $this->manage_job_model->rows($whr);
        
        else
            $total_rows = $this->manage_job_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_job/listing';
        
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
        
        $data['result'] = $this->manage_job_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/job/complete_listing";
        //pr($data);
        $this->load->view("admin/template", $data);
    }
    
}
?>