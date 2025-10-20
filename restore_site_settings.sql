-- Restore site settings to default values
-- Run this to fix the corrupted settings

UPDATE `site_settings` SET `setting_value` = 'Vheeki Krafts' WHERE `setting_key` = 'site_title';
UPDATE `site_settings` SET `setting_value` = 'Handcrafted Art & Unique Creations' WHERE `setting_key` = 'site_tagline';
UPDATE `site_settings` SET `setting_value` = 'Discover unique handcrafted artworks and crafts made with passion. Shop our exclusive collection of handmade jewelry, home decor, and artistic creations.' WHERE `setting_key` = 'site_description';
UPDATE `site_settings` SET `setting_value` = 'handmade, crafts, art, jewelry, home decor, handcrafted, unique gifts' WHERE `setting_key` = 'site_keywords';
UPDATE `site_settings` SET `setting_value` = '© 2025 Vheeki Krafts. All rights reserved.' WHERE `setting_key` = 'copyright_text';
UPDATE `site_settings` SET `setting_value` = '#5D87FF' WHERE `setting_key` = 'primary_color';
UPDATE `site_settings` SET `setting_value` = '#49BEFF' WHERE `setting_key` = 'secondary_color';
UPDATE `site_settings` SET `setting_value` = 'Mon-Fri: 9:00 AM - 6:00 PM\nSat: 10:00 AM - 4:00 PM\nSun: Closed' WHERE `setting_key` = 'business_hours';
UPDATE `site_settings` SET `setting_value` = '12' WHERE `setting_key` = 'products_per_page';
UPDATE `site_settings` SET `setting_value` = 'Welcome to Vheeki Krafts, where creativity meets craftsmanship. We specialize in handmade artworks and unique creations that bring beauty and personality to your space.' WHERE `setting_key` = 'about_us_text';
UPDATE `site_settings` SET `setting_value` = '1' WHERE `setting_key` = 'promo_section_active';
UPDATE `site_settings` SET `setting_value` = 'NEW COLLECTION' WHERE `setting_key` = 'promo_section_subtitle';
UPDATE `site_settings` SET `setting_value` = 'Discover Our Autumn Collection' WHERE `setting_key` = 'promo_section_title';
UPDATE `site_settings` SET `setting_value` = 'Made using clean, non-toxic ingredients, our products are designed for everyone.' WHERE `setting_key` = 'promo_section_description';
UPDATE `site_settings` SET `setting_value` = 'Explore More' WHERE `setting_key` = 'promo_section_button_text';
UPDATE `site_settings` SET `setting_value` = '/shop' WHERE `setting_key` = 'promo_section_button_link';
