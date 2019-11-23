<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$item_heading = $params->get('item_heading', 'h4');
?>
<div class="wrap-column">

<?php
//var_dump($item);
 if ($params->get('item_title')) : ?>

	<<?php echo $item_heading; ?> class="newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
	<?php if ($params->get('link_titles') && $item->link != '') : ?>
		<a href="<?php echo $item->link; ?>">
			<?php echo $item->title; ?>
		</a>
	<?php else : ?>
		<?php echo $item->title; ?>
	<?php endif; ?>
	</<?php echo $item_heading; ?>>

<?php endif; ?>

<?php if (!$params->get('intro_only')) : ?>
	<?php echo $item->afterDisplayTitle; ?>
<?php endif; ?>

<?php echo $item->beforeDisplayContent; ?>

<?php echo $item->introtext; ?>
<div class="clearfix"></div>
<div class="home_article_published">
<?php echo JText::sprintf('COM_CONTENT_PUBLISHED_DATE_ON', '<span>'.JHtml::_('date', $item->publish_up, JText::_('DATE_FORMAT_LC2')).'</span>'); ?>
</div>
<div class="home_article_category">
    <?php echo JText::sprintf('COM_CONTENT_CATEGORY', '<span>'.$item->category_title.'</span>'); ?>
</div>
 <div class="home_article_hits">
    <?php echo JText::sprintf('COM_CONTENT_ARTICLE_HITS', '<span>'.$item-> hits.'</span>'); ?>

</div>
<div class="clearfix"></div>
<?php if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
	<?php echo '<a class="readmore btn btn-primary" href="' . $item->link . '">' . $item->linkText . '</a>'; ?>
<?php endif; ?>
</div>
