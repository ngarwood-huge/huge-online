<?php
/* ======================================================
 # Cookies Policy Notification Bar for Joomla! - v4.0.7 (pro version)
 # -------------------------------------------------------
 # For Joomla! CMS
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2021 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.
 # Demo: https://demo.web357.com/joomla/browse/cookies-policy-notification-bar
 # Support: support@web357.com
 # Last modified: Monday 03 May 2021, 08:04:11 PM
 ========================================================= */

defined('_JEXEC') or die;

require_once __DIR__ . '/script.install.helper.php';

class PlgAjaxCookiespolicynotificationbarInstallerScript extends PlgAjaxCookiespolicynotificationbarInstallerScriptHelper
{
	public $name           	= 'Cookies Policy Notification Bar';
	public $alias          	= 'cookiespolicynotificationbar';
	public $extension_type 	= 'plugin';
	public $plugin_folder   = 'ajax';
}