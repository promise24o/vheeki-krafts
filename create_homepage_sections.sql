-- Add promo section settings to site_settings table
INSERT INTO `site_settings` (`setting_key`, `setting_value`, `setting_type`) VALUES
('promo_section_active', '1', 'text'),
('promo_section_subtitle', 'NEW COLLECTION', 'text'),
('promo_section_title', 'Discover Our Autumn Collection', 'text'),
('promo_section_description', 'Made using clean, non-toxic ingredients, our products are designed for everyone.', 'textarea'),
('promo_section_button_text', 'Explore More', 'text'),
('promo_section_button_link', '/shop', 'text'),
('promo_section_image_light', '', 'image'),
('promo_section_image_dark', '', 'image')
ON DUPLICATE KEY UPDATE 
  setting_value = VALUES(setting_value),
  setting_type = VALUES(setting_type);
