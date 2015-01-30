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
	return true;
}
</script>

<div id="global_content_wrapper">
<div id="global_content"> 
	<h2> <?php echo $title; ?></h2>
		
  
 <div class="search"> 
 <?php if($this->session->flashdata('status')!=''){ ?>
              <p><?php echo $this->session->flashdata('status'); ?></p>  
                <?php } ?> 
 <form action="<?php echo base_url().'admin/manage_user/listing_search';?>" method="post" class="global_form_box">
              
		 <div><label for="search_by" tag="" class="optional"><?php echo 'Search By';?></label>
        <select name='field'>
		<?php echo $field;?>
			<option value="occupation" <?php echo ($field=='occupation')? 'selected="true"':''?> ><?php echo 'Occupation';?></option>
			<option value="first_name" <?php echo ($field=='first_name')? 'selected="true"':''?> ><?php echo 'Fist Name';?></option>
			<option value="last_name" <?php echo ($field=='last_name')? 'selected="true"':''?> ><?php echo 'last Name';?></option>	
			<option value="address" <?php echo ($field=='address')? 'selected="true"':''?> ><?php echo 'address';?></option>
			<option value="email_id" <?php echo ($field=='email_id')? 'selected="true"':''?> ><?php echo 'Email ';?></option>
			<option value="role" <?php echo ($field=='role')? 'selected="true"':''?> ><?php echo 'Role ';?></option>	
		</select></div> 

 <div><label for="search_value" tag="" class="optional"><?php echo 'Search Value';?></label><input type='text' name='srch' id="srch" value="<?php echo $srch; ?>"/></div>
		
		
		<div class="buttons">
<button name="search" id="search" type="submit" onclick="return data_empty();"><?php echo 'Search';?></button>
<a class="category_btn" href='<?php echo base_url().'admin/manage_user/listing'; ?>'><?php echo 'Reset';?></a> 
<a class="category_btn" href="<?php echo base_url().'admin/manage_user/add_user'?>"><?php echo 'Add User';?></a>

</div>
 


</form>
 </div> 
    <div class="clear"> </div>
	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_user/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
	<?php if($tc>0){
	
	 ?>
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
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_user/list_ordering/'.$offset.'/first_name/'.$pasc?>" style='color:#000;'><?php } echo 'First Name';?></a>
        </th>
		  </th>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_user/list_ordering/'.$offset.'/last_name/'.$pasc?>" style='color:#000;'><?php } echo 'Last Name';?></a>
        </th>
        
        </th>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_user/list_ordering/'.$offset.'/email_id/'.$pasc?>" style='color:#000;'><?php } echo 'Email id';?></a>
        </th>
        
           </th>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_user/list_ordering/'.$offset.'/address/'.$pasc?>" style='color:#000;'><?php } echo 'Address';?></a>
        </th>
        
        
         </th>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_user/list_ordering/'.$offset.'/occupation/'.$pasc?>" style='color:#000;'><?php } echo 'Occupation';?></a>
        </th>
        
        </th>
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_user/list_ordering/'.$offset.'/role/'.$pasc?>" style='color:#000;'><?php } echo 'Role';?></a>
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
            <td class='admin_table_user'><?php echo htmlspecialchars($value->first_name); ?></td>
            <td class='admin_table_user'><?php echo htmlspecialchars($value->last_name); ?></td>
            <td class='admin_table_user'><?php echo htmlspecialchars($value->email_id); ?></td>
            <td class='admin_table_user'><?php echo htmlspecialchars($value->address); ?></td>
            <td class='admin_table_user'><?php echo htmlspecialchars($value->occupation); ?></td>
            <td class='admin_table_user'><?php  htmlspecialchars($value->role); 
                    if($value->role==2)
                    
                   {
                   echo"SP";
                    }
                    
                    else
                    {
                    echo"C";
                    }
                    
                    
                    
                    
                    ?></td>   
            <td class='admin_table_options'>
              <a href="<?php echo base_url().'admin/manage_user/delete/'.$value->id?>" title="Delete" onclick="return confirm('Are you sure you want to delete user?');"><img src="<?php echo base_url().'public/images/b_drop.png'?>" alt="Delete"></a>&nbsp;&nbsp;
							<a href="<?php echo base_url().'admin/manage_user/add_user/'.$value->id?>"><img src="<?php echo base_url().'public/images/edit.png'?>" alt="Edit"></a></td>
							
							<td><a class="fancybox fancybox.ajax" href="<?php echo base_url().'admin/manage_user/user_detail/'.$value->id?>" title="detail" ><button type="button">Detail</button></a></td>
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
     
  </div>
  <input name="data[User][mode]" value="" id="UserMode" type="hidden">	
</form>


  
  </div>
   
  
  </div>
</div>