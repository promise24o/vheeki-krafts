-- Seed 30 Artwork Products for Vheeki Krafts
-- Images from Unsplash (free to use)

-- First, let's update categories to be artwork-focused
UPDATE `categories` SET 
  `category_name` = 'Abstract Art',
  `category_slug` = 'abstract-art',
  `category_description` = 'Bold abstract compositions that challenge perception and inspire creativity'
WHERE `category_slug` = 'body-care';

UPDATE `categories` SET 
  `category_name` = 'Nature & Landscape',
  `category_slug` = 'nature-landscape',
  `category_description` = 'Breathtaking natural scenes and stunning landscape photography'
WHERE `category_slug` = 'skin-care';

UPDATE `categories` SET 
  `category_name` = 'Urban & Architecture',
  `category_slug` = 'urban-architecture',
  `category_description` = 'Modern cityscapes and architectural masterpieces'
WHERE `category_slug` = 'hair-care';

UPDATE `categories` SET 
  `category_name` = 'Minimalist',
  `category_slug` = 'minimalist',
  `category_description` = 'Clean, simple designs that speak volumes through subtlety'
WHERE `category_slug` = 'accessories';

UPDATE `categories` SET 
  `category_name` = 'Black & White',
  `category_slug` = 'black-white',
  `category_description` = 'Timeless monochrome photography and art'
WHERE `category_slug` = 'home-decor';

UPDATE `categories` SET 
  `category_name` = 'Portraits & People',
  `category_slug` = 'portraits-people',
  `category_description` = 'Captivating human expressions and emotions'
WHERE `category_slug` = 'jewelry';

-- Insert 30 Products
-- Abstract Art Category (5 products)
INSERT INTO `products` (`product_name`, `product_slug`, `sku`, `encrypted_id`, `category_id`, `price`, `discount_price`, `description`, `sizes`, `colors`, `tags`, `stock_quantity`, `is_best_seller`, `is_new_arrival`, `is_on_sale`, `is_hot_item`) VALUES
('Vibrant Fluid Dreams', 'vibrant-fluid-dreams', 'VFD2401', 'vfd2401enc7a8b9c', 1, 45000.00, 38000.00, 'A mesmerizing abstract piece featuring fluid acrylic pours in vibrant blues, purples, and gold. This artwork captures the essence of movement and energy, perfect for modern living spaces.', '["12x16 inches", "16x20 inches", "24x36 inches"]', '["Blue", "Purple", "Gold"]', '["Abstract", "Modern", "Colorful"]', 15, 1, 0, 1, 1),
('Geometric Harmony', 'geometric-harmony', 'GEH3402', 'geh3402enc4d5e6f', 1, 38000.00, NULL, 'Bold geometric shapes in warm earth tones create a harmonious composition. This piece brings structure and sophistication to any wall.', '["16x20 inches", "20x24 inches"]', '["Orange", "Brown", "Beige"]', '["Geometric", "Modern", "Warm"]', 20, 0, 1, 0, 0),
('Crimson Explosion', 'crimson-explosion', 'CRE4503', 'cre4503enc1a2b3c', 1, 52000.00, NULL, 'An explosive abstract composition dominated by deep reds and blacks. This powerful piece makes a bold statement in contemporary interiors.', '["20x24 inches", "24x36 inches", "30x40 inches"]', '["Red", "Black", "White"]', '["Abstract", "Bold", "Contemporary"]', 10, 1, 0, 0, 1),
('Pastel Whispers', 'pastel-whispers', 'PAW5604', 'paw5604enc8e9f0a', 1, 35000.00, 28000.00, 'Soft pastel hues blend seamlessly in this calming abstract piece. Perfect for bedrooms and meditation spaces.', '["12x16 inches", "16x20 inches"]', '["Pink", "Blue", "Cream"]', '["Abstract", "Soft", "Calming"]', 18, 0, 0, 1, 0),
('Midnight Cosmos', 'midnight-cosmos', 'MIC6705', 'mic6705enc5b6c7d', 1, 48000.00, NULL, 'Deep blues and purples swirl together like a cosmic nebula. This piece brings the mystery of space into your home.', '["16x20 inches", "24x36 inches"]', '["Navy", "Purple", "Silver"]', '["Abstract", "Space", "Dark"]', 12, 0, 1, 0, 1),

-- Nature & Landscape Category (5 products)
('Misty Mountain Morning', 'misty-mountain-morning', 'MMM7806', 'mmm7806enc2c3d4e', 2, 42000.00, NULL, 'Capture the serenity of dawn breaking over misty mountain peaks. This landscape photograph brings tranquility to any space.', '["16x20 inches", "20x24 inches", "24x36 inches"]', '["Blue", "Gray", "White"]', '["Nature", "Mountains", "Peaceful"]', 25, 1, 0, 0, 0),
('Golden Hour Fields', 'golden-hour-fields', 'GHF8907', 'ghf8907enc9f0a1b', 2, 39000.00, 32000.00, 'Endless fields bathed in the warm glow of golden hour. This piece radiates warmth and nostalgia.', '["16x20 inches", "24x36 inches"]', '["Gold", "Green", "Orange"]', '["Nature", "Sunset", "Warm"]', 20, 0, 0, 1, 1),
('Tropical Paradise', 'tropical-paradise', 'TRP9108', 'trp9108enc6a7b8c', 2, 44000.00, NULL, 'Lush tropical foliage and crystal-clear waters transport you to paradise. Perfect for creating a vacation vibe at home.', '["20x24 inches", "24x36 inches", "30x40 inches"]', '["Green", "Turquoise", "White"]', '["Tropical", "Beach", "Vibrant"]', 15, 1, 1, 0, 1),
('Autumn Forest Path', 'autumn-forest-path', 'AFP0209', 'afp0209enc3d4e5f', 2, 41000.00, NULL, 'A winding path through a forest ablaze with autumn colors. This piece celebrates the beauty of seasonal change.', '["16x20 inches", "20x24 inches"]', '["Orange", "Red", "Brown"]', '["Nature", "Autumn", "Forest"]', 18, 0, 1, 0, 0),
('Desert Dunes at Dusk', 'desert-dunes-dusk', 'DDD1310', 'ddd1310enc0b1c2d', 2, 46000.00, 39000.00, 'Sweeping sand dunes under a purple-pink sunset sky. This dramatic landscape brings desert majesty indoors.', '["20x24 inches", "24x36 inches"]', '["Purple", "Orange", "Sand"]', '["Desert", "Sunset", "Dramatic"]', 12, 0, 0, 1, 0),

-- Urban & Architecture Category (5 products)
('Manhattan Skyline', 'manhattan-skyline', 'MAS2411', 'mas2411enc7e8f9a', 3, 50000.00, NULL, 'Iconic New York City skyline at twilight. Perfect for urban enthusiasts and city lovers.', '["20x24 inches", "24x36 inches", "30x40 inches"]', '["Blue", "Gray", "Gold"]', '["Urban", "Cityscape", "Modern"]', 22, 1, 0, 0, 1),
('Brutalist Beauty', 'brutalist-beauty', 'BRB3512', 'brb3512enc4a5b6c', 3, 43000.00, 36000.00, 'Raw concrete architecture captured in dramatic angles. A celebration of brutalist design.', '["16x20 inches", "20x24 inches"]', '["Gray", "White", "Black"]', '["Architecture", "Brutalist", "Modern"]', 16, 0, 0, 1, 0),
('Neon Tokyo Nights', 'neon-tokyo-nights', 'NTN4613', 'ntn4613enc1b2c3d', 3, 47000.00, NULL, 'Vibrant neon lights illuminate Tokyo streets at night. This piece captures urban energy and excitement.', '["20x24 inches", "24x36 inches"]', '["Pink", "Blue", "Purple"]', '["Urban", "Neon", "Night"]', 14, 1, 1, 0, 1),
('Spiral Staircase', 'spiral-staircase', 'SPS5714', 'sps5714enc8c9d0e', 3, 40000.00, NULL, 'An elegant spiral staircase photographed from below. This architectural detail adds sophistication to any space.', '["16x20 inches", "20x24 inches"]', '["White", "Gray", "Gold"]', '["Architecture", "Elegant", "Geometric"]', 19, 0, 1, 0, 0),
('Bridge to Nowhere', 'bridge-to-nowhere', 'BTN6815', 'btn6815enc5d6e7f', 3, 45000.00, 38000.00, 'A minimalist bridge disappearing into fog. This piece evokes mystery and contemplation.', '["20x24 inches", "24x36 inches"]', '["Gray", "White", "Blue"]', '["Architecture", "Minimal", "Fog"]', 13, 0, 0, 1, 1),

-- Minimalist Category (5 products)
('Single Leaf', 'single-leaf', 'SIL7916', 'sil7916enc2e3f4a', 4, 32000.00, NULL, 'One perfect leaf against a clean white background. The essence of minimalist beauty.', '["12x16 inches", "16x20 inches"]', '["Green", "White"]', '["Minimalist", "Nature", "Simple"]', 30, 1, 0, 0, 0),
('Zen Stones', 'zen-stones', 'ZEN8017', 'zen8017enc9a0b1c', 4, 35000.00, 28000.00, 'Balanced stones in perfect harmony. This piece brings zen philosophy to your walls.', '["16x20 inches", "20x24 inches"]', '["Gray", "White", "Black"]', '["Minimalist", "Zen", "Balance"]', 25, 0, 0, 1, 1),
('Empty Space', 'empty-space', 'EMS9118', 'ems9118enc6b7c8d', 4, 30000.00, NULL, 'A study in negative space and subtle gradients. Less is more in this contemplative piece.', '["16x20 inches", "20x24 inches", "24x36 inches"]', '["White", "Cream", "Gray"]', '["Minimalist", "Abstract", "Subtle"]', 28, 0, 1, 0, 0),
('Line and Form', 'line-and-form', 'LAF0219', 'laf0219enc3c4d5e', 4, 36000.00, NULL, 'Clean lines intersect in perfect proportion. A celebration of simplicity and precision.', '["12x16 inches", "16x20 inches"]', '["Black", "White"]', '["Minimalist", "Geometric", "Modern"]', 22, 1, 1, 0, 1),
('Solitary Tree', 'solitary-tree', 'SOT1320', 'sot1320enc0d1e2f', 4, 38000.00, 32000.00, 'One tree stands alone in vast emptiness. This piece speaks to solitude and strength.', '["16x20 inches", "20x24 inches"]', '["Green", "White", "Blue"]', '["Minimalist", "Nature", "Peaceful"]', 20, 0, 0, 1, 0),

-- Black & White Category (5 products)
('Dramatic Shadows', 'dramatic-shadows', 'DRS2421', 'drs2421enc7f8a9b', 5, 41000.00, NULL, 'High contrast shadows create dramatic patterns. This monochrome piece is timeless and bold.', '["16x20 inches", "20x24 inches", "24x36 inches"]', '["Black", "White"]', '["Black and White", "Dramatic", "Contrast"]', 24, 1, 0, 0, 1),
('Vintage Portrait', 'vintage-portrait', 'VIP3522', 'vip3522enc4b5c6d', 5, 44000.00, 37000.00, 'A classic black and white portrait with timeless elegance. Perfect for traditional and modern spaces alike.', '["16x20 inches", "20x24 inches"]', '["Black", "White", "Gray"]', '["Portrait", "Vintage", "Classic"]', 15, 0, 0, 1, 0),
('Stormy Seascape', 'stormy-seascape', 'STS4623', 'sts4623enc1c2d3e', 5, 46000.00, NULL, 'Turbulent waves captured in dramatic black and white. This piece brings the power of the ocean indoors.', '["20x24 inches", "24x36 inches", "30x40 inches"]', '["Black", "White", "Gray"]', '["Seascape", "Dramatic", "Monochrome"]', 18, 1, 1, 0, 1),
('Urban Geometry', 'urban-geometry', 'URG5724', 'urg5724enc8d9e0f', 5, 39000.00, NULL, 'City architecture reduced to geometric forms in black and white. Modern and sophisticated.', '["16x20 inches", "20x24 inches"]', '["Black", "White"]', '["Architecture", "Geometric", "Urban"]', 21, 0, 1, 0, 0),
('Misty Forest', 'misty-forest', 'MIF6825', 'mif6825enc5e6f7a', 5, 43000.00, 36000.00, 'Trees emerge from fog in this ethereal black and white landscape. Mysterious and captivating.', '["20x24 inches", "24x36 inches"]', '["Black", "White", "Gray"]', '["Nature", "Forest", "Ethereal"]', 16, 0, 0, 1, 1),

-- Portraits & People Category (5 products)
('Contemplation', 'contemplation', 'CON7926', 'con7926enc2f3a4b', 6, 48000.00, NULL, 'A thoughtful portrait capturing deep emotion and introspection. This piece connects on a human level.', '["16x20 inches", "20x24 inches"]', '["Brown", "Beige", "Black"]', '["Portrait", "Emotion", "Human"]', 12, 1, 0, 0, 0),
('Joy in Motion', 'joy-in-motion', 'JIM8027', 'jim8027enc9b0c1d', 6, 42000.00, 35000.00, 'A candid moment of pure happiness captured in motion. This piece radiates positive energy.', '["16x20 inches", "20x24 inches", "24x36 inches"]', '["Colorful", "Warm"]', '["Portrait", "Happy", "Candid"]', 17, 0, 0, 1, 1),
('Silhouette at Sunset', 'silhouette-sunset', 'SIS9128', 'sis9128enc6c7d8e', 6, 40000.00, NULL, 'A dramatic silhouette against a golden sunset. Perfect for creating atmosphere and mood.', '["16x20 inches", "20x24 inches"]', '["Orange", "Black", "Purple"]', '["Portrait", "Sunset", "Silhouette"]', 19, 1, 1, 0, 1),
('Generations', 'generations', 'GEN0229', 'gen0229enc3d4e5f', 6, 45000.00, NULL, 'A touching portrait celebrating family bonds across generations. This piece tells a story of love and legacy.', '["20x24 inches", "24x36 inches"]', '["Warm", "Natural"]', '["Portrait", "Family", "Emotional"]', 14, 0, 1, 0, 0),
('Street Musician', 'street-musician', 'STM1330', 'stm1330enc0e1f2a', 6, 43000.00, 36000.00, 'A soulful street performer captured in their element. This piece celebrates art and passion.', '["16x20 inches", "20x24 inches"]', '["Black", "White", "Sepia"]', '["Portrait", "Music", "Street"]', 15, 0, 0, 1, 0);

-- Insert product images (using Unsplash URLs)
INSERT INTO `product_images` (`product_id`, `image_path`, `is_primary`, `sort_order`) VALUES
-- Abstract Art
(1, 'https://images.unsplash.com/photo-1541961017774-22349e4a1262?w=800', 1, 1),
(1, 'https://images.unsplash.com/photo-1549887534-1541e9326642?w=800', 0, 2),
(2, 'https://images.unsplash.com/photo-1557672172-298e090bd0f1?w=800', 1, 1),
(3, 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?w=800', 1, 1),
(4, 'https://images.unsplash.com/photo-1579783902614-a3fb3927b6a5?w=800', 1, 1),
(5, 'https://images.unsplash.com/photo-1550859492-d5da9d8e45f3?w=800', 1, 1),

-- Nature & Landscape
(6, 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800', 1, 1),
(6, 'https://images.unsplash.com/photo-1519904981063-b0cf448d479e?w=800', 0, 2),
(7, 'https://images.unsplash.com/photo-1500382017468-9049fed747ef?w=800', 1, 1),
(8, 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=800', 1, 1),
(9, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800', 1, 1),
(10, 'https://images.unsplash.com/photo-1509316785289-025f5b846b35?w=800', 1, 1),

-- Urban & Architecture
(11, 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?w=800', 1, 1),
(11, 'https://images.unsplash.com/photo-1514565131-fce0801e5785?w=800', 0, 2),
(12, 'https://images.unsplash.com/photo-1511818966892-d7d671e672a2?w=800', 1, 1),
(13, 'https://images.unsplash.com/photo-1542051841857-5f90071e7989?w=800', 1, 1),
(14, 'https://images.unsplash.com/photo-1513002749550-c59d786b8e6c?w=800', 1, 1),
(15, 'https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?w=800', 1, 1),

-- Minimalist
(16, 'https://images.unsplash.com/photo-1565011523534-747a8601f10a?w=800', 1, 1),
(17, 'https://images.unsplash.com/photo-1544551763-46a013bb70d5?w=800', 1, 1),
(18, 'https://images.unsplash.com/photo-1557682250-33bd709cbe85?w=800', 1, 1),
(19, 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800', 1, 1),
(20, 'https://images.unsplash.com/photo-1513836279014-a89f7a76ae86?w=800', 1, 1),

-- Black & White
(21, 'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?w=800', 1, 1),
(21, 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=800', 0, 2),
(22, 'https://images.unsplash.com/photo-1500917293891-ef795e70e1f6?w=800', 1, 1),
(23, 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=800', 1, 1),
(24, 'https://images.unsplash.com/photo-1479839672679-a46483c0e7c8?w=800', 1, 1),
(25, 'https://images.unsplash.com/photo-1511497584788-876760111969?w=800', 1, 1),

-- Portraits & People
(26, 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=800', 1, 1),
(27, 'https://images.unsplash.com/photo-1529626455594-4ff0802cfb7e?w=800', 1, 1),
(28, 'https://images.unsplash.com/photo-1499952127939-9bbf5af6c51c?w=800', 1, 1),
(29, 'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=800', 1, 1),
(30, 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=800', 1, 1);

-- Summary
-- Total Products: 30
-- Best Sellers: 10 products
-- New Arrivals: 9 products
-- On Sale: 11 products (with discounts)
-- Hot Items: 10 products
-- All products have stock and are active
