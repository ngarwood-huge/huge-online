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

jimport('joomla.form.formfield');

class JFormFieldrestoretodefaults extends JFormField {
	
	protected $type = 'restoretodefaults';

	protected function getInput()
	{
		$html = '';

		// Get Joomla! version
		$jversion = new JVersion;
		$short_version = explode('.', $jversion->getShortVersion()); // 3.8.10
		$mini_version = $short_version[0].'.'.$short_version[1]; // 3.8

		if (version_compare( $mini_version, "2.5", "<=")):
			// j25
			$j25 = true;
			$j3x = false;
		else:
			// j3x
			$j25 = false;
			$j3x = true;
		endif;

		if ($j25)
		{
			$html .= '<div style="display: block;border: 2px solid red;clear: both;padding: 4px;">This "Restore to Defaults" feature is not supported in Joomla! 2.5</div>';
		}
		else
		{
			// load js
			JFactory::getDocument()->addScript(JURI::root(true).'/plugins/system/cookiespolicynotificationbar/assets/js/admin.min.js');

			$html .= '<p><a class="btn btn-danger cpnb-restore-to-detafaults-btn" data-cpnb-restore-to-defaults-confirmation-msg="'.JText::_('PLG_SYSTEM_CPNB_RESTORE_TO_DEFAULTS_CONFIRMATION_MSG').'"><strong>'.JText::_('PLG_SYSTEM_CPNB_RESTORE_TO_DEFAULTS_BTN').'</strong></a></p>';
			$html .= '<div class="cpnb-settings-restored-to-default"></div>';
		}
		
		return $html;		
	}
}