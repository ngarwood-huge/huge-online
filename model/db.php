<?php

function dbConnect()
{
    $dbhost = '213.171.200.92';
    $dbname = 'jos_huge_online_db';
    $uname = 'hugeuser';
    $passwd = 'Hug30nline@1';

    $dsn = "mysql:host={$dbhost};dbname={$dbname}";

    try {
        $db = new PDO($dsn, $uname, $passwd);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    return $db;
}

/**
    p_title VARCHAR(150),
    p_title_snake (200),
    p_desc VARCHAR(500),
    p_price DECIMAL(6,2),
    p_image VARCHAR(200),
    p_category_id INT(1)
**/
function dbImport($title, $slug, $price, $desc, $imageName, $catId)
{
    $db = dbConnect();

    $db->beginTransaction();
    try {

       # Get max product ID
       $stmt = $db->prepare("SELECT MAX(virtuemart_product_id) AS max_product_id FROM `jos2_virtuemart_products`");
       $stmt->execute();

       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       print_r($result);

       $nextProductId = $result['max_product_id'] + 1;


        # Insert Product details
        $stmt = $db->prepare("INSERT INTO `jos2_virtuemart_products` (virtuemart_product_id, virtuemart_vendor_id, product_in_stock, published) VALUES (?, 1, 100, 1)");
        $stmt->execute([$nextProductId]);

        # Product ID
        $productId = $nextProductId;

        # Insert GB product details
        $stmt = $db->prepare( "INSERT INTO `jos2_virtuemart_products_en_gb` (virtuemart_product_id, product_name, metadesc, slug) VALUES (?,?,?,?)" );
        $stmt->execute([$productId, $title, $title, $slug]);

        # Insert Image details
        $stmt = $db->prepare("INSERT INTO `jos2_virtuemart_medias` (virtuemart_vendor_id, file_title, file_mimetype, file_type, file_url, file_url_thumb, published, created_on, created_by ) VALUES (1, ?, \"image/jpeg\", \"product\", concat(\"images/stories/virtuemart/product/\", ?), concat(\"images/stories/virtuemart/product/resized/\", ?), 1, now(), 979)");
        $stmt->execute([$imageName, $imageName, $imageName]);

        # Media ID
        $mediaId = $db->lastInsertId();

        # Insert Product Category
        $stmt = $db->prepare("INSERT INTO `jos2_virtuemart_product_categories` (virtuemart_product_id, virtuemart_category_id ) VALUES (?, ?)");
        $stmt->execute([$productId, $catId]);
		
        # Insert Product Media (Image)
        $stmt = $db->prepare("INSERT INTO `jos2_virtuemart_product_medias` (virtuemart_product_id, virtuemart_media_id) VALUES (?, ?)");
        $stmt->execute([$productId, $mediaId]);
		
        # Insert Product Price
        $stmt = $db->prepare("INSERT INTO `jos2_virtuemart_product_prices` (virtuemart_product_id, product_price, product_currency) VALUES (?, ?, ?)");
        $stmt->execute([$productId, $price, 144]);

        # Insert Product Price
        $stmt = $db->prepare("INSERT INTO `jos2_virtuemart_product_manufacturers` ( `virtuemart_product_id` , `virtuemart_manufacturer_id`) VALUES (?, ?)");
        $stmt->execute([$productId, 14]);

        $db->commit();

    } catch (PDOException $e) {
        print $e->getMessage();
        $db->rollBack();
    }
}
