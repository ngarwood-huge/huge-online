<?php
defined('_JEXEC') or  die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
/*
*Cart Ajax Module
*
* @version $Id: mod_virtuemart_cart_tm.php 5482 2012-02-19 00:49:18Z Milbo $
* @package VirtueMart
* @subpackage modules
*
* 	@copyright (C) 2010 - Patrick Kohl
// W: demo.st42.fr
// E: cyber__fr|at|hotmail.com
*
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* VirtueMart is Free Software.
* VirtueMart comes with absolute no warranty.
*
* www.virtuemart.net
*/
/*if (!class_exists( 'VmConfig' )) {
require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');}
//VmConfig::loadConfig();

vmJsApi::jPrice();
vmJsApi::cssSite();*/
defined('DS') or define('DS', DIRECTORY_SEPARATOR);
$jsVars  = ' jQuery(document).ready(function(){
	jQuery(".vmCartModule").productUpdate();

});' ;

if (!class_exists( 'VmConfig' )) require(JPATH_ADMINISTRATOR . DS . 'components' . DS . 'com_virtuemart'.DS.'helpers'.DS.'config.php');

if(!class_exists('VirtueMartCart')) require(JPATH_VM_SITE.DS.'helpers'.DS.'cart.php');
require_once JPATH_SITE.DS.'plugins'.DS.'system'.DS.'vm2_cart'.DS.'vm2_cart.php';
$plg=new plgSystemVM2_Cart(JDispatcher::getInstance(),array());
$data=$plg->prepareAjaxData();

$lang = JFactory::getLanguage();
$extension = 'mod_virtuemart_cart_tm';
$lang->load($extension);//  when AJAX it needs to be loaded manually here >> in case you are outside virtuemart !!!
if ($data->totalProduct>1) $data->totalProductTxt = JText::sprintf('TM_VIRTUEMART_CART_X_PRODUCTS', $data->totalProduct);
else if ($data->totalProduct == 1) $data->totalProductTxt = JText::_('TM_VIRTUEMART_ITEM');
else $data->totalProductTxt = JText::_('TM_VIRTUEMART_EMPTY_CART');
$data->totalProductTxt = '<span class="cart_num"><span class="crt-text">'.JText::_('TM_VIRTUEMART_NOW_IN_YOUR_CART').'</span><a href="' . JRoute::_('index.php?option=com_virtuemart&view=cart') . '">' . $data->totalProductTxt . '</a></span>';

if (false && $data->dataValidated == true) {
	$taskRoute = '&task=confirm';
	$linkName = JText::_('COM_VIRTUEMART_CART_CONFIRM');
} else {
	$taskRoute = '';
	$linkName = JText::_('COM_VIRTUEMART_CART_SHOW');
}
$useSSL = VmConfig::get('useSSL',0);
$useXHTML = true;
$data->cart_show = '<a style ="float:right;" href="'.JRoute::_("index.php?option=com_virtuemart&view=cart".$taskRoute,$useXHTML,$useSSL).'"><span><span>'.$linkName.'</span></span></a>';
$data->billTotal = '<span>'.$lang->_('COM_VIRTUEMART_CART_TOTAL').':</span>'.'<strong>'. $data->billTotal .'</strong>';
$URLOriginal = JURI::base();
$module_base = $URLOriginal . 'modules/mod_virtuemart_cart_tm/tmpl/';
vmJsApi::jQuery();
vmJsApi::jPrice();
echo vmJsApi::writeJS();
$document = JFactory::getDocument();
//$document->addScriptDeclaration($jsVars);
$moduleclass_sfx = $params->get('moduleclass_sfx', '');
//$show_price = (bool)$params->get( 'show_price', 1 ); // Display the Product Price?
//$show_product_list = (bool)$params->get( 'show_product_list', 1 ); // Display the Product Price?
/* Laod tmpl default */
//JHTML::script(JURI::base().'modules/mod_virtuemart_cart_tm/assets/vmprices2.js');
require(JModuleHelper::getLayoutPath('mod_virtuemart_cart_tm'));

 ?>