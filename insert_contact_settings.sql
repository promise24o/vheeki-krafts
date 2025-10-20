-- Insert Contact Information Settings for Vheeki Krafts (Port Harcourt)
INSERT INTO `site_settings` (`setting_key`, `setting_value`, `setting_type`) VALUES
('contact_email', 'info@vheekikrafts.com', 'text'),
('contact_mobile', '+234 803 456 7890', 'text'),
('contact_hotline', '+234 901 234 5678', 'text'),
('whatsapp_number', '+2348034567890', 'text'),
('contact_address', 'Plot 45, Trans-Amadi Industrial Layout\nPort Harcourt, Rivers State\nNigeria', 'textarea'),
('contact_directions_link', 'https://maps.google.com/?q=Trans-Amadi+Industrial+Layout+Port+Harcourt', 'text'),
('business_hours', 'Mon-Fri: 9:00 AM - 6:00 PM\nSat: 10:00 AM - 4:00 PM\nSun: Closed', 'textarea')
ON DUPLICATE KEY UPDATE 
  setting_value = VALUES(setting_value),
  setting_type = VALUES(setting_type);
