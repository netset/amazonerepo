 <script type="text/javascript" src="<?php echo base_url() ?>public/slider/js/shCore.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/slider/js/shBrushXml.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>public/slider/js/shBrushJScript.js"></script>
<script defer src="<?php echo base_url() ?>public/slider/js/jquery.flexslider.js"></script>
  <script type="text/javascript">
    $(function(){
      SyntaxHighlighter.all();
    });
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>
<script type="text/javascript">
	$(document).ready(function() {

			$("#fancybox-manual-a").fancybox({	
				width:'auto',
				height:'auto',				
				autoScale:true,				
			});
		
			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('#box');
			});
                        $(".producting_showing").click(function(){
				var id=$(this).attr('coupon_id');
                                
                                if(id != 0) {
				$.post('<?php echo base_url(); ?>partner_single/getCouponFace',{coupon_id:id},function(data){
					$('#box').html(data);
					$("#fancybox-manual-a").click();
				});
                             }
			});
		});
</script>
<script>
function showResult(value)
{  
	if(value!=''){
	$.post('<?php echo base_url(); ?>profile/searchFriend',{name:value},function(res){
		
			var res= $.parseJSON(res);
			$.each(res, function(key, value){
					if(value.id!=0){
						html='<img src="<?php echo base_url(); ?>timthumb?src=<?php echo base_url(); ?>public/uploads/profile_pics/'+value.img_name+'&h=40&w=40&zc=1" class="img" /><p class="ladies_text">'+value.name+' '+value.surname+'</p><div class="clear"></div>';
						
		}
		else
		{
			html='No record Found';
		}
	
	 });
	 $('.ladies').prepend(html);
	});
	}

}
</script>

<div style="display:none"><a id="fancybox-manual-a" href="#box">fancybox</a></div>
<div id="box" style="display:none;width:600px">

</div>
 
 <!--start right sidebar here --><article id="right">
<?php if(!isset($genr_div)){ ?>
<style> 
#map
{
	width:98.5%; 
    height:237px; 
	margin-left: 22px;
	border:1px solid #DEDEDE; 
	border-radius:3px;
}
</style> 
 
 <script src="http://openlayers.org/dev/lib/OpenLayers.js" type="text/javascript"></script>
        <script type="text/javascript">
            //Sample code by August Li
            var iconSize = new OpenLayers.Size(30, 30);
            var iconOffset = new OpenLayers.Pixel(-(iconSize.w / 2), -iconSize.h);
            var icon = new OpenLayers.Icon("<?php base_url();?>public/images/frontend_images/mark.png",
                           iconSize, iconOffset);
            var zoom, center, currentPopup, map, lyrMarkers;
            var popupClass = OpenLayers.Class(OpenLayers.Popup.FramedCloud, {
                "autoSize": true,
                "minSize": new OpenLayers.Size(300, 50),
                "maxSize": new OpenLayers.Size(500, 300),
                "keepInMap": true
            });
            var bounds = new OpenLayers.Bounds();
            function addMarker(lng, lat, info) {
                var pt = new OpenLayers.LonLat(lng, lat)
                                       .transform(new OpenLayers.Projection("EPSG:4326"), 
                                       map.getProjectionObject());
                bounds.extend(pt);
                var feature = new OpenLayers.Feature(lyrMarkers, pt);
                feature.closeBox = true;
                feature.popupClass = popupClass;
                feature.data.popupContentHTML = info;
                feature.data.overflow = "auto";
                var marker = new OpenLayers.Marker(pt, icon.clone());
                var markerClick = function(evt) {
                    if (currentPopup != null && currentPopup.visible()) {
                        currentPopup.hide();
                    }
                    if (this.popup == null) {
                        this.popup = this.createPopup(this.closeBox);
                        map.addPopup(this.popup);
                        this.popup.show();
                    } else {
                        this.popup.toggle();
                    }
                    currentPopup = this.popup;
                    OpenLayers.Event.stop(evt);
                };
                marker.events.register("mousedown", feature, markerClick);
                lyrMarkers.addMarker(marker);
            }
			
			
  
            function initMap(alllat,alllng) {
				
                var options = {
                    projection: new OpenLayers.Projection("EPSG:900913"),
                    displayProjection: new OpenLayers.Projection("EPSG:4326"),
                    units: "m",
                    numZoomLevels: 19,
                    maxResolution: 156543.0339,
                    maxExtent: new OpenLayers.Bounds(-20037508.34, -20037508.34, 20037508.34, 20037508.34)
                };
                map = new OpenLayers.Map("map", options);
                map.addControl(new OpenLayers.Control.DragPan());
                var lyrOsm = new OpenLayers.Layer.OSM();
                map.addLayer(lyrOsm);
                lyrMarkers = new OpenLayers.Layer.Markers("Markers");
                map.addLayer(lyrMarkers);
                 //add marker on given coordinates
				 var alllat='<?php echo $alllat; ?>';
				 var alllng='<?php echo $alllng; ?>';
				var full_address='<?php echo $full_address; ?>';
				//alert(full_address);
				
				 var lat=JSON.parse(alllat);
				 var lng=JSON.parse(alllng);
				var formatted_address=JSON.parse(full_address);
				
              $.each(lat,function(index,val){
               	addMarker(lng[index],val,formatted_address[index]);
			});
                center = bounds.getCenterLonLat();
                map.setCenter(center, map.getZoomForExtent(bounds) - 1);
                zoom = map.getZoom();
            }
        </script>
  

 
 
  
<body onLoad="initMap()">
<div id="corner"><img src="<?php echo base_url(); ?>public/images/inner_images/gold.PNG" class="box" />
<h3>Corner</h3>
<div class="clear"></div>
</div>
<div class="map_box"><div id="map"></div>
<div class="clear"></div>
</div>
</body>

<?php }else{ ?>
<div class="corner"><img class="box" src="<?php echo base_url(); ?>public/images/inner_images/gold.PNG">
<h3>Points</h3>
<img class="quest_mrk" src="<?php echo base_url(); ?>public/images/inner_images/quest.png">
<div class="clear"></div>
</div>
<div class="map_box">
<div class="point_avail">
<div class="number_avail">
<h2><?php echo $points ?></h2>
</div>
<ul>
<li><img src="<?php echo base_url(); ?>public/images/inner_images/<?php echo  ($percentage>33)?'green_star.PNG':'grey_star.PNG'; ?>"></li>
<li><img src="<?php echo base_url(); ?>public/images/inner_images/<?php echo  ($percentage>66)?'green_star.PNG':'grey_star.PNG'; ?>"></li>
<li><img src="<?php echo base_url(); ?>public/images/inner_images/<?php echo  ($percentage>90)?'green_star.PNG':'grey_star.PNG'; ?>"></li>
</ul>
<div class="clear"></div>
</div>
<div class="cld_back">
<p><?php echo $percentage; ?>%</p>
</div>
<div class="process">
 <img alt="" src="<?php echo base_url(); ?>public/images/inner_images/process.PNG" class="process-bar" style="width:<?php echo $progess; ?>%">
</div>
<script>
	function validate(){
		if($('#txtInsertCode').val()!=''){			
			var d=parseInt('<?php echo $percentage ?>');
			if(d<100){
				return true;
			}else{
				alert('l\'acquisto di alcuni prodotti');
				return false;
			}
		}else{
			alert('Per favoreinserireilcodice');
			return false;
		}	
			return false;
	}	
</script>
<form action="" method="POST" onSubmit="return validate();">
<input name="txtInsertCode" id="txtInsertCode" type="text" class="insert_code"  placeholder="insert code">
<input name="" type="submit" onClick="test()" class="crediti_gred" value="Aggiungi punti">
</form>
<div class="clear"></div>
</div>
<div id="corner" class="cerca">
			<img src="<?php base_url();?>public/images/inner_images/search.png" class="search_img" />	
            <h3>Cerca persone</h3>
            <div class="clear"></div>	
</div>
<div class="map_box">
		<form action="" method="POST">
		<input type="text" class="insert_code2" id="txtSearch" onkeyup="showResult(this.value)">
        </form>
        <div class="ladies">
        	
        </div>
       <div class="ladies">
      
        	
            
        </div>
       
</div>


<?php } ?>

<div class="corner box_corner"><img src="<?php echo base_url(); ?>public/images/inner_images/box.PNG" class="box" />
<h3>Coupan</h3>
<div class="clear"></div>
</div>
<div class="map_box">
<section class="slider">
        <div class="flexslider">
          <ul class="slides">
		<?php foreach($coupons as $coupon){ ?>
				<li>					
					<div class="producting_showing"  coupon_id="<?php echo ($coupon->id!=0)? $coupon->id:"0"; ?>">
						<h1>Coupon</h1>
						<div id="product_displaying"> 
							<img src="<?php echo base_url(); ?>timthumb?src=<?php echo base_url(); ?>public/uploads/coupon_pics/<?php echo $coupon->primary_image; ?>&h=213&w=212&zc=1">
						</div>
						<div class="product_maring">
						<div class="product_poin"> <h4> <span class="numbering"><?php echo $coupon->points; ?></span> points</h4> </div>
						<div class="entering_date"> <h3> Entro il:</h3> <h1> <?php echo date('d/m/Y',strtotime($coupon->valid_upto)); ?> </h1>  </div>
						 </div>
						 <div class="clear"> </div>
					</div>
  	    		</li>  	    		
			<?php } ?>		
          </ul>
        </div>
      </section>

<!--end pagination here -->
<div class="clear"></div>
</div>
<?php if(!isset($genr_div)){ ?>
<div class="corner box_corner"> 
 
 <img src="<?php echo base_url(); ?>public/images/inner_images/trofi.PNG" class="box">  <h3> Trofei </h3></div>
<div class="map_box">
<ul class="bonus_point"> 

<?php foreach($troffie as $value){?>
<li> <img src="<?php echo base_url(); ?>public/uploads/troffie_pics/<?php echo $value->image; ?>"> </li>

<?php }?>

</ul>
<div class="clear"> </div>
</div>
<?php } ?>
</article><!--end left sidebar here -->