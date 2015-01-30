<div style="font-size:12px;line-height:none">
<h2> <?php echo $title; ?></h2>
<div class="addform">
<form action="<?php echo base_url(); ?>admin/login/change_password" method="POST" class="login">
				<!----- show flash message----->
				 <?php echo $this->session->flashdata('success')!=''?'<p>'.$this->session->flashdata('success').'.</p>':''; ?>
                 <!----- end flash message----->
				<table align="center" style="padding-left: 104px; width:88%;">
				 <!----- change admin Username ----->
				<tr style="height:40px;">
						<td><span>&nbsp;</span><?php echo 'Username ';?>: </td>
						<td><input type="text" name="email" maxlength="50" style="width:100%"  value="<?php echo @$result['0']['email_id'];echo @$email; ?>" />
						</td><td style="width:40%"><div style="color:red; font-weight:bold; margin-left:20px;" >(If you want change username)</div></td>
					</tr>
                <!----- change admin password ----->
					<tr style="height:40px;">
						<td><span>&nbsp;</span><?php echo 'Old Password ';?>: </td>
						<td><input type="password" name="oldpassword" maxlength="50" style="width:100%"  value="<?php echo @$oldpassword;?>" >
						</td><td style="width:40%"><div class="error" style="margin-left:20px;"><?php echo form_error("oldpassword"); ?></div></td>
					</tr>
                     
                    <tr style="height:40px;">
						<td><span>&nbsp;</span><?php echo 'New Password ';?>: </td>
						<td><input type="password" name="newpassword" maxlength="50" style="width:100%"  value="<?php echo @$newpassword;?>" >
						</td><td style="width:40%"><div class="error" style="margin-left:20px;"><?php echo form_error("newpassword"); ?></div></td>
					</tr>
                    
                    <tr style="height:40px;">
						<td><span>&nbsp;</span><?php echo 'Confirm Password';?>: </td>
						<td><input type="password" name="passconf" maxlength="50" style="width:100%"  value="<?php echo @$passconf;?>" >
						</td><td style="width:40%"><div class="error" style="margin-left:20px;"><?php echo form_error("passconf"); ?></div></td>
					</tr>
                    <tr>
                    <td style="font-weight:bold;"></td>
	     <td><input type="hidden" id="id" name="id" value="<?php echo $this->session->userdata('admin_id')?>"/></td></tr>
         
         <tr><td><button type="submit" class="buttons" name="submit" id="submit"><?php echo 'Change';?></button>
         <button type="button" class="buttons" name="cancel" id="cancel" onClick="location.href='<?php echo base_url().'admin/login/welcome'; ?>'"><?php echo 'Cancel';?></button></td></tr>
         </table>
         
        
         </form>
</div>
         </div>
        