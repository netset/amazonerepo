<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
var s_id = '<?php if(empty($user_country))  echo @$result->country_id;  else  echo @$user_country ; ?>';
$.post('<?php echo base_url(); ?>admin/manage_profile/get_state',{'country_id':s_id},function(data){
  $('#user_state').html(data);
  <?php if(isset($user_state)){ ?>
  $('#user_state').val('<?php echo @$user_state ?>');
  <?php }else{?>
  $('#user_state').val('<?php echo @$result->state_id ?>');
  <?php }?>
 });
var state_id = '<?php if(empty($user_state)) echo @$result->state_id; else echo @$user_state; ?>';
$.post('<?php echo base_url(); ?>admin/manage_profile/get_city',{'state_id':state_id},function(data){
  $('#user_city').html(data);
  <?php if(isset($user_city)){ ?>
  $('#user_city').val('<?php echo @$user_city ?>');
  <?php }else{?>
  $('#user_city').val('<?php echo @$result->city_id ?>');
  <?php }?>
 });
});


function get_state(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_profile/get_state',{'country_id':id},function(data){
  $('#user_state').html(data);
 });
}
function get_city(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_profile/get_city',{'state_id':id},function(data){
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
				<td>First Name *</td><td><input type="text" maxlength="50" name="user_first_name" style="width:95%" value="<?php echo @$result->first_name;  echo @$user_first_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_first_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Last Name </td><td><input type="text" maxlength="50" name="user_last_name" style="width:95%" value="<?php echo @$result->last_name;echo @$user_last_name;?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_last_name"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Email *</td><td><input type="text" name="user_email" maxlength="50" style="width:95%" value="<?php echo @$result->email_id;echo @$user_email; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("user_email"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Profile Picture </td><td><input type="file" name="image" style="width:95%" value="<?php echo @$result->image;echo @$image; ?>" /></td><td><img style="max-width:100px;max-height:100px;" alt="No image selected" src="<?php echo base_url(); ?>public/uploads/<?php $res=$this->session->userdata('pic_name');if(!empty($res)){	echo $this->session->userdata('pic_name');}else
{
echo "admin.jpg";
}	   ?>" /><div class="error"><?php echo @$mess;echo form_error("image"); ?></div></td>
			</tr>
			<tr>			
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_user"><?php echo $this->uri->segment(4)? 'ADD':'Update';?></button><a href="<?php echo base_url();?>admin/manage_user/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>