-- Fix order_items table to match the application code
-- This will standardize the column names to what the controller expects

-- Check current schema
SELECT 'Current order_items schema:' AS info;
DESCRIBE order_items;

-- Rename columns if they exist with old names
SET @dbname = DATABASE();
SET @tablename = 'order_items';

-- Check if unit_price exists and price doesn't
SET @unit_price_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'unit_price');
SET @price_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'price');

-- Rename unit_price to price
SET @query = IF(@unit_price_exists = 1 AND @price_exists = 0, 
    'ALTER TABLE order_items CHANGE COLUMN unit_price price DECIMAL(10,2) NOT NULL', 
    'SELECT "Column unit_price -> price: Already correct or not needed" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Check if total_price exists and subtotal doesn't
SET @total_price_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'total_price');
SET @subtotal_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'subtotal');

-- Rename total_price to subtotal
SET @query = IF(@total_price_exists = 1 AND @subtotal_exists = 0, 
    'ALTER TABLE order_items CHANGE COLUMN total_price subtotal DECIMAL(10,2) NOT NULL', 
    'SELECT "Column total_price -> subtotal: Already correct or not needed" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Remove unnecessary columns that the app doesn't use
-- product_name (we can get from products table)
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'product_name');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE order_items DROP COLUMN product_name', 
    'SELECT "Column product_name: Already removed" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- product_sku (we can get from products table)
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'product_sku');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE order_items DROP COLUMN product_sku', 
    'SELECT "Column product_sku: Already removed" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- size (not currently used in cart)
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'size');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE order_items DROP COLUMN size', 
    'SELECT "Column size: Already removed" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- color (not currently used in cart)
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'color');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE order_items DROP COLUMN color', 
    'SELECT "Column color: Already removed" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Rename item_id to order_item_id for consistency
SET @item_id_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'item_id');
SET @order_item_id_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'order_item_id');

SET @query = IF(@item_id_exists = 1 AND @order_item_id_exists = 0, 
    'ALTER TABLE order_items CHANGE COLUMN item_id order_item_id INT(11) NOT NULL AUTO_INCREMENT', 
    'SELECT "Column item_id -> order_item_id: Already correct" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Show final schema
SELECT 'Final order_items schema:' AS info;
DESCRIBE order_items;

SELECT '✅ order_items table schema updated successfully!' AS status;
