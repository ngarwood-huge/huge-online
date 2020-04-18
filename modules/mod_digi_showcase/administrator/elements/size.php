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

class JFormFieldSize extends JFormField {
    protected $type = 'Size';
    
    protected function getInput() {
        
        // assign the default data
        $type = 'number';
        $class = '';
        
        // check if input has a class
        if ($this->element['class']) {
            
            // get input class
            $class .= $this->element['class'];
            
            // check if input should be number or text
            if (($class == 'padding') || ($class == 'margin')) {
				$type = 'text';
			}
			
        }
        
        // get input number data
        if ($type == 'number') {
        	
        	$min = '';
			$max = '';
			$step = '';
        	
        	if ($this->element['min']) {
				$min .= $this->element['min'];
			}
			if ($this->element['max']) {
				$max .= $this->element['max'];
			}
			if ($this->element['step']) {
				$step .= $this->element['step'];
			}
        	
        }
        
        // generate input html
        $html = '<input type="'.$type.'" 
        '.($type == 'number' ? ($min ? 'min="'.$this->element['min'].'"' : '') : '').'
        '.($type == 'number' ? ($max ? 'max="'.$this->element['max'].'"' : '') : '').'
        '.($type == 'number' ? ($step ? 'step="'.$this->element['step'].'"' : '') : '').' 
        '.($class ? 'class="input-'.$this->element['class'].'"' : '').' 
        name="'.$this->name.'" 
        id="'.$this->id.'" 
        value="'.htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8').'">';
        
        // generate unit measurement label
        if ($this->element['extension'] == 'px') {
            $html .= '<span class="label label-info px">px</span>';
        } else if($this->element['extension'] == 'percent') {
            $html .= '<span class="label label-info percent">%</span>';
        }
        
        return $html;
    }
}

?>