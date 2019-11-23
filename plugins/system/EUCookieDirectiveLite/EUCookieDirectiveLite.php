<?php
/*
Plugin Name:    EUCookieDirectiveLite
Edition:        Lite Edition
Plugin URI:     http://www.channelcomputing.co.uk
Description:    A plugin to display a notification to the user about the usage of cookies on the site. It allows the site admin to easily conform with the 
                <a href='http://www.ico.gov.uk/news/latest_news/2011/must-try-harder-on-cookies-compliance-says-ico-13122011.aspx'>EU Cookie Directive</a>.
Version:        1.0.5
Author:         Channel Computing
Author URI:     http://www.channelcomputing.co.uk

Copyright (C) 2011-2012, Channel Computing
All rights reserved.

Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.
Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.
THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, 
THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE 
LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; 
LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Joomla! EU Cookie Directive plugin
 *
 * @package        Joomla
 * @subpackage    System
 */
class  plgSystemEUCookieDirectiveLite extends JPlugin
{
    /**
     * Constructor
     *
     * For php4 compatability we must not use the __constructor as a constructor for plugins
     * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
     * This causes problems with cross-referencing necessary for the observer design pattern.
     *
     * @access    protected
     * @param    object $subject The object to observe
     * @param     array  $config  An array that holds the plugin configuration
     * @since    1.0
     */
    function plgSystemEUCookieDirectiveLite(& $subject, $config)
    {
        parent::__construct($subject, $config);
    
    }

    /**
    * Start the output
    *
    */
    function onAfterRender()
    {
        
        global $mainframe, $database;
        
        //get Params
        $message = $this->params->get('warningMessage', '');
		$message2 = $this->params->get('PrivacyPolicyPage', '');
		$message3 = $this->params->get('title', '');
		$message4 = $this->params->get('accept', '');
		$message5 = $this->params->get('Agree', '');
        $privacyLink = $this->params->get('detailsUrl', 'index.php');
        $width = $this->params->get('width', '0');
        //deal with the width options
        if ($width == "0") {
            $width = "100%";
        } else {
            $width = $width . "px";
        }

        $document    =& JFactory::getDocument();
        $doctype    = $document->getType();
        $app =& JFactory::getApplication();
		
		$ICON_FOLDER = JURI::root() . 'plugins/system/EUCookieDirectiveLite/EUCookieDirectiveLite/images/';     
        
        if ( $app->getClientId() === 0 ) {
            
			$style = "\n".'<style type="text/css">
                div#cookieMessageContainer{
                    font: 12px/28px Helvetica,Arial,Verdana,sans-serif;
					position:fixed;
                    z-index:999999;
                    bottom:0;
					right:0;
                    margin:0 auto;
					padding: 5px;
                }
                #cookieMessageText p,.accept{font: 12px/28px Helvetica,Arial,Verdana,sans-serif;margin:0;padding:0 0 6px;text-align:left;vertical-align:middle}
				.accept label{vertical-align:middle}
				#cookieMessageContainer table,#cookieMessageContainer tr,#cookieMessageContainer td{margin:0;padding:0;vertical-align:middle;border:0;background:none}
                #cookieMessageAgreementForm{margin:0 0 0 10px}
                #cookieMessageInformationIcon{margin:0 10px 0 0;height:29px}
                #info_icon{vertical-align:middle;margin:5px 0 0}
                #buttonbarContainer{height:29px;margin:0 0 -10px}
				input#AcceptCookies{margin:0 10px;vertical-align:middle}
				.accept {padding: 5px 6px 4px 10px;}
				#continue_button {padding: 5px 15px 5px 15px; font-size:12px; line-height:16px;}
            </style>'."\n";
			
			$hide = "\n".'<style type="text/css">
					div#cookieMessageContainer{display:none}
				</style>'."\n";
		
            $SCRIPTS_FOLDER = JURI::root() . 'plugins/system/EUCookieDirectiveLite/EUCookieDirectiveLite/';
            $cookiescript = '<script type="text/javascript" src="' . $SCRIPTS_FOLDER . 'EUCookieDirective.js"></script>'."\n";	
						
            $strOutputHTML = "";
            //Define paths for portability
            $strOutputHTML .= '<div id="cookieMessageOuter" style="width:100%">';
            $strOutputHTML .= '<div id="cookieMessageContainer" style="width:' . $width . ';background-color:#1D1D1D;color:#fff">';
            $strOutputHTML .= '<table width="100%">';
            $strOutputHTML .= '<tr>';
            $strOutputHTML .= '<td colspan="2">';
            $strOutputHTML .= '<div id="cookieMessageText" style="padding:6px 10px 0 10px; text-align:center;">';
            $strOutputHTML .= '<p style="color:#fff!important;text-align:center;">' . $message . '<a id="cookieMessageDetailsLink" style="color:#fff!important; text-decoration: underline;" title="'.$message3.'" href="' . $privacyLink . '"> '.$message2.'</a>.</p>';
            $strOutputHTML .= '</div>';
            $strOutputHTML .= '</td>';
            $strOutputHTML .= '</tr>';
            $strOutputHTML .= '<tr>';
            $strOutputHTML .= '<td align="center">';
            $strOutputHTML .= '<span class="accept"><span class="cookieMessageText" style="color:#fff;" !important;>'.$message4.'</span></span></label> ';				
            $strOutputHTML .= '<div border="0" class="cookie_button btn btn-primary" id="continue_button" onclick="SetCookie(\'cookieAcceptanceCookie\',\'accepted\',9999);">'.$message5.'</div>';
            $strOutputHTML .= '</p></td>';
            $strOutputHTML .= '</tr>';
            $strOutputHTML .= '</table>';
            $strOutputHTML .= '</div>';
            $strOutputHTML .= '</div>';

            //Only write the HTML Output if the cookie has not been set as "accepted"
            if(!isset($_COOKIE['cookieAcceptanceCookie']) || $_COOKIE['cookieAcceptanceCookie'] != "accepted")
            { 
                
                $body = JResponse::getBody();
                $body = str_replace('</head>', $style.'</head>', $body);
                $body = str_replace('</body>', $strOutputHTML.$cookiescript.'</body>', $body);
                JResponse::setBody($body);
            }
            elseif($_COOKIE['cookieAcceptanceCookie'] == "accepted") {
                $body = JResponse::getBody();
                $body = str_replace('</head>', $hide.'</head>', $body);
                JResponse::setBody($body);
            }
        }
    }
}