<?php
/**
 * @package bootstrapmegamenu Bootstrap Mega Menu for Joomla
 * @subpackage mod_bootstrapmegamenu
 * @copyright Copyright (C) 2013 T.V.T Marine Automation (aka TVTMA). All rights reserved.
 * @license http://www.gnu.org/licenses GNU General Public License version 2 or later; see LICENSE.txt
 * @author url: http://ma.tvtmarine.com
 * @author TVTMA support@ma.tvtmarine.com
 */
defined('_JEXEC') or die;
$app = JFactory::getApplication();

$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$default_mnu = $menu->getDefault($lang->getTag());
$row = 'row';
$list_unstyled = 'list-unstyled';
$navbar_collapse = 'navbar-collapse collapse';
$navbar_btn_class = 'navbar-toggle collapsed';


?>
<div class="tvtma-megamnu">
                <div id="tvtma-megamnu">
                <ul class="sf-menuW">
                            <?php
                            $load_multicol_css = false;
                            $nav_child = ($params->get('enable_hoverdropdown', 0) == 1) ? 'nav-child ' : '';

                            $multicol_start = false;
                            $col_no = 0;
                            $lastitem = 0;
							$k = 1;
                            foreach ($list as $i => &$item) :

                                    $multi_col = $item->params->get('multicol_start');
									$bootstrapmega_subtype = $item->params->get('bootstrapmega_subtype');
									$bootstrapmega_modules = $item->params->get('bootstrapmega_modules');
									$bootstrapmega_label = $item->params->get('bootstrapmega_label');
									$bootstrapmega_class = $item->params->get('bootstrapmega_class');
									$bootstrapmega_modules = $item->params->get('bootstrapmega_modules');
									
									if ($bootstrapmega_modules)
                                    {
										$document	= &JFactory::getDocument();
										$renderer	= $document->loadRenderer('module'); 
										for($r=0; $r<count($bootstrapmega_modules); $r++) {
											//echo 'lorem'.$bootstrapmega_modules[$r];
											$dbo = JFactory::getDBO();
											$dbo->setQuery("SELECT * FROM #__modules WHERE id='".$bootstrapmega_modules[$r]."'");
											$module = $dbo->loadObject();
											$module->user = '';
											 echo '<div class="modulewrap'.$bootstrapmega_modules[$r].'">';                                
											 if($module->showtitle)
											 {
												echo '<div class="ModuleTile">'.$module->title.'</div>';
											 }
											 echo $renderer->render($module,array("style"=>"raw"));
											 echo '</div><div class="clearfix"></div>';
										}
									}


                                    if ($multi_col)
                                    {
                                            $load_multicol_css = true;
                                    }
                                    $menu_subtitle = $item->params->get('bootstrapmega_subtitle');
                                    $bootstrapmega_width = trim($item->params->get('bootstrapmega_width'));

                                    $class = 'item-menu item-' . $item->id;
									if($item->html_categories) {
											$class .=' parent drop';
									}
                                    if ($item->id == $active_id)
                                    {
                                            $class .= ' current';
                                    }

                                    if (in_array($item->id, $path))
                                    {
                                            $class .= ' active';
                                    } elseif ($item->type == 'alias')
                                    {
                                            $aliasToId = $item->params->get('aliasoptions');
                                            if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
                                            {
                                                    $class .= ' active';
                                            } elseif (in_array($aliasToId, $path))
                                            {
                                                    $class .= ' alias-parent-active';
                                            }
                                    }

                                    if ($item->type == 'separator')
                                    {
                                            $class .= ' divider';
                                    }

                                    if ($item->deeper)
                                    {
                                            $class .= ' deeper';
                                    }

                                    if ($item->parent)
                                    {
                                            $class .= ' parent drop';
                                            if ($bootstrapmega_width == 'full')
                                            {
                                                    $class .=' tvtma-megamnu-fullwidth';
                                            }
											if ( $multi_col){
											 	$class .=' megacol-top';
											}
											
											//print_r($item->html_categories);
											
                                    }
                                    if ($list[$lastitem]->col_header)
                                    {
                                            $class .= ' megacol-header-top';
                                    }
                                    if ($item->deeper && $item->level > 1)
                                    {
                                            $class = str_replace('dropdown', '', $class);
                                            if (!$item->multicol_element)
                                            {
                                                    $class .= ' drop-submenu';
                                            }
                                    }
									 if ( $item->level == 1)
                                    {
										$class .= ' count-item'.$k++.'';
									}
                                    if (!empty($class))
                                    {
                                            $class = ' class="' . trim($class) . '"';
                                    }

                                    echo '<li' . $class . ' >';
									if ($bootstrapmega_subtype!=='mod'){
                                    // Render the menu item.
                                    switch ($item->type) :
                                            case 'separator':
                                            case 'url':
                                            case 'component':
                                            case 'heading':
                                                    require JModuleHelper::getLayoutPath('mod_bootstrapmegamenu', 'default_' . $item->type);
                                                    break;

                                            default:
                                                    require JModuleHelper::getLayoutPath('mod_bootstrapmegamenu', 'default_url');
                                                    break;
                                    endswitch;
									}
											//
											
											print_r($item->html_categories);
									
                                    // The next is a column header
                                    if ($item->col_header)
                                    {
                                            // The next item is the first item of the first column
                                            if ($item->multicol_start)
                                            {
												
                                                    $multicol_start = true;
                                                    $col_no = 0;
                                                    $width_style = ($bootstrapmega_width == 'full' || $bootstrapmega_width == '') ? '' : 'width: ' . $bootstrapmega_width . ';"';
                                                    $left_offset = trim($item->params->get('left_offset'));
                                                    $left_offset = $left_offset ? 'left: ' . $left_offset . ';' : '';

                                                    $right_offset = trim($item->params->get('right_offset'));
                                                    $right_offset = $right_offset ? 'right: ' . $right_offset . ';' : '';

                                                    $offset_style = ($left_offset || $right_offset || $width_style) ? ' style="' . $left_offset . $right_offset . $width_style . '"' : '';
                                                    echo '<ul class="' . $nav_child . $list_unstyled . ' drop-menu drop-menu-mega sf-mega"' . $offset_style . '>
                                                                <div class="' . $row . '">
                                                                <div class="tvtma-megamnu-content">';
                                            }
                                            // The next item is a column header but not the first column under the multi-column menu item
                                            else
                                            {
                                                    echo '</ul>';
                                            }

                                            if ($multicol_start)
                                            {
                                                   
                                                 $span_width = $item->col_width ? 'col-md-' . $item->col_width . ' col-sm-' . $item->col_width . ' ' : 'col-md-12 ';
                                                                   
                                                    echo '<ul class="' . $span_width . $list_unstyled . ' block">';
                                            }
                                    }
                                    // Normal item in a multicol
                                    elseif ($item->multicol_element)
                                    {
                                            // No further action is needed
                                    }
                                    // The next item is deeper.
                                    elseif ($item->deeper)
                                    {
                                            echo '<ul class="' . $nav_child . $list_unstyled . ' drop-menu">';
                                    } elseif ($item->multicol_end)
                                    {
                                            $multicol_start = false;
                                            echo '</div></div></ul>';
                                    }
                                    // The next item is shallower.
                                    elseif ($item->shallower)
                                    {
                                            echo '</li>';

                                            echo str_repeat('</ul></li>', $item->level_diff);
                                    }

                                    // The next item is on the same level.
                                    else
                                    {
                                            echo '</li>';
                                    }
                                    $lastitem = $i;
									
                            endforeach;

                           
                            ?>
                </ul>
                </div>
</div>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery.noConflict();
	jQuery("#tvtma-megamnu ul.sf-menuW  > li.megacol-top > ul.chield").remove("");
});
</script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery.noConflict();
	// initialise plugins
		jQuery('ul.sf-menuW,.sf-mega,.block').superfish({
		hoverClass:    'sfHover',         
	    pathClass:     'overideThisToUse',
	    pathLevels:    1,    
	    delay:         800, 
	    speed:         'normal',   
	    autoArrows:    false, 
	    dropShadows:   true, 
	    disableHI:     false, 
	    easing:        "swing",
	    onInit:        function(){},
	    onBeforeShow:  function(){},
	    onShow:        function(){},
	    onHide:        function(){}
		});

	jQuery('.sf-menuW').slicknav({
		label: 'Navigation: ',
		prependTo: '.navigation',
		closeOnClick: true,
		allowParentLinks: true
	});

		var ismobile = navigator.userAgent.match(/(iPhone)|(iPod)|(android)|(webOS)/i)
		if(ismobile){
			jQuery('.sf-menu').sftouchscreen({});
		}
	});
</script>