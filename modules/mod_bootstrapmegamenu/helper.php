<?php

/**
 * @package bootstrapmegamenu Bootstrap Mega Menu for Joomla
 * @subpackage mod_bootstrapmegamenu
 * @copyright Copyright (C) 2013 T.V.T Marine Automation (aka TVTMA). All rights reserved.
 * @license http://www.gnu.org/licenses GNU General Public License version 2 or later; see LICENSE.txt
 * @author url: http://ma.tvtmarine.com
 * @author TVTMA support@ma.tvtmarine.com
 */
defined('_JEXEC') or die("Direct access denied!");

/**
 * Helper for mod_bootstrapmegamenu
 */

class ModBootstrapMegaMenuHelper
{

        /**
         * Get a list of the menu items.
         *
         * @param  JRegistry   $params  The module options.
         *
         * @return  array
         *
         * @since   1.0
         */
		 
        public static function getList(&$params)
        {
                $app = JFactory::getApplication();
                $menu = $app->getMenu();

                // Get active menu item
                $base = self::getBase($params);
                $user = JFactory::getUser();
                $levels = $user->getAuthorisedViewLevels();
                asort($levels);
                $key = 'menu_items' . $params . implode(',', $levels) . '.' . $base->id;
                $cache = JFactory::getCache('mod_bootstrapmegamenu', '');
                if (!($items = $cache->get($key)))
                {
                        $path = $base->tree;
                        $start = (int) $params->get('startLevel');
                        $end = (int) $params->get('endLevel');
                        $showAll = $params->get('showAllChildren');
                        $items = $menu->getItems('menutype', $params->get('menutype'));
						$category_list = self::getCategoryTree();
                        $lastitem = 0;
                        $start_multicol_id = null;
                        $noc = 0;
                        $colheader_idx = array();
                        if ($items)
                        {
                                foreach ($items as $i => $item)
                                {
									
									
                                        if (($start && $start > $item->level) || ($end && $item->level > $end) || (!$showAll && $item->level > 1 && !in_array($item->parent_id, $path)) || ($start > 1 && !in_array($item->tree[$start - 2], $path)) || (isset($start_multicol_id) && $item->level > 3))
                                        {
                                                unset($items[$i]);
                                                continue;
                                        }

                                        $item->deeper = false;
                                        $item->shallower = false;
                                        $item->level_diff = 0;

                                        // properties for mega menu

                                        $item->multicol_start = false;
                                        $item->cols_width = array();
                                        $item->multicol_end = false;
                                        $item->multicol_element = false;
                                        $item->col_header = false;
                                        $item->col_width = 0;
                                        $item->noc = 0;
										
										
										
                                        if (isset($items[$lastitem]))
                                        {
                                                $items[$lastitem]->deeper = ($item->level > $items[$lastitem]->level);
                                                $items[$lastitem]->shallower = ($item->level < $items[$lastitem]->level);
                                                $items[$lastitem]->level_diff = ($items[$lastitem]->level - $item->level);
                                                $items[$lastitem]->multicol_start = ($items[$lastitem]->params->get('multicol_start', false) && $items[$lastitem]->level == 1 && $items[$lastitem]->deeper);
                                                if ($items[$lastitem]->multicol_start)
                                                {

                                                        $start_multicol_id = $lastitem;
                                                        $items[$lastitem]->cols_width = self::comma_explode($items[$lastitem]->params->get('bootstrapmega_colwidth'));
                                                }

                                                if (isset($start_multicol_id))
                                                {
                                                        switch ($item->level) {
                                                                case 3:
                                                                        $items[$lastitem]->multicol_element = true;
                                                                        if ($items[$lastitem]->level == 2 && !$items[$lastitem - 1]->col_header)
                                                                        {
																			$items[$lastitem - 1]->col_header = true;
																			$colheader_idx[] = $lastitem - 1;
																			$noc ++;
																			
																		}
                                                                        break;

                                                                case 2:
                                                                        $items[$lastitem]->multicol_element = true;
																		$items[$lastitem]->col_header = true;
																		$colheader_idx[] = $lastitem;
																		$noc ++;
																		
                                                                        break;
																		

                                                                case 1:
                                                                        // End of multi column
                                                                        $items[$lastitem]->multicol_end = true;

                                                                        // calculate columns width
                                                                        $equal_col_width = floor(12 / $noc);
                                                                        for ($idx = 0; $idx < $noc; $idx++)
                                                                        {
                                                                                // Equal Widths
                                                                                if (empty($items[$start_multicol_id]->cols_width))
                                                                                {
                                                                                        $items[$colheader_idx[$idx]]->col_width = $equal_col_width;
                                                                                }
                                                                                // Pre-Given widths from params
                                                                                else
                                                                                {
                                                                                        if (isset($items[$start_multicol_id]->cols_width[$idx]))
                                                                                        {
                                                                                                $items[$colheader_idx[$idx]]->col_width = $items[$start_multicol_id]->cols_width[$idx];
                                                                                        }
                                                                                        // TODO: Lack col width params, find a way to process it
                                                                                        else
                                                                                        {

                                                                                        }
                                                                                }
                                                                        }

                                                                        $items[$lastitem]->multicol_element = false;

                                                                        // Reset multi-col flags
                                                                        $noc = 0;
                                                                        $start_multicol_id = null;
                                                                        $colheader_idx = array();
                                                                        break;
                                                        }
                                                }
												
										}

                                        $item->parent = (boolean) $menu->getItems('parent_id', (int) $item->id, true);

                                        $lastitem = $i;
                                        $item->active = false;
                                        $item->flink = $item->link;

                                        // Reverted back for CMS version 2.5.6
                                        switch ($item->type) {
                                                case 'separator':
                                                case 'heading':
                                                        // No further action needed.
                                                        continue;

                                                case 'url':
                                                        if ((strpos($item->link, 'index.php?') === 0) && (strpos($item->link, 'Itemid=') === false))
                                                        {
                                                                // If this is an internal Joomla link, ensure the Itemid is set.
                                                                $item->flink = $item->link . '&Itemid=' . $item->id;
                                                        }
                                                        break;

                                                case 'alias':
                                                        // If this is an alias use the item id stored in the parameters to make the link.
                                                        $item->flink = 'index.php?Itemid=' . $item->params->get('aliasoptions');
                                                        break;

                                                default:
                                                        $router = $app::getRouter();
                                                        if ($router->getMode() == JROUTER_MODE_SEF)
                                                        {
                                                                $item->flink = 'index.php?Itemid=' . $item->id;
                                                        } else
                                                        {
                                                                $item->flink .= '&Itemid=' . $item->id;
                                                        }
                                                        break;
                                        }

                                        if (strcasecmp(substr($item->flink, 0, 4), 'http') && (strpos($item->flink, 'index.php?') !== false))
                                        {
                                                $item->flink = JRoute::_($item->flink, true, $item->params->get('secure'));
                                        } else
                                        {
                                                $item->flink = JRoute::_($item->flink);
                                        }

                                        // We prevent the double encoding because for some reason the $item is shared for menu modules and we get double encoding
                                        // when the cause of that is found the argument should be removed
                                        $item->title = htmlspecialchars($item->title, ENT_COMPAT, 'UTF-8', false);
                                        $item->anchor_css = htmlspecialchars($item->params->get('menu-anchor_css', ''), ENT_COMPAT, 'UTF-8', false);
                                        $item->anchor_title = htmlspecialchars($item->params->get('menu-anchor_title', ''), ENT_COMPAT, 'UTF-8', false);
                                        $item->menu_image = $item->params->get('menu_image', '') ? htmlspecialchars($item->params->get('menu_image', ''), ENT_COMPAT, 'UTF-8', false) : '';
										if ($item->level >=1){
											if ($item->component=='com_virtuemart') {
												switch ($item->query['view'])  {
													case 'categories':
													case 'category':
														$item->html_categories=self::buildTree($category_list, (int)$item->query['virtuemart_category_id'], 0, $item, $params);
														break;
												}
											}
											
										}
                                }

                                if (isset($items[$lastitem]))
                                {
                                        $items[$lastitem]->deeper = (($start ? $start : 1) > $items[$lastitem]->level);
                                        $items[$lastitem]->shallower = (($start ? $start : 1) < $items[$lastitem]->level);
                                        $items[$lastitem]->level_diff = ($items[$lastitem]->level - ($start ? $start : 1));

                                        // End of multi column
                                        if (isset($start_multicol_id))
                                        {
                                                $items[$lastitem]->multicol_end = true;

                                                // calculate columns width
                                                $equal_col_width = floor(12 / $noc);
                                                for ($idx = 0; $idx < $noc; $idx++)
                                                {
                                                        // Equal Widths
                                                        if (empty($items[$start_multicol_id]->cols_width))
                                                        {
                                                                $items[$colheader_idx[$idx]]->col_width = $equal_col_width;
                                                        }
                                                        // Pre-Given widths from params
                                                        else
                                                        {
                                                                if (isset($items[$start_multicol_id]->cols_width[$idx]))
                                                                {
                                                                        $items[$colheader_idx[$idx]]->col_width = $items[$start_multicol_id]->cols_width[$idx];
                                                                }
                                                                // TODO: Lack col width params, find a way to process it
                                                                else
                                                                {

                                                                }
                                                        }
                                                }

                                                $items[$lastitem]->multicol_element = false;

                                                // Reset multi-col flags
                                                $noc = 0;
                                                $start_multicol_id = null;
                                                $colheader_idx = array();
                                        }
                                }
                        }

                        $cache->store($items, $key);
                }
                return $items;
        }

        /**
         * Get base menu item.
         *
         * @param   JRegistry  $params  The module options.
         *
         * @return   object
         *
         * @since	1.0
         */
        public static function getBase(&$params)
        {

                // Get base menu item from parameters
                if ($params->get('base'))
                {
                        $base = JFactory::getApplication()->getMenu()->getItem($params->get('base'));
                } else
                {
                        $base = false;
                }

                // Use active menu item if no base found
                if (!$base)
                {
                        $base = self::getActive($params);
                }

                return $base;
        }

        /**
         * Get active menu item.
         *
         * @param   JRegistry  $params  The module options.
         *
         * @return  object
         *
         * @since	1.0
         */
        public static function getActive(&$params)
        {
                $menu = JFactory::getApplication()->getMenu();

                return $menu->getActive() ? $menu->getActive() : $menu->getDefault();
        }

        /**
         * Method to explode string seperated by commas
         * @param string $string string seperated by commas
         * @return array return a clean array
         */
        protected static function comma_explode($string)
        {
                $string = trim($string);
                if (!$string)
                {
                        return array();
                }
                $array = explode(',', $string);
                foreach ($array as $key => $value)
                {
                        if ($value = trim($value))
                        {
                                $array[$key] = $value;
                        } else
                        {
                                unset($array[$key]);
                        }
                }
                return $array;
        }

        /**
         *
         * @param int $totalitems
         * @param array $colwidth
         * @param array $itemsincols
         * @return array
         */
        protected static function mapColAndWidth($totalitems, $colwidth = array(), $itemsincols = array())
        {
                $result = array();
                // Equal width columns
                $noc = 0;
                if (empty($colwidth) && !empty($itemsincols))
                {
                        $noc = count($itemsincols);
                        $width = floor(12 / $noc);
                        for ($i = 0; $i < $noc; $i++)
                        {
                                $result[$i]['width'] = $width;
                                $result[$i]['items'] = $itemsincols[$i];
                        }
                } elseif (!empty($colwidth) && empty($itemsincols))
                {
                        $noc = count($colwidth);
                        $width = floor(12 / $noc);
                        for ($i = 0; $i < $noc; $i++)
                        {
                                $result[$i]['width'] = $width;
                                $result[$i]['items'] = null;
                        }
                } elseif (!empty($colwidth) && !empty($itemsincols))
                {
                        $colwidth_count = count($colwidth);
                        $itemsincols_count = count($itemsincols);
                        $diff = $colwidth_count - $itemsincols_count;
                        if ($diff > 0)
                        {
                                $noc = $itemsincols_count;
                        } else
                        {
                                $noc = $colwidth_count;
                        }
                        for ($i = 0; $i < $noc; $i++)
                        {
                                $result[$i]['width'] = $colwidth[$i];
                                $result[$i]['items'] = $itemsincols[$i];
                                if ($i == $noc - 1)
                                {
                                        if ($diff < 0)
                                        {
                                                for ($index = 0; $index < $diff; $index++)
                                                {
                                                        $result[$i]['items'] += $itemsincols[$i + $index + 1];
                                                }
                                        }
                                }
                        }
                } else
                {
                        // No further action is required
                }


                return $result;
        }
			/**
	* This function is repsonsible for returning an array containing category information
	* @param boolean Show only published products?
	* @param string the keyword to filter categories
	*/
	function getCategoryTree( $only_published=true, $keyword = "" ) {
			$database	=& JFactory::getDBO();
			// Get only published categories
			$query  = "SELECT c.virtuemart_category_id AS cid, cl.category_description, cl.category_name,cx.category_child_id as cid, cx.category_parent_id as parent,c.ordering, c.published
						FROM #__virtuemart_categories AS c, #__virtuemart_category_categories AS cx, #__virtuemart_categories_".str_replace('-','_',strtolower(JFactory::getLanguage()->getTag()))." AS cl WHERE ";
			$query .= "(c.virtuemart_category_id=cx.category_child_id) AND (c.virtuemart_category_id=cl.virtuemart_category_id) ";
			$query .= "ORDER BY c.ordering ASC, cl.category_name ASC";
			// initialise the query in the $database connector
			// this translates the '#__' prefix into the real database prefix
			$database->setQuery( $query );
			$category_list = $database->loadAssocList('cid');

			// Transfer the Result into a searchable Array

			// establish the hierarchy of the menu
			$children = array();
			// first pass - collect children
			foreach ($category_list as $v ) {
				$v['category_name']=htmlspecialchars($v['category_name']);
				$pt = $v['parent'];
				$list = @$children[$pt] ? $children[$pt] : array();
				array_push( $list, $v );
				$children[$pt] = $list;
			}

			return $children;
	}

	function buildTreeVm(&$fields, $index=0) {
		$list=array();
		if ($fields[$index]) {
			if (is_array($fields[$index])) {
				foreach ($fields[$index] as $key => $value) {
					$list[$value['cid']]['cid']=$value['cid'];
					$list[$value['cid']]['name']=$value['category_name'];
					$list[$value['cid']]['desc']=$value['category_description'];
					$list[$value['cid']]['children']=self::buildTreeVM($fields, $value['cid']);
				}
			}
		}
		return $list;
	}

	function buildTree(&$fields, $index=0, $level=0, &$item, &$params) {
		//$params_list = getList();
		$html='';
		if ($fields[$index]) {
			if (is_array($fields[$index])) {
				if (count($fields[$index])) {
					$html.="\n<ul class=\"level".$level." chield nav-child list-unstyled drop-menu\">\n";
					foreach ($fields[$index] as $key => $value) {
						$children = self::buildTree($fields, $value['cid'], $level+1, $item, $params);
						$li_level = $level+1;
						$li_parent = $children!=''?' parent deeper drop-submenu':'';
						$li_active = $value['cid']==JRequest::getVar('virtuemart_category_id')?' active':'';
						$html.="\t<li class=\"item-menu level".$li_level.$li_parent.$li_active."\">";
						$link = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$value['cid'].'&Itemid='.$item->id);
						if (substr($link,0,11)=='/component/') {
							$link.='?Itemid='.$item->id;
						}
						$html.="<a href=\"".$link."\">".trim($value['category_name']).'</a>';
						if ($level == 0)  {
							if($params->get('showVirtueMartCategoryDescription')) {
								if (trim($value['category_description'])) {
									$html.='<span class="vmdesc">'.trim($value['category_description']).'</span>';
								}
							}
						}
						$html.=$children;
						$html.="\t</li>\n";
					}
					$html.="</ul>\n";
				}
			}
		}
		return $html;
	}


}
