-- Add encrypted_id field to products table for unique long IDs
ALTER TABLE `products` ADD COLUMN `encrypted_id` VARCHAR(100) NOT NULL UNIQUE AFTER `product_id`;

-- Create index for faster lookups
CREATE INDEX `idx_encrypted_id` ON `products` (`encrypted_id`);
