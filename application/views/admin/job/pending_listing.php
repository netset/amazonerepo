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
 <form action="<?php echo base_url().'admin/manage_job/listing_search';?>" method="post" class="global_form_box">
              
		 <!--  <div><label for="search_by" tag="" class="optional"><?php echo 'Search By';?></label>
      <select name='field'>
		<?php echo $field;?>
			<option value="t.job_title" <?php echo ($field=='t.job_title')? 'selected="true"':''?> ><?php echo ' Title';?></option>	
								
			<option value="p.cat_name" <?php echo ($field=='p.cat_name')? 'selected="true"':''?> ><?php echo 'Category';?></option>			
			<option value="t.job_status" <?php echo ($field=='t.job_status')? 'selected="true"':''?> ><?php echo 'Status';?></option>
			<option value="us.first_name" <?php echo ($field=='us.first_name')? 'selected="true"':''?> ><?php echo 'Posted By';?></option>
		</select></div> 

 <div><label for="search_value" tag="" class="optional"><?php echo 'Search Value';?></label><input type='text' name='srch' id="srch" value="<?php echo $srch; ?>"/></div>-->
		
		
		<div class="buttons">
<!--<button name="search" id="search" type="submit" onclick="return data_empty();"><?php echo 'Search';?></button>
<a href='<?php echo base_url().'admin/manage_job/listing'; ?>' class="category_btn"><?php echo 'Reset';?></a> 
<a href="<?php echo base_url().'admin/manage_job/add_job'?>" class="category_btn"><?php echo 'Add Job';?></a>-->
<a href="<?php echo base_url().'admin/manage_job/complete_listing'?>" class="category_btn"><?php echo 'Complete';?></a>
<a href="<?php echo base_url().'admin/manage_job/pending_listing'?>" class="category_btn"><?php echo 'Pending';?></a>
<a href="<?php echo base_url().'admin/manage_job/InProgress_listing'?>" class="category_btn"><?php echo 'InProgress';?></a>
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
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_job/list_ordering/'.$offset.'/t.job_title/'.$pasc?>" style='color:#000;'><?php } echo 'Title';?></a>
		</th>
		
		        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_job/list_ordering/'.$offset.'/t.job_detail/'.$pasc?>" style='color:#000;'><?php } echo 'Description';?></a>
		</th>
		
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_job/list_ordering/'.$offset.'/us.first_name/'.$pasc?>" style='color:#000;'><?php } echo 'Posted By';?></a>
		</th>
		
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_job/list_ordering/'.$offset.'/p.cat_name/'.$pasc?>" style='color:#000;'><?php } echo 'Category';?></a>
        </th>
		        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_job/list_ordering/'.$offset.'/t.end_date/'.$pasc?>" style='color:#000;'><?php } echo 'End Date';?></a>
		</th>

		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_job/list_ordering/'.$offset.'/t.job_status/'.$pasc?>" style='color:#000;'><?php } echo 'Status';?></a>
		</th>
      <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Action';?></a></th>
        
             <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Detail';?></a></th> 
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td><input  name="IDs[]"  type='checkbox' class='checkbox' value="<?php echo $value->id?>"></td>
          
            
            <td class='admin_table_user'><?php echo $value->job_title; ?></td>
             <td class='admin_table_user'><?php echo $value->job_detail; ?></td>
              <td class='admin_table_user'><?php echo $value->first_name; ?></td>
              <td class='admin_table_user'><?php echo $value->cat_name; ?></td>
            <td class='admin_table_user'><?php echo $value->end_date; ?></td>
             <td class='admin_table_user'><?php  $value->job_status;
             
             if($value->job_status==0)
             {
             echo"PENDING";
             }
             elseif($value->job_status==1)
             {
             echo"IN PROGRESS";
             }
             else
             
            {
            echo"COMPLETED";
             }
             ?>
             
             </td>
			
            <td class='admin_table_options'>
              <a href="<?php echo base_url().'admin/manage_job/delete/'.$value->id?>" title="Delete" onclick="return confirm('Are you sure you want to delete ?');"><img src="<?php echo base_url().'public/images/b_drop.png'?>" alt="Delete"></a>&nbsp;&nbsp;
							<a href="<?php echo base_url().'admin/manage_job/add_job/'.$value->id?>"><img src="<?php echo base_url().'public/images/edit.png'?>" alt="Edit"></a></td>
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
    <button type='submit' value="Delete Selected" onclick='return changeAction("delete");'><?php echo 'Delete Selected';?></button>
<!--    <button type='submit'  value="Activate" onclick='return changeAction("active");'><?php //echo 'Activate';?></button>
    <button type='submit' value="Deactivate" onclick='return changeAction("deactive");'><?php // echo 'Deactivate';?></button> -->
    
     
  </div>
  <input name="data[User][mode]" value="" id="UserMode" type="hidden">	
</form>


  
  </div>
   
  
  </div>
</div>