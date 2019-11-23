<?php

require_once('model/db.php');

ini_set('max_execution_time', '1800');

$eol = '<br>';
$domain = 'https://www.pakcosmetics.com';
$hugeImagePath = 'images/stories/virtuemart/product/';
$pages = array();
$products = array ();
$counter = 0;
// Open brand list
$handle = fopen("downloadComplete.txt", "r");
if ($handle) {
    while (($product = fgets($handle)) !== false) {
 
        $counter++;

        if($counter <= 10) {continue;}

        $tProduct = rtrim($product);

        $productPage = $domain.$tProduct;

        #print "Product page: $productPage $eol";

        $content = file_get_contents($productPage);

        if(empty($content)) {
            file_put_contents('rinse.log','Could not retrieve data from '.$tProduct, FILE_APPEND);
            continue;
        } 

        // Get product data in product page
        #list($imagePath, $imageName) = getItem($content, 'image'); 
        #print "Image: $image <br>"; 

        #$imageFullPath = $domain.$imagePath;
        #$imageContent = file_get_contents($imageFullPath);

        #$hugeImageFullPath = $hugeImagePath.$imageName;
        #file_put_contents($hugeImageFullPath, $imageContent);

        $price = getItem($content, 'price');
        $size = getItem($content, 'size');
        $t = getItem($content, 'title'); 
        $title = $t.' '.$size;
        $desc = getItem($content, 'desc');
        list($imagePath, $imageName) = getItem($content, 'image'); 
        $slug = convert2Slug($title);
        $catId = getCategoryId($title);

        if(empty($price)) {
            $price = '1.99';
        }

        print "Title: $title" . PHP_EOL;
        print "Price: $price" . PHP_EOL;
        print "Size: $size" . PHP_EOL;
        print "Desc: $desc" . PHP_EOL;
        print "Image: ".trim($imageName) . PHP_EOL;
        print "Slug: $slug" . PHP_EOL;
        print "CatID: $catId" . PHP_EOL;

        dbImport($title, $slug, $price, $desc, trim($imageName), $catId);

    }

    fclose($handle);

} else {
    // error opening the file.
} 

exit;

function getCategoryId($t)
{
    $t = strtolower($t);

    if( strpos($t,'men') && strpos($t,'shampoo') ) { 
        $catId = '61';
    }
    elseif( strpos($t,'men') && strpos($t,'conditioner') ) { 
        $catId = '61';
    }
    elseif( strpos($t,'men') && strpos($t,'dye') ) { 
        $catId = '60';
    }
    elseif( strpos($t,'men') && strpos($t,'colour') ) { 
        $catId = '62';
    }
    elseif( strpos($t,'men') && strpos($t,'shav') ) { 
        $catId = '57';
    }
    elseif( strpos($t,'men') && strpos($t,'hair') ) { 
        $catId = '59';
    }
    elseif( strpos($t,'organic') ) { 
        $catId = '51';
    }
    elseif( strpos($t,'shampoo') ) { 
        $catId = '42';
    }
    elseif( strpos($t,'conditioner') ) { 
        $catId = '43';
    }
    elseif( strpos($t,'treatment') ) { 
        $catId = '44';
    }
    elseif( strpos($t,'relaxer') ) { 
        $catId = '45';
    }
    elseif( strpos($t,'colouring') || strpos($t,'dye') ) { 
        $catId = '46';
    }
    elseif( strpos($t,'oil') && strpos($t,'serum') ) { 
        $catId = '47';
    }
    elseif( strpos($t,'skin') && strpos($t,'moisturi') ) { 
        $catId = '52';
    }
    elseif( strpos($t,'skin') && strpos($t,'treatment') ) { 
        $catId = '55';
    }
    elseif( strpos($t,'skin') && strpos($t,'wash') ) { 
        $catId = '53';
    }
    elseif( strpos($t,'soap') ) { 
        $catId = '53';
    }
    elseif( strpos($t,'hair') && strpos($t, 'removal') ) { 
        $catId = '54';
    }
    elseif( strpos($t,'kids') && strpos($t, 'skin') ) { 
        $catId = '56';
    }
    elseif( strpos($t,'wig') ) { 
        $catId = '65';
    }
    elseif( strpos($t,'bulk') ) { 
        $catId = '66';
    }
    elseif( strpos($t,'iron') ) { 
        $catId = '74';
    }
    elseif( strpos($t,'dryer') ) { 
        $catId = '71';
    }
    elseif( strpos($t,'tong') ) { 
        $catId = '73';
    }
    elseif( strpos($t,'comb') ) { 
        $catId = '69';
    }
    elseif( strpos($t,'clipper') ) { 
        $catId = '72';
    }
    elseif( strpos($t,'trimmer') ) { 
        $catId = '72';
    }
    elseif( strpos($t,' cap') ) { 
        $catId = '70';
    }
    elseif( strpos($t,'brush') ) { 
        $catId = '68';
    }
    else {
        $catId = '75';
    }

    return $catId;
}

function convert2Slug($t)
{
    $t2 = str_replace(' ','-',$t);
    $t3 = strtolower($t2);

    return $t3;
}

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
            $pattern = '<span>\W+nbsp;([0-9\.]+)<\/span>';
        break;
        case 'size':
            $pattern = '<option selected="selected" value="[0-9]+">([0-9a-zA-Z\.\ ]+)<\/option>';
        break;
        case 'desc':
            $pattern = '<div class="pdb_description">([a-zA-Z0-9\_\-\ \." ]+)</div>';
        break;
    }

    #print "Pattern: $pattern <br>";

    preg_match("/$pattern/", $c, $matches);

    if ($item == 'image') {
        return array($matches[1],$matches[2]);
    }

    if(!empty($matches[1])) {
        return $matches[1];
    }
    else {
        return '';
    }

}

function file_force_contents($dir, $contents){

        $parts = explode('/', $dir);
        $file = array_pop($parts);

        print "Dirs: " . PHP_EOL;
        print_r($parts);
        print "File: $file" . PHP_EOL;
        $dir = '';
  
        $count = 0;
        foreach($parts as $part) {
            if($count == 0){
                $dir .= $part;
            } else {
                $dir .= "/$part";
            }  
            if(!is_dir($dir)) {
                if(false === mkdir($dir)) {
                    $mesg = "Could create dir: $dir" . PHP_EOL;
                    file_put_contents('rinse.log', $mesg, FILE_APPEND);
                    print $mesg;
                    break;
                }
            }
            $count++;

        }

        $destFile = $dir.'/'.$file;
        $mesg =  "Dest file: $destFile" . PHP_EOL;
        file_put_contents('rinse.log', $mesg, FILE_APPEND);
        print $mesg;

        file_put_contents($destFile, $contents);

}

?>

