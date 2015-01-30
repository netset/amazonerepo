<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
var s_id = '<?php if(empty($user_country))  echo @$result->country_id;  else  echo @$user_country ; ?>';
$.post('<?php echo base_url(); ?>admin/manage_employee/get_state',{'country_id':s_id},function(data){
  $('#user_state').html(data);
  <?php if(isset($user_state)){ ?>
  $('#user_state').val('<?php echo @$user_state ?>');
  <?php }else{?>
  $('#user_state').val('<?php echo @$result->state_id ?>');
  <?php }?>
 });
   /*var id=$('#id').val();
   if(typeof id === "undefined")
   {
		$('#pass').show();
   }
   else if(id!='')
   {
		$('#pass').hide();
   }*/
 
});


function get_state(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_employee/get_state',{'country_id':id},function(data){
  $('#user_state').html(data);
 });
}
function get_city(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_employee/get_city',{'state_id':id},function(data){
  $('#user_city').html(data);
 });
}
</script>


<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result) || @$user_id!=''){ ?>
			<input type="hidden" name="id" id="id" value="<?php echo @$result->id ;  echo @$user_id ;?>" />
		<?php } ?>		
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>User Name *</td><td><input type="text" maxlength="50" name="user_name" style="width:95%" value="<?php echo @$result->username;  echo @$user_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_name"); ?></div></td>
			</tr>
			<tr style="height:40px;" id="pass">
				<td>Password *</td><td><input type="password" maxlength="50" name="user_pass" style="width:95%" value="<?php echo @$result->password;echo @$user_pass;?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_pass"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>First Name *</td><td><input type="text" maxlength="50" name="user_first_name" style="width:95%" value="<?php echo @$result->fname;  echo @$user_first_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_first_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Last Name *</td><td><input type="text" maxlength="50" name="user_last_name" style="width:95%" value="<?php echo @$result->lname;echo @$user_last_name;?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_last_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Email *</td><td><input type="text" name="user_email" maxlength="50" style="width:95%" value="<?php echo @$result->email;echo @$user_email; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_email"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Default Department *</td><td>			
				<select name="user_depart" id="user_depart" style="width:95%">
										<option value="">Select Department</option>
					<?php
					foreach($departments as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result->department_id==$row->id){echo 'selected="selected"'; }?> <?php if(@$user_depart==$row->id){echo 'selected="selected"'; }?>><?php echo $row->dept_name; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td><td style="width:40%"><div class="error"><?php echo form_error("user_depart"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Default Assistant *</td>
				<td>
					<select name="user_assist" style="width:95%">
										<option value="">Select Assistant</option>
					<?php
					foreach($assistants as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result->assistant_id==$row->id){echo 'selected="selected"'; }?> <?php if(@$user_assist==$row->id){echo 'selected="selected"'; }?>><?php echo $row->assist_fname; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td>
				<td style="width:40%"><div class="error"><?php echo form_error("user_assist"); ?></div></td>
			</tr>
			<tr>			
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_employee"><?php echo $this->uri->segment(4)? 'Update':'Add';?></button><a href="<?php echo base_url();?>admin/manage_employee/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>