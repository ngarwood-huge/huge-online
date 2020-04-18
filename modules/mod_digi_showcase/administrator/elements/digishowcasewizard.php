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

jimport('joomla.filesystem.file');

class JFormFieldDigishowcasewizard extends JFormField {
    protected $type = 'Digishowcasewizard';
    
    protected function getInput() {
    	
    	// general variables
    	$document = JFactory::getDocument();
    	
    	// add css style
		$document->addStyleDeclaration('
			#wizard_form {
				background-color: #0075b7;
				border-color: #0075b7;
				background-image: url("'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'wizard-pattern.png");
				background-repeat: repeat;
			}
			#wizard_form > * {
				color: #fff;
			}
			#wizard_form .lead {
				font-weight: 400;
			}
			#wizard_icons_wrap div.icon-wrapper {
				float: left;
				display: block !important;
				width: auto !important;
				height: auto !important;
				line-height: 12px !important;
				background: none;
			}
			#wizard_icons_wrap div.icon {
				text-align: center;
				margin-right: 15px;
				float: left;
				margin-bottom: 15px;
			}
			#wizard_icons_wrap div.icon a {
				background-color: #fff;
				background-position: -30px;
				display: block;
				float: left;
				height: 97px;
				width: 108px;
				color: #565656;
				vertical-align: middle;
				text-decoration: none;
				border: 1px solid #CCC;
				-webkit-border-radius: 5px;
				-moz-border-radius: 5px;
				border-radius: 5px;
				-webkit-transition-property: background-position, 0 0;
				-moz-transition-property: background-position, 0 0;
				-webkit-transition-duration: .8s;
				-moz-transition-duration: .8s;
			}
			#wizard_icons_wrap div.icon a:hover,
			#wizard_icons_wrap div.icon a:focus,
			#wizard_icons_wrap div.icon a:active {
				background-position: 0;
				-webkit-border-bottom-left-radius: 50% 20px;
				-moz-border-radius-bottomleft: 50% 20px;
				border-bottom-left-radius: 50% 20px;
				-webkit-box-shadow: -5px 10px 15px rgba(0,0,0,0.25);
				-moz-box-shadow: -5px 10px 15px rgba(0,0,0,0.25);
				box-shadow: -5px 10px 15px rgba(0,0,0,0.25);
				position: relative;
				z-index: 10;
			}
			#wizard_icons_wrap div.icon a img {
				padding: 10px 15px 5px;
				margin: 0 auto;
			}
			#wizard_icons_wrap div.icon a span {
				display: block;
				text-align: center;
			}
		');
    	
    	// add javascript code
    	$document->addScriptDeclaration('
			$j(document).ready(function(){
				
				var wizard_message_container = $j("#wizard_message");
				
				$j(function wizard() {
					
					$j("#wizard_icons_wrap").children(".icon-wrapper").each(function() {
						
						var button = $j(this);
						var operation = $j(this).attr("id").replace("wizard_", "");
						
						button.click(function(e) {
							e.stopPropagation();
							e.preventDefault();
							wizardOperation(operation);
						});
					
					});
					
				});
				
				function wizardOperation(current_operation) {
					
					// get the current url
					var current_url = window.location;
					
					// add the current task to the url
					current_url += "&wizard_task=" + current_operation;
					
					$j("#wizard_icons_wrap").fadeOut(function() {
						
						// show the loading alert
						wizard_message_container.html("<div class=\"alert alert-block alert-info\"><h4>PLEASE WAIT</h4> <span id=\"loader\"><img style=\"margin-left: 30px;\" width=\"14\" src=\"http://www.digigreg.com/images/icons/loader.gif\" alt=\"loading\"></span></div>");
					});
					
					$j.ajax({
						url: current_url,
						success: function() {
							
							// show the success alert
							wizard_message_container.html("<div class=\"alert alert-block alert-success\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a><h4>DONE</h4> A beautiful " + current_operation.replace("wizard_", "").replace("_", " ").toLowerCase() + " has been created.</div>");
							
							// reload the page and remove from the url undesidered parts
							window.location = current_url.replace("#", "").replace("&wizard_task=" + current_operation, "");
						}
					});
					
				}
				
			});
		');
        
        // include digigreg api
        include_once "digigreg_api.php";
        
        // general variables
        $uri = JFactory::getURI();
        
        // set the table and the column of database
        $db_table = '#__modules';
        $db_column = 'id';
        
        // get variables from url
        $extension_id = $uri->getVar('id', 'none');
        $task = $uri->getVar('wizard_task', 'none');
        
        // if url contains proper variables
		if ($extension_id !== 'none' && is_numeric($extension_id) && $task !== 'none') {
			
			// get module data from database
			$dbo = JFactory::getDBO();
			$query = 'SELECT params FROM '.$db_table.' WHERE '.$db_column.' = '.$extension_id.' LIMIT 1';	
            $dbo->setQuery($query);
            $params = $dbo->loadObject();
			
			// replace params
			$params = json_decode($params->params);
			
			if ($task == 'list') {
				// mode
				$params->mode = 0;
				$params->rows = 10;
				$params->columns = 1;
				// layout
				$params->{'filter-switch'} = 0;
				$params->{'items-padding'} = '15 15 15 15';
				$params->{'items-css'} = 'border: 2px solid; border-radius: 2px; margin-bottom: 15px;';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 0;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 1;
				$params->{'category-switch'} = 1;
				$params->{'show-extra-info'} = 1;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 0;
			} else if ($task == 'table') {
				// mode
				$params->mode = 0;
				$params->rows = 6;
				$params->columns = 4;
				// layout
				$params->{'filter-switch'} = 0;
				$params->{'items-padding'} = '10 10 10 10';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 0;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 1;
				$params->{'category-switch'} = 1;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 0;
			} else if ($task == 'slideshow') {
				// mode
				$params->mode = 1;
				$params->{'carousel-mode'} = 0;
				$params->{'carousel-autoanimation'} = 1;
				$params->{'carousel-autoanimation-interval'} = 5000;
				$params->{'carousel-items-quantity'} = 3;
				$params->{'carousel-columns-quantity'} = 1;
				$params->{'carousel-scroll-quantity'} = 1;
				$params->{'carousel-arrows'} = 1;
				$params->{'carousel-dots'} = 0;
				$params->{'carousel-loop'} = 1;
				$params->{'carousel-center-element'} = 0;
				// layout
				$params->{'filter-switch'} = 0;
				$params->{'items-padding'} = '0 0 0 0';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 0;
				$params->{'show_title'} = 0;
				$params->{'show_description'} = 0;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 0;
			} else if ($task == 'carousel') {
				// mode
				$params->mode = 1;
				$params->{'carousel-mode'} = 0;
				$params->{'carousel-autoanimation'} = 1;
				$params->{'carousel-autoanimation-interval'} = 3000;
				$params->{'carousel-items-quantity'} = 6;
				$params->{'carousel-columns-quantity'} = 3;
				$params->{'carousel-scroll-quantity'} = 1;
				$params->{'carousel-arrows'} = 1;
				$params->{'carousel-dots'} = 1;
				$params->{'carousel-loop'} = 1;
				$params->{'carousel-center-element'} = 1;
				// layout
				$params->{'filter-switch'} = 0;
				$params->{'items-padding'} = '0 0 0 0';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 0;
				$params->{'show_title'} = 0;
				$params->{'show_description'} = 0;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 0;
			} else if ($task == 'timeline') {
				// mode
				$params->mode = 2;
				$params->{'timeline-items-quantity'} = 12;
				$params->{'timeline-animation'} = 1;
				$params->{'timeline-image-inside'} = 0;
				// layout
				$params->{'filter-switch'} = 1;
				$params->{'filter-alignment'} = 1;
				$params->{'items-padding'} = '0 10 0 10';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 1;
				$params->{'image_width'} = 100;
				$params->{'image_height'} = 100;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 1;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 1;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 0;
			} else if ($task == 'tag_cloud') {
				// mode
				$params->mode = 3;
				$params->{'sphere-items-quantity'} = 18;
				$params->{'sphere-width'} = 400;
				$params->{'sphere-height'} = 400;
				$params->{'sphere-radius'} = 150;
				// layout
				$params->{'filter-switch'} = 0;
				$params->{'items-padding'} = '0 0 0 0';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 1;
				$params->{'image_width'} = 100;
				$params->{'image_height'} = 100;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 0;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 0;
			} else if ($task == 'random_grid') {
				// mode
				$params->mode = 4;
				$params->{'masonry-items-quantity'} = 20;
				$params->{'masonry-columns'} = 5;
				$params->{'masonry-mode'} = 1;
				// layout
				$params->{'filter-switch'} = 1;
				$params->{'filter-alignment'} = 1;
				$params->{'items-padding'} = '10 10 10 10';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 1;
				$params->{'image_width'} = 400;
				$params->{'image_height'} = 400;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 0;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 1;
			} else if ($task == 'big_grid') {
				// mode
				$params->mode = 4;
				$params->{'masonry-items-quantity'} = 9;
				$params->{'masonry-columns'} = 6;
				$params->{'masonry-mode'} = 0;
				$params->{'masonry-blocks-size'} = 1;
				// layout
				$params->{'filter-switch'} = 1;
				$params->{'filter-alignment'} = 1;
				$params->{'items-padding'} = '10 10 10 10';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 1;
				$params->{'image_width'} = 400;
				$params->{'image_height'} = 400;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 0;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 1;
			} else if ($task == 'small_grid') {
				// mode
				$params->mode = 4;
				$params->{'masonry-items-quantity'} = 25;
				$params->{'masonry-columns'} = 5;
				$params->{'masonry-mode'} = 0;
				$params->{'masonry-blocks-size'} = 0;
				// layout
				$params->{'filter-switch'} = 1;
				$params->{'filter-alignment'} = 1;
				$params->{'items-padding'} = '10 10 10 10';
				$params->{'items-css'} = '';
				// items
				$params->{'show_image'} = 1;
				$params->{'image-type'} = 3;
				$params->{'show_placeholder_image'} = 1;
				$params->{'generate_thumbnail'} = 1;
				$params->{'image_width'} = 200;
				$params->{'image_height'} = 200;
				$params->{'show_title'} = 1;
				$params->{'show_description'} = 0;
				$params->{'category-switch'} = 0;
				$params->{'show-extra-info'} = 0;
				$params->{'items-background-switch'} = 0;
				$params->{'items-background-overlay'} = 1;
			}
			
			
			$params = json_encode($params);
			
			// set module data in database
			$dbo = JFactory::getDBO();
			$query = 'UPDATE '.$db_table.' SET params = '.$dbo->quote($params).' WHERE '.$db_column.' = '.$extension_id.' LIMIT 1';
            $dbo->setQuery($query);
            $result = $dbo->query();
            
        }
        
        $html = '';
        
        $html .= '<div id="wizard_form" class="well">';
        $html .= '<h2>'.JText::_('MOD_DIGI_SHOWCASE_FIELD_WIZARD_TITLE').'</h2>';
        $html .= '<p class="lead">'.JText::_('MOD_DIGI_SHOWCASE_FIELD_WIZARD_DESC').'</p>';
        $html .= '<div id="wizard_message" class="system-message"></div>';
        $html .= '<div id="wizard_icons_wrap" class="clearfix">';
        
        // standard
        $html .= '<div id="wizard_list" class="icon-wrapper"><div class="icon"><a href="#"><img alt="List" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'list.png" width="60">List</a></div></div>';
        $html .= '<div id="wizard_table" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Table" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'table.png" width="60">Table</a></div></div>';
        
        // carousel
        $html .= '<div id="wizard_slideshow" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Slideshow" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'slideshow.png" width="60">Slideshow</a></div></div>';
        $html .= '<div id="wizard_carousel" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Carousel" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'carousel.png" width="60">Carousel</a></div></div>';
        
        // timeline
        $html .= '<div id="wizard_timeline" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Timeline" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'timeline.png" width="60">Timeline</a></div></div>';
        
        // tag cloud
        $html .= '<div id="wizard_tag_cloud" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Tag Cloud" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'tag_cloud.png" width="60">Tag Cloud</a></div></div>';
        
        // masonry
        $html .= '<div id="wizard_random_grid" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Random Grid" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'random-grid.png" width="60">Random Grid</a></div></div>';
        $html .= '<div id="wizard_big_grid" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Big Grid" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'big-grid.png" width="60">Big Grid</a></div></div>';
        $html .= '<div id="wizard_small_grid" class="icon-wrapper"><div class="icon"><a href="#"><img alt="Small Grid" src="'.juri::root().'modules'.DS.'mod_digi_showcase'.DS.'assets'.DS.'images'.DS.'small-grid.png" width="60">Small Grid</a></div></div>';
        
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}

?>