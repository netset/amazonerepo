<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function(){
		$('#bbtn').click(function(){
			$('#forgotform').submit();			
		});
	});
	
	function validate(){
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; 
		if($('#txtEmail').val()!=''){
			if(mailformat.test($('#txtEmail').val())==false)
			{
				$('.status').html("<div class='status' style='color:red; margin-left:-130px;'>Please enter valid e-mail</div>");
				document.getElementById('email_status').style.display = 'none';
			}
			else
			{
				return true;
			}
		}
		else{
			$('.status').html("<div class='status' style='color:red; margin-left:-130px;'>Please enter e-mail</div>");
			document.getElementById('email_status').style.display = 'none';
		}
		return false;
	}
</script>

<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form  id="forgotform" onSubmit="return validate()" style="padding-top:4px" method="POST" action="" enctype="multipart/form-data">
			
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<div id='email_status'><?php echo @$status!='' ? @$status:''; ?></div>
			<tr style="height:40px;">
				<td>Email</td><td><input type="text" name="txtEmail" id="txtEmail" maxlength="50" value="" style="width:200px;"/></td><td style="width:40%"><div class="status"></div></td>
			</tr>
			<tr>			
				<td align="right">  </td>
				<td align="left"> <a href="javascript:void(0)" id="bbtn"> <button type="botton" class="buttons" name="forgot">Submit</button> 
				<a href="<?php echo base_url() ?>admin/login/index" ><button type="button" class="buttons" name="cancel" ><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>