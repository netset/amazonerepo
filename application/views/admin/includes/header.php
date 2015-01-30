<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo "Il verde premia";?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/screen.css" />
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.4.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>
<style>
	.msg{color:green;}
	.error{color:red;}
</style>
</head>
<body> 
<!-- Start: page-top-outer -->
<div id="page-top-outer">    

<!-- Start: page-top -->
	<div id="page-top">

		<!-- start logo -->
		<div id="logo1">
			<!--<img src="<?php echo base_url();?>public/images/erp.png" >-->
					 <div style="color:white;font-size: 50px; padding: 30px 0 30px 0px;">Il verdia premia</div>
		</div>
		
		
		<div id="top-search">
			
		</div>
		
		<div class="clear"></div>

	</div>
<!-- End: page-top -->

</div>
<!-- End: page-top-outer -->
	
<div class="clear">&nbsp;</div>
 
<!--  start nav-outer-repeat START -->
<div class="nav-outer-repeat"> 
<!--  start nav-outer -->
<div class="nav-outer"> 

		<!-- start nav-right -->
		<div id="nav-right">
			<!--<div class="nav-divider">&nbsp;</div>
			<div class="showhide-account1">
				<a href="<?php echo base_url();?>index.php/admin/dashboard/myaccount"><img src="<?php echo base_url();?>public/images/nav_myaccount.gif"></a>
			</div>
			<div class="nav-divider">&nbsp;</div>-->
			
			<div class="logout1" style="margin-left:136px;"> 
				<a href="<?php echo base_url();?>admin/login/logout"><img src="<?php echo base_url();?>public/images/logout.png" ></a>
			</div>
			<div class="clear">&nbsp;</div>
		</div>
		<!-- end nav-right -->

		<!--  start nav -->
		<div class="nav">
		<div class="table">
		
		<ul <?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='home'){echo 'class="current"';}else echo 'class="select"';?> id="heading1" >
			<li >
		
			<a href="<?php echo base_url();?>admin/login/welcome"><b><?php echo lang('Home','Home')?></b></a>

			</li>
		</ul>
		<!--<div class="nav-divider">&nbsp;</div>
		   	               
		<ul <?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='product'){echo 'class="current"';}else echo 'class="select"';?> id="heading1" >
			<li><a href="<?php base_url();?>product"><b>Product Managment</b></a>
			<div class="select_sub show" >
				<ul class="sub" >
					<li style="font-weight:bold"><a href="<?php base_url();?>">All Products&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
					<li style="font-weight:bold"><a href="<?php base_url();?>">Category Management</a></li>			
				</ul>
			</div>
			
			</li>
		</ul>
		<div class="nav-divider">&nbsp;</div>		 
		<ul <?php if($this->uri->segment(2)=='dashboard' && $this->uri->segment(3)=='usermgmt'){echo 'class="current"';}else echo 'class="select"';?> id="heading1" >
			<li><a href="<?php base_url();?>usermgmt"><b>User Managment</b></a>
		
			<div class="select_sub show">
					<ul class="sub">
			<li style="font-weight:bold;"><a href="<?php base_url();?>">Add New User</a></li>
			<li style="font-weight:bold"><a href="<?php base_url();?>">Edit Profile</a></li>
			<li style="font-weight:bold"><a href="<?php base_url();?>">Change Password</a></li>
					 
			</ul>
			</div>
			
			</li>
		</ul>
		
		<div class="nav-divider">&nbsp;</div>
		-->
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
		</div>
		<!--  start nav -->

</div>
<div class="clear"></div>
<!--  start nav-outer -->
</div>
<!--  start nav-outer-repeat................ END -->