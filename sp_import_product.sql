DELIMITER ;;

USE jos_huge_online_db;;

DROP PROCEDURE IF EXISTS `sp_import_product`;;

CREATE DEFINER=`hugeuser`@`213.171.200.92` PROCEDURE `sp_import_product`(
p_title VARCHAR(150),
p_title_snake VARCHAR(200),
p_desc VARCHAR(500),
p_price DECIMAL(6,2),
p_image VARCHAR(200),
p_category_id INTEGER(1) )

BEGIN  
        DECLARE var_virtuemart_media_id INTEGER;
	DECLARE var_virtuemart_product_id INTEGER;
	DECLARE var_virtuemart_product_price_id INTEGER;
        DECLARE var_currency_id INTEGER;
        DECLARE var_thumb_img_path VARCHAR(100);
        DECLARE var_full_img_path VARCHAR(100);
        DECLARE var_admin_id INTEGER;
        DECLARE var_vendor_id INTEGER;
        DECLARE var_stock INTEGER;
        DECLARE var_published INTEGER;
        DECLARE var_file_mime_type VARCHAR(20);
        DECLARE var_file_type VARCHAR(20);

	SET var_currency_id = 144;
	SET var_thumb_img_path = 'images/stories/virtuemart/product/resized/';
	SET var_full_img_path = 'images/stories/virtuemart/product/';
	SET var_admin_id = 979;
	SET var_vendor_id = 1;
	SET var_stock = 100;
	SET var_published = 1;
	SET var_file_mime_type = 'image/jpeg';
	SET var_file_type = 'product';
	
    START TRANSACTION;
 
		-- Insert Product details
		INSERT INTO `jos2_virtuemart_products` (virtuemart_vendor_id, product_in_stock, published)
		VALUES (var_vendor_id, var_stock, var_published);
		
		SET var_virtuemart_product_id := LAST_INSERT_ID();
		
		-- Insert Image details
		INSERT INTO `jos2_virtuemart_medias` (virtuemart_vendor_id, file_title, file_mimetype, file_type, file_url, file_url_thumb, published, created_on, created_by )
		VALUES (var_vendor_id, p_image, var_file_mime_type, var_file_type, concat(var_full_img_path, p_image), concat(var_thumb_img_path, p_image), var_published, now(), var_admin_id);
		
		SET var_virtuemart_media_id := LAST_INSERT_ID();
		
		-- Insert GB product details
		INSERT INTO `jos2_virtuemart_products_en_gb` (virtuemart_product_id, product_name, metadesc, slug)
		VALUES (var_virtuemart_product_id, p_title, p_title, p_title_snake);
		
		-- Insert Product Category
		INSERT INTO `jos2_virtuemart_product_categories` (virtuemart_product_id, virtuemart_category_id )
		VALUES (var_virtuemart_product_id, p_category_id);
		
		-- Insert Product Media (Image)
		INSERT INTO `jos2_virtuemart_product_medias` (virtuemart_product_id, virtuemart_media_id)
		VALUES (var_virtuemart_product_id, var_virtuemart_media_id);
		
		-- Insert Product Price
		INSERT INTO `jos2_virtuemart_product_prices` (virtuemart_product_id, product_price, product_currency)
		VALUES	(var_virtuemart_product_id, p_price, var_currency_id)	;
	
	
	COMMIT;
	
END ;

DELIMITER ;
