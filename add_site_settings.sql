-- Add additional site settings
INSERT INTO `site_settings` (`setting_key`, `setting_value`, `setting_type`) VALUES
('site_description', 'Discover unique handcrafted artworks and crafts made with passion. Shop our exclusive collection of handmade jewelry, home decor, and artistic creations.', 'textarea'),
('site_keywords', 'handmade, crafts, art, jewelry, home decor, handcrafted, unique gifts', 'text'),
('copyright_text', '© 2025 Vheeki Krafts. All rights reserved.', 'text'),
('site_logo', '', 'image'),
('site_favicon', '', 'image'),
('primary_color', '#5D87FF', 'text'),
('secondary_color', '#49BEFF', 'text'),
('whatsapp_number', '', 'text'),
('business_hours', 'Mon-Fri: 9:00 AM - 6:00 PM\nSat: 10:00 AM - 4:00 PM\nSun: Closed', 'textarea'),
('facebook_url', '', 'text'),
('instagram_url', '', 'text'),
('twitter_url', '', 'text'),
('linkedin_url', '', 'text'),
('youtube_url', '', 'text'),
('pinterest_url', '', 'text'),
('tiktok_url', '', 'text'),
('whatsapp_url', '', 'text'),
('products_per_page', '12', 'text'),
('about_us_text', 'Welcome to Vheeki Krafts, where creativity meets craftsmanship. We specialize in handmade artworks and unique creations that bring beauty and personality to your space.', 'textarea')
ON DUPLICATE KEY UPDATE 
  setting_value = VALUES(setting_value),
  setting_type = VALUES(setting_type);
