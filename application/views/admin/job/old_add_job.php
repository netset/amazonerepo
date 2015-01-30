<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script>
$(document).ready(function(){
var s_id = '<?php if(empty($job_assign))  echo @$result[0]->emp_id;  else  echo @$job_assign ; ?>';
$.post('<?php echo base_url(); ?>admin/manage_job/get_assist',{'assign_id':s_id},function(data){
		 $('#job_assist1').html(data);
		 $.post('<?php echo base_url(); ?>admin/manage_job/get_assist_id',{'emp_id':s_id},function(data){
		   $('#job_assist1').val(data);
		 });	 
		 });



		<?php if(!empty($assistants) || !empty($assistant_id) || !empty($hours)) { ?>
		$(".assistant1").show();	
		<?php }else{ ?>
		$(".assistant1").hide();	
		<?php
		}
		?>
		
		<?php
		if(@$job_opt=='1' || @$result[0]->job_num_option=='1')
		{
		?>
			$("#manual").show();
		<?php
		}
		else if(@$job_opt=='0')
		{
		?>
			$("#manual").hide();
		<?php
		}
		else
		{
		?>
			$("#manual").hide();
		<?php }
		?>
});
	
</script>
						<script>
			function check_job_no()
			{
				  var job_name= $("#job_name").val();	

	  var url = "http://localhost/Savaria/admin/manage_job/check_job";
				$.ajax({  
					type: "POST",  
					url: url,  
					data: {"job_no":job_name} ,
					success: function(data)
								{ 
		// alert(data);
				$("#err").html(data);		 
								}  
				});
			return false; 				  
			}

function get_assist(id)
{
 $.post('<?php echo base_url(); ?>admin/manage_job/get_assist',{'assign_id':id},function(data){
  $('#job_assist1').html(data);
 });
}
			
			
			</script>
<div style="font-size:12px">

<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result)){ ?>
			<input type="hidden" name="id" value="<?php echo $result[0]->id ?>" />
		<?php } ?>		
		<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<!--<td>Job Number *</td><td><input maxlength="50" type="text" name="job_name" style="width:95%" value="<?php echo @$result[0]->job_num;echo @$job_name; ?>"/></td><td style="width:40%"><div class="error"><?php echo form_error("job_name"); ?></div></td>
				--><td>Job Number *</td><td>			Automatic&nbsp;&nbsp;<input type="radio" name="job_opt" value="0" onchange="check_opt(this.value);" <?php if(@$job_opt== 0){ echo 'checked="checked"';} ?>>&nbsp;&nbsp;
			Manual&nbsp;&nbsp;<input type="radio" name="job_opt" value="1" onchange="check_opt(this.value);" <?php if(@$job_opt== 1 || @$result[0]->job_num_option){ echo 'checked="checked"';} ?> ></td><td style="width:40%"><div class="error"><?php echo form_error("job_opt"); ?></div></td>
			</tr>
			<tr style="height:40px;" id="manual">
			<td>Job Number *</td><td><input maxlength="50" type="text" name="job_name" id="job_name" style="width:95%" value="<?php echo @$result[0]->job_num;echo @$job_name; ?>" onblur="check_job_no();"/></td><td style="width:40%"><div class="error" id="err"><?php echo form_error("job_name"); ?></div>
			</td>
			</tr>
			<script>
			function check_opt(val)
			{
				if(val==1)
				{
					$("#manual").show();
				}
				else
				{
					$("#manual").hide();
				}				
			}
			</script>


			<tr style="height:40px;">
				<td>Job Description *</td><td><textarea maxlength="510" name="job_desc" style="width:260px;max-width:260px; margin-bottom:10px;"><?php echo @$result[0]->job_descr;echo @$job_desc; ?></textarea></td><td><div class="error"><?php echo form_error("job_desc"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td>Job Hours *</td><td><input maxlength="10" placeholder="optional" type="text" name="job_time" style="width:95%" value="<?php echo @$result[0]->job_hours;echo @$job_time; ?>"/></td><td style="width:40%"><span style="color:red">hh:mm</span><div class="error"><?php echo form_error("job_time"); ?></div></td>
			</tr>

			<tr style="height:40px;">
				<td>Job Assign To *</td><td>
					<select name="job_assign" style="width:95%" onchange="get_assist(this.value)">
					<option value="" ><?php echo 'Select'; ?></option>
					<?php
					foreach($employee as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result[0]->emp_id==$row->id || @$job_assign==$row->id){echo 'selected="selected"'; }?>><?php echo $row->fname; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td><td><div class="error"><?php echo form_error("job_assign"); ?></div></td>
			</tr>
			<tr style="height:40px;">
				<td><a href="#" onclick="return checkradio(this.value);" >Add an Assistant</a></td>
				<td></td>	
				<td></td>
			</tr>
						<script>
			function checkradio(val)
			{
				$(".assistant1").toggle();	
				return false;					
			}
			</script>
			<tr style="height:40px;" class="assistant1">
				<td>Assistant *</td><td>
					<select name="job_assist1" id="job_assist1" style="width:95%">
					<!--<option value="" ><?php //echo 'Select'; ?></option>	-->		
					<?php
					/* foreach($employee as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$assistants[0]->assistant_id==$row->id || @$assistant_id==$row->id){echo 'selected="selected"'; }?>><?php echo $row->fname; ?> </option>
						
					<?php
					} */
					?>
					</select>
				</td><td><div class="error"><?php echo form_error("job_assist1"); ?></div></td>
			</tr>
			<tr style="height:40px;" class="assistant1">
				<td>Job Hours *</td><td><input maxlength="10" type="text" name="job_time1" style="width:95%" value="<?php echo @$assistants[0]->hours;echo @$hours; ?>"/></td><td style="width:40%"><span style="color:red">hh:mm</span><div class="error"><?php echo form_error("job_time1"); ?></div></td>
			</tr>
			<tr>			
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name="add_job"><?php echo $this->uri->segment(4)? 'Update':'Add';?></button><a href="<?php echo base_url();?>admin/manage_job/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>