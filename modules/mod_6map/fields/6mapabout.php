<?php
/*------------------------------------------------------------------------
# 6Maps module by Team of Six, balbooa.com
# ------------------------------------------------------------------------
# author    Balbooa http://www.balbooa.com/
# Copyright@2013 balbooa.com.  All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.balbooa.com/
-------------------------------------------------------------------------*/
// no direct access
    defined('_JEXEC') or die('Restricted access');

defined('JPATH_BASE') or die;


jimport('joomla.form.formfield');
$document = JFactory::getDocument();
class JFormField6MapAbout extends JFormField{

	public function getModuleName(){
	
	  $part = explode( DIRECTORY_SEPARATOR, str_replace( array( '\fields', '/fields' ), '', dirname(__FILE__) ));          
          $moduleName 	= end($part);
		//$templateName 	= $templateName [ count( $templateName ) - 1 ];
		return $moduleName;
	}

	protected function getInput(){
		$doc = JFactory::getDocument();

		$moduleName = $this->getModuleName();
      if(version_compare(JVERSION, "3.2.0",'lt')) {
	  //$doc->addScript(JURI::root() . "modules/mod_6map/assets/js/jquery-1.7.1.min.js");
         
      }
?>      
     <script type="text/javascript">
           jQuery( window ).load(function() {
                              if (jQuery('#jform_params_idcheangeMapColor').val()=='true'){                                                              
                                 jQuery( ".control-group" ).has('.minicolors').show();                              
                              }else if (jQuery('#jform_params_idcheangeMapColor').val()=='false'){                                 
                                 jQuery( ".control-group" ).has('.minicolors').hide();
                              }
          });
     
     
     
     
     
           jQuery( document ).ready(function() {
                  
                         jQuery(function(){
                            var obj = jQuery('.slideoptions');
                            obj.bind('keyup', function() {
                                this.value = this.value.replace(/[A-Za-z\W]/, '');
                            });
                            obj.bind('keydown', function() {
                                this.value = this.value.replace(/[A-Za-z\W]/, '');
                            });              
                          });
                        
                        
                         jQuery('#jform_params_idcheangeMapColor').on('change', function() {

                              if (this.value=='true'){ 
                                //toggleClass//removeClass//addClass//show()//hide()                                
                                 jQuery( ".control-group" ).has('.minicolors').show();
                              
                              }else if (this.value=='false'){
                                 
                                 jQuery( ".control-group" ).has('.minicolors').hide();
                              }
                          });
                        
                           
            });
   </script>
<?php         
	}
}
