<!DOCTYPE html>
<html class="sidebar_default no-js" lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title;?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="css/images/favicon.png">
<!-- Le styles -->
<link href="<?php echo base_url();?>public/js/plugins/chosen/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/twitter/bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/base.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/twitter/responsive.css" rel="stylesheet">
<link href="<?php echo base_url();?>public/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
<script src="<?php echo base_url();?>public/js/plugins/modernizr.custom.32549.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script> 
$(document).ready(function(){
  $("#header_flip").click(function(){
	 $(".header_panel").slideToggle('slow');
  });
});

function check_stu()
{
	if(document.getElementById("dash_search").value == '')
	{
		alert('Please enter valid value');
		return false;
	}
}
function check_teach()
{
	if(document.getElementById("dash_search_teach").value == '')
	{
		alert('Please enter valid value');
		return false;
	}
}
</script>
<style>
body{font-size:15px;font-size:1.5rem;font-family:"Open Sans",Arial,sans-serif;color:#7e838b; width:100%;float:left;height:100%;overflow-x:hidden;padding:0}
</style>


<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
</head>

<?php //echo "<pre>"; print_r($result);?>
<?php if(($this->uri->segment(2) != 'teacher_registration' && $this->uri->segment(3) != '') || ($this->uri->segment(2) != 'student_registration' && $this->uri->segment(3) != '')) { ?>
<body>
<?php } else{?>
<body style='background-image:none;'>
<?php }?>
<?php $id = $this->uri->segment(3);?>
<div id="loading"><img src="<?php echo base_url();?>public/img/ajax-loader.gif"></div>
<div id="responsive_part">
  <div class="logo"> <a href="index.html"><span>Start</span><span class="icon"></span></a> </div>
  <ul class="nav responsive">
    <li>
      <button class="btn responsive_menu icon_item" data-toggle="collapse" data-target=".overview"> <i class="icon-reorder"></i> </button>
    </li>
  </ul>
</div>
<!-- Responsive part -->
<?php if(($this->uri->segment(2) != 'teacher_registration' && $this->uri->segment(3) != '') || ($this->uri->segment(2) != 'student_registration' && $this->uri->segment(3) != '')) { ?>
<div id="sidebar" class=" collapse1 in">
  <div class="scrollbar">
    <div class="track">
      <div class="thumb">
        <div class="end"></div>
      </div>
    </div>
  </div>
  <div class="viewport ">
    <div class="overview collapse">
     
	  <?php if($this->uri->segment(1) == 'student'){ ?>
	    <div class="search row-fluid container">
        <h2>Search</h2>
        <form class="form-search" action="<?php echo base_url()?>student/search/<?php echo $id;?>" method="post" onsubmit="check_stu()">
          <div class="input-append">
            <input type="text" class=" search-query" placeholder="" name="dash_search" id="dash_search">
            <button type="submit" class="btn_search color_4">Search</button>
          </div>
        </form>
      </div>
      <ul id="sidebar_menu" class="navbar nav nav-list container full">
			<li class="accordion-group  color_4"> <a class="dashboard" href="<?php echo base_url()?>student/welcome/<?php echo $id;?>"><img src="<?php echo base_url();?>public/img/menu_icons/dashboard.png"><span>Dashboard</span></a> </li>
			
			
			<li class="accordion-group color_22"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4"> <img src="<?php echo base_url();?>public/img/menu_icons/subject.png"><span>Subject</span></a>
			  <ul id="collapse4" class="accordion-body collapse">
				<li><a href="<?php echo base_url()?>student/student_add_subject/<?php echo $id;?>">Add Subject</a></li>
				<li><a href="<?php echo base_url()?>student/search_subject/<?php echo $id;?>">Search Subject</a></li>
			  </ul>
            </li>
        
        <li class="accordion-group color_25"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse5"> <img src="<?php echo base_url();?>public/img/menu_icons/others.png"><span>Specific Pages</span></a>
          <ul id="collapse5" class="accordion-body collapse">
            <li><a href="<?php echo base_url()?>student/profile/<?php echo $id;?>">Profile</a></li>
            <li><a href="<?php echo base_url()?>student/search/<?php echo $id;?>">Search</a></li>
          </ul>
        </li>
      </ul> <?php } ?>
	  
	  <?php if($this->uri->segment(1) == 'teacher'){ ?>
	   <div class="search row-fluid container">
        <h2>Search</h2>
        <form class="form-search" action="<?php echo base_url()?>teacher/search/<?php echo $id;?>/<?php echo $this->uri->segment(4)?>" onsubmit="check_teach()" method="post">
          <div class="input-append">
            <input type="text" class=" search-query" placeholder="" name="dash_search" id="dash_search_teach">
            <button type="submit" class="btn_search color_4">Search</button>
          </div>
        </form>
      </div>
      <ul id="sidebar_menu" class="navbar nav nav-list container full">
			<li class="accordion-group  color_4"> <a class="dashboard" href="<?php echo base_url()?>teacher/welcome/<?php echo $id;?>/<?php echo $this->uri->segment(4); ?>"><img src="<?php echo base_url();?>public/img/menu_icons/dashboard.png"><span>Dashboard</span></a> </li>
        
		
			<li class="accordion-group color_22"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse4"> <img src="<?php echo base_url();?>public/img/menu_icons/subject.png"><span>Subject</span></a>
			  <ul id="collapse4" class="accordion-body collapse">
				<li><a href="<?php echo base_url()?>teacher/create_subject/<?php echo $id;?>/<?php echo $this->uri->segment(4)?>">Create Subject</a></li>
				<li><a href="<?php echo base_url()?>teacher/search_subject/<?php echo $id;?>/<?php echo $this->uri->segment(4)?>">Search Subject</a></li>
			  </ul>
            </li>
		
		 
		 <?php $count = $this->teacher_model->count_notifications($id,$this->uri->segment(4));?>
		 
        <li class="color_13"> <a class="widgets" href="<?php echo base_url()?>teacher/notification/<?php echo $id;?>/<?php echo $this->uri->segment(4)?>"> <img src="<?php echo base_url();?>public/img/menu_icons/calendar.png"><span>Notifications (<?php echo $count;?>)</span></a> </li> 
        
        <li class="accordion-group color_25"> <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse5"> <img src="<?php echo base_url();?>public/img/menu_icons/others.png"><span>Specific Pages</span></a>
          <ul id="collapse5" class="accordion-body collapse">
            <li><a href="<?php echo base_url()?>teacher/profile/<?php echo $id;?>/<?php echo $this->uri->segment(4)?>">Profile</a></li>
            <li><a href="<?php echo base_url()?>teacher/search/<?php echo $id;?>/<?php echo $this->uri->segment(4)?>">Search</a></li>
          </ul>
        </li>
      </ul> <?php } ?>
	  
      <div class="menu_states row-fluid container ">
        <h2 class="pull-left">Menu Settings</h2>
        <div class="options pull-right">
          <button id="menu_state_1" class="color_4" rel="tooltip" data-state ="sidebar_icons" data-placement="top" data-original-title="Icon Menu">1</button>
          <button id="menu_state_2" class="color_4 active" rel="tooltip" data-state ="sidebar_default" data-placement="top" data-original-title="Fixed Menu">2</button>
          <button id="menu_state_3" class="color_4" rel="tooltip" data-placement="top" data-state ="sidebar_hover" data-original-title="Floating on Hover Menu">3</button>
        </div>
      </div>
      <!-- End sidebar_box --> 
      
    </div>
  </div>
</div><?php } ?>
<div id="main">
<div class="container">
    <div class="header row-fluid">
      <div class="logo"><?php if($this->uri->segment(1) == 'student' && $this->uri->segment(3) != ''){?> 
			<a href="<?php echo base_url()?>student/welcome/<?php echo $id;?>"><span class="icon"></span></a><?php 
		} 
		if($this->uri->segment(1) == 'teacher' && $this->uri->segment(3) != ''){?>
			<a href="<?php echo base_url()?>teacher/welcome/<?php echo $id;?>"><span class="icon"></span></a><?php 
		} 
		if(($this->uri->segment(2) == 'student_registration' && $this->uri->segment(1) == 'student' && $this->uri->segment(3) == '') || ($this->uri->segment(2) == 'forgotpassword' && $this->uri->segment(1) == 'student')){?> 
			<a href="<?php echo base_url()?>student"><span class="icon"></span></a> <?php 
		} 
		if(($this->uri->segment(1) == 'teacher' && $this->uri->segment(2) == 'teacher_registration' && $this->uri->segment(3) == '') || ($this->uri->segment(2) == 'forgotpassword' && $this->uri->segment(1) == 'teacher')){?>
			<a href="<?php echo base_url()?>teacher"><span class="icon"></span></a><?php 
		}?></div>
      <div class="top_right">
	  <?php if($this->uri->segment(1) == 'student' && $this->uri->segment(3) != ''){?>
        <ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <div class="title"><span class="name"><?php echo @$result['0']['first_name']." ".@$result['0']['last_name'];?></span><span class="subtitle"><?php  echo @$result['0']['school_name'];?></span></div>
            <span class="icon"><img style="width:80px; height:80px;" src="<?php echo base_url()."public/uploads/student_prf_pics/".@$result['0']['image'] ?>"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			  <li><a href="<?php echo base_url()?>student/edit_profile_picture/<?php echo $id;?>"><i class=" icon-user"></i> Edit Profile Picture Profile</a></li>
              <li><a href="<?php echo base_url()?>student/profile/<?php echo $id;?>"><i class=" icon-user"></i> My Profile</a></li>
			  <li><a href="<?php echo base_url()?>student/logout"><i class=" icon-unlock"></i>Log Out</a></li>
            </ul>
          </li>
        </ul><?php } if($this->uri->segment(1) == 'teacher' && $this->uri->segment(3) != ''){ ?>
		<ul class="nav nav_menu">
          <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <div class="title"><span class="name"><?php echo @$result['0']['first_name']." ".@$result['0']['last_name'];?></span><span class="subtitle"><?php  echo @$result['0']['school_name'];?></span></div>
            <span class="icon"><img style="width:80px; height:80px;" src="<?php echo base_url()."public/uploads/teacher_prf_pics/".@$result['0']['image'] ?>"></span></a>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
              <li><a href="<?php echo base_url()?>teacher/edit_profile_picture/<?php echo $id;?>/<?php echo $this->uri->segment(4);?>"><i class=" icon-user"></i> Edit Profile Picture Profile</a></li>
			  <li><a href="<?php echo base_url()?>teacher/profile/<?php echo $id;?>/<?php echo $this->uri->segment(4);?>"><i class=" icon-user"></i> My Profile</a></li>
			  <li><a href="<?php echo base_url()?>teacher/logout"><i class=" icon-unlock"></i>Log Out</a></li>
            </ul>
          </li>
        </ul>
		
		<?php }?>
      </div> 
      <!-- End top-right --> 
    </div>
	
	<?php if($this->uri->segment(1) == 'teacher'){if($this->uri->segment(2) == 'inbox_message' || $this->uri->segment(2) == 'sent_message' || $this->uri->segment(2) == 'create_message') {?>
	<a href="<?php echo base_url()?>teacher/inbox_message/<?php echo $id;?>/<?php echo $this->uri->segment(4);?>" ><button type="button" class="buttons" style="color:#000000;">Inbox</button> </a>
	<a href="<?php echo base_url()?>teacher/sent_message/<?php echo $id;?>/<?php echo $this->uri->segment(4);?>"><button type="button" class="buttons" style="color:#000000;">Sent</button> </a>
	<a href="<?php echo base_url()?>teacher/create_message/<?php echo $id;?>/<?php echo $this->uri->segment(4);?>"><button type="button" class="buttons" style="color:#000000;">Create</button> </a>
	<?php }}?>
	
	<?php if($this->uri->segment(1) == 'student'){if($this->uri->segment(2) == 'inbox_message' || $this->uri->segment(2) == 'sent_message' || $this->uri->segment(2) == 'create_message') {?>
	<a href="<?php echo base_url()?>student/inbox_message/<?php echo $id;?>" ><button type="button" class="buttons" style="color:#000000;">Inbox</button> </a>
	<a href="<?php echo base_url()?>student/sent_message/<?php echo $id;?>"><button type="button" class="buttons" style="color:#000000;">Sent</button> </a>
	<a href="<?php echo base_url()?>student/create_message/<?php echo $id;?>"><button type="button" class="buttons" style="color:#000000;">Create</button> </a>
	<?php }}?>
	
<?php $this->load->view($file); ?>
</div>

 <div id="footer">
    <p> &copy; edumi education - 2013 </p>
    <span class="company_logo"><a href="http://www.pixelgrade.com"></a></span> </div> 
</div>
<div class="background_changer dropdown">
  <div class="dropdown" id="colors_pallete"> <a data-toggle="dropdown" data-target="drop4" class="change_color"></a>
    <ul  class="dropdown-menu pull-left" role="menu" aria-labelledby="drop4">
      <li><a data-color="color_0" class="color_0" tabindex="-1">1</a></li>
      <li><a data-color="color_1" class="color_1" tabindex="-1">1</a></li>
      <li><a data-color="color_2" class="color_2" tabindex="-1">2</a></li>
      <li><a data-color="color_3" class="color_3" tabindex="-1">3</a></li>
      <li><a data-color="color_4" class="color_4" tabindex="-1">4</a></li>
      <li><a data-color="color_5" class="color_5" tabindex="-1">5</a></li>
      <li><a data-color="color_6" class="color_6" tabindex="-1">6</a></li>
      <li><a data-color="color_7" class="color_7" tabindex="-1">7</a></li>
      <li><a data-color="color_8" class="color_8" tabindex="-1">8</a></li>
      <li><a data-color="color_9" class="color_9" tabindex="-1">9</a></li>
      <li><a data-color="color_10" class="color_10" tabindex="-1">10</a></li>
      <li><a data-color="color_11" class="color_11" tabindex="-1">10</a></li>
      <li><a data-color="color_12" class="color_12" tabindex="-1">12</a></li>
      <li><a data-color="color_13" class="color_13" tabindex="-1">13</a></li>
      <li><a data-color="color_14" class="color_14" tabindex="-1">14</a></li>
      <li><a data-color="color_15" class="color_15" tabindex="-1">15</a></li>
      <li><a data-color="color_16" class="color_16" tabindex="-1">16</a></li>
      <li><a data-color="color_17" class="color_17" tabindex="-1">17</a></li>
      <li><a data-color="color_18" class="color_18" tabindex="-1">18</a></li>
      <li><a data-color="color_19" class="color_19" tabindex="-1">19</a></li>
      <li><a data-color="color_20" class="color_20" tabindex="-1">20</a></li>
      <li><a data-color="color_21" class="color_21" tabindex="-1">21</a></li>
      <li><a data-color="color_22" class="color_22" tabindex="-1">22</a></li>
      <li><a data-color="color_23" class="color_23" tabindex="-1">23</a></li>
      <li><a data-color="color_24" class="color_24" tabindex="-1">24</a></li>
      <li><a data-color="color_25" class="color_25" tabindex="-1">25</a></li>
    </ul>
  </div>
</div>
<!-- End .background_changer -->
</div>
<!-- /container --> 

<!-- Le javascript
    ================================================== --> 
<!-- General scripts --> 
<script src="<?php echo base_url();?>public/js/jquery.js" type="text/javascript"> </script> 
<!--[if !IE]> -->
<script src="<?php echo base_url();?>public/js/plugins/enquire.min.js" type="text/javascript"></script> 
<!-- <![endif]-->
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/jquery.sparkline.min.js"></script> 
<script src="<?php echo base_url();?>public/js/plugins/excanvas.compiled.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-transition.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-alert.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-modal.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-dropdown.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-scrollspy.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-tab.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-tooltip.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-popover.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-button.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-collapse.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-carousel.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-typeahead.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/bootstrap-affix.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/fileinput.jquery.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/jquery-ui-1.8.23.custom.min.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>public/js/jquery.touchdown.js" type="text/javascript"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/jquery.uniform.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/jquery.tinyscrollbar.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/jnavigate.jquery.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/jquery.touchSwipe.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/jquery.peity.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/wysihtml5-0.3.0.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/bootstrap-wysihtml5.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/jquery.peity.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/textarea-autogrow.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/character-limit.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/jquery.maskedinput-1.3.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/chosen/chosen/chosen.jquery.min.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/bootstrap-datepicker.js"></script> 
<script language="javascript" type="text/javascript" src="<?php echo base_url();?>public/js/plugins/bootstrap-colorpicker.js"></script> 

<!-- Custom made scripts for this template --> 
<script src="<?php echo base_url();?>public/js/scripts.js" type="text/javascript"></script> 
<script type="text/javascript">
  /**** Specific JS for this page ****/
 $(document).ready(function () {
       
        $('textarea.autogrow').autogrow();
        var elem = $("#chars");
        $("#text").limiter(100, elem);
        // Mask plugin http://digitalbush.com/projects/masked-input-plugin/
        $("#mask-phone").mask("(999) 999-9999");
        $("#mask-date").mask("99-99-9999");
        $("#mask-int-phone").mask("+33 999 999 999");
        $("#mask-tax-id").mask("99-9999999");
        $("#mask-percent").mask("99%");
        // Editor plugin https://github.com/jhollingworth/bootstrap-wysihtml5/
        $('#editor1').wysihtml5({
          "image": false,
          "link": false
          });
        // Chosen select plugin
        $(".chzn-select").chosen({
          disable_search_threshold: 10
        });
        // Datepicker
        $('#datepicker1').datepicker({
          format: 'mm-dd-yyyy'
        });
        $('#datepicker2').datepicker();
        $('.colorpicker').colorpicker()
        $('#colorpicker3').colorpicker();
    });



</script>
</body>
</html>