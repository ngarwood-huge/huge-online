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

 
defined('_JEXEC') or die;

jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');

if ( ! class_exists('PlgSystemWeb357frameworkInstallerScript'))
{
	require_once __DIR__ . '/script.install.helper.php';

	class PlgSystemWeb357frameworkInstallerScript extends PlgSystemWeb357frameworkInstallerScriptHelper
	{
		public $name           = 'Web357 Framework';
		public $alias          = 'web357framework';
		public $extension_type = 'plugin';

		public function onBeforeInstall($route)
		{
			// Check if is new version
			if ( ! $this->isNewer())
			{
				$this->softbreak = true;
				//return false;
			}

			return true;
		}

		public function onAfterInstall($route)
		{
			$this->deleteOldFiles();
		}

		private function deleteOldFiles()
		{
			JFile::delete(array(JPATH_SITE . '/plugins/system/web357framework/web357framework.script.php'));
		}
	}
}
