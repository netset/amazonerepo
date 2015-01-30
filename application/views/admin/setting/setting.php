<div style="font-size:12px">

<h2> <?php echo $title; ?></h2>
<div class="addform">
	<form action=""  method="POST" enctype="multipart/form-data">

				<table align="center" style=" padding-left: 104px; width:88%;">	
			<tr style="height:40px;">
				<td>Default department *</td>				<td>
					<select name="depart" style="width:95%">
					<?php
					foreach($departments as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result[0]->default_value==$row->id){echo 'selected="selected"'; }?>><?php echo $row->dept_name; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td>
			</tr>
			<tr style="height:40px;">
				<td>Default Assistent *</td>				<td>
					<select name="assist" style="width:95%">
					<?php
					foreach($employee as $row)
					{?>
						<option value="<?php echo $row->id; ?>" <?php if(@$result[1]->default_value==$row->id){echo 'selected="selected"'; }?>><?php echo $row->fname; ?> </option>
						
					<?php
					}
					?>
					</select>
				</td>
			</tr>
			<tr>			
				<td align="right">  </td>
				<td align="left"> <button type="submit" class="buttons" name=""><?php echo $this->uri->segment(4)? 'Update':'Add';?></button><a href="<?php echo base_url();?>admin/manage_category/listing"> <button type="button" class="buttons" name="cancel" onClick="history.go(-1)"><?php echo 'Cancel';?></button></a></td>
			</tr>
		</table>
	</form>
</div>
</div>