<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
var s_id = '<?php if(empty($user_country))  echo @$result->country;  else  echo @$user_country ; ?>';
$.post('<?php echo base_url(); ?>admin/manage_user/get_state',{'country_id':s_id},function(data){
  $('#user_state').html(data);
  <?php if(isset($user_state)){ ?>
  $('#user_state').val('<?php echo @$user_state ?>');
  <?php }else{?>
  $('#user_state').val('<?php echo @$result->state ?>');
  <?php }?>
 });
var state_id = '<?php if(empty($user_state)) echo @$result->state; else echo @$user_state; ?>';
$.post('<?php echo base_url(); ?>admin/manage_user/get_city',{'state_id':state_id},function(data){
  $('#user_city').html(data);
  <?php if(isset($user_city)){ ?>
  $('#user_city').val('<?php echo @$user_city ?>');
  <?php }else{?>
  $('#user_city').val('<?php echo @$result->city ?>');
  <?php }?>
 });
});


function get_state(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_user/get_state',{'country_id':id},function(data){
  $('#user_state').html(data);
 });
}
function get_city(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_user/get_city',{'state_id':id},function(data){
  $('#user_city').html(data);
 });
}
</script>


<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result)){ ?>
			<input type="hidden" name="id" value="<?php echo $result->id ?>" />
		<?php } ?>		
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>User Name *</td><td><input type="text" maxlength="50" name="user_name" style="width:95%" value="<?php echo @$result->username;  echo @$user_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>First Name *</td><td><input type="text" maxlength="50" name="user_first_name" style="width:95%" value="<?php echo @$result->first_name;  echo @$user_first_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_first_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Last Name *</td><td><input type="text" maxlength="50" name="user_last_name" style="width:95%" value="<?php echo @$result->last_name;echo @$user_last_name;?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_last_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Gender *</td><td>Male<input type="radio" name="user_gender" style="width:20%"  <?php echo (@$result->gender=='M')? 'checked="checked"':''?>  <?php echo (@$user_gender=='M')? 'checked="checked"':''?>  value="M">Female<input type="radio" name="user_gender" style="width:20%" <?php echo (@$result->gender=='F')? 'checked="checked"':''?>  <?php echo (@$user_gender=='F')? 'checked="checked"':''?>  value="F"></td><td style="width:40%"><div class="error"><?php echo form_error("user_gender"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Email *</td><td><input type="text" name="user_email" maxlength="50" style="width:95%" value="<?php echo @$result->email;echo @$user_email; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_email"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Address *</td><td style="max-width:100px;"><textarea maxlength="100" name="user_address" style="width:258px;max-width:258px;"><?php echo @$result->address;echo @$user_address; ?></textarea></td><td><div class="error"><?php echo form_error("user_address"); ?></div></td>
			</tr>
<!--			<tr style="height:40px;">
				<td>Country *</td><td><input type="text" maxlength="50" name="user_country" style="width:95%" value="<?php echo @$result->country;echo @$user_country;?>" /></td><td><div class="error"><?php echo form_error("user_country"); ?></div></td>
			</tr> -->
			<tr style="height:40px;">
				<td>Country *</td>				<td>
					<select name="user_country" id="user_country" onchange="get_state(this.value)" style="width:95%">
										<option value="">Select Country</option>
					<?php
					foreach($countries as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result->country==$row->id){echo 'selected="selected"'; }?> <?php if(@$user_country==$row->id){echo 'selected="selected"'; }?>><?php echo $row->country_name; ?> </option>';-->
						
					<?php
					}
					?>
					</select>
				</td><td style="width:40%"><div class="error"><?php echo form_error("user_country"); ?></div></td>
			</tr>
					<!--	<tr style="height:40px;">
				<td>State *</td><td><input type="text" maxlength="50" name="user_state" id="user_state" style="width:95%" value="<?php echo @$result->state;echo @$user_state;?>" /></td><td><div class="error"><?php echo form_error("user_state"); ?></div></td>
			</tr>-->
			
			<tr style="height:40px;">
				<td>State *</td><td>
					<select name="user_state" id="user_state" onchange="get_city(this.value)" style="width:95%">
					</select>
				</td>
				<td style="width:40%"><div class="error"><?php echo form_error("user_state"); ?></div></td>
			</tr>
			<!--<tr style="height:40px;">
				<td>City *</td><td><input type="text" maxlength="50" name="user_city" id="user_city" style="width:95%" value="<?php echo @$result->city;echo @$user_city; ?>" /></td><td><div class="error"><?php echo form_error("user_city"); ?></div></td>
			</tr>-->
			<tr style="height:40px;">
				<td>City *</td><td>
					<select name="user_city" id="user_city" style="width:95%">

					</select>
				</td>
				<td style="width:40%"><div class="error"><?php echo form_error("user_city"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Phone *</td><td><input type="text" maxlength="15" name="user_phone" style="width:95%" value="<?php echo @$result->phone;echo @$user_phone;?>" /></td><td><div class="error"><?php echo form_error("user_phone"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Status *</td>
				<td>
					<select name="user_status" style="width:95%">
						<option value="1" <?php if(@$result->status=='1'){echo 'selected="selected"'; }?>  <?php if(@$user_status=='1'){echo 'selected="selected"'; }?>><?php echo 'Active'; ?></option>
						<option value="0" <?php if(@$result->status=='0'){echo 'selected="selected"'; }?>  <?php if(@$user_status=='0'){echo 'selected="selected"'; }?>><?php echo 'Inactive'; ?></option>
					</select>
				</td>
			</tr>
			<tr>			
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_school"><?php echo $this->uri->segment(4)? 'Update':'Add';?></button><a href="<?php echo base_url();?>admin/manage_user/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>