<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Panel</title>
<link href="<?php echo base_url(); ?>public/css/admin/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo base_url(); ?>public/js/listing.js"></script>
	<!-- Add jQuery library -->
	<script type="text/javascript" src="<?php echo base_url();?>/fancyapp/lib/jquery-1.9.0.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url();?>/fancyapp/lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/fancyapp/source/jquery.fancybox.js?v=2.1.4"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/fancyapp/source/jquery.fancybox.css?v=2.1.4" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/fancyapp/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="<?php echo base_url();?>/fancyapp/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/fancyapp/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="<?php echo base_url();?>/fancyapp/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="<?php echo base_url();?>/fancyapp//source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

	<script type="text/javascript">
	var j= jQuery.noConflict();
		j(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			j('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			j(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			j(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			j(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			j(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			j('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			j('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			j('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			j("#fancybox-manual-a").click(function() {
				j.fancybox.open('1_b.jpg');
			});

			j("#fancybox-manual-b").click(function() {
				j.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			j("#fancybox-manual-c").click(function() {
				j.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}
	</style>
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
<div id="global_header_wrapper"> 
    <div id="global_header"> 
    <div>
    <div class="generic_layout_container layout_core_admin_menu_mini">
    	<div id="global_header_right">
          <div id="global_header_right_menu">       
       [<a href="<?php echo base_url(); ?>admin/login/logout"><?php echo 'Logout';?></a>]
	   <a class="fancybox" data-fancybox-group="gallery"  href="<?php echo base_url(); ?>public/uploads/<?php echo $this->session->userdata('pic_name');?>" title="Admin">	   
	   <img src="<?php echo base_url(); ?>public/uploads/<?php $res=$this->session->userdata('pic_name');if(!empty($res)){	echo $this->session->userdata('pic_name');}else
{
echo "admin.jpg";
}	   ?>" style="height:100px;width:100px;"></a>
        </div>
                </div>
           </div>
                    </div>   
                    
 <div>
<div class="generic_layout_container layout_core_admin_menu_logo">
	<div id="global_header_logo">
		<!-- <a href="/admin/"> <img src="<?php echo base_url(); ?>public/images/admin_icon/verde_logo.png" width="217" height="48"/> </a> -->
	</div>
		</div>
			</div>                   
                             
    </div>
</div>


<div id="global_menu_wrapper"> 

    <div> 
        <div class="generic_layout_container layout_core_admin_menu_main">
            <div id='cssmenu'>
<ul>
   <li><a href='<?php echo base_url();?>admin/login/welcome'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Manage</span></a>
      <ul>
      		 <li><a href="<?php echo base_url();?>admin/manage_category/listing">Category</a></li>
		<li><a href="<?php echo base_url();?>admin/manage_user/listing">Users</a></li>
		<li><a href="<?php echo base_url();?>admin/manage_message/listing">Messages</a></li>
		<li><a href="<?php echo base_url();?>admin/manage_job/listing">Jobs</a></li>
		<li><a href="<?php echo base_url();?>admin/manage_bid/listing">Bids</a></li>
	
		<!--	<li><a href="#">Payment Approval</a></li>-->
  
     </ul>
   </li>
   
   <li  class='has-sub' ><a href='#'><span>Settings</span></a>
		<ul>
	<!--	<li><a href="<?php echo base_url(); ?>admin/login/setting"><?php echo 'Default Setting'; ?></a></li>-->
		<li><a href="<?php echo base_url(); ?>admin/login/change_password"><?php echo 'Change Password'; ?></a></li>
		<li><a href="<?php echo base_url(); ?>admin/manage_profile/add_profile"><?php echo 'Profile'; ?></a></li>
      
      </ul>
   </li>
      </li>
   
   
  
</ul>
</div>
    </div>
    </div>
</div>
<?php }?>
<div id="global_content_wrapper">

<div id="global_content"> 
	<?php $this->load->view($file); ?>
</div>
</div>
</body>
</html>