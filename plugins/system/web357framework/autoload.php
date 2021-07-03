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

// Registers Web357 framework's namespace
JLoader::registerNamespace('Web357Framework', __DIR__ . '/Web357Framework/', false, false, 'psr4' );

JLoader::registerAlias('Functions', '\\Web357Framework\\Functions');
JLoader::registerAlias('VersionChecker', '\\Web357Framework\\VersionChecker');