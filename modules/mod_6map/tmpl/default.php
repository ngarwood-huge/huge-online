<?php
/*------------------------------------------------------------------------
# 6Maps module by Team of Six, balbooa.com
# ------------------------------------------------------------------------
# author    Balbooa http://www.balbooa.com/
# Copyright@2013 balbooa.com.  All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.balbooa.com/
-------------------------------------------------------------------------*/
// no direct access
    defined('_JEXEC') or die('Restricted access');
    
$doc->addStyleSheet(JURI::root() . 'modules/mod_6map/assets/css/css-map.css');
?>
  <script type="text/javascript">                       
                        
                            var map<?php echo $uniqid;?>;
                            var marker<?php echo $uniqid;?> = null;
                                          
                            var markerParam<?php echo $uniqid;?> = <?php echo $markerParam;?>
                            
                          <?php if($image!=''){ ?>
                            var image<?php echo $uniqid;?> = new google.maps.MarkerImage(
                                  markerParam<?php echo $uniqid;?>.image,
                                  new google.maps.Size(<?php echo $siseImage[0];?>,<?php echo $siseImage[1];?>),
                                  new google.maps.Point(0,0),
                                  new google.maps.Point(<?php echo $siseImage[0]/2?>,<?php echo $siseImage[1];?>)
                                );
                            <?php }?>
                            
                             setTimeout(function() {
                                 location6map_codeAddress<?php echo $uniqid;?>();
                             },5);    
                             
                          // Create an array of styles.
                 var styles<?php echo $uniqid;?> = [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#a2daf2"}]},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"color":"#f7f1df"}]},{"featureType":"landscape.natural","elementType":"geometry","stylers":[{"color":"#d0e3b4"}]},{"featureType":"landscape.natural.terrain","elementType":"geometry","stylers":[{"visibility":"off"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#bde6ab"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.medical","elementType":"geometry","stylers":[{"color":"#fbd3da"}]},{"featureType":"poi.business","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffe15f"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#efd151"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"color":"black"}]},{"featureType":"transit.station.airport","elementType":"geometry.fill","stylers":[{"color":"#cfb2db"}]}];


          function location6map_codeAddress<?php echo $uniqid;?>() {
                                var geocoder = new google.maps.Geocoder();
                                
                                myOptions = {
                                    zoom:<?php if($zoom) echo $zoom;
                                             else echo 1;?>,   
                                    panControl:<?php echo $panControl?>,                                
                                    zoomControl:<?php echo $zoomControl?>,
                                    mapTypeControl:<?php echo $mapTypeControl?>,
                                    scaleControl:<?php echo $scaleControl?>,
                                    streetViewControl:<?php echo $streetViewControl?>, 
									scrollwheel:false,                                  
                                    overviewMapControl:<?php echo $overviewMapControl?>,
                                    rotateControl:<?php echo $rotateControl?>,    
                                    mapTypeId: google.maps.MapTypeId.<?php echo $map_type?>
                                }                                
                                
                                map<?php echo $uniqid;?> = new google.maps.Map(document.getElementById("<?php echo "map_canvas-" . $uniqid;?>"), myOptions);
                                map<?php echo $uniqid;?>.setOptions({styles: styles<?php echo $uniqid;?>});
                                var address = '<?php echo $address; ?>';
                                geocoder.geocode( { 'address': address}, function(results, status) {
                                    if (status == google.maps.GeocoderStatus.OK) {
                                        map<?php echo $uniqid;?>.setCenter(results[0].geometry.location);
                                        if (marker<?php echo $uniqid;?>) marker<?php echo $uniqid;?>.setMap(null);
                                        
                                        marker<?php echo $uniqid;?> = new google.maps.Marker({
                                            title: markerParam<?php echo $uniqid;?>.title,
                                            <?php if($image!=''){ ?>
                                            icon:image<?php echo $uniqid;?>,
                                            <?php }?>
                                            map: map<?php echo $uniqid;?>,                                            
                                            position: results[0].geometry.location,                                            
                                            draggable: false,
                                            animation: google.maps.Animation.DROP
                                            });  
                                                                                  
                                          if(markerParam<?php echo $uniqid;?>.contentInfo){                                                       
                                              var infowindow = new google.maps.InfoWindow({
                                                content: markerParam<?php echo $uniqid;?>.contentInfo
                                              });
                                              if(markerParam<?php echo $uniqid;?>.showContentOnload){
                                                infowindow.open(map<?php echo $uniqid;?>,marker<?php echo $uniqid;?>);
                                              }  
                                              
                                              <?php 
                                                    
                                              if($infoWindowControl=='true'){?>                                           
                                                  infowindow.open(map<?php echo $uniqid;?>,marker<?php echo $uniqid;?>);
                                                  google.maps.event.addListener(marker<?php echo $uniqid;?>, 'click', function() {
                                                      infowindow.open(map<?php echo $uniqid;?>,marker<?php echo $uniqid;?>);
                                                  });
                                               <?php }else { ?>  
                                                  google.maps.event.addListener(marker<?php echo $uniqid;?>, 'click', function() {
                                                      infowindow.open(map<?php echo $uniqid;?>,marker<?php echo $uniqid;?>);
                                                  });
                                               <?php  } ?>  
                                              
                                           }
                                    } else {
                                        alert("Please check the accuracy of Address");
                                    }
                                });
                            }                                         

	jQuery(document).ready(function() {
		var mod6map = <?php echo $width ?>;
		var mod6mapParrent = jQuery('#<?php echo "map_canvas-" . $uniqid;?>').parent().width();
		if( mod6map >= mod6mapParrent ){jQuery('#<?php echo "map_canvas-" . $uniqid;?>').width(mod6mapParrent);}
		else{jQuery('#<?php echo "map_canvas-" . $uniqid;?>').width(mod6map);}
		jQuery(window).resize(function() {
			var mod6map = <?php echo $width ?>;
			var mod6mapParrent = jQuery('#<?php echo "map_canvas-" . $uniqid;?>').parent().width();
			if( mod6map >= mod6mapParrent ){
			jQuery('#<?php echo "map_canvas-" . $uniqid;?>').width(mod6mapParrent);
			}else{
			jQuery('#<?php echo "map_canvas-" . $uniqid;?>').width(mod6map);
			}
			
		
		});
	});
</script>               
                        
              
<?php
if ($address) {
?>

	<div id="<?php echo "map_canvas-" . $uniqid;?>" class="mod6map"></div>
	
<?php } else { ?>
	<p>Please provide the address value.</p>
<?php }
