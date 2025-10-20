-- Create homepage_banners table for managing slider content
CREATE TABLE `homepage_banners` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `subtitle` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `button_text` varchar(100) NOT NULL,
  `button_link` varchar(255) NOT NULL,
  `background_image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Insert default banners (matching current homepage)
INSERT INTO `homepage_banners` (`subtitle`, `title`, `button_text`, `button_link`, `background_image`, `sort_order`, `is_active`) VALUES
('Discover Unique Crafts', 'Handmade<br>Masterpieces', 'Shop Now', '/shop', 'hero-slider-09.jpg', 1, 1),
('New Arrivals', 'Artisanal<br>Collections', 'Explore Now', '/shop', 'hero-slider-08.jpg', 2, 1),
('Special Offers', 'Exclusive<br>Deals', 'Discover Deals', '/shop', 'hero-slider-07.jpg', 3, 1);
