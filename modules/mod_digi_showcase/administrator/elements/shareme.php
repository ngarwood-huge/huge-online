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

class JFormFieldShareMe extends JFormField {
    protected $type = 'ShareMe';
    
    protected function getInput() {
    	
    	// include digigreg api
        include_once "digigreg_api.php";
        
        // get extension general variables
        $extension_system_name = getExtensionSystemName();
        $extension_type = getExtensionType();
        $plugin_type = getPluginType();
        
        // if the extension is a plugin, add the needed prefix and plugin type for the language strings
        if ($extension_type == 'plugin') {
        	$extension_system_name = 'plg_'.str_replace('-', '_', $plugin_type).'_'.str_replace('-', '_', $extension_system_name);
        }
    	
    	// general variables
    	$document = JFactory::getDocument();
    	
    	// add css style
		$document->addStyleDeclaration('
			@media (max-width: 990px) {
				#digigreg_shareme_like_jed,
				#digigreg_shareme_help,
				#digigreg_shareme_bug,
				#digigreg_shareme_more {
					display: none;
				}
			}
		');
        
        $html = '';
        
        // open row
        $html .= '<div class="row-fluid">';
        
        // open column
        $html .= '<div class="span3" id="digigreg_shareme_like">';
        
        // like title
        $html .= '<span class="label label-success" style="margin-bottom: 5px">'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_DO_YOU_LIKE').'</span>';
       
        // joomla extensions link
        $html .= '<div class="share-me" id="digigreg_shareme_like_jed"><a class="btn btn-default btn-small" href="http://extensions.joomla.org/profile/profile/details/249047" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_REVIEW_JED_DESC').'"><i class="icon-thumbs-up"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_REVIEW_JED_TITLE').'</a></div>';
        
        // facebook like button
        $html .= '<div class="share-me" id="digigreg_shareme_like_facebook"><iframe src="//www.facebook.com/plugins/like.php?href=http%3A%2F%2Ffacebook.com%2Fdigigregcom&amp;send=false&amp;layout=button_count&amp;width=150&amp;show_faces=false&amp;font=arial&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100%; height:21px;" allowTransparency="true"></iframe></div>';
		
		// close column
        $html .= '</div>';
        
        // open column
        $html .= '<div class="span3" id="digigreg_shareme_help">';
        
        // help title
		$html .= '<span class="label label-info" style="margin-bottom: 5px">'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_NEED_HELP').'</span>';
		
		// docs link
		$html .= '<div class="share-me" id="digigreg_shareme_help_docs"><a class="btn btn-info btn-small" href="https://www.digigreg.com/en/wiki.html" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_READ_DOCS_DESC').'"><i class="icon-help"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_READ_DOCS_TITLE').'</a></div>';
		
		// forum link
		$html .= '<div class="share-me" id="digigreg_shareme_help_forum"><a class="btn btn-info btn-small" href="https://www.digigreg.com/en/forum.html" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_ASK_FORUM_DESC').'"><i class="icon-pencil"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_ASK_FORUM_TITLE').'</a></div>';
		
		// close column
        $html .= '</div>';
        
        // open column
        $html .= '<div class="span3" id="digigreg_shareme_bug">';
        
        // bug title
        $html .= '<span class="label label-warning" style="margin-bottom: 5px">'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_FOUND_BUG').'</span>';
        
        // ticket link
        $html .= '<div class="share-me" id="digigreg_shareme_bug_ticket"><a class="btn btn-warning btn-small" href="https://www.digigreg.com/en/contacts/open-ticket.html" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_REPORT_US_DESC').'"><i class="icon-cog"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_REPORT_US_TITLE').'</a></div>';
        
        // forum link
		$html .= '<div class="share-me" id="digigreg_shareme_bug_forum"><a class="btn btn-warning btn-small" href="https://www.digigreg.com/en/forum.html" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_WRITE_FORUM_DESC').'"><i class="icon-pencil"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_WRITE_FORUM_TITLE').'</a></div>';
        
        // close column
        $html .= '</div>';
        
        // open column
        $html .= '<div class="span3" id="digigreg_shareme_more">';
        
        // more title
		$html .= '<span class="label label-default" style="margin-bottom: 5px">'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_NEED_MORE').'</span>';
		
		// our extensions link
		$html .= '<div class="share-me" id="digigreg_shareme_more_products"><a class="btn btn-default btn-small" href="https://www.digigreg.com/en/products.html" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_MORE_EXTENSIONS_DESC').'"><i class="icon-grid"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_MORE_EXTENSIONS_TITLE').'</a></div>';
        
        // customization link
		$html .= '<div class="share-me" id="digigreg_shareme_more_request"><a class="btn btn-default btn-small" href="https://www.digigreg.com/en/contacts/open-ticket.html" target="_blank" title="'.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_CUSTOMIZATION_DESC').'"><i class="icon-info"></i> '.JText::_(strToUpper($extension_system_name).'_FIELD_SHAREME_CUSTOMIZATION_TITLE').'</a></div>';
        
        // close column
        $html .= '</div>';
        
        // close row
        $html .= '</div>';
        
        // divider
        $html .= '<hr />';
		
        return $html;
        
    }
}

?>