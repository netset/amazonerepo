<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script>

</script>


<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result) || @$assistant_id!=''){ ?>
			<input type="hidden" name="id" id="id" value="<?php echo @$result[0]->id ;  echo @$assistant_id ;?>" />
		<?php } ?>		
		<table align="center" style=" padding-left: 104px; width:88%;">	
		
		
		<tr style="height:40px;">
				<td>Reciever *</td><td>			
				<select name="first_name" id="first_name" style="width:95%">
										<option value="">Select user</option>
					<?php
					
					foreach($user as $row)
					{
					  //pr($user); die;
					?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result[0]->sender_id== $row->id){echo 'selected="selected"'; }?> <?php if(@$first_name==$row->id){echo 'selected="selected"'; }?>><?php echo $row->first_name; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td><td style="width:40%"><div class="error"><?php echo form_error("first_name"); ?></div></td>
			</tr>
			
			
			<tr style="height:40px;">
				<td>Message *</td><td style="max-width:100px;"><textarea cols="30" rows="5" name="message" style="width:258px;max-width:258px;"><?php echo @$result->message;echo @$message; ?></textarea></td><td><div class="error"><?php echo form_error("message"); ?></div></td>
			</tr>
							
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_message"><?php echo $this->uri->segment(4)? 'Update':'Send';?></button><a href="<?php echo base_url();?>admin/manage_message/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>