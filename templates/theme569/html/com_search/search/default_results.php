<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

include_once(JPATH_ROOT . '/model/db.php');
$db = dbConnect();
?>



<dl class="search-results<?php echo $this->pageclass_sfx; ?>">
<?php foreach($this->results as $result) : ?>
    <!-- <?php print_r($result); ?> -->
    <!-- <?php print JPATH_ROOT; ?> -->
    <?php $thumbUrl = getProductThumbById($db, $result->virtuemart_product_id) ; ?>
    <?php if (!$thumbUrl) {
        continue;
    } ?>
    <?php $price = getProductPriceById($db, $result->virtuemart_product_id) ; ?>
	<dt class="result-title">
		<?php //echo $this->pagination->limitstart + $result->count.'. ';?>
		<?php if ($result->href) :?>
			<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
				<?php echo str_replace('()','',$this->escape($result->title));?>
			</a>
		<?php else:?>
			<?php echo $this->escape($result->title);?>
		<?php endif; ?>
	</dt>
	<?php if ($this->params->get('show_date')) : ?>
		<dd class="result-created<?php echo $this->pageclass_sfx; ?>">
			<small><?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?></small>
		</dd>
	<?php endif; ?>
	<?php if ($result->section) : ?>
		<dd class="result-category">
			<small>
				(<?php echo $this->escape($result->section); ?>)
			</small>
		</dd>
	<?php endif; ?>
    <?php if($thumbUrl): ?>
    <div class="item_image product_image" style="width:33%">
        <img src="<?php echo $thumbUrl; ?>" alt="<?php echo $this->escape($result->title);?>" class="browseProductImage" />
        <div class="products-listing" style="text-align: left">
            <div class="product_price">
                <div class="PricesalesPrice vm-display vm-price-value" >
                    <span class="PricesalesPrice" >&pound;<?php echo substr($price,0,-4); ?>
                    </span>
                </div>
            </div>
        </div>
        <dd class="result-text" style="text-align: left">
            <?php echo $result->text; ?>
        </dd>
    </div>
    <?php endif; ?>

<?php endforeach; ?>
</dl>

<div class="search-pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
