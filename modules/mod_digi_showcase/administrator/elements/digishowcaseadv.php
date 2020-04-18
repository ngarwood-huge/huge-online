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

class JFormFieldDigishowcaseadv extends JFormField {
    protected $type = 'Digishowcaseadv';
    
    protected function getInput() {
    	
    	// general variables
    	$link = 'https://www.digigreg.com/en/products/joomla-plugins/digi-showcase-plugins.html';
    	$document = JFactory::getDocument();
    	
    	// add css style
		$document->addStyleDeclaration('
			#digigreg_adv {
				background-color: #00b16a;
				background-image: url("'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'adv-pattern.png");
				background-repeat: repeat;
				border-color: #00b16a;
				position: relative;
				z-index: 0;
				display: flex;
				align-items: center;
				justify-content: center;
				min-height: 276px;
				overflow: hidden;
			}
			#digigreg_adv > * {
				color: #fff;
			}
			#digigreg_adv .lead {
				font-weight: 400;
			}
			#digigreg_adv_text {
				text-align: center;
			}
			#digigreg_adv .pulse {
				z-index: -1;
				position: absolute;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				max-width: 1024px;
			}
			#digigreg_adv .pulse circle {
				fill: #7fc6a4;
				transform: scale(0);
				opacity: 0;
				transform-origin: 50% 50%;
				animation: pulse 2s cubic-bezier(.5,.5,0,1) infinite;
			}
			#digigreg_adv .pulse circle:nth-child(2) {
				animation: pulse 2s 0.75s cubic-bezier(.5,.5,0,1) infinite;
			}
			#digigreg_adv .pulse circle:nth-child(3) {
				animation: pulse 2s 1.5s cubic-bezier(.5,.5,0,1) infinite;
			}
			@keyframes pulse {
				25% {
					opacity: 0.4;
				}
				100% {
					transform: scale(1);
				}
			}
		');
        
        $html = '';
        
        $html .= '<div id="digigreg_adv" class="well">';
        
        $html .= '<div id="digigreg_adv_text">';
        
        $html .= '<h2>'.strToUpper(JText::_('MOD_DIGI_SHOWCASE_ADV_TITLE')).'</h2>';
        
        $html .= '<br />';
        
        $html .= '<p class="lead">'.JText::_('MOD_DIGI_SHOWCASE_ADV_DESC').'</p>';
        
		$html .= '<br />';
		
		$html .= '<p><a class="btn btn-default" href="'.$link.'" target="_blank">'.strToUpper(JText::_('MOD_DIGI_SHOWCASE_READ_MORE')).'</a></p>';
		
		$html .= '</div>';
		
		$html .= '<svg class="pulse" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
					<circle id="Oval" cx="512" cy="512" r="512"></circle>
					<circle id="Oval" cx="512" cy="512" r="512"></circle>
					<circle id="Oval" cx="512" cy="512" r="512"></circle>
				  </svg>';
		
		$html .= '</div>';	
        
        return $html;
        
    }
}

?>