<div id="global_content_wrapper">
<div id="global_content"> 
<h1><center><?php echo "#".$job_no; ?></center></h1>
<h1><center><?php echo $job_name; ?></center></h1>
<?php if(!empty($date_range)){ ?>
<h1><center><?php echo $date_range; ?></center></h1>
<?php } ?>
	<h2> <?php echo $title; ?></h2>
<!--serach by date-->
    <div class="clear"> </div>
	 <a href="<?php echo base_url().'admin/manage_new_report/download_report4/'.@$job_no."/".@$srch_date; ?>">  <img src="<?php echo base_url().'public/img/pdf.png' ?>" alt="Download"></a>		
	 <a href="<?php echo base_url().'admin/manage_new_report/download_csv_report4/'.@$job_no."/".@$srch_date; ?>">  <img src="<?php echo base_url().'public/img/csv.png' ?>" style="width:30px;" alt="Download"></a>	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_employee/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
   
  </div>
  </div>
     	
                 
  <table cellspacing="0" class='admin_table'>
    <thead>
      <tr>
		<th width="10%" style='width: 1%;'><?php echo 'Job Date';?></a>
        </th>   
		<th width="10%" style='width: 1%;'><?php echo 'Name';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php echo 'Job Hours';?></a>
        </th>		
	
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td class='admin_table_user'><?php echo htmlspecialchars($value->created_date); ?></td>
            <td class='admin_table_user'><?php echo $value->fname." ".$value->lname; ?></td>
             <td class="admin_table_centered nowrap">
             	<?php 			
				if($value->mins>=60)
				{
					$add_hours=floor($value->mins/60);
					$add_mins=$value->mins%60;
				
					$value->hours=$value->hours+$add_hours;
					//$value->total_min=$value->total_min-60;
					$value->mins=$add_mins;
				}
					echo $value->hours,":";
					echo $value->mins;
				?>          
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
</form>


  
  </div>
   
  
  </div>
</div>
