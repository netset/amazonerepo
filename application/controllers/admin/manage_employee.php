<?php
/*
	purpose: controller to manage all opertion performed for user managenment	
	author: Nitin Saluja
*/
class Manage_employee extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/manage_employee_model');
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}
	function listing($offset=0,$order='id',$srt='desc'){
		$data['title']='Manage Employees';

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

			$total_rows       = $this->manage_employee_model->rows($whr);

		else

			$total_rows       = $this->manage_employee_model->rows($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_employee/listing';

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
				$config['first_link'] = "First";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_link'] = "Last";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_employee_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/employee/listing";	
		$this->load->view("admin/template",$data);
	}
	
	function listing_search($offset=0,$order='id',$srt='desc'){
		//echo $_POST['srch']; echo $_POST['field']; die;
		$data['title']='Manage Employees';

        $data['order']    = $order;

  	    $data['asc']      = $srt;

  	    $data['pasc']     = $srt=='asc'?'desc':'asc';

  	    if(isset($_POST['srch']) && isset($_POST['field']) )
  	    {
  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);
  	    $this->session->set_userdata('searchvalue', $srch);
  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);
  	    $this->session->set_userdata('searchfield', $field);
  	   
  	    
  	    }
  	    else
  	    {  
	             $data['srch']     = $srch  = $this->session->userdata('searchvalue');

  	             $data['field']    = $field = $this->session->userdata('searchfield');
  	            
  	    }

  	    $whr="1";

  	    if($srch!='')

        {

              $whr= "$field like '%$srch%'";

        }

		$table = '';

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_employee_model->rows($whr);

		else

			$total_rows       = $this->manage_employee_model->rows($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_employee/listing_search';

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
				$config['first_link'] = "First";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_link'] = "Last";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_employee_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/employee/listing";	
		$this->load->view("admin/template",$data);
	}
	////////for ordering///////////
	
		function list_ordering($offset,$order,$srt){
		//echo $_POST['srch']; echo $_POST['field']; die;
		$data['title']='Manage Employees';

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

			$total_rows       = $this->manage_employee_model->rows($whr);

		else

			$total_rows       = $this->manage_employee_model->rows($whr=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_employee/listing';

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
				$config['first_link'] = "First";
		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";
		$config['last_link'] = "Last";
		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_employee_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/employee/listing";	
// print_r($data);die;
		$this->load->view("admin/template",$data);
	}
	
	//////////////////
 function get_state()
 {
  $country_id = $this->input->post('country_id');
  $query="SELECT * FROM at_states where country_id =$country_id";
  $q1=$this->db->query($query);
  $res = $q1->result();
  $html="";
  $html.='<option value="">Select State</option>';
  foreach($res as $val)
  {
   $html.='<option value="'.$val->id.'">'.$val->st_name.'</option>';
  }
  echo $html;
 }
 function get_city()
 {
  $state_id = $this->input->post('state_id');
  $query="SELECT * FROM at_cities where state_id = ".$state_id;
  $q1=$this->db->query($query);
  $res = $q1->result();
  $html="";
  $html.='<option value="">Select City</option>';
  foreach($res as $val)
  {
   $html.='<option value="'.$val->id.'">'.$val->city_name.'</option>';
  }
  echo $html;
 }
	
	function add_employee($id=''){
        if($id==''){
		    $data['title']='Add Employee';
        }else{
            $data['title']='Edit Employee';
        }
		
		$data['departments']=$this->manage_employee_model->get_all_departments();
		$data['assistants']=$this->manage_employee_model->get_all_assistants();
		if($this->input->post()){				
			/* form validation */
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_name','Username','required|trim|xss_clean|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('user_depart','Default Department','required|trim|xss_clean');
			$this->form_validation->set_rules('user_assist','Default Assistant','required|trim|xss_clean');
			$this->form_validation->set_rules('user_pass','Password','required|trim|xss_clean|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_first_name','First Name','required|trim|xss_clean|alpha_dash|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('user_last_name','Last Name','required|trim|xss_clean|alpha_dash|min_length[3]|max_length[25]');
			$this->form_validation->set_rules('user_email','Email','required|trim|valid_email');
			
			if($this->form_validation->run() == FALSE){
				$data['user_id']=$id;
				$data['user_depart']=$this->input->post('user_depart');
				$data['user_assist']=$this->input->post('user_assist');
				$data['user_name']=$this->input->post('user_name');
				$data['user_pass']=$this->input->post('user_pass');
				$data['user_first_name']=$this->input->post('user_first_name');
				$data['user_last_name']=$this->input->post('user_last_name');
				$data['user_email']=$this->input->post('user_email');	
				$data['file']="admin/employee/add_employee";
			}else{   /* validation ends */
			
				if($id!=''){
						if($this->manage_employee_model->update_employee($id)){
							$this->session->set_flashdata('status', '<div class="msg">'.'User Information has been Updated Successfully'.'</div>');
						}else{
							$this->session->set_flashdata('status', '<div class="error">'.'You did not make any change'.'</div>');
						}
					}else{	

						if($this->manage_employee_model->add_employee($data)){	
							$this->load->library('email');
							$config['protocol'] = 'sendmail';
							$config['mailtype'] = 'text';
							$config['mailpath'] = '/usr/sbin/sendmail';
							$config['charset'] = 'iso-8859-1';
							$config['wordwrap'] = TRUE;
							$this->email->initialize($config);
							$this->email->from('test@temptestserver.org');
							$this->email->to($this->input->post('txtEmail'));					
							$this->email->subject('Login Credentials');
							$res="Hi ".$this->input->post('user_first_name'). ", \n \t ".'<p>Your Username: '.$this->input->post('user_name'). 'And password is '.$this->input->post('user_pass').' </p><p>Thanks</p><p>Savaria Team</p>';
							$this->email->message($res);
							if (!$this->email->send())
							{
								$this->session->set_flashdata('status', '<div class="msg">'.'Employee Information has been Added Successfully.Unfortunately, Login Credentials not sent'.'</div>');
								$this->email->print_debugger();
							} else{
									$this->session->set_flashdata('status', '<div class="msg">'.'Employee Information has been Added & Login Credentials sent Successfully'.'</div>');
							}						
							
						}else{				
							$this->session->set_flashdata('status', '<div class="error">'.'Problem Adding'.'</div>');
						}
					} 
					
				redirect(base_url()."admin/manage_employee/listing");
			}
			
		}else{	
			if($id!=''){			
				$data['result']=$this->manage_employee_model->get_employee($id);				
			}
			
			$data['file']="admin/employee/add_employee";
			
		}
		//var_dump($data['result']);
		$this->load->view('admin/template',$data);
	}
	
	function edit_employee($id=''){
	
        if($id==''){
		    $data['title']='Add Employee';
        }else{
            $data['title']='Edit Employee';
        }
		$data['countries']=$this->manage_employee_model->get_all_countries();				
		$data['departments']=$this->manage_employee_model->get_all_departments();
		if($this->input->post()){				
			/* form validation */
			$this->load->library('form_validation');
			$this->form_validation->set_rules('user_name','Username','required|trim|xss_clean|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_depart','Department','required|trim|xss_clean');
			$this->form_validation->set_rules('user_pass','Password','required|trim|xss_clean|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_first_name','First Name','required|trim|xss_clean|alpha_dash|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_last_name','Last Name','required|trim|xss_clean|alpha_dash|min_length[5]|max_length[25]');
			$this->form_validation->set_rules('user_gender','Gender','required|trim|xss_clean');
			$this->form_validation->set_rules('user_email','Email','required|trim|valid_email');
			$this->form_validation->set_rules('user_address','Address','required|trim|min_length[5]|max_length[50]');
			$this->form_validation->set_rules('user_city','City','required|trim');	
			$this->form_validation->set_rules('user_state','State','required|trim');
			$this->form_validation->set_rules('user_country','Country','required|trim');
			$this->form_validation->set_rules('user_phone','Phone','required|trim|numeric|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('user_phone1','Alternative Phone','required|trim|numeric|min_length[5]|max_length[12]');
			
			if($this->form_validation->run() == FALSE){
				$data['user_depart']=$this->input->post('user_depart');
				$data['user_name']=$this->input->post('user_name');
				$data['user_pass']=$this->input->post('user_pass');
				$data['user_first_name']=$this->input->post('user_first_name');
				$data['user_last_name']=$this->input->post('user_last_name');
				$data['user_gender']=$this->input->post('user_gender');
				$data['user_email']=$this->input->post('user_email');
				$data['user_address']=$this->input->post('user_address');
				$data['user_city']=$this->input->post('user_city');
				$data['user_state']=$this->input->post('user_state');
				$data['user_country']=$this->input->post('user_country');
				$data['user_phone']=$this->input->post('user_phone');
				$data['user_phone1']=$this->input->post('user_phone1');
				$data['user_status']=$this->input->post('user_status');
				$data['file']="admin/employee/edit_employee";
			}else{   /* validation ends */
			
				if($id!=''){
						if($this->manage_employee_model->update_user($id)){
							$this->session->set_flashdata('status', '<div class="msg">'.'User Information has been Updated Successfully'.'</div>');
						}else{
							$this->session->set_flashdata('status', '<div class="error">'.'Problem Updating'.'</div>');
						}
					}else{	

						if($this->manage_employee_model->add_user($data)){					
							$this->session->set_flashdata('status', '<div class="msg">'.'User Information has been Added Successfully'.'</div>');
						}else{				
							$this->session->set_flashdata('status', '<div class="error">'.'Problem Adding'.'</div>');
						}
					} 
				
				redirect(base_url()."admin/manage_employee/listing");
			}
			
		}else{	
			if($id!=''){			
				$data['result']=$this->manage_employee_model->get_employee($id);				
			}
			$data['file']="admin/employee/add_employee";
			
		}
		$this->load->view('admin/template',$data);
	}
	
	
	function detailed_hours($id,$offset=0,$order='id',$srt='desc')
		{
				$this->load->model('admin/manage_report_model');
				$emp_name= $this->manage_report_model->employee_name($id,1); 
			$data['emp_id']= $emp_name[0]->id;
			$data['title']= $emp_name[0]->fname ." ". $emp_name[0]->lname;
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
        $data['order']    = $order;

  	    $data['asc']      = $srt;

  	    $data['pasc']     = $srt=='asc'?'desc':'asc';

  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);

  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);
  	    $whr="1";
  	    $whr1="1";

  	    if($srch!='')

        {

             $whr= "$field like '%$srch%'";
			 if($field=='emp.fname')
			 {
              $whr1= "ass.assist_fname like '%$srch%'";
			 }

        }
		$table = '';

 	    $data['offset']       = 0;

      	$data['result'] = $this->manage_employee_model->get_employee_detail_where($whr,$offset,$id,$data['datepicker'],$data['datepicker1']);
	//	echo "<pre>";print_r($data);
		$data['file']="admin/employee/detailed_hours";	
		$this->load->view("admin/template",$data);
	}
	public function download_detailed_hours(){
		$this->load->model('admin/manage_report_model');
		$id=$this->uri->segment(4);
		$srch_date=$this->uri->segment(5);
		$emp_name= $this->manage_report_model->employee_name($id,1); 
		$full_name= $emp_name[0]->fname ." ". $emp_name[0]->lname;
      	$res = $this->manage_employee_model->download_get_employee_detail_where($id,$srch_date);
		if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
			$date_range= $srch_date[0]." TO " .$srch_date[1];
		}
		else
		{
			$date_range= "Full";
		}
		$this->load->helper(array('My_Pdf')); 
	 $data = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>

<link href="'. base_url().'public/css/admin/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="global_content_wrapper">
<div id="global_content"> 
<center><h1>'.$full_name.'</h1></center>
	<h2> '.$date_range.' Report</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;text-align: left;">Job No. </th>
		<th width="10%" style="width: 1%;text-align: left;">Job Hours
        </th>
		        </th>
				<th width="10%" style="width: 1%;text-align: left;">Job Date
        </th>
        
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= "#".$value->job_num;		
			
		$data .= '	</td>
             <td class="admin_table_centered nowrap">';
	$data .= $value->job_hours.":".$value->job_mins;		
			
		$data .= '	     </td>             <td class="admin_table_centered nowrap">';
	$data .= $value->created_date;		
			
		$data .= ' </td>
     
		 </tr>';
			
	}
	   $data .= '                  
 
                  </tbody>
  </table>
  </div>
</div>
</body>
</html>'; // Pass the url of html report
	 create_pdf($data); //Create pdf
	 }
	function delete($id='')
	{
		if($id!=''){
			$_POST['IDs']=array($id);
			$_POST['action']='delete';
		}	
		$this->manage_employee_model->doAction('at_employee');
	}
}
?>