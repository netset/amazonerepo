<!--<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.4.1.min.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<!--Files inculde for lightbox -->
<!-- Add jQuery library -->
	<!--<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/lib/jquery-1.9.0.min.js"></script>-->
	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url(); ?>public/lightbox/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/lightbox/source/jquery.fancybox.css?v=2.1.4" media="screen" />
<!-- for popup box -->	
<script type="text/javascript">
$(document).ready(function() {
$('.fancybox').fancybox();
});
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
<!--[if lte IE 10]>
	<style>
		
	        .admin_table_centered, .admin_table_options
	        {
	        	text-align:center !important;
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
			<form action="<?php echo base_url().'admin/manage_message/listing_search';?>" method="post" class="global_form_box">
				<div><label for="search_by" tag="" class="optional"><?php echo 'Search By';?></label>
					<select name='field' style="width:150px;">
						<option value="message" <?php echo ($field=='message')? 'selected="true"':''?> ><?php echo 'message';?></option>
                                                <option value="sender" <?php echo ($field=='sender')? 'selected="true"':''?> ><?php echo 'Sender';?></option>
                                                <option value="B.first_name" <?php echo ($field=='B.first_name')? 'selected="true"':''?> ><?php echo 'Reciever';?></option>
					</select>
				</div> 
				<div><label for="search_value" tag="" class="optional"><?php echo 'Search Value';?></label><input type='text' name='srch' id="srch" value="<?php echo $srch; ?>"/></div>   
				<div class="buttons">
					<button name="search" id="search" type="submit" onclick="return data_empty();"><?php echo 'Search';?></button>
					<a href='<?php echo base_url().'admin/manage_message/listing' ?>'><button type='button' ><?php echo 'Reset';?></button></a> 
					<a href="<?php echo base_url().'admin/manage_message/add_message'?>"><button type='button'><?php echo 'Send Message';?></button></a>
					
					<a href="<?php echo base_url().'admin/manage_message/send_email'?>"><button type='button'><?php echo 'Send Email';?></button></a>
				</div>
			</form>
		</div> 
		<div class="clear"> </div>
		<div class="admin_table_form">  		
			<form action="<?php echo base_url()?>admin/manage_message/delete" method="post" class="longFieldsForm" name="listForm" id="listForm" accept-charset="utf-8" ><div style="display:none;"><input name="_method" value="POST" type="hidden"></div>
			<?php if($tc>0){ ?>
			<div class="admin_results"> 
				<div class="pages">
						<?php echo $this->pagination->create_links();
					 }?>     
				</div>
			</div>    	         
		  <table cellspacing="0" class='admin_table' id="tblData">
			<thead>
				  <tr>
				   
					<th width="6%" style='width: 1%;'><?php if(!empty($result)){?><input onclick="changeCheckboxStatus(listForm)" name="selectAll" class="checkbox" type="checkbox"><?php } ?>
					</th>
					
					
					<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_message/'.$listing.'/'.$offset.'/sender /'.$pasc?>"><?php } echo 'Sender';?></a>
					</th>
					<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_message/'.$listing.'/'.$offset.'/receiver /'.$pasc?>"><?php } echo 'Receiver';?></a>
					</th>
					<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_message/'.$listing.'/'.$offset.'/message/'.$pasc?>"><?php } echo 'Message';?></a>
					</th>
					<th width="10%" style='width: 1%;'><?php if(!empty($result)){?><a href="<?php echo base_url().'admin/manage_message/'.$listing.'/'.$offset.'/message_time/'.$pasc?>"><?php } echo 'Message time';?></a>
					</th>

				   <th width="10%" class='admin_table_centered' style='width: 1%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Action';?></a></th>
			</th>
        <th width="10%" class='admin_table_centered' style='width: 3%;'><?php if(!empty($result)){?><a href="javascript:void(0)"><?php } echo 'Detail';?></a></th>	  </tr>
			</thead>
			<tbody>
			<?php $i=1;
			if($result){
				foreach($result as $value){?>
				<tr class="<?php if($i%2==1)echo 'odd';else echo 'even';?>">
					<?php //echo $value->id; ?>
					<td><input  name="IDs[]"  type='checkbox' class='checkbox' value="<?php echo $value->id; ?>"></td>
					 <td class='admin_table_user'><?php echo htmlspecialchars($value->sender); ?></td>  
					<td class='admin_table_user'><?php echo htmlspecialchars($value->receiver); ?></td>    
					<td class='admin_table_user'><?php echo htmlspecialchars($value->message); ?></td>    
					<td class='admin_table_user'><?php echo strip_tags($value->message_time); ?></td>         
					<td class='admin_table_options'>
					<a href="<?php echo base_url().'admin/manage_message/delete/'.$value->id?>" title="Delete" onclick="return confirm('Are you sure you want to delete message?');"><img src="<?php echo base_url().'public/images/b_drop.png'?>" alt="Delete"></a>&nbsp;&nbsp;
			<td><a class="fancybox fancybox.ajax" href="<?php echo base_url().'admin/manage_message/message_detail/'.$value->id?>" title="Detail"><button type="button">Detail</button></a></td>		  
				</tr>
               <?php }
			}else{ ?>
				<tr><td colspan='4'><?php echo "No such record found"; 
			}?>
			</td></tr>   
		</tbody>
  </table>
  <br/>
  <div class='buttons'>
  <input type='hidden' id='action' name='action' value='' />
    <button type='submit' value="Delete Selected" onclick='return changeAction("delete");'><?php echo 'Delete Selected';?></button>
        
  </div>
 </form>
    </div>
    </div>
</div>