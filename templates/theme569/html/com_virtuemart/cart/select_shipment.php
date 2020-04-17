<?php
/**
 *
 * Template for the shipment selection
 *
 * @package	VirtueMart
 * @subpackage Cart
 * @author Max Milbers
 *
 * @link http://www.virtuemart.net
 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * VirtueMart is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * @version $Id: cart.php 2400 2010-05-11 19:30:47Z milbo $
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');


	if (VmConfig::get('oncheckout_show_steps', 1)) {
		echo '<div class="checkoutStep" id="checkoutStep2">' . JText::_('COM_VIRTUEMART_USER_FORM_CART_STEP2') . '</div>';
	}

	if ($this->layoutName!='default') {
		$headerLevel = 1;
		if($this->cart->getInCheckOut()){
			$buttonclass = 'button';
		} else {
			$buttonclass = 'default';
		}
	?>

<form method="post" id="userForm" name="chooseShipmentRate" action="<?php echo JRoute::_('index.php'); ?>" class="form-validate">
	<?php
	} else {
		$headerLevel = 3;
		$buttonclass = 'vm-button';
	}

	// echo "<h".$headerLevel." class='cart-form_title'>".JText::_('COM_VIRTUEMART_CART_SELECT_SHIPMENT')."</h".$headerLevel.">"; ?>

    <?php

    // H.U.G.E delivery only available initially Sat/Sun
    $dayOfWeek = date("D");

    // log dayOfWeek to file
    file_put_contents('/home/hp3-linc7-nfs1-x/304/1810304/user/shipment.log', 'Day of week: '.$dayOfWeek . PHP_EOL, FILE_APPEND) ;
    $whereString = '';
    if ($dayOfWeek != 'Sat' && $dayOfWeek != 'Sun') {
    $whereString = ' WHERE `virtuemart_shipmentmethod_id` <> 6';
    }

    ?>
		
	<div class="options-list">
		<?php
	    if ($this->found_shipment_method  ) {
            file_put_contents('/home/hp3-linc7-nfs1-x/304/1810304/user/shipment.log', PHP_EOL . 'Shipment Rates: '. print_r($this->shipments_shipment_rates, true) . PHP_EOL, FILE_APPEND) ;
            ?>
		<ul>
		<?php
            // H.U.G.E delivery only available initially Sat/Sun
            $dayOfWeek = date("D");
            $hugeDeliveryAvailable = false;
            if ($dayOfWeek == 'Sat' || $dayOfWeek == 'Sun') {
                $hugeDeliveryAvailable = true;
            }

		    // if only one Shipment , should be checked by default
		    foreach ($this->shipments_shipment_rates[0] as $idx => $shipment_shipment_rate) {
                //file_put_contents('/home/hp3-linc7-nfs1-x/304/1810304/user/shipment.log', PHP_EOL . 'Shipment Rates Index: '. print_r($idx, true) . PHP_EOL, FILE_APPEND) ;
                //file_put_contents('/home/hp3-linc7-nfs1-x/304/1810304/user/shipment.log', PHP_EOL . 'Shipment Shipment Rates: '. print_r($shipment_shipment_rate, true) . PHP_EOL, FILE_APPEND) ;

                if ($hugeDeliveryAvailable == false && $idx == 0) {
                    $shipment_shipment_rate = str_replace('input','input disabled', $shipment_shipment_rate) ;
                    $shipment_shipment_rate = str_replace('input','input disabled', $shipment_shipment_rate) ;
		           // continue; // First shipping method is H.U.G.E Delivery
                }
                echo '<li>' . $shipment_shipment_rate . '</li>';
                /*
				if (is_array($shipment_shipment_rates)) {
				    foreach ($shipment_shipment_rates as $shipment_shipment_rate) {
						echo '<li>' . $shipment_shipment_rate . '</li>';
				    }
				}
                */
		    } ?>
		</ul>
		<?php 
	    } else {
			//echo "<h".$headerLevel.">".$this->shipment_not_found_text."</h".$headerLevel.">";
	    } ?>
    </div>
	<div class="control-button">
	    <!-- <button  name="updatecart" class="btn btn-primary button default" type="submit" ><?php echo JText::_('COM_VIRTUEMART_SAVE'); ?></button> -->
		<?php if ($this->layoutName!='default') { ?>
			<!-- <button class="btn btn-default button <?php echo $buttonclass ?>  " type="reset" onClick="window.location.href='<?php echo JRoute::_('index.php?option=com_virtuemart&view=cart&task=cancel'); ?>'"  ><?php echo JText::_('COM_VIRTUEMART_CANCEL'); ?></button> -->
		<?php  } ?>
	</div>

<?php
if ($this->layoutName!='default') {
?> <input type="hidden" name="option" value="com_virtuemart" />
    <input type="hidden" name="view" value="cart" />
    <input type="hidden" name="task" value="updatecart" />
    <input type="hidden" name="controller" value="cart" />
</form>
<?php
}
?>


