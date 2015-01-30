<div style="font-size:12px">
<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">
		<?php if(isset($result)){ ?>
			<input type="hidden" name="id" value="<?php echo @$result[0]->id; ?>" />
		<?php } ?>	
				<table align="center"  style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>Job Category</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->cat_name;?></div></td><td style="width:40%"></td>
			</tr>	
			<tr style="height:40px;">
				<td>Job Title</td><td><div style="width:300px;padding-left:20px"><?php echo @$result[0]->job_title;?></div></td><td style="width:40%"></td>
			</tr>		
			
			<tr style="height:40px;">
				<td >Additional Comments </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->comments;?></div></td><td style="width:40%"></td>
			</tr>
			
			</tr>
			
			
			<tr style="height:40px;">
				<td >Budget </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->Budget;?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >Country </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->country;?></div></td><td style="width:40%"></td>
			</tr>
			<tr style="height:40px;">
				<td >State </td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->state;?></div></td><td style="width:40%"></td>
			</tr>
			
				
			<tr style="height:40px;">
				<td >Created Date</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->created_date;?></div></td><td style="width:40%"></td>
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
				<td >End Date</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->end_date;?></div></td><td style="width:40%"></td>
			</tr>
		<tr style="height:40px;">
			<td colspan="3"><h3>Extra Information</h3></td>
			</tr>
				
		<tr style="height:40px;">
			<td >Total Applications</td><td><div style="width:300px;padding-left:20px;word-wrap:break-word;"><?php echo @$result[0]->total_bids;?></div></td><td style="width:40%"></td>
			</tr>
				
		</table>
		
		
	</form>
</div>
</div>