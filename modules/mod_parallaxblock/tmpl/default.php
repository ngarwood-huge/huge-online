<?php 
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root(true).'/modules/mod_parallaxblock/css/parallaxblock.css');
$document->addScript(JURI::root(true).'/modules/mod_parallaxblock/js/jquery.stellar.js');
//$document->addScript(JURI::root(true).'/modules/mod_parallaxblock/js/smoothing-scroll.js');
//print_r($params->get('selector'));
?>
<script type="text/javascript">

jQuery(document).ready(function() { 
  if (jQuery('html').hasClass('desktop')) {
	  var bgrotation = '<?php echo $params->get('backgroundratio');?>';
	  var horizontalOffset = '<?php echo $params->get('horizontalOffset');?>';
	  var verticalOffset = '<?php echo $params->get('verticalOffset');?>';
	  var selector = '<?php echo $params->get('selector');?>';
	  jQuery(selector).children('.container').wrap('<div class="stellar-block" data-stellar-background-ratio="'+bgrotation+'" data-stellar-horizontal-offset="'+horizontalOffset+'" data-stellar-vertical-offset="'+verticalOffset+'"></div>');

  }
});

</script>
<script type="text/javascript">
jQuery(document).ready(function() { 
  if (jQuery('html').hasClass('desktop')) {
	  jQuery.stellar({
		horizontalScrolling: false
	  });

  }
});
</script>
<style type="text/css">
<?php echo $params->get('selector');?> .stellar-block {
  background-image: url(<?php if($params->get('mod_image')!=null){echo JURI::root(true).'/'.$params->get('mod_image');}?>);
  background-position: 50% 100%;
}
@media only screen and (max-width: 1200px) {  
  <?php echo $params->get('selector');?>  {
    background-image: url(<?php if($params->get('mod_image')!=null){echo JURI::root(true).'/'.$params->get('mod_image');}?>);
 	background-position: 35% 50%;
	 background-attachment: scroll!important;
  }
}
</style>
