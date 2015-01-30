<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result)){ ?>
			<input type="hidden" name="id" value="<?php echo @$result[0]->id; ?>" />
		<?php } ?>	
				<table align="center"  style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>Job Category</td><td><div style="width:300px;padding-left:20px"><?php echo ucwords(@$result[0]->cat_name);?></div></td><td style="width:40%"></td>
			</tr>	
			<tr style="height:40px;">
				<td>Job Title</td><td><div style="width:300px;padding-left:20px"><?php echo ucwords(@$result[0]->job_title);?></div></td><td style="width:40%"></td>
			</tr>		
			<tr style="height:40px;">
				<td>Job Posted By</td><td><div style="width:300px;padding-left:20px"><?php echo ucwords(@$result[0]->owner);?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >Applicant Name</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo ucwords(@$result[0]->sp_name);?></div></td><td style="width:40%"></td>
			</tr>
			
			
			
			
			<tr style="height:40px;">
				<td >Actual Budget </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo "$".ucwords(@$result[0]->budget);?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >Bid Amount </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo "$".ucwords(@$result[0]->bid_amount);?></div></td><td style="width:40%"></td>
			</tr>
	
				
			<tr style="height:40px;">
				<td >Deleivery Date</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo ucwords(@$result[0]->deleivery_date);?></div></td><td style="width:40%"></td>
			</tr>
			
			
				<tr style="height:40px;">
<td >Job Status</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;">
<?php  @$result[0]->job_status;
if( @$result[0]->job_status==0)
{
echo"PENDING";
}
elseif(@$result[0]->job_status==1)
{

echo"IN PROGRESS";
}
else
{
echo"COMPLETED";
}


?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
<td >Hired</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;">
<?php  if( @$result[0]->is_hired==0)
{
echo"No";
}
else
{

echo"YES";
}



?></div></td><td style="width:40%"></td>
			</tr>	
		</table>
		
		
	</form>
</div>
</div>
