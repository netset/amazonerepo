<?php
/*
purpose: controller to manage all opertion performed for Category managenment	
author: Nitin Saluja
*/
class Manage_bid extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/manage_bid_model');
        if ($this->session->userdata('admin_id') == '') {
            redirect(base_url() . 'admin/login');
        }
    }
    function listing($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'Manage Bids';
        
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
            $total_rows = $this->manage_bid_model->rows($whr);
        
        else
            $total_rows = $this->manage_bid_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_bid/listing';
        
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
        
        $data['result'] = $this->manage_bid_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/bid/listing";
      //  pr($data['result']);
        $this->load->view("admin/template", $data);
    }
    
    
    function listing_search($offset = 0, $order = 'id', $srt = 'desc')
    {
        
        $data['title'] = 'Manage bids';
        
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
         
        if($field=='t.bid_status')
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
            $total_rows = $this->manage_bid_model->rows($whr);
        
        else
            $total_rows = $this->manage_bid_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_bid/listing_search';
        
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
        
        $data['result'] = $this->manage_bid_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        $data['file']   = "admin/bid/listing";
        $this->load->view("admin/template", $data);
    }
    
    ////////for ordering///////////
    
    function list_ordering($offset, $order, $srt)
    {
        $data['title'] = 'Manage bids';
        
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
            $total_rows = $this->manage_bid_model->rows($whr);
        
        else
            $total_rows = $this->manage_bid_model->rows($whr = 1);
        
        $data['tc'] = $total_rows;
        
        $this->load->library('pagination');
        
        
        
        $data['offset'] = $offset;
        
        $config['base_url'] = base_url() . 'admin/manage_bid/listing';
        
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
        
        $data['result'] = $this->manage_bid_model->get_where($table, $whr, false, "$order $srt", true, $config['per_page'], $offset);
        
        $data['file'] = "admin/bid/listing";
        $this->load->view("admin/template", $data);
    }
    
    
    
    
    
    //////////////////
    function bid_detail($id)
    {
        $data['title']  = 'Bid Detail';
        $data['result'] = $this->manage_bid_model->get_bid($id);
        $data['file'] = "admin/bid/bid_detail";
       // pr($data);
        $this->load->view('admin/pop/template', $data);
       
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
        $this->manage_bid_model->doAction('job_applications');
    }
    
    
    
  
    
    
    
}
?>
