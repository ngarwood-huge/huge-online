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

 
defined('JPATH_BASE') or die;
		
jimport('joomla.form.formfield');
jimport( 'joomla.form.form' );

class JFormFieldcpnbstatus extends JFormField {
	
	protected $type = 'cpnbstatus';

	protected function getLabel()
	{
		// BEGIN: Check if CPNB plugin exists
		jimport('joomla.plugin.helper');
		if(!JPluginHelper::isEnabled('system', 'cookiespolicynotificationbar')):
			return JText::_('<div style="border:1px solid red; padding:10px; width: 50%"><strong style="color:red;">The plugin is unpublished.</strong><br>The plugin should be enabled to display the input text fields for each of your active languages. Please, enable the plugin first and then try to navigate to this tab again!</div>');
		else:
			return '';	
		endif;
		// END: Check if CPNB plugin exists
	}

	protected function getInput() 
	{
		return '';
	}
	
}