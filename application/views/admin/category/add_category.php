  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
$(function() {
$( "#datepicker" ).datepicker();
});
</script>
     
<div style="font-size:12px">

<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
	
		<?php if(isset($result)){
		//pr($result);
	
		 ?>
		
		
			<input type="hidden" name="id" value="<?php echo @$result[0]->id ?>" />
		<?php } ?>		
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>Category *</td><td><input maxlength="55" type="text" name="cat_name" style="width:95%" value="<?php 
				echo @$result[0]->cat_name;echo @$cat_name; ?>" /></td><td><div class="error"><?php echo form_error("cat_name"); ?></div></td>
			</tr>
		
			
			
			
				
			
						
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_category"><?php echo $this->uri->segment(4)? 'Update':'Add';?></button> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></td>
			</tr>
		</table>
	</form>
</div>
</div>