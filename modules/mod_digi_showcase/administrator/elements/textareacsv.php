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

class JFormFieldTextareacsv extends JFormField {
    protected $type = 'Textareacsv';
    
    protected function getInput() {
    	
    	$document = JFactory::getDocument();
    	
    	// add css style
		$document->addStyleDeclaration('
			.textarea-csv .label {
				margin-bottom: 5px;
				margin-right: 5px;
				white-space: normal;
			}
			@media (max-width: 767px) {
				.textarea-csv .well {
					margin-top: 20px;
				}
			}
		');
    	
    	// add javascript code
    	$document->addScriptDeclaration('
			$j(document).ready(function(){
				
				$j(".textarea-csv").each(function() {
				
					var item_id = "#" + $j(this).attr("id");
					var target_id = "#" + $j(item_id).find("textarea").attr("id");
		
				
					$j(target_id).focus(function() {
						$j(item_id).children(".well").show();
						textareaBeautify();
					});
		
					$j(target_id).focusout(function() {
						$j(item_id).children(".well").hide();
					});
		
					$j(target_id).keyup(function() {
						textareaBeautify();
					});
		
					function textareaBeautify() {
						$j(item_id).children(".well").html("");
						var content = $j(target_id).val();
						var valuesArray = $j(target_id).attr("values").split(",");
						var valuesNumber = valuesArray.length
						if (content) {
							var itemsArray = content.split("\n");
							$j.each(itemsArray,function(i) {
								$j(item_id).children(".well").append("<span class=\"label label-success\"> " + (i + 1) + " </span>");
								var dataArray = itemsArray[i].split(",");
								$j.each(dataArray,function(e) {
									if (e <= (valuesNumber - 1)) {
										if (dataArray[e]) {
											$j(item_id).children(".well").append("<span class=\"label label-info\"> " + valuesArray[e] + ": " + dataArray[e] + " </span>");
										} else {
											$j(item_id).children(".well").append("<span class=\"label label-warning\"> " + valuesArray[e] + ": missing </span>");
										}
									} else {
										if (dataArray[e]) {
											$j(item_id).children(".well").append("<span class=\"label label-danger\"> Unrecognized variable: " + dataArray[e] + " </span>");
										} else {
											$j(item_id).children(".well").append("<span class=\"label label-danger\"> Unneeded comma </span>");
										}
									}
								});
								$j(item_id).children(".well").append("<hr />");
							});
						}
					}
		
				});
				
			});
		');
        
        // assign the default data
        $rows = $this->element['rows'];
        $cols = $this->element['cols'];
        $class = '';
        $values = $this->element['values'];
        
        // check if input has a class
        if ($this->element['class']) {
            
            // get input class
            $class .= $this->element['class'];
			
        }
        
        // generate input html
        $html = '';
        
        $html .= '<div id="'.$this->id.'_wrapper" class="textarea-csv">';
        
        $html .= '<div class="span6">';
        
        $html .= '<textarea name="'.$this->name.'" id="'.$this->id.'"
        '.($rows ? 'rows="'.$this->element['rows'].'"' : '').'
        '.($cols ? 'cols="'.$this->element['cols'].'"' : '').'
        '.($values ? 'values="'.$this->element['values'].'"' : '').'
        '.($class ? 'class="input-'.$this->element['class'].'"' : '').'
        >'. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '</textarea>';
        
        $html .= '</div>';
        
        $html .= '<div class="span6 well hide">';
        
        $html .= '</div>';
        
        $html .= '</div>';
        
        return $html;
    }
}

?>