<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>
<script>
function data_empty()
{
	var dt=document.getElementById("datepicker").value;
	var dt1=document.getElementById("datepicker1").value;

		if(dt!='')
		{
			if(dt1=='')
			{
				alert('Please Enter End Date');
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
		else
		{
			return true;
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
 <form action="<?php echo base_url().'admin/manage_employee/detailed_hours/'.$emp_id;?>" method="post" class="global_form_box">
		
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
<a class="category_btn" href='<?php echo base_url().'admin/manage_employee/detailed_hours/'.$emp_id; ?>'><?php echo 'Reset';?></a> 
</div>

</form>


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
?>

 </div> 
 
   <a href="<?php echo base_url().'admin/manage_employee/download_detailed_hours/'.$emp_id.'/'.$download_search_value; ?>">  <img src="<?php echo base_url().'public/img/pdf.png' ?>" alt="Download" title="Download"></a>

    <div class="clear"> </div>
	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_employee/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
     	
                 
  <table cellspacing="0" class='admin_table'>
    <thead>
      <tr>
        <th width="10%" style='width: 1%;'><?php echo 'Job No.';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php echo 'Job Hours';?></a>
        </th>
				
		        </th>
				<th width="10%" style='width: 1%;'><?php echo 'Job Date';?></a>
        </th>        
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td class='admin_table_user'><?php echo "#",htmlspecialchars($value->job_num); ?></td>
             <td class="admin_table_centered nowrap">
             	<?php echo $value->job_hours,":",$value->job_mins; ?>         
            </td>
			            
             </td>
			             <td class="admin_table_centered nowrap">
             	<?php echo htmlspecialchars($value->created_date); ?>         
            </td>
     
		 </tr>
               <?php }
}
else{
?>
<tr><td colspan='4'><?php echo "No such record found";
}?></td></tr>   
                  </tbody>
  </table>
  <br />
  <div class='buttons'>
  <input type='hidden' id='action' name='action' value='' />
  <?php
  $download_search_value=@$srch."-".@$st_st_date."-".@$end_end_date;
  
   if(!empty($result))
   {
  ?>
  

    <?php
    }
    ?>
     
  </div>
  <input name="data[User][mode]" value="" id="UserMode" type="hidden">	
</form>


  
  </div>
   
  
  </div>
</div>
