<?php
/**
 * 
 * @version             See field version manifest file
 * @package             See field name manifest file
 * @author				Gregorio Nuti
 * @copyright			See field copyright manifest file
 * @license             GNU General Public License version 2 or later
 * 
 */

// no direct access
defined('_JEXEC') or die;

// define ds variable for joomla 3 compatibility
if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

jimport('joomla.form.formfield');

class JFormFieldTime extends JFormField {
    protected $type = 'Time';
    
    protected function getInput() {
        
        // assign the default data
        $type = 'number';
        $class = '';
        $min = '';
		$max = '';
		$step = '';
        
        // check if input has a class
        if ($this->element['class']) {
            
            // get input class
            $class .= $this->element['class'];
            
        }
        
        // get input number data
        if ($this->element['min']) {
			$min .= $this->element['min'];
		}
		if ($this->element['max']) {
			$max .= $this->element['max'];
		}
		if ($this->element['step']) {
			$step .= $this->element['step'];
		}
        
        // generate input html
        $html = '<input type="'.$type.'" 
        '.($min ? 'min="'.$this->element['min'].'"' : '').' 
        '.($max ? 'max="'.$this->element['max'].'"' : '').' 
        '.($step ? 'step="'.$this->element['step'].'"' : '').' 
        '.($class ? 'class="input-'.$this->element['class'].'"' : '').' 
        name="'.$this->name.'" 
        id="'.$this->id.'" 
        value="'.htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8').'">';
        
        // generate unit measurement label
        if ($this->element['extension'] == 's') {
            $html .= '<span class="label label-info seconds">s</span>';
        } else if($this->element['extension'] == 'ms') {
            $html .= '<span class="label label-info milliseconds">ms</span>';
        }
        
        return $html;
    }
}

?>