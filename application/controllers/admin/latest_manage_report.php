<?php
/*
	purpose: controller to manage all opertion performed for user managenment	
	author: Nitin Saluja
*/
class Manage_report extends CI_Controller
{
	function __construct(){
		parent::__construct();
		$this->load->model('admin/manage_report_model');
		if($this->session->userdata('admin_id')=='')
		{
			redirect(base_url().'admin/login'); 
		}
	}
	function listing($offset=0,$order='id',$srt='desc'){
		$data['title']='Report';
		$data['datepicker']=$this->input->post('picker');
		$data['datepicker1']=$this->input->post('picker1');
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

			$total_rows       = $this->manage_report_model->rows($whr);

		else

			$total_rows       = $this->manage_report_model->rows($whr=1);

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

        $this->pagination->initialize($config);
		
	    $data['result'] = $this->manage_report_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/report/listing";	
		//var_dump($data);
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

  	    if($srch!='')

        {

              $whr= "$field like '%$srch%'";

        }

		$table = '';

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_report_model->rows($whr);

		else

			$total_rows       = $this->manage_report_model->rows($whr=1);

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

        $this->pagination->initialize($config);
	    $data['result'] = $this->manage_report_model->get_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);

		$data['file']="admin/report/listing";	
		$this->load->view("admin/template",$data);
	}
	
	
		function employee_detail($id,$offset=0,$order='id',$srt='desc')
		{
				$srch_date=$this->uri->segment(5);
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

		if(isset($whr) and $whr!='')

			$total_rows       = $this->manage_report_model->employee_detail_rows($whr,$id,$srch_date);

		else

			$total_rows       = $this->manage_report_model->employee_detail_rows($whr=1,$id,$srch_date);

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

        $this->pagination->initialize($config);
		
	    //$data['result'] = $this->manage_report_model->get_employee_detail_where($table,$whr,false,"$order $srt",true,$config['per_page'],$offset);
	    $data['result'] = $this->manage_report_model->get_employee_detail_where($whr,$config['per_page'],$offset,$id,$srch_date);
		
		$data['file']="admin/report/employee_detail";	
		//var_dump($data);
		$this->load->view("admin/pop/template",$data);
	}
	
	public function pdf_report(){
	$id=$this->uri->segment(4);
	$srch_date=$this->uri->segment(5);
		 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_report_model->get_pdf_emp_result($id,$srch_date); 
	 $data = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>

<link href="http://localhost/Savaria/public/css/admin/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="global_content_wrapper">
<div id="global_content"> 
	<h2> Report</h2>
      
  <table cellspacing="0" class="admin_table">
    <thead>
      <tr>
        <th width="10%" style="width: 1%;">Job No. </th>
		<th width="10%" style="width: 1%;">Job Hours
        </th>
				<th width="10%" style="width: 1%;">Description
        </th>
		        </th>
				<th width="10%" style="width: 1%;">Approved Date
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
			
		$data .= '	     </td>
			             <td class="admin_table_centered nowrap">';
	$data .= $value->job_descr;		
			
		$data .= ' </td>
			             <td class="admin_table_centered nowrap">';
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
	 //pr($data);die;
	 create_pdf($data); //Create pdf
	 }
	 
	 
	 public function automatic_pdf_report(){
		 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_report_model->automatic_pdf_report(); 
	 $data = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>

<link href="http://localhost/Savaria/public/css/admin/style.css" rel="stylesheet" type="text/css" />
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
		 $this->load->helper(array('My_Pdf')); 
	 $res= $this->manage_report_model->get_download_pdf_emp_result($srch_date); 
	 $data = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>

<link href="http://localhost/Savaria/public/css/admin/style.css" rel="stylesheet" type="text/css" />
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
		create_pdf($data); //Create pdf
	         
	 }
	 
}
?>