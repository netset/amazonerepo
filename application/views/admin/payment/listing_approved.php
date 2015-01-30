<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>

<script>
function data_empty()
{
	var search = document.getElementById("srch").value;
	if(search=='')
	{
		alert('Please enter valid input');
		return false;
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
 <form action="<?php echo base_url().'admin/manage_payment/view_approved_jobs';?>" method="post" class="global_form_box">
              
		 <div><label for="search_by" tag="" class="optional"><?php echo 'Search By';?></label>
        <select name='field'>
		<?php echo $field;?>
			<option value="job.job_num" <?php echo ($field=='job.job_num')? 'selected="true"':''?> ><?php echo 'Job Number';?></option>	
			<option value="job.job_descr" <?php echo ($field=='job.job_descr')? 'selected="true"':''?> ><?php echo 'Job Description';?></option>					
			<option value="emp.fname" <?php echo ($field=='emp.fname')? 'selected="true"':''?> ><?php echo 'Job Assign';?></option>			
		</select></div> 

 <div><label for="search_value" tag="" class="optional"><?php echo 'Search Value';?></label><input type='text' name='srch' id="srch" value="<?php echo $srch; ?>"/></div>
		
		
		<div class="buttons">
<button name="search" id="search" type="submit" onclick="data_empty()"><?php echo 'Search';?></button>
<a href='<?php echo base_url().'admin/manage_payment/view_approved_jobs'; ?>' class="category_btn"><?php echo 'Reset';?></a> 
<a href="<?php echo base_url().'admin/manage_payment/view_pending_jobs_for_approval'?>" class="category_btn"><?php echo 'Jobs Pending For Approval';?></a>
</div>
 


</form>
 </div> 
    <div class="clear"> </div>
	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_job/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
	<?php if($tc>0){ ?>
    <div class="admin_results"> 
  
  
  
  <div class="pages">
            
            <?php
                      echo $this->pagination->create_links();
                 }?>     
  </div>
  </div>
     	
                 
  <table cellspacing="0" class='admin_table'>
    <thead>
      <tr>
        <th width="6%" style='width: 1%;'><?php if(!empty($result)){?><input onclick="changeCheckboxStatus(listForm)" name="selectAll" class="checkbox" type="checkbox"><?php } ?>
        </th>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_payment/view_approved_jobs/'.$offset.'/job.job_num/'.$pasc?>" style='color:#000;'><?php } echo 'Job Number';?></a>
			
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_payment/view_approved_jobs/'.$offset.'/emp.fname/'.$pasc?>" style='color:#000;'><?php } echo 'Job Assign To';?></a>
        </th>    
            <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_payment/view_pending_jobs_for_approval/'.$offset.'/job.created_date/'.$pasc?>" style='color:#000;'><?php } echo 'Date';?></a>
        </th>
		      <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Payment Status';?></a></th>
              <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Change Status';?></a></th>
             <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Detail';?></a></th> 
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td><input  name="IDs[]"  type='checkbox' class='checkbox' value="<?php echo $value->id?>"></td>
          
            
            <td class='admin_table_user'>#<?php echo ucfirst(htmlspecialchars($value->job_num)); ?></td>
	             
			<td class="admin_table_centered nowrap"><?php echo $value->fname." ".$value->lname; ?>  
            </td>
            			<td class="admin_table_centered nowrap"><?php echo $value->created_date; ?>  
            </td>		
            <td class='admin_table_centered'>
       		
			<img src="<?php if($value->payment_approval_status==0){ echo "Pending";}elseif($value->payment_approval_status==1){ echo base_url().'public/images/inner_images/green_dot.png';}else{echo "Rejected";}?>">
			</td>
			            <td class='admin_table_options'>
&nbsp;&nbsp;
							<a href="<?php echo base_url().'admin/manage_payment/dicision_change/'.$value->id?>" class="fancybox fancybox.ajax"><img src="<?php echo base_url().'public/images/dicision.png'?>" alt="Unapprove" style="width:25px;" title="Unapprove"></a></td>
							<td><a class="fancybox fancybox.ajax" href="<?php echo base_url().'admin/manage_job/job_detail/'.$value->id?>" ><button type="button">Detail</button></a></td>
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
    <button type='submit' value="Approve Selected" onclick='return changeAction("unapprove");'><?php echo 'Unapprove Selected';?></button>
<!--    <button type='submit'  value="Activate" onclick='return changeAction("active");'><?php //echo 'Activate';?></button>
    <button type='submit' value="Deactivate" onclick='return changeAction("deactive");'><?php // echo 'Deactivate';?></button> -->
    
     
  </div>
  <input name="data[User][mode]" value="" id="UserMode" type="hidden">	
</form>


  
  </div>
   
  
  </div>
</div>
