<?php

/**
 * @package bootstrapmegamenu Bootstrap Mega Menu for Joomla
 * @subpackage mod_bootstrapmegamenu
 * @copyright Copyright (C) 2013 T.V.T Marine Automation (aka TVTMA). All rights reserved.
 * @license http://www.gnu.org/licenses GNU General Public License version 2 or later; see LICENSE.txt
 * @author url: http://ma.tvtmarine.com
 * @author TVTMA support@ma.tvtmarine.com
 */
// Deny direct access

defined('_JEXEC') or die();

defined('DS') or define('DS', DIRECTORY_SEPARATOR);
require_once __DIR__ . '/helper.php';
// initial declaration
$module_path = 'modules/mod_bootstrapmegamenu';
$assets_path = $module_path . '/assets';

$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base() . 'modules/mod_bootstrapmegamenu/assets/superfish.css');
$doc->addStyleSheet(JURI::base() . 'modules/mod_bootstrapmegamenu/assets/slicknav.css');

$doc->addScript(JURI::base() . 'modules/mod_bootstrapmegamenu/js/superfish.js');
$doc->addScript(JURI::base() . 'modules/mod_bootstrapmegamenu/js/hoverIntent.js');
$doc->addScript(JURI::base() . 'modules/mod_bootstrapmegamenu/js/sftouchscreen.js');
$doc->addScript(JURI::base() . 'modules/mod_bootstrapmegamenu/js/jquery.slicknav.js');

$list = ModBootstrapMegaMenuHelper::getList($params);
$base = ModBootstrapMegaMenuHelper::getBase($params);
$active = ModBootstrapMegaMenuHelper::getActive($params);
$active_id = $active->id;
$path = $base->tree;

$showAll = $params->get('showAllChildren');
$class_sfx = htmlspecialchars($params->get('class_sfx'));


$plugin = JPluginHelper::getPlugin('system', 'bootstrapmegamenu');
$plg_params = new JRegistry();
$plg_params->loadString($plugin->params);

if (count($list))
{
        require JModuleHelper::getLayoutPath('mod_bootstrapmegamenu', $params->get('layout', 'default'));
}