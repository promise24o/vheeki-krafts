-- Add portfolio field to product_reviews table
ALTER TABLE `product_reviews` ADD COLUMN `reviewer_portfolio` VARCHAR(255) NULL AFTER `customer_email`;
