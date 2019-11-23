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

$uniqid 		= $module->id;
$address		= $params->get ('address','');
$height			= $params->get ('height',300);
$width			= $params->get ('widht',500);
$map_type		= $params->get ('map_type','ROADMAP');
$zoom			= $params->get ('zoom',6);
$zoomControl		= $params->get ('zoomControl','true');
$mapTypeControl		= $params->get ('mapTypeControl','true');
$scaleControl	  	= $params->get ('scaleControl','true');
$streetViewControl	= $params->get ('streetViewControl','true');
$panControl         = $params->get ('panControl','true');
$overviewMapControl = $params->get ('overviewMapControl','true');
$rotateControl      = $params->get ('rotateControl','true');
$infoWindowControl  = $params->get ('infoWindowControl','false');

$cheangeMapColor    = $params->get ('cheangeMapColor');
    if ($cheangeMapColor=='true'){     
      $mapColor = $params->get ('mapColor');
    }else{     
      $mapColor = '';
    }
    
$image = trim($params->get('image'));
  if($image!=''){
    $siseImage = array();
    $siseImage = getimagesize($params->get('image'));
  }
    $markerParam =  '{';
    if($params->get('title')!=''){
      $markerParam .=  'title:\''.addslashes($params->get('title')).'\',';
    }
    if($image!=''){
      $markerParam .=  'image:\''.($image!=''? JURI::root().$image:'').'\',';
    }
    $txt =  json_encode($params->get('contentInfo'));
    if ($txt!='null'){
      $markerParam .=  'contentInfo:'. $txt.',';
    }
    $markerParam .=  '};';
$doc = JFactory::getDocument();
$doc->addScript('https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');//Add map api script
$doc->addStyledeclaration("#map_canvas-" . $uniqid . " {margin:0;padding:0;height:" . $height . "px}");//Add inline stlesheet
require(JModuleHelper::getLayoutPath('mod_6map'));//Load layout
if($params->get('jquery-local',1) == "1") {
    JHtml::_('script',JURI::base()."modules/mod_6map/assets/js/jquery-1.7.1.min.js");
}