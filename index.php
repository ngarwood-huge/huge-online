<?php
/**
 * @package    Joomla.Site
 *
 * @copyright  Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

/**
include 'productList.php';

foreach($products as $productString) {
    echo "\n\n$productString\n";
    crawl_page("http://www.pakcosmetics.com/search/$productString", $productString, 2);
    #sleep(1);
}

exit;

function crawl_page($url, $productString, $depth = 5)
{
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);

    $anchors = $dom->getElementsByTagName('img');
    foreach ($anchors as $element) {

        $src = $element->getAttribute('src');
        $alt =  $element->getAttribute('alt');

        if(strstr($src,'productimg')) {
            $src2 = str_replace('productimg','productimgRegular',$src);
            echo "\nPRODUCT: $alt";

            $imageUrl = "http://www.pakcosmetics.com$src2";
            echo "\nIMAGE URL: $imageUrl";
            echo "\nIMAGE: <img src=\"$imageUrl\">\n";

            $newImageName = rename_image($productString);
            $imageExt = substr($src2,-3);
            $fileDest = "../productInfo/$newImageName.$imageExt";

            if(file_exists($fileDest)) {
                continue;
            }

            $imageString = file_get_contents($imageUrl);


            echo "\nIMAGE DEST: $fileDest\n";
            $save = file_put_contents($fileDest, $imageString);

            print_r($save);
        }

        crawl_page($href, $depth - 1);
    }

}

function rename_image($orig_name) 
{
    $orig_name = str_replace(' ','-',$orig_name);
    $orig_name = strtolower($orig_name);

    if(strstr($orig_name,'&')) {
        $orig_name = str_replace('&','n',$orig_name);
    }

    if(strstr($orig_name,'---')) {
        $orig_name = str_replace('---','-',$orig_name);
    }

    return $orig_name;
}
*/

if (version_compare(PHP_VERSION, '5.3.10', '<'))
{
	die('Your host needs to use PHP 5.3.10 or higher to run this version of Joomla!');
}

/**
 * Constant that is checked in included files to prevent direct access.
 * define() is used in the installation folder rather than "const" to not error for PHP 5.2 and lower
 */
define('_JEXEC', 1);

if (file_exists(__DIR__ . '/defines.php'))
{
	include_once __DIR__ . '/defines.php';
}

if (!defined('_JDEFINES'))
{
	define('JPATH_BASE', __DIR__);
	require_once JPATH_BASE . '/includes/defines.php';
}

require_once JPATH_BASE . '/includes/framework.php';

// Mark afterLoad in the profiler.
JDEBUG ? $_PROFILER->mark('afterLoad') : null;

// Instantiate the application.
$app = JFactory::getApplication('site');

// Execute the application.
$app->execute();
