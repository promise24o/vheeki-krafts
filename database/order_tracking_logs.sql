-- Order Tracking Logs Table
-- This table stores all tracking activities and status changes for orders

CREATE TABLE IF NOT EXISTS `order_tracking_logs` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_by` varchar(100) DEFAULT 'System',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`),
  KEY `order_id` (`order_id`),
  KEY `created_at` (`created_at`),
  FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Add tracking_number column to orders table if it doesn't exist
ALTER TABLE `orders` 
ADD COLUMN `tracking_number` varchar(100) DEFAULT NULL AFTER `order_number`,
ADD KEY `tracking_number` (`tracking_number`);

-- Insert initial tracking logs for existing orders
INSERT INTO `order_tracking_logs` (`order_id`, `status`, `message`, `created_by`, `created_at`)
SELECT 
  `order_id`,
  `order_status`,
  CONCAT('Order placed - Status: ', UPPER(`order_status`)),
  'System',
  `created_at`
FROM `orders`
WHERE NOT EXISTS (
  SELECT 1 FROM `order_tracking_logs` WHERE `order_tracking_logs`.`order_id` = `orders`.`order_id`
);
