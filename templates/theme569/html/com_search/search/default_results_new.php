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

    <div class="products-listing">

        <?php // Start the Output
        // Calculating Products Per Row
        $products_per_row = 3 ;
        $cellwidth = 'width:'.floor ( 100 / $products_per_row  ) . '%';

        foreach ( $this->results as $result ) { ?>
            <!-- <?php print_r($result); ?> -->
            <?php $productTitle = str_replace('()', '', $result->title) ; ?>

            <?php
                // this is an indicator whether a row needs to be opened or not
            if ($col == 1) { ?>
                <div class="row listing__grid">
            <?php } ?>

            <div class="item item__product product" style="<?php echo $cellwidth; ?>">
                <div class="product_wrap">

                    <h3 class="item_name product_title">
                        <?php // Product Name
                        echo JHTML::link ( JRoute::_ ( 'index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $result->virtuemart_product_id . '&virtuemart_category_id=' . $result->cat_id, FALSE ), $productTitle, array ('title' => $productTitle ) ); ?>
                    </h3>

                    <div class="item_image product_image">
                        <!--  Product Image -->
                        <?php $thumbUrl = getProductThumbById($db, $result->virtuemart_product_id) ; ?>
                        <?php if ($thumbUrl) { ?>
                            <a title="<?php echo $productTitle; ?>"  href="<?php echo $result->href; ?>">
                                <img src="<?php echo $thumbUrl; ?>" alt="<?php echo $this->escape($productTitle);?>" class="browseProductImage" />
                            </a>
                        <?php } ?>
                    </div>

                    <div class="product_price" id="productPrice<?php echo $result->virtuemart_product_id ?>">

                        <?php // if ($this->show_prices == '1') { ?>
                            <?php $productPrice = getProductThumbById($db, $result->virtuemart_product_id) ; ?>
                            <div class="product_price">
								<div class="PricesalesPrice vm-display vm-price-value" >
                                    <span class="PricesalesPrice" ><?php echo $productPrice; ?></span>
                                </div>
                                <div class="PricesalesPriceWithDiscount vm-display vm-price-value" >
                                    <span class="PricesalesPriceWithDiscount" ><?php echo $productPrice; ?></span>
                                </div>
                            </div>
                        <?php //} ?>

                    </div>
                </div>
            </div>

            <?php

            // Do we need to close the current row now?
            if ($col == $products_per_row) { ?>
                </div>
                <?php
                $col = 1;
            } elseif ($nb == count($results) && $col != $products_per_row) {
                echo '</div>';
            } else {
                $col ++;
            }
            $nb ++;
        } ?>
    </div>

<div class="search-pagination">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
