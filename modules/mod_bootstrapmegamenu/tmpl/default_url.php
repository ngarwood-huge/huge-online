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

// Note. It is important to remove spaces between elements.
$class = '';
if ($item->anchor_css)
{
        $class .= $item->anchor_css;
}
if ($item->deeper && $params->get('showAllChildren'))
{
        if ($class)
        {
                $class .= ' dropdown-toggle';
        } else
        {
                $class .= 'dropdown-toggle';
        }
}
if ($class)
{
        $class = 'class="' . $class . '" ';
}
$dataToggle = ($item->deeper && $params->get('showAllChildren') && $item->level < 2 && !$nav_child) ? 'data-toggle="dropdown" ' : '';
$icon = ($item->parent && $item->level == 1 && $params->get('showAllChildren')) ? '' : '';
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';
if ($item->menu_image)
{
        $item->params->get('menu_text', 1) ?
                        $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /> <span class="image-title">' . $item->title . '</span> ' :
                        $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
} else
{
        $linktype = $item->title;
}
$subtitle_param = trim($item->params->get('bootstrapmega_subtitle'));
$subtitle = $subtitle_param ? '<div class="small">' . $subtitle_param . '</div>' : '';

/* BEGIN icons */
$glyphicon_classes = trim($item->params->get('glyphicon'));
if ($glyphicon_classes)
{
        $linktype = '<span class="' . $glyphicon_classes . '"></span> ' . $linktype;
}
/* END icons */

$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

switch ($item->browserNav) :
        default:
        case 0:
                ?><a data-hover="<?php echo $linktype; ?>" <?php echo $dataToggle . $class; ?> href="<?php echo $flink; ?>" <?php echo $title; ?>><?php echo $linktype . $icon . $subtitle; ?>
				<?php if (isset($bootstrapmega_label) && $bootstrapmega_label) {?>
                    <div class="megamenu-label <?php echo $bootstrapmega_class; ?>">
                        <span>
                            <span><?php echo $bootstrapmega_label; ?></span>
                        </span>
                    </div>
                    
                <?php } ?></a><?php
                break;
        case 1:
                // _blank
                ?><a data-hover="<?php echo $linktype; ?>"  <?php echo $class; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?><?php if (isset($bootstrapmega_label) && $bootstrapmega_label) {?>
                    <div class="megamenu-label <?php echo $bootstrapmega_class; ?>">
                        <span>
                            <span><?php echo $bootstrapmega_label; ?></span>
                        </span>
                    </div>
                    
                <?php } ?></a><?php
                break;
        case 2:
                // window.open
                $options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,' . $params->get('window_open');
                ?><a data-hover="<?php echo $linktype; ?>" <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href, 'targetWindow', '<?php echo $options; ?>');
                                                return false;" <?php echo $title; ?>><?php echo $linktype; ?><?php if (isset($bootstrapmega_label) && $bootstrapmega_label) {?>
                    <div class="megamenu-label <?php echo $bootstrapmega_class; ?>">
                        <span>
                            <span><?php echo $bootstrapmega_label; ?></span>
                        </span>
                    </div>
                    
                <?php } ?></a><?php
                break;
endswitch;

