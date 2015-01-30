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
				<td>Job Title *</td><td><input maxlength="55" type="text" name="job_title" style="width:95%" value="<?php 
				echo @$result[0]->job_title;echo @$job_title; ?>" /></td><td><div class="error"><?php echo form_error("job_title"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Job Detail*</td>
				<td><input maxlength="55" type="text" name="job_detail" id="job_detail" style="width:95%" value="<?php echo @$result[0]->job_detail;echo @$job_detail; ?>"/></td><td><div class="error"><?php echo form_error("job_detail"); ?></div></td>
			</tr>
			
			
			
			<tr style="height:40px;">
				<td>Country* </td><td><input maxlength="50"  type="text" name="country" style="width:95%" value="<?php echo @$result[0]->country;echo @$country; ?>"/></td><td style="width:40%"></span><div class="error"><?php echo form_error("country"); ?></div></td>
			</tr>
			
			<tr style="height:40px;">
				<td>State* </td><td><input maxlength="50"  type="text" name="state" style="width:95%" value="<?php echo @$result[0]->state;echo @$state; ?>"/></td><td style="width:40%"></span><div class="error"><?php echo form_error("state"); ?></div></td>
			</tr>
	
	
			<tr style="height:40px;">
				<td>Comments </td><td><input maxlength="10"  type="text" name="comments" style="width:95%" value="<?php echo @$result[0]->comments;echo @$comments; ?>"/></td><td style="width:40%"></span><div class="error"><?php echo form_error("comments"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Budget* </td><td><input maxlength="10"  type="text" name="budget" style="width:95%" value="<?php echo @$result[0]->budget;echo @$budget; ?>"/></td><td style="width:40%"></span><div class="error"><?php echo form_error("budget"); ?></div></td>
			</tr>
			
			
		
	
			<td>End Date *</td><td><input type="text" maxlength="50" id="datepicker" name="end_date" style="width:95%" value="<?php if(!empty($result[0]->end_date)){
					$date=explode("-",$result[0]->end_date);
					echo $date[2]."/".$date[1]."/".$date[0];
					}  else
					{
						echo @$end_date;
					}
					 ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("end_date"); ?></div></td>
			</tr>

			<tr style="height:40px;">
				<td>Category *</td><td>			
				<select name="cat_name" id="cat_name" style="width:95%">
										<option value="">Select category</option>
					<?php
					
					foreach($category as $row)
					{
					
					
					?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result[0]->job_cat== $row->id){echo 'selected="selected"'; }?> <?php if(@$cat_name==$row->id){echo 'selected="selected"'; }?>><?php echo $row->cat_name; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td><td style="width:40%"><div class="error"><?php echo form_error("cat_name"); ?></div></td>
			</tr>
				
			
						
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_job"><?php echo $this->uri->segment(4)? 'Update':'Add';?></button> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></td>
			</tr>
		</table>
	</form>
</div>
</div>