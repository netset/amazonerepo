<?php
/*
	purpose: controller to manage all opertion performed for Category managenment	
	author: Nitin Saluja
*/
class Manage_user  extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/manage_user_model');
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}
	function listing($offset=0,$order='id',$srt='desc'){
	
		$data['title']='Manage User';

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

			$total_rows       = $this->manage_user_model->rows($whr);

		else

			$total_rows       = $this->manage_user_model->rows($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_user/listing';

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
		
	    $data['result'] = $this->manage_user_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);
		$data['file']="admin/user/listing";	
		//var_dump($data['result'] );
		$this->load->view("admin/template",$data);
	}
	
	
	function listing_search($offset=0,$order='id',$srt='desc'){
	
        $data['title']='Manage User';

        $data['order']    = $order;

       $data['asc']      = $srt;

       $data['pasc']     = $srt=='asc'?'desc':'asc';
       
       if(isset($_POST['srch']) && isset($_POST['field']) )
       {
        
       
       $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);
       $this->session->set_userdata('searchvalue', $srch);
       $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(music);
       $this->session->set_userdata('searchfield', $field);
             
       }
       else
       {  
                $data['srch']     = $srch  = $this->session->userdata('searchvalue');

                 $data['field']    = $field = $this->session->userdata('searchfield');
               
       }

       if($srch!='')

        {
        	if($field=='role')
     		{
       			if($srch == 'C')
       			{
       			$whr= "$field=1";
       			}
       			else
       			{
       			$whr= "$field=2";
       			}
        	}
		else
		{
			$whr= "$field like '%$srch%'";
		}

        }

  $table = '';

  if(isset($whr) and $whr!='')

   $total_rows       = $this->manage_user_model->rows($whr);

  else

   $total_rows       = $this->manage_user_model->rows($whr=1);

       $data['tc']       = $total_rows;

        $this->load->library('pagination');


        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_user/listing_search';

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
  
     $data['result'] = $this->manage_user_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

  $data['file']="admin/user/listing";
  $this->load->view("admin/template",$data);
 }
	
	////////for ordering///////////
	
    function list_ordering($offset,$order,$srt){
		$data['title']='Manage Users';

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

			$total_rows       = $this->manage_user_model->rows($whr);

		else

			$total_rows       = $this->manage_user_model->rows($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_user/listing';

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
		
	    $data['result'] = $this->manage_user_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/user/listing";	
		$this->load->view("admin/template",$data);
	}
	

		
	
	
	//////////////////
 function user_detail($id)
    {
 
        $data['title']  = 'User Detail';
        $data['result'] = $this->manage_user_model->get_user($id);
        
        $data['file'] = "admin/user/user_detail";
       echo $this->load->view('admin/pop/template', $data);
    
    }
    
	

	
	function add_user($id=''){
	$this->load->model('admin/manage_user_model');
        if($id==''){
		    $data['title']='Add user';
		     
        }else{
            $data['title']='Edit user';
            
        }		
        	$this->load->model('admin/manage_category_model');	
        	$data['category']=$this->manage_category_model->get_all_departments();
		if($this->input->post()){
			/* form validation */
			//pr($this->input->post());
			$this->load->library('form_validation');
			$this->form_validation->set_rules('first_name','First name','required|trim|xss_clean');
			$this->form_validation->set_rules('last_name','Last name','required|trim|xss_clean');
			$this->form_validation->set_rules('email_id','Email id','required|trim|xss_clean');
			$this->form_validation->set_rules('address','Address','required|trim|xss_clean');

			$this->form_validation->set_rules('role','Role','required|trim|xss_clean');
			$this->form_validation->set_rules('password','Password','required|trim|xss_clean');
			$this->form_validation->set_rules('mobile','Mobile','required|trim|xss_clean');
			$this->form_validation->set_rules('about','About','required|trim|xss_clean');
			if( $this->input->post('role') == 1){
		  			$this->form_validation->set_rules('occupation','Occupation','required|trim|xss_clean');
		  			$this->form_validation->set_rules('last_name','Last name','required|trim|xss_clean');
		        }	
			elseif( $this->input->post('role') == 2){
		      $this->form_validation->set_rules('cat_name','Category','required|trim|xss_clean');
		       $this->form_validation->set_rules('work_history','Work history','required|trim|xss_clean');
		       $this->form_validation->set_rules('training','Training','required|trim|xss_clean');
		        $this->form_validation->set_rules('experience','Experience','required|trim|xss_clean');
		        }
			if($this->form_validation->run() == FALSE){
				$data['first_name']=$this->input->post('first_name');
				$data['last_name']=$this->input->post('last_name');
				$data['email_id']=$this->input->post('email_id');
				$data['address']=$this->input->post('address');
				$data['mobile']=$this->input->post('mobile');
				$data['occupation']=$this->input->post('occupation');
			        $data['role']=$this->input->post('role');
			        $data['password']=$this->input->post('password');
			   if( $this->input->post('role') == 2){
			        $data['cat_name']=$this->input->post('cat_name');
			        $data['about']=$this->input->post('about');
			        $data['work_history']=$this->input->post('work_history');
			        $data['training']=$this->input->post('training'); 
			        $data['experience']=$this->input->post('experience');
			   }   
				$data['file']="admin/user/add_user";	
			}else{   /* validation ends */				

					if($id!='')
					
					{
					
								if($this->manage_user_model->update_user($id)){
									$this->session->set_flashdata('status', '<div class="msg">'.'User has been Updated Successfully'.'</div>');
								}else{
									$this->session->set_flashdata('status', '<div class="error">'.'Problem Updating'.'</div>');
								}
					}else{	
						
									if($this->manage_user_model->add_user()){					
										$this->session->set_flashdata('status', '<div class="msg">'.'User has been added Successfully'.'</div>');
									}else{				
										$this->session->set_flashdata('status', '<div class="error">'.'Problem Adding'.'</div>');
									}
					} 
					redirect(base_url()."admin/manage_user/listing");
		}
			
		}else{	
		if($id!=''){
			
		$data['result']=$this->manage_user_model->get_user($id);
				
                              
			}
			
			$data['file']="admin/user/add_user";
			
		}
		//pr($data); 
		$this->load->view('admin/template',$data);
	}
	
	
	function delete($id='')
	{
		if($id!=''){
			$_POST['IDs']=array($id);
			$_POST['action']='delete';
		}	
		//var_dump($_REQUEST);die;
		$this->manage_user_model->doAction('users');
	}
	
	
	
	/* not used */
	function view_completed_jobs()
	{
		$data['result']=$this->manage_user_model->view_completed();
		var_dump($data['result']);die;
		$data['file']="admin/job/add_job";
		$this->load->view('admin/template',$data);
	}
	
	function view_pending_jobs_for_approval()
	{
		$data['result']=$this->manage_user_model->view_pending_approval();
		var_dump($data['result']);die;
		$data['file']="admin/job/add_job";
		$this->load->view('admin/template',$data);
	}	
	function view_approved_jobs()
	{
		$data['result']=$this->manage_user_model->view_approved_jobs();
		var_dump($data['result']);die;
		$data['file']="admin/job/add_job";
		$this->load->view('admin/template',$data);
	}
	
	
	
}
?>