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

class mod_Digi_ShowcaseInstallerScript {
	
	function update($parent) {
		
		$newVersion = $parent->get('manifest')->version;
		
		if ($newVersion == '2.0.0') {
			
			// update all stored values with new names
			$dbo = JFactory::getDBO();
			$query = ('SELECT mo.* FROM `#__modules` mo WHERE `module` = \'mod_digi_showcase\' AND `client_id` = 0');
			$dbo->setQuery($query);
        	$modules = $dbo->loadAssocList();
        	
        	echo '<hr />';
        	
        	echo '<ul>';
			
			if(!empty($modules)) {
				foreach($modules AS $module) {
					
					// get module params
					$params = $module['params'];
					
					// replace values
					if (strpos($params, 'module_version') === false) {
						
						$params = str_replace('articles_category', 'joomla-categories', $params);
						$params = str_replace('show_expired_articles', 'show-expired-articles', $params);
						$params = str_replace('articles_time_correction', 'articles-time-correction', $params);
						$params = str_replace('intro_text', 'intro-text', $params);
						$params = str_replace('show_title', 'show-title', $params);
						$params = str_replace('show_description', 'show-description', $params);
						$params = str_replace('characters', 'description-characters', $params);
						$params = str_replace('show_created_date', 'show-created-date', $params);
						$params = str_replace('show_image', 'show-image', $params);
						$params = str_replace('show_placeholder_image', 'show-placeholder-image', $params);
						$params = str_replace('generate_thumbnail', 'generate-thumbnail', $params);
						$params = str_replace('image_width', 'image-width', $params);
						$params = str_replace('image_height', 'image-height', $params);
						$params = str_replace('order_by', 'order-by', $params);
						$params = str_replace('order_type', 'order-type', $params);
						$params = str_replace('characters', 'title-characters', $params);
					
						// update the record
						$dbo = JFactory::getDBO();
						$query = ('UPDATE `#__modules` SET `params` = \''.$params.'\' WHERE id = '.$module['id']);
						$dbo->setQuery($query);
						$result = $dbo->execute();
					
						if ($result) {
							echo '<li>Module with ID "'.$module['id'].'" and with title "'.$module['title'].'" has been updated.</li>';
						}
						
					}
				}
			}
			
			echo '</ul>';
			
			echo '<p>Digi Showcase has been updated to version ' . $parent->get('manifest')->version . '.</p>';
			
		}
		
	}
	
}

?>