-- Update product slugs for products that don't have them
-- This script generates slugs from product names

UPDATE products 
SET product_slug = LOWER(
    TRIM(
        REPLACE(
            REPLACE(
                REPLACE(
                    REPLACE(
                        REPLACE(
                            REPLACE(
                                REPLACE(
                                    REPLACE(
                                        REPLACE(
                                            REPLACE(product_name, ' ', '-'),
                                        '&', 'and'),
                                    '/', '-'),
                                ',', ''),
                            '.', ''),
                        '!', ''),
                    '?', ''),
                "'", ''),
            '"', ''),
        '--', '-')
    )
)
WHERE product_slug IS NULL OR product_slug = '';

-- Verify the update
SELECT product_id, product_name, product_slug FROM products LIMIT 10;
