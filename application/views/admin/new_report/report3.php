<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>
<script>
function data_empty()
{
	//var search = document.getElementById("srch").value;
	var dt=document.getElementById("datepicker").value;
	var dt1=document.getElementById("datepicker1").value;
		if(dt=='')
		{
			alert('Please enter valid input');
			return false;	
		}
		else if(dt1=='')
		{
			alert('Please enter valid input');
			return false;	
		}
		else
		{
			var s_mdy=dt.split("/");
			var e_mdy=dt1.split("/");
			var d1=new Date(parseInt(s_mdy[2],10),(parseInt(s_mdy[0],10))-1,parseInt(s_mdy[1],10),0,0,parseInt(00,10));
			var d2=new Date(parseInt(e_mdy[2],10),(parseInt(e_mdy[0],10))-1,parseInt(e_mdy[1],10),0,0,parseInt(00,10));
			var dd1=d1.valueOf();
			var dd2=d2.valueOf(); 
			if (dd1>dd2)
			{
			   alert("End Date must be greater than Start Date");
			   return false;
			}
			else
			{
				return true;
			}
		}
	}
</script>

<div id="global_content_wrapper">
<div id="global_content"> 
	<h2> <?php echo $title; ?></h2>
		
  
 <div class="search"> 
 <?php if($this->session->flashdata('status')!=''){ ?>
              <p><?php echo $this->session->flashdata('status'); ?></p>  
                <?php } ?> 
 <form action="<?php echo base_url().'admin/manage_new_report/search_report3';?>" method="post" class="global_form_box">
	<div><label for="search_by" tag="" class="optional" ><?php echo 'Search By';?></label>
        <input type="text" placeholder="Date" id="datepicker" name="picker" value="<?php echo @$datepicker; ?>"/>&nbsp;&nbsp;To&nbsp;
		  <input type="text" placeholder="Date" id="datepicker1" name="picker1" value="<?php echo @$datepicker1; ?>"/>
</div> 	

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#datepicker" ).datepicker();
});

$(function() {
$( "#datepicker1" ).datepicker();
});
</script>
<!---->	

	
		<div class="buttons">
<button name="search" id="search" type="submit" onclick="return data_empty();"><?php echo 'Search';?></button>
<a class="category_btn" href='<?php echo base_url().'admin/manage_new_report/report3'; ?>'><?php echo 'Reset';?></a> 
</div>
 


</form>

 </div> 
<!--serach by date-->
<?php
if(!empty($datepicker))
{
$st_date=explode('/',$datepicker);
$st_st_date=$st_date[0].".".$st_date[1].".".$st_date[2];

$end_date=explode('/',$datepicker1);
$end_end_date=$end_date[0].".".$end_date[1].".".$end_date[2];
$search_value=@$st_st_date."-".@$end_end_date;
}

  $download_search_value=@$st_st_date."-".@$end_end_date;
  
   if(!empty($result))
   {
  ?>
  
  <a href="<?php echo base_url().'admin/manage_new_report/download_report3/'.$download_search_value; ?>">  <img src="<?php echo base_url().'public/img/pdf.png' ?>" alt="Download"></a>  
  <a href="<?php echo base_url().'admin/manage_new_report/download_csv_report3/'.$download_search_value; ?>">  <img src="<?php echo base_url().'public/img/csv.png' ?>" style="width:30px;" alt="Download"></a>
    <?php
    }
    ?>

    <div class="clear"> </div>
		<?php if($tc>0){ ?>
	    <div class="admin_results"> 
    <div class="pages">
            
            <?php
                      echo $this->pagination->create_links();
                 }?>     
  </div>
  </div>
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_employee/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
                 
  <table cellspacing="0" class='admin_table'>
    <thead>
      <tr>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="javascript:void(0)" style='color:#000;'><?php } echo 'Job No.';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="javascript:void(0)" style='color:#000;'><?php } echo 'Total Hours';?></a>
        </th>
				<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="javascript:void(0)" style='color:#000;'><?php } echo 'No. Of Jobs';?></a>
        </th>

<th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Action';?></a></th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){
	?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td class='admin_table_user'><?php echo "#".$value->job_no; ?></td>
             <td class="admin_table_centered nowrap">
             	<?php
				
				if($value->grand_total_min>=60)
				{
					$add_hours=floor($value->grand_total_min/60);
					$add_mins=$value->grand_total_min%60;
				
					$value->grand_total=$value->grand_total+$add_hours;
					//$value->total_min=$value->total_min-60;
					$value->grand_total_min=$add_mins;
				}

				if($value->grand_total<10){
				echo "0",$value->grand_total,":";
				}
				else
				{
				 echo $value->grand_total,":";
				}
				if($value->grand_total_min<10){
				echo "0",$value->grand_total_min;
				}
				else
				{
				echo $value->grand_total_min;
				}
				?>         
            </td>
			<td class='admin_table_user'><?php echo $value->grand_total_count;?></td>           
            <td class='admin_table_options'>
				<a class="fancybox fancybox.ajax" href="<?php echo base_url().'admin/manage_new_report/report4/'.$value->job_no.'/'.@$search_value; ?>" ><button type="button" >Detail</button></a></td>         
		 </tr>
               <?php }
}
else{
?>
<tr><td colspan='4'><?php echo "No such record found";
}?></td></tr>   
                  </tbody>
  </table>
</form>


  
  </div>
   
  
  </div>
</div>
