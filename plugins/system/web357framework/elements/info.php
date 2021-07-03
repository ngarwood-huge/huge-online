<?php
/* ======================================================
 # Web357 Framework for Joomla! - v1.8.3 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright (©) 2014-2021 Web357. All rights reserved.
 # License: GNU/GPLv3, http://www.gnu.org/licenses/gpl-3.0.html
 # Website: https:/www.web357.
 # Demo: https://demo.web357.com/joomla/
 # Support: support@web357.com
 # Last modified: Monday 03 May 2021, 08:04:11 PM
 ========================================================= */

 
defined('JPATH_BASE') or die;

require_once(JPATH_PLUGINS . DIRECTORY_SEPARATOR . "system" . DIRECTORY_SEPARATOR . "web357framework" . DIRECTORY_SEPARATOR . "elements" . DIRECTORY_SEPARATOR . "elements_helper.php");

jimport('joomla.form.formfield');

class JFormFieldinfo extends JFormField {
	
	protected $type = 'info';

	function getInput()
	{
		if (version_compare(JVERSION, '4.0', '>='))
		{
			return $this->getInput_J4();
		}
		else
		{
			return $this->getInput_J3();
		}
	}

	function getLabel()
	{
		if (version_compare(JVERSION, '4.0', '>='))
		{
			return $this->getLabel_J4();
		}
		else
		{
			return $this->getLabel_J3();
		}
	}

	protected function getLabel_J3()
	{	
		return VersionChecker::outputMessage($this->element);
	}
	
	protected function getInput_J3()
	{
		return ' ';
	}

	protected function getLabel_J4()
	{
		return 'Version Checker';
	}

	protected function getInput_J4()
	{
		return VersionChecker::outputMessage($this->element);
	}
}