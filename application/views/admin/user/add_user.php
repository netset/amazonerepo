<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result)){ ?>
		
	
		 
			<input type="hidden" name="id" id="id" value="<?php echo @$result->id ;  echo @$id ;?>" />
		<?php }
		 ?>	
		
		
		
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>First Name *</td><td><input type="text" maxlength="50" name="first_name" style="width:95%" value="<?php echo @$result[0]->first_name;  echo @$first_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("first_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Last Name *</td><td><input type="text" maxlength="50" name="last_name" id="last_name" onblur="get_job_no(this.value)"  style="width:95%" value="<?php echo @$result[0]->last_name;  echo @$last_name; ?>"/></td><td style="width:40%"><div class="error" id="last_name"><?php echo form_error("last_name"); ?></div></td>
			</tr>
			
			<tr style="height:40px;">
				<td>Email *</td><td><input type="text" maxlength="50" name="email_id" id="email_id" onblur="email_id(this.value)"  style="width:95%" value="<?php echo @$result[0]->email_id;  echo @$email_id; ?>"/></td><td style="width:40%"><div class="error" id="email_id"><?php echo form_error("email_id"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Password *</td><td><input type="password" maxlength="50" name="password" id="email_id" onblur="password(this.value)"  style="width:95%" value="<?php echo @$result[0]->password;  echo @$password; ?>"/></td><td style="width:40%"><div class="error" id="password"><?php echo form_error("password"); ?></div></td>
			</tr>
			
			
			<tr style="height:40px;">
				<td>Mobile No. *</td><td><input type="text" maxlength="50" name="mobile" id="mobile " onblur="mobile(this.value)"  style="width:95%" value="<?php echo @$result[0]->mobile;  echo @$mobile; ?>"/></td><td style="width:40%"><div class="error" id="mobile"><?php echo form_error("mobile"); ?></div></td>
			</tr>
			
			
			<tr style="height:40px;">
				<td>Address *</td><td><input type="text" maxlength="50" name="address" id="address" onblur="address(this.value)"  style="width:95%" value="<?php echo @$result[0]->address;  echo @$address; ?>"/></td><td style="width:40%"><div class="error" id="address"><?php echo form_error("address"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>About *</td><td><input type="text" maxlength="50" name="about" id="about" onblur="about(this.value)"  style="width:95%" value="<?php echo @$result[0]->about;  echo @$about; ?>"/></td><td style="width:40%"><div class="error" id="about"><?php echo form_error("about"); ?></div></td>
			</tr>
					
			<tr style="height:40px;">
				<td>Occupation *</td><td><input type="text" maxlength="50" name="occupation" id="occupation" onblur="occupation(this.value)"  style="width:95%" value="<?php echo @$result[0]->occupation;  echo @$occupation; ?>"/></td><td style="width:40%"><div class="error" id="occupation"><?php echo form_error("occupation"); ?></div></td>
			</tr>
			
			</table> 
		
	
			
			<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>Role *</td><td>			
				<select name="role" id="role" style="width:95%"  onchange="role_data(this.value);">
				      <option value="">Select Role</option>
				      <option value="1" <?php if(@$result[0]->role==1 || @$role==1){echo 'selected="selected"'; }?>>customer</option>
				      <option value="2" <?php if(@$result[0]->role==2 || @$role==2){echo 'selected="selected"'; }?>>service provider</option>
					</select>
				</td><td style="width:40%"><div class="error"><?php echo form_error("role"); ?></div></td>
			</tr>
			</table>
		<table align="center" id="sp_role" class="role_data" style=" padding-left: 104px; width:88%;">	
			<?php //if(@$result[0]->role == 2) {?>
		

			
			<tr style="height:40px;">
				<td>Work History *</td><td><input type="text" maxlength="50" name="work_history" id="work_history" onblur="work_history(this.value)"  style="width:95%" value="<?php echo @$result[0]->work_history;  echo @$work_history; ?>"/></td><td style="width:40%"><div class="error" id="work_history"><?php echo form_error("work_history"); ?></div></td>
			</tr>
			
			<tr style="height:40px;">
				<td>Training *</td><td><input type="text" maxlength="50" name="training" id="training" onblur="training(this.value)"  style="width:95%" value="<?php echo @$result[0]->training;  echo @$training; ?>"/></td><td style="width:40%"><div class="error" id="training"><?php echo form_error("training"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Category *</td><td>
					<select name="cat_name" style="width:95%" >
					<option value="" ><?php echo 'Select Category'; ?></option>
					<?php
					foreach($category as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result[0]->cat_id==$row->id || @$cat_name==$row->id){echo 'selected="selected"'; }?>><?php echo $row->cat_name; ?> </option>
						
					<?php
					}
					?>
					</select>
					</td><td style="width:40%"><div class="error" id="cat_name"><?php echo form_error("cat_name"); ?></div></td>
					
			</tr>
			<tr style="height:40px;">
				<td>Experience *</td><td><input type="text" maxlength="50" name="experience" id="experience" onblur="experience	(this.value)"  style="width:95%" value="<?php echo @$result[0]->experience;  echo @$experience; ?>"/></td><td style="width:40%"><div class="error" id="experience	"><?php echo form_error("experience"); ?></div></td>
			</tr>

			<?php // } ?>
						</table>
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr>			
				<td align="right">  </td>
				<td align="left"> <button type="submit" onClick="return get_job_no();" class="buttons" name="add_user"><?php echo $this->uri->segment(4)? 'Update':'Add';?></button><a href="<?php echo base_url();?>admin/manage_user/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>

  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
      <script>
$(document).ready(function(){

		$(".role_data").hide();	
		<?php if(@$role == 1 || @$result[0]->role == 1){?>
			$("#c_role").show();
		<?php }
		if(@$role == 2 || @$result[0]->role == 2){?>
			$("#sp_role").show();
		<?php }?>
		//$(".role").hide();	
});

function role_data(role)
{
if(role == 2)
{
	$("#sp_role").show();	
	$("#c_role").hide();	
}
else
{
	$("#sp_role").hide();
	$("#c_role").show();	
}
} onchange="role_data(this.value);"

</script>


<script>
function get_job_no()
{
	var id=$('#cust_job_no').val();
	 $.post('<?php echo base_url(); ?>admin/manage_user/get_job_no',{'job_no':id},function(data){
		$('#job_no_check').html(data);
		if(data=="<span style='color:green;'>Available</span>")
		{
			return true;
		}else
		{
			alert("Job Number Already Exist");
			return false;
		}
	 });
}

</script>