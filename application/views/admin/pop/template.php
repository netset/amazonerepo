<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>

<link href="<?php echo base_url(); ?>public/css/admin/style.css" rel="stylesheet" type="text/css" />
<style>
.error
{
color:red;
}
.msg
{
color:green;
}
</style>
</head>

<body>
<?php if($this->uri->segment(3) != 'forgotpassword'){?>


<?php }?>
<div id="global_content_wrapper">

<div id="global_content"> 
	<?php $this->load->view($file); ?>
</div>
</div>
</body>
</html>