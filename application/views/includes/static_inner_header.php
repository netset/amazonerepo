<script>
	$(document).ready(function(){
		$('#logoutbtn').click(function(){
			if($('#logoutbtn').attr('class')=="current"){
				$('#logoutbtn').attr('class','');
				$('#logoutMenu').fadeOut('fast');
			}else{
				$('#logoutbtn').attr('class','current');
				$('#logoutMenu').fadeIn('fast');
			}
		});
		
	});
</script>
<script>
	$(document).ready(function(){
		var timer,delay=10000;
		timer = setInterval(function(){
			$.post('<?php echo base_url(); ?>home/ajaxRecentNew',{},function(data){
                                 if(data>0)
				$('.badge').css('border','2px solid')
				$('.badge').html(data);	
			});	
		}, delay);
	});
</script>
<div style="z-index:10000;position:fixed;width:100%">
<nav style="display:none" id="top_menu"> 
<div class="center_nav">
<?php 
                    $uri = $_SERVER['REQUEST_URI'];
                    $pieces = explode("/", $uri);
                   
                    $tab=$pieces[1];
                    
                    ?>
<ul> 
<li> <p><a href="<?php base_url() ?>home/index/news">News</a></p> 
<style>
.badge{
	background: none repeat scroll 0 0 red;
    /*border: 2px solid;*/
    border-radius: 100px 100px 100px 100px;
    color: #FFFFFF;
    float: left;
    font-size: 12px;
    font-weight: bold;
    height: auto;
    padding-left: 3px;
    padding-right: 3px;
    width: auto;

}
</style>
<div class="badge" <?php if($news_count>0) echo 'style="border: 2px solid;"' ?>><?php if($news_count>0) echo $news_count; ?></div>

</li>
<li <?php if($tab=="icorner") echo 'class="acive"'; ?>> <p><a href="<?php base_url() ?>icorner">I corner</a></p> </li>
<li <?php if($tab=="partner" || $tab=="partner_single") echo 'class="acive"'; ?>> <p><a href="<?php base_url() ?>partner">Partner</a></p></li>
<li <?php if($tab=="static_pages")echo 'class="acive"'; ?>> <p><a href="<?php base_url() ?>static_pages">II progetto</a></p></li>
</ul>
 </div>
 <div class="clear"> </div>
</nav>
<p></p>
<header><nav> <a href="<?php base_url() ?>home"><img class="logo" src="<?php base_url() ?>public/images/inner_images/logo.png"></a> <img id="navArrow" class="arrow" src="<?php base_url() ?>public/images/inner_images/arrow.PNG">
<?php 
$uri = $_SERVER['REQUEST_URI'];
$pieces = explode("/", $uri);
$tab=$pieces[1];
?>
<ul>
<li <?php if($tab=="home") echo 'class="current"'; ?>><a href="<?php base_url() ?>home"><span>Home</span></a></li>
<li <?php if($tab=="profile") echo 'class="current"'; ?>><a href="<?php base_url() ?>profile"><span>Profilo</span></a></li>
<li><a href="#"><span>Impostazioni</span></a>
<div class="clear"></div>
       <ul>
        <li <?php if($tab=="settings") echo 'class="current"'; ?>><a href="<?php base_url() ?>settings"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modifica Profilo</span></a></li>
        <li><a href="#"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Privacy</span></a></li>
        <li><a href="<?php echo base_url(); ?>login/logout"><span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Esci</span></a></li>
       </ul></li>

</ul>
</nav> <!--end pagination here -->
<div class="clear"></div>
</header><!--end header here -->
<p></p>
</div>