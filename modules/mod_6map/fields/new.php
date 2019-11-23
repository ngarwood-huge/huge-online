<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
 
jimport('joomla.form.formfield');
$document = JFactory::getDocument();
$document->addStylesheet(JURI::base(true) . '/../modules/mod_6map/assets/css/mod_style.css');
$document->addStylesheet(JURI::base(true) . '/../modules/mod_6map/assets/css/font-awesome.css');
$document->addScript(JURI::root() . "modules/mod_6map/assets/js/js.js");

// The class name must always be the same as the filename (in camel case)
class JFormFieldNew extends JFormField {
        //The field class must know its own type through the variable $type.
        protected $type = 'New';
        public function getInput() {}
}