<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result)){
		//pr($result); die;
		 ?>
			<input type="hidden" name="id" value="<?php echo @$result[0]->id; ?>" />
		<?php } ?>	
				<table align="center"  style=" padding-left: 104px; width:88%;">	
<?php if(@$result[0]->role == 1) {?>
			<tr style="height:40px;">
				<td>First Name</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->first_name;?></div></td><td style="width:40%"></td>
			</tr>	
				
			<tr style="height:40px;">
				<td>Last Name</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->last_name?></div></td><td style="width:40%"></td>

			</tr>
<?php } else{?>
			<tr style="height:40px;">
				<td>Name</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->first_name;?></div></td><td style="width:40%"></td>
			</tr>
<?php }?>
			
			<tr style="height:40px;">
				<td >Email </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->email_id;?></div></td><td style="width:40%"></td>
			</tr>
			
			</tr>
			<tr style="height:40px;">
				<td >Address </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->address;?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >Occupation </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->occupation;?></div></td><td style="width:40%"></td>
			</tr>
			<?php if($result[0]->role == 2){ ?>
			<tr style="height:40px;">
				<td >Work History </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->work_history;?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >Training </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->training;?></div></td><td style="width:40%"></td>
			</tr>
						
			<tr style="height:40px;">
				<td >About </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->about;?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
			<td >Category </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->cat_name;?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >Experience </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->experience;?></div></td><td style="width:40%"></td>
			</tr>
			<?php }?>
				
			<tr style="height:40px;">
<td >Role</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;">
<?php  @$result[0]->role;
if( @$result[0]->role==2)
{
echo"ServiceProvider";
}

else
{
echo"Customer";
}


?></div></td><td style="width:40%"></td>
			</tr>
			
			

			
		

			
					
					<?php 
				 if(!empty($assistants)){ ?>
						<tr style="height:40px;"><th colspan="3">Assistants</th>
					</tr>
					
					
			<tr style="height:40px;">
				<td >Assistant Name  </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo $value->assist_fname;?></div></td><td style="width:40%"></td>
			</tr>
						<tr style="height:40px;">
				<td >Assistant Hours</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php  if(!empty($value->hours)){ echo $value->hours,":",$value->mins;}?></div></td><td style="width:40%"></td>
			</tr>
					
					<?php
					}
					?>
		</table>
		
		
	</form>
</div>
</div>