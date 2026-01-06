-- Fix orders table schema to match application requirements
-- Run this if you're getting errors during checkout

-- Check if columns exist and add them if missing
SET @dbname = DATABASE();
SET @tablename = 'orders';

-- Add city column if it doesn't exist
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'city');
SET @query = IF(@col_exists = 0, 
    'ALTER TABLE orders ADD COLUMN city VARCHAR(100) NOT NULL AFTER shipping_address', 
    'SELECT "Column city already exists" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Add state column if it doesn't exist
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'state');
SET @query = IF(@col_exists = 0, 
    'ALTER TABLE orders ADD COLUMN state VARCHAR(100) NOT NULL AFTER city', 
    'SELECT "Column state already exists" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Add postal_code column if it doesn't exist
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'postal_code');
SET @query = IF(@col_exists = 0, 
    'ALTER TABLE orders ADD COLUMN postal_code VARCHAR(20) DEFAULT NULL AFTER state', 
    'SELECT "Column postal_code already exists" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Add order_notes column if it doesn't exist
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'order_notes');
SET @query = IF(@col_exists = 0, 
    'ALTER TABLE orders ADD COLUMN order_notes TEXT DEFAULT NULL AFTER postal_code', 
    'SELECT "Column order_notes already exists" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Rename notes to order_notes if notes exists and order_notes doesn't
SET @notes_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'notes');
SET @order_notes_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'order_notes');
SET @query = IF(@notes_exists = 1 AND @order_notes_exists = 0, 
    'ALTER TABLE orders CHANGE COLUMN notes order_notes TEXT DEFAULT NULL', 
    'SELECT "Column notes/order_notes OK" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Remove subtotal, tax_amount, shipping_amount if they exist (we only use total_amount)
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'subtotal');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE orders DROP COLUMN subtotal', 
    'SELECT "Column subtotal does not exist" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'tax_amount');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE orders DROP COLUMN tax_amount', 
    'SELECT "Column tax_amount does not exist" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'shipping_amount');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE orders DROP COLUMN shipping_amount', 
    'SELECT "Column shipping_amount does not exist" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Remove billing_address if it exists (we don't use it)
SET @col_exists = (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = 'billing_address');
SET @query = IF(@col_exists = 1, 
    'ALTER TABLE orders DROP COLUMN billing_address', 
    'SELECT "Column billing_address does not exist" AS message');
PREPARE stmt FROM @query;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Verify the final schema
SELECT 
    'Orders table schema updated successfully' AS status,
    COUNT(*) AS total_columns
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'orders';

-- Show current columns
SELECT COLUMN_NAME, DATA_TYPE, IS_NULLABLE, COLUMN_DEFAULT
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'orders'
ORDER BY ORDINAL_POSITION;
