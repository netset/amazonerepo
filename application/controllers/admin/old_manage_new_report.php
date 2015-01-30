<?php
/*
	purpose: controller to manage all opertion performed for user managenment	
	author: Nitin Saluja
*/
class Manage_new_report extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/manage_new_report_model');
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}
	function listing($offset=0,$order='emp_id',$srt='desc'){
		$data['title']='Report';
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

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_new_report_model->rows($whr,$whr1);

		else

			$total_rows       = $this->manage_new_report_model->rows($whr=1,$whr1=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_report/listing';

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

       // $this->pagination->initialize($config);
	    $data['result'] = $this->manage_new_report_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset,$whr1);

		$data['file']="admin/new_report/listing";	
		//var_dump($data['result']);
		$this->load->view("admin/template",$data);
	}
	
	
	function listing_search($offset=0,$order='emp_id',$srt='desc'){
		$data['title']='Report';
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
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
  	    $whr1="1";

  	    if($srch!='')

        {

             $whr= "$field like '%$srch%'";
			 if($field=='emp.fname')
			 {
              $whr1= "ass.assist_fname like '%$srch%'";
			 }
			  if($field=='emp.role_name')
			 {
              $whr1= "ass.role_name like '%$srch%'";
			 }

        }
		$table = '';

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_new_report_model->rows($whr,$whr1);

		else

			$total_rows       = $this->manage_new_report_model->rows($whr=1,$whr1=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_report/listing_search';

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
		
	    $data['result'] = $this->manage_new_report_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset,$whr1);

		$data['file']="admin/new_report/listing";	
		//var_dump($data['result']);
		$this->load->view("admin/template",$data);
	}
	
	////////for ordering///////////
	
		function list_ordering($offset,$order,$srt)
		{
		//echo $_POST['srch']; echo $_POST['field']; die;
		$data['title']='Manage Report';

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

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_new_report_model->rows($whr,$whr1);

		else

			$total_rows       = $this->manage_new_report_model->rows($whr=1,$whr1=1);
  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_report/listing';

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
	    $data['result'] = $this->manage_new_report_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/new_report/listing";	
		$this->load->view("admin/template",$data);
	}
	
	
		function employee_detail($id,$offset=0,$order='id',$srt='desc')
		{
				$srch_date=$this->uri->segment(6);
				$role=$this->uri->segment(5);
			  $data['srch_date']    = $srch_date;
		if(strpos($srch_date,"."))
		{
			$date_range=explode("-",$srch_date);
			$data['date_range']= $date_range[0]." TO " .$date_range[1];
		}
		else
		{
			$data['date_range']= "Full";
		}
        $data['role']    = $role;
		$data['title']='Report';
		$data['emp_id']=$id;

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

		
	    $data['result'] = $this->manage_new_report_model->get_employee_detail_where($whr,$offset,$id,$srch_date,$role);
		$emp_name= $this->manage_new_report_model->employee_name($id,$role); 
		$data['full_name']= $emp_name[0]->fname ." ". $emp_name[0]->lname;
		$data['file']="admin/new_report/employee_detail";	
		//echo "<pre>";print_r($data);die;
		$this->load->view("admin/pop/template",$data);
	}
	
	public function pdf_report(){
		$id=$this->uri->segment(4);
		$role=$this->uri->segment(5);
		$srch_date=$this->uri->segment(6);
		$emp_name= $this->manage_new_report_model->employee_name($id,$role); 
		$full_name= $emp_name[0]->fname ." ". $emp_name[0]->lname;
		if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
			$date_range= $srch_date[1]." TO " .$srch_date[2];
		}
		else
		{
			$date_range= "Full";
		}
		 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_new_report_model->get_pdf_emp_result($id,$role,$srch_date); 
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
				<th width="10%" style="width: 1%;text-align: left;">Approved Date
        </th>
        
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= $value->job_num;		
			
		$data .= '	</td>
             <td class="admin_table_centered nowrap">';
	$data .= $value->job_hours;		
			
		$data .= '	     </td>             <td class="admin_table_centered nowrap">';
	$data .= $value->approve_date;		
			
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
	 
	 
	 public function automatic_pdf_report(){
		 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_new_report_model->automatic_pdf_report(); 
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
	<h2> Report</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">Employee Name</th>
		<th width="10%" style="width: 1%;">Total Hours
        </th>
				<th width="10%" style="width: 1%;">No. Of Jobs
        </th>
        
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= $value->fname;		
			
		$data .= '	</td>
             <td class="admin_table_centered nowrap">';
	$data .= $value->total;		
			
		$data .= '	     </td>
			             <td class="admin_table_centered nowrap">';
	$data .= $value->total_job;		
			
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
		create_store_pdf($data); //Create pdf
		 $file_name = 'report' . date('dMY');
		$this->load->library('email');
		$config['protocol'] = 'sendmail';
		$config['mailtype'] = 'text';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$this->email->initialize($config);
        $this->email->set_newline("\r\n"); 
	    $this->email->from('learneverydaytutorials@gmail.com', 'Arifur Rahman');
	    $this->email->to('nitinsaluja98@gmail.com');    
	    $this->email->subject('This is an email test');      
	    $this->email->message('It is working. Great!');
	    	         
	   echo  $file =  './././public/uploads/'.$file_name.'.pdf';  die;   
	     	        $this->email->attach($file);

	        if($this->email->send())
	        {
	            echo 'Your email was sent, successfully.';
	        }
	         
	        else
	        {
	            show_error($this->email->print_debugger());
	        }  
	 }
	 
	  public function download_pdf_report(){
	 $srch_date=$this->uri->segment(4);
		if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
			$date_range= $srch_date[1]." TO " .$srch_date[2];
		}
		else
		{
			$date_range= "Full";
		}
		 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_new_report_model->get_download_pdf_emp_result($srch_date); 
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
	<h2>'.$date_range. ' Report</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">First Name</th>
		<th width="10%" style="width: 1%;">Last Name</th>
        <th width="10%" style="width: 1%;">Designation</th>
		<th width="10%" style="width: 1%;">Total Hours
        </th>
				<th width="10%" style="width: 1%;">No. Of Jobs
        </th>
        
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= $value->fname;		
	$data .= '</td> <td class="admin_table_user">';
	$data .= $value->lname;		
			
		
		$data .= '	</td>
		            <td class="admin_table_user">';
	if($value->role==1)	
{
	$data .= "Employee";	
}	else
{
	$data .= "Assistant";
}
	//$data .= $value->role;		
			
		$data .= '	</td>
             <td class="admin_table_centered nowrap">';
             if($value->total_min>=60)
				{
					$add_hours=floor($value->total_min/60);
					$add_mins=$value->total_min%60;
				
					$value->total=$value->total+$add_hours;
					//$value->total_min=$value->total_min-60;
					$value->total_min=$add_mins;
				}
             
	$data .= $value->total.":".$value->total_min;		
			
		$data .= '	     </td>
			             <td class="admin_table_centered nowrap">';
	$data .= $value->total_job;		
			
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
	 
	 /////////////////////////Report 3 and 4////////////////////////
	 
	function report3($offset=0,$order='emp_id',$srt='desc'){
		$data['title']='Report';
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

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_new_report_model->rows($whr,$whr1);

		else

			$total_rows       = $this->manage_new_report_model->rows($whr=1,$whr1=1);

  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');

        

        $data['offset']           = $offset;

        $config['base_url']       = base_url().'admin/manage_report/listing';

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

       // $this->pagination->initialize($config);
	   $whr=1;
	   $whr1=1;
	    $data['result'] = $this->manage_new_report_model->get_report3($whr,$whr1);

		$data['file']="admin/new_report/report3";	
	//	var_dump($data['result']);
		$this->load->view("admin/template",$data);
	}
	
	function search_report3($offset=0,$order='emp_id',$srt='desc')
	{
		$data['title']='Report';
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
		$whr=1;
		$whr1=1;
		if(!empty($data['datepicker']))
		{
			$start_date=explode("/",$data['datepicker']);
			$end_date=explode("/",$data['datepicker1']);
				$whr="at_jobs.created_date BETWEEN '". $start_date[2]."-".$start_date[0]."-".$start_date[1] ."' AND '". $end_date[2]."-".$end_date[0]."-".$end_date[1] ."'";
				$whr1="aj.created_date BETWEEN '". $start_date[2]."-".$start_date[0]."-".$start_date[1] ."' AND '". $end_date[2]."-".$end_date[0]."-".$end_date[1] ."'";
		}

        $data['order']    = $order;
  	    $data['asc']      = $srt;

  	    $data['pasc']     = $srt=='asc'?'desc':'asc';

  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);

  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);
		$data['offset']= $offset;
	    $data['result'] = $this->manage_new_report_model->get_report3($whr,$whr1);
		$data['file']="admin/new_report/report3";	
		//var_dump($data);
		$this->load->view("admin/template",$data);
	}
	 function report4($job_no){
		$data['title']='Report';
		$data['job_no']="#".$job_no;
		$srch_date=$this->uri->segment(5);
		$whr=1;
		if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
			$date_range= $srch_date[0]." TO " .$srch_date[1];
			$start_date=explode(".",$srch_date[0]);
			$end_date=explode(".",$srch_date[1]);
			$whr="aj.created_date BETWEEN '". $start_date[2]."-".$start_date[0]."-".$start_date[1] ."' AND '". $end_date[2]."-".$end_date[0]."-".$end_date[1] ."'";
		}
		else
		{
			$date_range= "";
		}
		$data['date_range']=$date_range;
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
	    if($job_detail=$this->manage_new_report_model->get_job_detail($job_no))
		{
			$data['job_name']=$job_detail[0]->company_name;
		}
		else
		{
			$data['job_name']='Not specified';
		}
	    $data['result'] = $this->manage_new_report_model->get_report4($job_no,$whr);
		$data['file']="admin/new_report/report4";	
	//	var_dump($data['result']);
		$this->load->view("admin/template",$data);
	}
	 
}
?>