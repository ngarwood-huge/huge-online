<?php 
defined('_JEXEC') or die;
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::root(true).'/modules/mod_video/css/video.css');
$document->addScript(JURI::root(true).'/modules/mod_video/js/jquery.vide.min.js');
//print_r($params->get('selector'));
?>
<script type="text/javascript">
jQuery(document).ready(function(){
  if (jQuery('html').hasClass('desktop')) {
	
	var selector = '<?php echo $params->get('vidselector');?>';
	var path = '<?php echo $params->get('videopath');?>';
	var filename = '<?php echo $params->get('filesname');?>';
	var basepath = '<?php echo JURI::root(true).'/'; ?>';

	jQuery(selector).vide(basepath+path+filename, {
		volume: 1,
		playbackRate: 1,
		muted: true,
		loop: true,
		autoplay: true,
		position: "50% 50%", // Similar to the CSS `background-position` property.
		posterType: "detect" // Poster image type. The default is "detect", which means auto-detection.
	});
  }
});

</script>
