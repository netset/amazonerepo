<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>
<script>
function data_empty()
{
	var search = document.getElementById("srch").value;
	if(search=='')
	{
		alert('Please enter valid input');
	}
}
</script>
<!--[if lt IE 10]>
	<style>
		img
		{
			border:none;
	        }
	        table.admin_table tbody tr td
	        {
	        padding-left:9px;
	        }
	</style>
<![endif]-->

<div id="global_content_wrapper">
<div id="global_content"> 
	<h2> <?php echo $title; ?></h2>
		
  
 <div class="search"> 
 <?php if($this->session->flashdata('status')!=''){ ?>
              <p><?php echo $this->session->flashdata('status'); ?></p>  
                <?php } ?> 
 <form action="<?php echo base_url().'admin/manage_employee/listing_search';?>" method="post" class="global_form_box">
              
		 <div><label for="search_by" tag="" class="optional"><?php echo 'Search By';?></label>
        <select name='field'>
		<?php echo $field;?>
			<option value="us.fname" <?php echo ($field=='us.fname')? 'selected="true"':''?> ><?php echo 'First Name';?></option>
			<option value="us.lname" <?php echo ($field=='us.lname')? 'selected="true"':''?> ><?php echo 'Last Name';?></option>
			<option value="us.email" <?php echo ($field=='us.email')? 'selected="true"':''?> ><?php echo 'Email';?></option>
			<option value="dept.dept_name" <?php echo ($field=='dept.dept_name')? 'selected="true"':''?>><?php echo 'Department';?></option>
			<option value="ass.assist_fname" <?php echo ($field=='ass.assist_fname')? 'selected="true"':''?>><?php echo 'Assistant';?></option>
					
		</select></div> 

 <div><label for="search_value" tag="" class="optional"><?php echo 'Search Value';?></label><input type='text' name='srch' id="srch" value="<?php echo $srch; ?>"/></div>
		
		
		<div class="buttons">
<button name="search" id="search" type="submit" onclick="data_empty()"><?php echo 'Search';?></button>
<a class="category_btn" href='<?php echo base_url().'admin/manage_employee/listing'; ?>'><?php echo 'Reset';?></a> 
<a class="category_btn" href="<?php echo base_url().'admin/manage_employee/add_employee'?>"><?php echo 'Add Employee';?></a></div>
 


</form>
 </div> 
    <div class="clear"> </div>
	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_employee/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
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
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_employee/list_ordering/'.$offset.'/fname/'.$pasc?>" style='color:#000;'><?php } echo 'First Name';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_employee/list_ordering/'.$offset.'/lname/'.$pasc?>" style='color:#000;'><?php } echo 'Last Name';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_employee/list_ordering/'.$offset.'/email/'.$pasc?>"><?php } echo 'Email';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_employee/list_ordering/'.$offset.'/dept.dept_name/'.$pasc?>"><?php } echo 'Department';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_employee/list_ordering/'.$offset.'/ass.assist_fname/'.$pasc?>"><?php } echo 'Assistant';?></a>
        </th>

      <!--  <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_employee/list_ordering/'.$offset.'/status/'.$pasc?>"><?php } echo 'Status';?></a></th>
      --><th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Action';?></a></th>
	  <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Detailed hours';?></a></th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td><input  name="IDs[]"  type='checkbox' class='checkbox' value="<?php echo $value->id?>"></td>
            <td class='admin_table_user'><?php echo htmlspecialchars($value->fname); ?></td>
             <td class="admin_table_centered nowrap">
             	<?php echo htmlspecialchars($value->lname); ?>         
            </td>
            <td class="admin_table_centered nowrap">
             	<?php echo htmlspecialchars($value->email); ?></td>   
			<td class="admin_table_centered nowrap">
             	<?php echo htmlspecialchars($value->dept_name); ?></td>   
							<td class="admin_table_centered nowrap">
             	<?php echo htmlspecialchars($value->assist); ?></td>   
			<!--
            <td class='admin_table_centered'>
             <img src="<?php if($value->status==1) $status='green2.jpg';else $status='red3.jpg'; echo base_url().'public/images/'.$status?>" alt="Active">          </td>-->
            
            <td class='admin_table_options'>
              <a href="<?php echo base_url().'admin/manage_employee/delete/'.$value->id?>" title="Delete" onclick="return confirm('Are you sure you want to delete Employee?');"><img src="<?php echo base_url().'public/images/b_drop.png'?>" alt="Delete"></a>&nbsp;&nbsp;
							<a href="<?php echo base_url().'admin/manage_employee/add_employee/'.$value->id?>"><img src="<?php echo base_url().'public/images/edit.png'?>" alt="Edit"></a></td>
							
							            <td class='admin_table_options'>
							<a href="<?php echo base_url().'admin/manage_employee/detailed_hours/'.$value->id?>">Click here</a></td>
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
   <!-- <button type='submit'  value="Activate" onclick='return changeAction("active");'><?php echo 'Activate';?></button>
    <button type='submit' value="Deactivate" onclick='return changeAction("deactive");'><?php echo 'Deactivate';?></button>-->
    
     
  </div>
  <input name="data[User][mode]" value="" id="UserMode" type="hidden">	
</form>


  
  </div>
   
  
  </div>
</div>