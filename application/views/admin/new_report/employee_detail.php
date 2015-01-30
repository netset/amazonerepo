<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>

<div id="global_content_wrapper">
<div id="global_content"> 
<h1><center><?php echo $full_name; ?></center></h1>
<h1><center><?php echo $date_range; ?></center></h1>
	<h2> <?php echo $title; ?></h2>

    <div class="clear"> </div>
 <a href="<?php echo base_url().'admin/manage_new_report/pdf_report/'.@$emp_id."/".@$role."/".@$srch_date; ?>">  <img src="<?php echo base_url().'public/img/pdf.png' ?>" alt="Download"></a>	
  <a href="<?php echo base_url().'admin/manage_new_report/download_csv_report2/'.@$emp_id."/".@$role."/".@$srch_date; ?>">  <img src="<?php echo base_url().'public/img/csv.png' ?>" style="width:30px;" alt="Download"></a>	
 
  </div>
     	
                 
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
				<th width="10%" style='width: 1%;'><?php echo 'Approved Date';?></a>
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
			<td class="admin_table_centered nowrap">
             	<?php if($value->payment_approval_status==1){echo $value->approve_date;}
				else{
					echo "Not approved yet";
				}
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
  </div>
   
  
