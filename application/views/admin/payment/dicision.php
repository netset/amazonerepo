<div style="font-size:12px">
<h2> Update Job Status !!</h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($id)){ ?>
			<input type="hidden" name="id" value="<?php echo $id ?>" />
		<?php } ?>	
<!--        personel          -->
		<table align="center" style=" padding-left: 350px; width:60%;">		
					<tr>			
				<td align="right">  </td>
				<td align="left"> </button> <a href="<?php echo base_url();?>admin/manage_payment/approve/<?php echo $id;?>"><button type="button" class="buttons" name="cancel" ><?php echo 'Approve';?></button></a></td>
			<!--	<td align="left"> </button> <a href="<?php echo base_url();?>admin/manage_payment/reject/<?php echo $id;?>"><button type="button" class="buttons" name="cancel" ><?php echo 'Reject';?></button></a></td>-->
			</tr>
		</table>
		
		
	</form>
</div>
</div>