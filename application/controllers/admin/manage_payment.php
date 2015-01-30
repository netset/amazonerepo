<?php
/*
	purpose: controller to manage all opertion performed for Category managenment	
	author: Nitin Saluja
*/
class Manage_payment extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/manage_payment_model');
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}

	function view_completed_jobs($offset=0,$order='id',$srt='desc'){
		$data['title']='Completed Jobs';

        $data['order']    = $order;

  	    $data['asc']      = $srt;

  	    $data['pasc']     = $srt=='asc'?'desc':'asc';

  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);

  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);

  	    $whr="1";

  	    if($srch!='')

        {

             $whr= "$field like '%$srch%'";

        }
		$table = '';

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_payment_model->rows_completed($whr);

		else

			$total_rows       = $this->manage_payment_model->rows_completed($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_payment/view_completed_jobs';

        $config['total_rows']     = $total_rows;

        $config['per_page']       = '10';

		$config['uri_segment']       = '4';

        $config['full_tag_open']="<ul class='paginationControl'>";
		$config['full_tag_close']="</ul>";
		$config['next_link']="Next";
		$config['next_tag_open']="<li>";
		$config['next_tag_close']="</li>";
		$config['prev_link']="Prev";
		$config['prev_tag_open']="<li>";
		$config['prev_tag_close']="</li>";
		$config['cur_tag_open']="<li class='selected'><a href='javascript:void(0)'>";
		$config['cur_tag_close']="</a></li>";
		$config['num_tag_open']="<li>";
		$config['num_tag_close']="</li>";

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_payment_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);
		$data['file']="admin/payment/listing";
			
		$this->load->view("admin/template",$data);
	}
	
	function view_pending_jobs_for_approval($offset=0,$order='id',$srt='desc'){
	
		$data['title']='Jobs Pending For Approval';

        $data['order']    = $order;

  	    $data['asc']      = $srt;

  	    $data['pasc']     = $srt=='asc'?'desc':'asc';

  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);

  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);

  	    $whr="1";

  	    if($srch!='')

        {

             $whr= "$field like '%$srch%'";

        }
		$table = '';

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_payment_model->rows_pending_approval($whr);

		else

			$total_rows       = $this->manage_payment_model->rows_pending_approval($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_payment/view_pending_jobs_for_approval';

        $config['total_rows']     = $total_rows;

        $config['per_page']       = '10';

		$config['uri_segment']       = '4';

        $config['full_tag_open']="<ul class='paginationControl'>";
		$config['full_tag_close']="</ul>";
		$config['next_link']="Next";
		$config['next_tag_open']="<li>";
		$config['next_tag_close']="</li>";
		$config['prev_link']="Prev";
		$config['prev_tag_open']="<li>";
		$config['prev_tag_close']="</li>";
		$config['cur_tag_open']="<li class='selected'><a href='javascript:void(0)'>";
		$config['cur_tag_close']="</a></li>";
		$config['num_tag_open']="<li>";
		$config['num_tag_close']="</li>";

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_payment_model->view_pending_approval($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);
		$data['file']="admin/payment/listing_pending_approval";	
		//pr($data['result']);
		$this->load->view("admin/template",$data);
	}
	
	function view_approved_jobs($offset=0,$order='id',$srt='desc'){
		$data['title']='Approved Jobs';

        $data['order']    = $order;

  	    $data['asc']      = $srt;

  	    $data['pasc']     = $srt=='asc'?'desc':'asc';

  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);

  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);

  	    $whr="1";

  	    if($srch!='')

        {

             $whr= "$field like '%$srch%'";

        }
		$table = '';

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_payment_model->rows_approved_jobs($whr);

		else

			$total_rows       = $this->manage_payment_model->rows_approved_jobs($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_payment/view_approved_jobs';

        $config['total_rows']     = $total_rows;

        $config['per_page']       = '10';

		$config['uri_segment']       = '4';

        $config['full_tag_open']="<ul class='paginationControl'>";
		$config['full_tag_close']="</ul>";
		$config['next_link']="Next";
		$config['next_tag_open']="<li>";
		$config['next_tag_close']="</li>";
		$config['prev_link']="Prev";
		$config['prev_tag_open']="<li>";
		$config['prev_tag_close']="</li>";
		$config['cur_tag_open']="<li class='selected'><a href='javascript:void(0)'>";
		$config['cur_tag_close']="</a></li>";
		$config['num_tag_open']="<li>";
		$config['num_tag_close']="</li>";

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_payment_model->view_approved_jobs($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);
		$data['file']="admin/payment/listing_approved";	
		$this->load->view("admin/template",$data);
	}
	
	function dicision($id){
		$data['id']=$id;
		$data['file']="admin/payment/dicision";
		$this->load->view('admin/pop/template',$data);

	}
		function dicision_change($id){
		$data['id']=$id;
		$data['file']="admin/payment/dicision_change";
		$this->load->view('admin/pop/template',$data);

	}
	
	function approve($id){
	    if($this->manage_payment_model->approve($id))
		{
			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['mailtype'] = 'text';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);
			$this->email->from('test@temptestserver.org');
			$this->email->to('test@gmail.com');					
			$this->email->subject('Payment Approval');
			$res="Hi, payment Approval";
			$this->email->message($res);
			if (!$this->email->send())
			{
				echo $this->email->print_debugger();
			} else{
				$this->session->set_flashdata('status', "<div class='msg'>Payment approval mail has been sent to HR successfully.</div>");
			}
			redirect(base_url()."admin/manage_payment/view_approved_jobs");
		}
	}
	function unapprove($id){
	    if($this->manage_payment_model->reject($id))
		{
			$this->load->library('email');
			$config['protocol'] = 'sendmail';
			$config['mailtype'] = 'text';
			$config['mailpath'] = '/usr/sbin/sendmail';
			$config['charset'] = 'iso-8859-1';
			$config['wordwrap'] = TRUE;

			$this->email->initialize($config);
			$this->email->from('test@temptestserver.org');
			$this->email->to('test@gmail.com');					
			$this->email->subject('Payment Rejection');
			$res="Hi, payment rejected";
			$this->email->message($res);
			if (!$this->email->send())
			{
				echo $this->email->print_debugger();
			} else{
				$this->session->set_flashdata('status', "<div class='error'>Payment rejection mail has been sent to HR successfully.</div>");
			}
			redirect(base_url()."admin/manage_payment/view_approved_jobs");
		}

	}
	
	function add_job($id=''){
	$this->load->model('admin/manage_employee_model');
	$this->load->model('admin/manage_job_model');
        if($id==''){
		    $data['title']='Add Job';
        }else{
            $data['title']='Edit Job';
        }
		$data['employee']=$this->manage_job_model->get_all_employees();	
		$data['assistants']=$this->manage_job_model->get_all_assistants();	
		$data['customers']=$this->manage_job_model->get_all_customers();
		$data['departments']=$this->manage_employee_model->get_all_departments();	
		if($this->input->post()){
			/* form validation */
			$this->load->library('form_validation');
			$this->form_validation->set_rules('job_time','Job Hours','numeric_col|trim|xss_clean|min_length[2]|max_length[5]');
			//$this->form_validation->set_rules('job_title','Job Title','required|trim|xss_clean|min_length[5]|max_length[50]');		
			$this->form_validation->set_rules('job_assign','Assign Job To','required|trim|xss_clean');
			$this->form_validation->set_rules('job_date','Job Date','required|trim|xss_clean');
			$this->form_validation->set_rules('job_type','Job Type','required|trim|xss_clean');
			$this->form_validation->set_rules('job_customer','Job Customer','required|trim|xss_clean|numeric|min_length[1]|max_length[25]');
			if($this->input->post('job_assist1')!='' || $this->input->post('job_time1')!='')
			{
				$this->form_validation->set_rules('job_assist1','Job Assistant','required|trim|xss_clean');
				$this->form_validation->set_rules('job_time1','Assistant Job Hours','required|trim|xss_clean|numeric_col|min_length[2]|max_length[5]');
			}
		
			if($this->form_validation->run() == FALSE){
				$data['job_customer']=$this->input->post('job_customer');
				$data['job_time']=$this->input->post('job_time');
				//$data['job_title']=$this->input->post('job_title');
				$data['job_date']=$this->input->post('job_date');
				$data['job_type']=$this->input->post('job_type');
				$data['job_assign']=$this->input->post('job_assign');
				$data['job_opt']=$this->input->post('job_opt');
				$data['assistant_id']=$this->input->post('job_assist1');
				$data['hours']=$this->input->post('job_time1');
				$data['job_num']=$this->input->post('job_num');
				$data['file']="admin/job/add_job";	
			}else{   /* validation ends */														
					if($id!='')
					{
								if($this->manage_job_model->update_job($id)){
									$this->session->set_flashdata('status', '<div class="msg">'.'Job Information has been Updated Successfully'.'</div>');
								}else{
									$this->session->set_flashdata('status', '<div class="error">'.'Problem Updating'.'</div>');
								}
					}else{	
						
									if($this->manage_job_model->add_job()){					
										$this->session->set_flashdata('status', '<div class="msg">'.'Job has been Assign Successfully'.'</div>');
									}else{				
										$this->session->set_flashdata('status', '<div class="error">'.'Problem Adding'.'</div>');
									}
					} 
					redirect(base_url()."admin/manage_payment/view_pending_jobs_for_approval");
		}
			
		}else{	
			if($id!=''){
				$data['result']=$this->manage_job_model->get_job($id);	
				$data['assistant']=$this->manage_job_model->get_job_assist($id);					
				$data['customer']=$this->manage_job_model->get_job_customer($id);					
			}
			$data['file']="admin/job/add_job";
			
		}
		$this->load->view('admin/template',$data);
	}
	
	
	function delete($id='')
	{
		if($id!=''){
			$_POST['IDs']=array($id);
			$_POST['action']='delete';
		}	
		//var_dump($_REQUEST);die;
		$this->manage_payment_model->doAction('at_jobs');
	}
	
	
}
?>