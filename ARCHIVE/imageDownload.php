<?php

ini_set('max_execution_time', '1800');

$eol = '<br>';
$domain = 'https://www.pakcosmetics.com';
$hugeImagePath = 'images/stories/virtuemart/product/';
$pages = array();
$products = array ();
$downloadTracker = 'downloadComplete.txt';

/** TO DO NEXT
 * Determine if can move pointer to line in file
 * Read and write to downloadComplete.txt - download count
 **/

// Open brand list
$handle = fopen("unique_products.txt", "r");
if ($handle) {
    while (($product = fgets($handle)) !== false) {

        $tProduct = rtrim($product);

        $productPage = $domain.$tProduct;

        print "Product page: $productPage $eol";

        $content = file_get_contents($productPage);

        if(empty($content)) {
            file_put_contents('rinse.log','Could not retrieve data from '.$tProduct, FILE_APPEND);
            continue;
        } 

        // Get product data in product page
        list($imagePath, $imageName) = getItem($content, 'image'); 
        print "Image: $image <br>"; 

        $imageFullPath = $domain.$imagePath;
        $imageContent = file_get_contents($imageFullPath);

        $hugeImageFullPath = $hugeImagePath.$imageName;
        file_put_contents($hugeImageFullPath, $imageContent);
        file_put_contents($downloadTracker, $tProduct .PHP_EOL, FILE_APPEND);

    }

    fclose($handle);

} else {
    // error opening the file.
} 

exit;

function getItem($c,$item){

    switch($item) {
        case 'title':
            $pattern = '<h1 id="h1_heading">\s+([a-zA-Z0-9\_\-\ ]+)';
        break;
        case 'thumb':
            $pattern = '<img src=\'\/images\/content\/productimg\/([a-zA-Z0-9\_\-\ \.]+\.jpg|gif|png|jpeg)\'';
        break;
        case 'image':
            $pattern = '<img src=\'(\/images\/content\/productimgRegular\/([a-zA-Z0-9\_\-\ \.]+\.jpg|gif|png|jpeg))\'';
        break;
        case 'price':
            $pattern = '<span>£([0-9\.])+<\/span>';
        break;
        case 'size':
            $pattern = '<option selected="selected" value="[0-9]+">([0-9a-zA-Z\.\ ]+)<\/option>';
        break;
        case 'desc':
            $pattern = '<div class="pdb_description">([a-zA-Z0-9\_\-\ \." ]+)</div>';
        break;
    }

    print "Pattern: $pattern <br>";

    preg_match("/$pattern/", $c, $matches);

    if ($item == 'image') {
        return array($matches[1],$matches[2]);
    }
    return $matches[1];

}

?>

