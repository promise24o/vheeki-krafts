# Database Seeds and Migrations

## Product Seed File

### Overview
The `seed_products.sql` file contains 30 curated artwork products across 6 categories, perfect for showcasing Vheeki Krafts' photography and visual art collection.

### Product Distribution

#### Categories (Updated from default):
1. **Abstract Art** (5 products) - Bold compositions and fluid art
2. **Nature & Landscape** (5 products) - Natural scenes and landscapes
3. **Urban & Architecture** (5 products) - Cityscapes and buildings
4. **Minimalist** (5 products) - Clean, simple designs
5. **Black & White** (5 products) - Timeless monochrome art
6. **Portraits & People** (5 products) - Human expressions and emotions

#### Product Highlights:
- **10 Best Sellers** - Popular items marked for prominence
- **9 New Arrivals** - Fresh additions to the collection
- **11 On Sale** - Discounted products (15-20% off)
- **10 Hot Items** - Trending pieces

### Image Sources
All product images are sourced from **Unsplash** (free to use, no attribution required):
- High-quality professional photography
- Optimized for web display (800px width)
- Direct CDN links for fast loading

### Installation Instructions

#### Option 1: Using phpMyAdmin
1. Open phpMyAdmin
2. Select the `vheeki_krafts` database
3. Click on the **Import** tab
4. Choose `seed_products.sql`
5. Click **Go**

#### Option 2: Using MySQL Command Line
```bash
mysql -u root -p vheeki_krafts < database/seed_products.sql
```

#### Option 3: Using Laragon Terminal
1. Open Laragon
2. Click **Terminal**
3. Run:
```bash
cd c:\laragon\www\vheeki-krafts
mysql -u root vheeki_krafts < database\seed_products.sql
```

### What Gets Created

1. **Categories Updated**: Existing 6 categories renamed to artwork themes
2. **30 Products Inserted**: Complete product details including:
   - Product names and descriptions
   - SKUs (unique identifiers)
   - Pricing (₦30,000 - ₦52,000)
   - Discount pricing where applicable
   - Available sizes (12x16" to 30x40")
   - Color schemes
   - Tags for filtering
   - Stock quantities (10-30 units each)
   - Highlight flags (Best Seller, New, Sale, Hot)

3. **Product Images**: 35+ images linked from Unsplash CDN

### Price Range
- **Minimum**: ₦28,000 (discounted)
- **Maximum**: ₦52,000
- **Average**: ~₦42,000

### After Running the Seed

Visit your admin panel to:
1. Review all products at `/admin/products`
2. Adjust prices if needed
3. Update descriptions to match your brand voice
4. Add more product images if desired
5. Generate QR codes for products

### Notes
- All products are set to `is_active = 1` (visible on frontend)
- Stock quantities are realistic (10-30 units)
- Images are hosted on Unsplash CDN (no local storage needed)
- You can replace Unsplash URLs with your own images later

### Contact Messages Table
Don't forget to also run:
```sql
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `read_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `is_read` (`is_read`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

---

**Created for Vheeki Krafts** - Transforming moments into timeless art 🎨
