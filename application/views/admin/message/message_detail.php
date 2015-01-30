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

			<tr style="height:40px;">
				<td>Sender</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->sender;?></div></td><td style="width:40%"></td>
			</tr>	
				
			<tr style="height:40px;">
				<td>Reciever</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->receiver?></div></td><td style="width:40%"></td>

			</tr>

			<tr style="height:40px;">
				<td>Description</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->message;?></div></td><td style="width:40%"></td>
			</tr>

			
		
			
	


</div></td><td style="width:40%"></td>
			</tr>
			
		
		</table>
		
		
	</form>
</div>
</div>