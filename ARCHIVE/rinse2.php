<?php

ini_set('max_execution_time', '1800');

$eol = '<br>';
$domain = 'https://www.pakcosmetics.com';
$pages = array();
$products = array ();

// Open brand list
$handle = fopen("brandlist.txt", "r");
if ($handle) {
    while (($brand = fgets($handle)) !== false) {

        $tBrand = rtrim($brand);

        $productPage = $domain.$tBrand;

        print "Product page: $productPage $eol";

        $content = file_get_contents($productPage);

        if(empty($content)) {
            file_put_contents('rinse.log','Could not retrieve data from '.$tBrand, FILE_APPEND);
            continue;
        } 

        // Get products in rhs listing
        getProductPages($content, $tBrand);
    }

    fclose($handle);

} else {
    // error opening the file.
} 

exit;

function getProductPages($c, $b) {
    
    $b2 = str_replace('-','[\-\ \_%20]+',$b);
    $b3 = str_replace('/','\/',$b2);
    $pattern = "($b3\/[a-zA-Z0-9\-]+\.html)";

    #print "Pattern for regex: $pattern <br>";

    preg_match_all("/$pattern/", $c, $matches);

    if(count($matches[0]) > 0) {
        foreach($matches[0] as $page) {
            file_put_contents('products.txt', $page . PHP_EOL, FILE_APPEND);
        }
    }
}

function getItem($content,$item){

    switch($item) {
        case 'title':
        break;
    }

    $pattern = '';

    #preg_match
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

