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
jimport('joomla.form.formfield');

class JFormFieldVmmanufacturers extends JFormField
{
	var $type = 'vmmanufacturers';

    function getInput() 
    {
		if (!class_exists( 'VmConfig' )) require(JPATH_ROOT .'/administrator/components/com_virtuemart/helpers/config.php');
		VmConfig::loadConfig();
		$model = VmModel::getModel('Manufacturer');
		$manufacturers = $model->getManufacturers(true, true, false);
		return JHtml::_('select.genericlist', $manufacturers, $this->name, 'class="inputbox"  size="1" multiple="multiple"', 'virtuemart_manufacturer_id', 'mf_name', $this->value, $this->id);
	}
}