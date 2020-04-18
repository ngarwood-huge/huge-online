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

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldUpdatesites extends JFormField {
	protected $type = 'updatesites';

	protected function getLabel() {
        return;
    }
    
	protected function getInput() {
	
		// include digigreg api
        include_once "digigreg_api.php";
        
        // update manifest varialbes
        $remote_server = 'https://www.digigreg.com';
        $remote_server_folder = 'xml';
		
		// get extension general variables
		$extension_type = getExtensionType();
		$extension_family = getExtensionFamily();
		$plugin_type = getPluginType();
		$extension_name = getExtensionName();
		$extension_system_name = getExtensionSystemName();
		$extension_version_type = getExtensionVersionType();
		
		// get language stings variable
		if ($extension_type == 'plugin') {
        	$extension_language_string = str_replace('-', '_', $plugin_type).'_'.str_replace('-', '_', $extension_system_name);
        	if (strpos($extension_language_string, 'plg_') === false) {
				$extension_language_string = 'plg_'.$extension_language_string;
			}
        } else {
        	$extension_language_string = $extension_system_name;
        }
		
		// get extension id
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $fields = array($db->qn('extension_id'));
        if ($extension_type == 'component') {
        	// if extension is component is needed its package id
			$conditions = array(
				$db->qn('element') . ' = ' . $db->quote(str_replace('com_', 'pkg_', $extension_system_name)),
				$db->qn('type') . ' = ' . $db->quote('package')
			);
		} else {
			$conditions = array(
				$db->qn('element') . ' = ' . $db->quote($extension_system_name),
				$db->qn('type') . ' = ' . $db->quote($extension_type)
			);
		}
        $query->select($fields)->from($db->quoteName('#__extensions'))->where($conditions);
        $db->setQuery($query);   
        $extension_id = $db->loadResult();
        
        // get update manifest url
        if ($extension_type == 'component') {
        	$extension_update_manifest_url = $remote_server.DS.$remote_server_folder.DS.str_replace('com_', 'pkg_', $extension_system_name).'.xml';
		} else {
			$extension_update_manifest_url = $remote_server.DS.$remote_server_folder.DS.$extension_system_name.'.xml';
		}
		
		// get extension params
		if ($extension_type == 'component') {
			JLoader::import('joomla.application.component.helper');
			$params = JComponentHelper::getParams($extension_system_name);
		} else if ($extension_type == 'module') {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('m.*');
			$query->from('#__modules AS m');
			$query->where('module = '.$db->quote($extension_system_name));
			$db->setQuery($query);
			$extension = $db->loadObject();
			$params = new JRegistry($extension->params);
		} else if ($extension_type == 'plugin') {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('p.params');
			$query->from('#__extensions AS p');
			$query->where('extension_id = '.$db->quote($extension_id));
			$db->setQuery($query);
			$extension = $db->loadObject();
			$params = new JRegistry($extension->params);
		} else if ($extension_type == 'template') {
			$db = JFactory::getDbo();
			$query = $db->getQuery(true);
			$query->select('t.*');
			$query->from('#__template_styles AS t');
			$query->where('template = '.$db->quote($extension_system_name));
			$db->setQuery($query);
			$extension = $db->loadObject();
			$params = new JRegistry($extension->params);
		}
		
		// get order credentials
		if ($extension_version_type == 'free' || $extension_version_type == 'lite') {
			// get credentials from extension params
			$credentials = $params->get('order_password', '');
			
			// if order_password param is not found get this from manifest file 
			if (!$credentials) {
				// get extension manifest
				if ($extension_family == 'components') {
					$extension_xml = JFactory::getXML(JPATH_ROOT.'/administrator/components/'.$extension_system_name.'/'.strtolower(str_replace('', '_', $extension_name)).'.xml');
				} else if ($extension_family == 'modules') {
					$extension_xml = JFactory::getXML(JPATH_ROOT.'/'.$extension_family.'/'.$extension_system_name.'/'.$extension_system_name.'.xml');
				} else if ($extension_family == 'plugins') {
					$extension_xml = JFactory::getXML(JPATH_ROOT.'/'.$extension_family.'/'.$plugin_type.'/'.$extension_system_name.'/'.$extension_system_name.'.xml');
				} else if ($extension_family == 'templates') {
					$extension_xml = JFactory::getXML(JPATH_ROOT.'/'.$extension_family.'/'.$extension_system_name.'/templateDetails.xml');
				}
				// extension is free, so get credentials from extension xml file
				foreach ($extension_xml->config->fields as $field) {
					foreach ($field->fieldset as $row) {
						$fieldset = new stdClass();
						$attributes = $row->attributes();
						$fieldset->name = (string) $attributes['name'];
						if ($fieldset->name == 'basic') {
							foreach ($row->field as $fieldItem) {
								if ($fieldItem['name'] == 'order_password') {
									$credentials = $fieldItem['default'];
								}
							}
						}
					}
				}
			}
		} else {
			// get credentials from extension params
			$credentials = $params->get('order_password', '');
		}
		
		// build the extra query
		$extra_query = 'option=com_virtuemart&view=plugin&name=istraxx_download';
		if ($credentials) {
			$credentials_array = explode('_', $credentials, 2);
			$order_item_id = $credentials_array[0];
			$order_password = $credentials_array[1];
			if (!empty($order_item_id) && !empty($order_password)) {
				$extra_query .= '&dlkey='.base64_encode($order_password).'&oid='.$order_item_id;
			}
		}
		
		// load update site record if it exists
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('update_site_id')
			->from($db->qn('#__update_sites_extensions'))
			->where($db->qn('extension_id').' = '.$db->q($extension_id));
		$db->setQuery($query);
		$update_site = $db->loadResult();
		
		if ($update_site) {
			// update record in upload sites table
			$update_site_fields = array(
				$db->qn('extra_query') . ' = ' . $db->quote($extra_query),
				$db->qn('enabled') . ' = 1',
				$db->qn('last_check_timestamp') . ' = 0');
			$query = $db->getQuery(true)
				->update($db->qn('#__update_sites'))
				->set($update_site_fields)
				->where($db->qn('update_site_id').' = '.$update_site);
			$db->setQuery($query);
			$db->execute();

			// purge updates cache for this update site
			$query = $db->getQuery(true)
				->delete($db->qn('#__updates'))
				->where($db->qn('update_site_id').' = '.$update_site);
			$db->setQuery($query);
			$db->execute();
		} else {
			// enter update site in database
			$update_site_columns = array('update_site_id', 'name', 'type', 'location', 'extra_query', 'enabled', 'last_check_timestamp');   
			$update_site_values = array('DEFAULT', $db->quote($extension_name), $db->quote('extension'), $db->quote($extension_update_manifest_url), $db->quote($extra_query), 1, 0);
			$query = $db->getQuery(true)
				->insert($db->qn('#__update_sites'))
    			->columns($db->qn($update_site_columns))
     			->values(implode(',', $update_site_values));
			$db->setQuery($query);
			$db->execute();
			
			// load update site id previously created
			$query = $db->getQuery(true)
				->select('update_site_id')
				->from($db->qn('#__update_sites'))
				->where($db->qn('name').' = '.$db->q($extension_name))
				->order($db->qn('update_site_id').' DESC')
				->setLimit(1);
			$db->setQuery($query);
			$update_site_id = $db->loadResult();
			
			// enter extension id to allow joomla to know for which extension the update site is made
			$update_sites_extensions_columns = array('update_site_id', 'extension_id');   
			$update_sites_extensions_values = array($update_site_id, $extension_id);
			$query = $db->getQuery(true)
				->insert($db->qn('#__update_sites_extensions'))
    			->columns($db->qn($update_sites_extensions_columns))
     			->values(implode(',', $update_sites_extensions_values));
			$db->setQuery($query);
			$db->execute();
		}
		
		if ($extension_version_type == 'free' || $extension_version_type == 'lite') {
			return;
		} else {
			$update_button = '<a class="btn btn-primary" onclick="jQuery(\'#toolbar-apply\').children(\'button\').click()">'.JText::_(strtoupper($extension_language_string).'_SAVE_PASSWORD').'</a>';
			return $update_button;
		}
		
	}
	
}