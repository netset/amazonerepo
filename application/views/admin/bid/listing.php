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
 <form action="<?php echo base_url().'admin/manage_bid/listing_search';?>" method="post" class="global_form_box">
              
		 <div><label for="search_by" tag="" class="optional"><?php echo 'Search By';?></label>
        <select name='field'>
		<?php echo $field;?>
			<option value="job_title" <?php echo ($field=='job_title')? 'selected="true"':''?> ><?php echo 'Title';?></option>									
			<option value="A.first_name" <?php echo ($field=='A.first_name')? 'selected="true"':''?> ><?php echo 'Posted By';?></option>	
	
			<option value="u.first_name" <?php echo ($field=='u.first_name')? 'selected="true"':''?> ><?php echo 'Applicant Name';?></option>
			
		</select></div> 

 <div><label for="search_value" tag="" class="optional"><?php echo 'Search Value';?></label><input type='text' name='srch' id="srch" value="<?php echo $srch; ?>"/></div>
		
		
		<div class="buttons">
<button name="search" id="search" type="submit" onclick="return data_empty();"><?php echo 'Search';?></button>
<a href='<?php echo base_url().'admin/manage_bid/listing'; ?>' class="category_btn"><?php echo 'Reset';?></a> 
<!--<a href="<?php echo base_url().'admin/manage_bid/add_bid'?>" class="category_btn"><?php echo 'Add bid';?></a>--></div>
 


</form>
 </div> 
    <div class="clear"> </div>
	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_bid/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
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
        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_bid/list_ordering/'.$offset.'/job_title/'.$pasc?>" style='color:#000;'><?php } echo 'Job Title';?></a>
		</th>
		
		        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_bid/list_ordering/'.$offset.'/cover_letter/'.$pasc?>" style='color:#000;'><?php } echo 'Cover Letter';?></a>
		</th>
		
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_bid/list_ordering/'.$offset.'/A.first_name/'.$pasc?>" style='color:#000;'><?php } echo 'Posted By';?></a>
		</th>
		
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_bid/list_ordering/'.$offset.'/u.first_name/'.$pasc?>" style='color:#000;'><?php } echo 'Applicant Name';?></a>
        </th>
		        <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_bid/list_ordering/'.$offset.'/deleivery_date/'.$pasc?>" style='color:#000;'><?php } echo 'Deleivery Date';?></a>
		</th>

		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_bid/list_ordering/'.$offset.'/bid_amount/'.$pasc?>" style='color:#000;'><?php } echo 'Bid Amount';?></a>
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
   
            <td class='admin_table_user'><?php echo ucwords($value->job_title); ?></td>
             <td class='admin_table_user'><?php echo ucwords(substr($value->cover_letter, 0, 10))."..."; ?></td>
              <td class='admin_table_user'><?php echo ucwords($value->owner); ?></td>
              <td class='admin_table_user'><?php echo ucwords($value->sp_name); ?></td>
            <td class='admin_table_user'><?php echo $value->deleivery_date; ?></td>
             <td class='admin_table_user'><?php  echo "$".ucwords($value->bid_amount); ?>
             </td>
			
            <td class='admin_table_options'>
              <a href="<?php echo base_url().'admin/manage_bid/delete/'.$value->id?>" title="Delete" onclick="return confirm('Are you sure you want to delete ?');"><img src="<?php echo base_url().'public/images/b_drop.png'?>" alt="Delete"></a>&nbsp;&nbsp;
						<!--	<a href="<?php echo base_url().'admin/manage_bid/add_bid/'.$value->id?>"><img src="<?php echo base_url().'public/images/edit.png'?>" alt="Edit"></a>--></td>
							<td><a class="fancybox fancybox.ajax" href="<?php echo base_url().'admin/manage_bid/bid_detail/'.$value->id?>" title="Detail"><button type="button">Detail</button></a></td>
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
