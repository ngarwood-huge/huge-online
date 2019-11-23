<?php

ini_set('max_execution_time', '1800');

$products = array();

// Open brand list
$handle = fopen("products.txt", "r");
if ($handle) {
    while (($product = fgets($handle)) !== false) {

        $tProduct = rtrim($product);

        array_push($products, $tProduct);

    }

    fclose($handle);

} else {
    print 'Error opening file';
    exit;
} 

$nProducts = array_unique($products);

// Write products to new file
foreach($nProducts as $nProduct) {
    print $nProduct . PHP_EOL;
    file_put_contents('unique_products.txt', $nProduct . PHP_EOL, FILE_APPEND);
}

print 'Dedupe complete';

?>

