<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link href="<?php echo base_url(); ?>public/css/admin/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>public/js/jquery-1.4.1.min.js"></script>
<script>
function loginCheck(){
	if($('#username').val()=="" && $('#password').val()==""){
		alert('Enter Username or Password');
		return false;
	}else if($('#username').val()==""){
		alert('Enter username');
		return false;
	}
	else if($('#password').val()==""){
		alert('Enter Password');
		return false;
	}
	return true;
}
</script>
</head>

<body>

<div id="login_page"> 
	<div class="settings"> 
	<?php
	if(!empty($error))
	{
		echo '<center><span style="color:red">'. $error .'</span></center>';
	}
	?>
	<center><span style="color:red"><?php echo form_error("username"); ?></span><br/>
	<center><span style="color:red"><?php echo form_error("password"); ?></span>
 <form onSubmit="return loginCheck()" class="global_form" action="" method="post"><div><div><h3>Admin Sign In</h3>
		<p class="form-description">To access the control panel, please provide your administrator username and password.</p>
		<div class="form-elements">
			<div id="username-wrapper" class="form-wrapper"><div id="username-label" class="form-label"><label for="username" class="required">		              Admin Username</label></div>
				<div id="username-element" class="form-element">

 <input type="text" name="username" id="username" maxlength="50" value="<?php if(!empty($cookusername)){ echo $cookusername;} echo @$log_username;?>" /></div></div>
		<div id="password-wrapper" class="form-wrapper"><div id="password-label" class="form-label"><label for="password" class="required">	       Password</label></div>
       <div id="password-element" class="form-element">
<input type="password" name="password" maxlength="50"  id="password" value="<?php if(!empty($cookpass)){ echo $cookpass;} echo @$log_password;?>" />
    </div></div>
	<div id="remember-wrapper" class="form-wrapper"><div id="remember-label" class="form-label"><label for="remember" class="required">Remember me</label></div>
       <div id="remember-element" class="form-element">
<input type="checkbox" name="remember" id="remember" value="1" />
    </div></div>
	
	
    <div id="execute-wrapper" class="form-wrapper"><div id="execute-label" class="form-label">&nbsp;</div><div id="execute-element"  class="form-element">
	<button name="execute" id="execute" type="submit">Sign In</button>
	 <a href="<?php echo base_url()?>admin/login/forgotpassword"><button name="forgot" id="forgot" type="button">Forgot Password</button>
	</div></div></div></div></div></form> 

	</div>

</div>
</body>
</html>
