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
		 $this->load->helper(array('csv')); 
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}
	
	function download_csv_report()
	{
	    $result = $this->manage_new_report_model->get_where($whr=1,$whr1=1);
		$i=0;
		foreach($result as $value)
		{
			//print_r($value);
			$data[$i]['name'] = ucfirst($value->fname) ." ". $value->lname;		
			if($value->role==1)	{	$data[$i]['role'] = "Employee";	}	
			else{	$data[$i]['role'] = "Assistant";}
			if($value->total_min>=60)
			{
				$add_hours=floor($value->total_min/60);
				$add_mins=$value->total_min%60;	
				$value->total=$value->total+$add_hours;
				$value->total_min=$add_mins;
			}
			$data[$i]['total_hours'] = $value->total.":".$value->total_min;		
			$data[$i]['total_jobs'] = $value->total_job;		
			$i++;		
		}
	    $col_headers = header('Content-Disposition: attachment; filename="report1.csv"'); 
		$header_colm=array('0'=>'Name','1'=>'Designation','2'=>'Total Hours','3'=>'No. Of Jobs');
		exportCSV($data,$col_headers,$header_colm);
	}

	
	function listing($offset=0,$order='emp_id',$srt='desc'){
		$data['title']='All Employees/Total Hours Report';
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
 	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);

  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);
	    $data['result'] = $this->manage_new_report_model->get_where($whr=1,$whr1=1);

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
			$data['date_range']= "";
		}
        $data['role']    = $role;
		$data['title']='Employee/Detailed Hours Report';
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
	
	function download_csv_report2($id,$offset=0)
	{
		$id=$this->uri->segment(4);
		$role=$this->uri->segment(5);
		$srch_date=$this->uri->segment(6);
		$emp_name= $this->manage_new_report_model->employee_name($id,$role); 
		$full_name= $emp_name[0]->fname ." ". $emp_name[0]->lname;
		if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
		}
		$result= $this->manage_new_report_model->get_pdf_emp_result($id,$role,$srch_date); 
		$i=0;
		foreach($result as $value)
		{
			$data[$i]['job_num'] = "#" . $value->job_num;		
			$data[$i]['job_hours'] = $value->job_hours . ":" . $value->job_hours;		
			$data[$i]['created_date'] = $value->created_date;	
			if($value->payment_approval_status==1){
				$data[$i]['approve_date'] = $value->approve_date;	
			}
			else{
				$data[$i]['approve_date'] = "Not approved yet";
			}				
			$i++;			
		}
	    $col_headers = header('Content-Disposition: attachment; filename="report2.csv"'); 
		$header_colm=array('0'=>'Job No.','1'=>'Job Hours','2'=>'Job Date','3'=>'Approved Date');
		exportCSV($data,$col_headers,$header_colm);
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
			$date_range= $srch_date[0]." TO " .$srch_date[1];
		}
		else
		{
			$date_range= "Full";
		}
		 $this->load->helper(array('My_Pdf')); 
	//$data['result'] = $this->manage_new_report_model->get_employee_detail_where($whr,$offset,$id,$srch_date,$role);
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
<h1><center>'.$full_name.'</center></h1>	<h2><center> '.$date_range.'</center></h2>
      Employee/Detailed Hours Report
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
	 
	function download_pdf_report(){
	 $srch_date=$this->uri->segment(4);
	 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_new_report_model->get_download_pdf_emp_result($srch_date); 
	 	if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
			$date_range= $srch_date[0]." TO " .$srch_date[1];
		}
		else
		{
			$date_range= "Full";
		}
	//echo "<pre>";print_r($res);	
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
	<h2><center>All Employees/Total Hours Report</center></h2>
	<h2>'.$date_range. ' Report</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">Name</th>
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
	$data .= ucfirst($value->fname) ." ". $value->lname;		
	$data .= '</td></td>
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
//echo $data;die;
		create_pdf($data); //Create pdf
	         
	 }
	 
	 /////////////////////////Report 3 and 4////////////////////////
	 
	function report3($offset=0,$order='id',$srt='desc'){
		$data['title']='Total Hours by Job Number Report';
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
			$total_rows       = $this->manage_new_report_model->get_report3_rows($whr,$whr1);
		else
			$total_rows       = $this->manage_new_report_model->get_report3_rows($whr=1,$whr1=1);
  	    $data['tc']       = $total_rows;
        $this->load->library('pagination');    
        $data['offset']           = $offset;
        $config['base_url']       = base_url().'admin/manage_new_report/report3';
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
		
	    $data['result'] = $this->manage_new_report_model->get_report3($table,$whr,false,"$order $srt",true,$config['per_page'],$offset,$whr1);
		$data['file']="admin/new_report/report3";	
		$this->load->view("admin/template",$data);
	}
	

	function search_report3($offset=0,$order='id',$srt='desc'){
		$data['title']='Total Hours by Job Number Report';
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
        $data['order']    = $order;
  	    $data['asc']      = $srt;
  	    $data['pasc']     = $srt=='asc'?'desc':'asc';
  	    $data['srch']     = $srch  = isset($_POST['srch'])?($this->input->post('srch')!=''?$this->input->post('srch'):''):$this->uri->segment(7);
  	    $data['field']    = $field = isset($_POST['field'])?($this->input->post('field')!=''?$this->input->post('field'):''):$this->uri->segment(8);
  	    $whr="1";
  	    $whr1="1";
		if(!empty($data['datepicker']))
		{
			$start_date=explode("/",$data['datepicker']);
			$end_date=explode("/",$data['datepicker1']);
				$whr="at_jobs.created_date BETWEEN '". $start_date[2]."-".$start_date[0]."-".$start_date[1] ."' AND '". $end_date[2]."-".$end_date[0]."-".$end_date[1] ."'";
				$whr1="aj.created_date BETWEEN '". $start_date[2]."-".$start_date[0]."-".$start_date[1] ."' AND '". $end_date[2]."-".$end_date[0]."-".$end_date[1] ."'";
		}
		$table = '';
		if(isset($whr) and $whr!='')
			$total_rows       = $this->manage_new_report_model->get_report3_rows($whr,$whr1);
		else
			$total_rows       = $this->manage_new_report_model->get_report3_rows($whr=1,$whr1=1);
  	    $data['tc']       = $total_rows;
        $this->load->library('pagination');    
        $data['offset']           = $offset;
        $config['base_url']       = base_url().'admin/manage_new_report/report3';
        $config['total_rows']     = $total_rows;
        $config['per_page']       = '50';
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
		
	    $data['result'] = $this->manage_new_report_model->get_report3($table,$whr,false,"$order $srt",true,$config['per_page'],$offset,$whr1);
		$data['file']="admin/new_report/report3";	
		$this->load->view("admin/template",$data);
	}
	function download_csv_report3()
	{
	$srch_date=$this->uri->segment(4);
 		$res=strpos($srch_date,".");
		if(!empty($res))
		{
			$srch_date=explode("-",$srch_date);
			$start_date=$srch_date[0];
			$end_date=$srch_date[1];
			$fromtime=explode(".",$start_date);
			$totime=explode(".",$end_date);
			$whr="at_jobs.created_date BETWEEN '". $fromtime[2]."-".$fromtime[0]."-".$fromtime[1] ."' AND '". $totime[2]."-".$totime[0]."-".$totime[1] ."'";
			$whr1="aj.created_date BETWEEN '". $fromtime[2]."-".$fromtime[0]."-".$fromtime[1] ."' AND '". $totime[2]."-".$totime[0]."-".$totime[1] ."'";
		}
		else
		{
			$whr=1;
			$whr1=1;
		}
		$result= $this->manage_new_report_model->get_report3($whr,$whr1);
		$i=0;
		foreach($result as $value)
		{
			$data[$i]['job_no'] = "#".$value->job_no;		
            if($value->grand_total_min>=60)
			{
					$add_hours=floor($value->grand_total_min/60);
					$add_mins=$value->grand_total_min%60;
					$value->grand_total=$value->grand_total+$add_hours;
					$value->grand_total_min=$add_mins;
			}
			$data[$i]['total_hours'] = $value->grand_total.":".$value->grand_total_min;		
			$data[$i]['total_jobs'] = $value->grand_total_count;		
			$i++;		
		}
				//echo "<pre>";print_r($data);die;
	    $col_headers = header('Content-Disposition: attachment; filename="report3.csv"'); 
		$header_colm=array('0'=>'Job No.','1'=>'Total Hours','2'=>'No. Of Jobs');
		exportCSV($data,$col_headers,$header_colm);
	}
	
	function download_report3(){
	$srch_date=$this->uri->segment(4);
 		$res=strpos($srch_date,".");
		if(!empty($res))
		{
			$srch_date=explode("-",$srch_date);
			$start_date=$srch_date[0];
			$end_date=$srch_date[1];
			$date_range= $srch_date[0]." TO " .$srch_date[1];
			$fromtime=explode(".",$start_date);
			$totime=explode(".",$end_date);
			$whr="at_jobs.created_date BETWEEN '". $fromtime[2]."-".$fromtime[0]."-".$fromtime[1] ."' AND '". $totime[2]."-".$totime[0]."-".$totime[1] ."'";
			$whr1="aj.created_date BETWEEN '". $fromtime[2]."-".$fromtime[0]."-".$fromtime[1] ."' AND '". $totime[2]."-".$totime[0]."-".$totime[1] ."'";
		}
		else
		{
			$date_range= "Full";
			$whr=1;
			$whr1=1;
		}
	 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_new_report_model->get_report3($whr,$whr1);
		
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
	<h2><center>Total Hours by Job Number Report</center></h2>
	<h2>'.$date_range. '</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">Job No.</th>
        <th width="10%" style="width: 1%;">Total Hours</th>
		<th width="10%" style="width: 1%;">No. Of Jobs      
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= "#".$value->job_no;		
	$data .= '</td>
             <td class="admin_table_centered nowrap">';
             if($value->grand_total_min>=60)
				{
					$add_hours=floor($value->grand_total_min/60);
					$add_mins=$value->grand_total_min%60;
				
					$value->grand_total=$value->grand_total+$add_hours;
					$value->grand_total_min=$add_mins;
				}
             
	$data .= $value->grand_total.":".$value->grand_total_min;		
			
		$data .= '	     </td>
			             <td class="admin_table_centered nowrap">';
	$data .= $value->grand_total_count;		
			
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
	
	 function report4($job_no){
		$data['title']='Report';
		$data['job_no']=$job_no;
		$data['srch_date']= $srch_date= $this->uri->segment(5);
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
		$this->load->view("admin/pop/template",$data);
	}
	
	
	function download_csv_report4()
	{
		$job_no=$this->uri->segment(4);
		$srch_date=$this->uri->segment(5);
		if(strpos($srch_date,"."))
		{
			$srch_date=explode("-",$srch_date);
			$start_date=explode(".",$srch_date[0]);
			$end_date=explode(".",$srch_date[1]);
			$whr="aj.created_date BETWEEN '". $start_date[2]."-".$start_date[0]."-".$start_date[1] ."' AND '". $end_date[2]."-".$end_date[0]."-".$end_date[1] ."'";
		}
		else
		{
			$whr=1;
		}
		$result= $this->manage_new_report_model->get_report4($job_no,$whr);
		$i=0;
		$data=array();
		foreach($result as $value)
		{	
			$data[$i]['created_date']= $value->created_date;	
			$data[$i]['name'] = $value->fname . " " . $value->lname;	
             if($value->mins>=60)
				{
					$add_hours=floor($value->mins/60);
					$add_mins=$value->mins%60;
					$value->hours=$value->hours+$add_hours;
					$value->mins=$add_mins;
				}
			$data[$i]['job_hours'] = $value->hours.":".$value->mins;	
			$i++;		
		}
	    $col_headers = header('Content-Disposition: attachment; filename="report4.csv"'); 
		$header_colm=array('0'=>'Job Date','1'=>'Name','2'=>'Job Hours');
		exportCSV($data,$col_headers,$header_colm);
	}
	public function download_report4(){
		$job_no=$this->uri->segment(4);
		$srch_date=$this->uri->segment(5);
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
			$whr=1;
			$date_range= "";
		}
	    if($job_detail=$this->manage_new_report_model->get_job_detail($job_no))
		{
			$job_name=$job_detail[0]->company_name;
		}
		else
		{
			$job_name='Not specified';
		}
	 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_new_report_model->get_report4($job_no,$whr);
	
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
	<h2><center>#' . $job_no . '</center></h2>
	<h2><center>' . $job_name . '</center></h2>
	<h2><center>'.$date_range. '</center></h2>
	<h2>Detailed hours by specific job number Report</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">Job Date</th>
        <th width="10%" style="width: 1%;">Employee Name</th>
		<th width="10%" style="width: 1%;">Job Hours      
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= $value->created_date;		
	$data .= '</td>
			    <td class="admin_table_centered nowrap">';
	$data .= $value->fname . " " . $value->lname;		
			
		$data .= ' </td>      
					<td class="admin_table_centered nowrap">';
             if($value->mins>=60)
				{
					$add_hours=floor($value->mins/60);
					$add_mins=$value->mins%60;
				
					$value->hours=$value->hours+$add_hours;
					$value->mins=$add_mins;
				}
             
	$data .= $value->hours.":".$value->mins;		
			
		$data .= '	     </td>
		 </tr>';
			
	}
	   $data .= '                  
 
                  </tbody>
  </table>
  </div>
</div>
</body>
</html>'; // Pass the url of html report
//echo $data;die;
		create_pdf($data); //Create pdf
	 }
	////////////////Report 5///////////////
	function report5($offset=0,$order='id',$srt='desc'){
		$this->load->model('admin/manage_customer_model');
		$data['title']='Manage Customers';
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
			$total_rows       = $this->manage_customer_model->rows($whr);
		else
			$total_rows       = $this->manage_customer_model->rows($whr=1);
  	    $data['tc']       = $total_rows;

        $this->load->library('pagination');     
        $data['offset']           = $offset;
        $config['base_url']       = base_url().'admin/manage_new_report/report5';
        $config['total_rows']     = $total_rows;
        $config['per_page']       = '50';
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
	    $data['result'] = $this->manage_customer_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);
		$data['file']="admin/new_report/complete_listing";
		$this->load->view("admin/template",$data);
	}
	function download_csv_report5()
	{
		$this->load->model('admin/manage_customer_model');
		$whr="1";
		$table = ''; 
		$result= $this->manage_customer_model->get_where($table,$whr,false,"id asc",false,10000,0);
		$i=0;
		$data=array();
		foreach($result as $value)
		{	     	
			$data[$i]['company_name']= $value->company_name;	
			$data[$i]['job_no'] = $value->job_no;	
			$i++;		
		}
	    $col_headers = header('Content-Disposition: attachment; filename="report5.csv"'); 
		$header_colm=array('0'=>'Company Name','1'=>'Job Number');
		exportCSV($data,$col_headers,$header_colm);
	}
	public function download_customer_list(){
		$this->load->model('admin/manage_customer_model');
		$title= "Customer_list";
		$whr="1";
		$table = '';
		$this->load->helper(array('My_Pdf')); 
		$res= $this->manage_customer_model->get_where($table,$whr,false,"id asc",false,10000,0);
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
	<h2>'.$title. '</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">Company Name</th>
		<th width="10%" style="width: 1%;">Job Number</th>      
      </tr>
    </thead>
    <tbody>';
	
	
	foreach($res as $value)
	{
     $data .= '                  <tr class="odd">
            <td class="admin_table_user">';
	$data .= $value->company_name;		
	$data .= '</td> <td class="admin_table_user">';
	$data .= $value->job_no;		
			
		
		$data .= '	</td>
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
	 
}
?>