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
 <form action="<?php echo base_url().'admin/manage_customer/listing_search';?>" method="post" class="global_form_box">
              

		
		
		<div class="buttons">
 <a href="<?php echo base_url().'admin/manage_customer/download_customer_list'?>"><img src="<?php echo base_url().'public/img/pdf.png' ?>" alt="Download Customer List" title="Download Customer List"></a>

</div>

</form>
 </div> 
    <div class="clear"> </div>
	
  <div class="admin_table_form"> 
   
				
  <form action="<?php echo base_url()?>admin/manage_customer/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8"><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
     	
                 
  <table cellspacing="0" class='admin_table'>
    <thead>
      <tr>
         <th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_customer/customer_list_ordering/0/company_name/'.$pasc?>" style='color:#000;'><?php } echo 'Company Name';?></a>
        </th>
		<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_customer/customer_list_ordering/0/job_no/'.$pasc?>"><?php } echo 'Job No.';?></a>
        </th>
        
        
      </tr>
    </thead>
    <tbody>
    <?php $i=1;
  if($result){
	foreach($result as $value){?>
                        <tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
            <td class='admin_table_user'><?php echo htmlspecialchars($value->company_name); ?></td>
            <td class="admin_table_centered nowrap">
             	<?php echo htmlspecialchars($value->job_no); ?></td>     
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
     
  </div>
  <input name="data[User][mode]" value="" id="UserMode" type="hidden">	
</form>


  
  </div>
   
  
  </div>
</div>
