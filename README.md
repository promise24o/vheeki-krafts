# Vheeki Krafts - Ecommerce Platform

A comprehensive CMS-based ecommerce platform for artworks and crafts built with CodeIgniter 3, featuring a complete admin panel, shopping cart, order management, and order tracking system.

![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-orange)
![PHP](https://img.shields.io/badge/PHP-7.4+-blue)
![MySQL](https://img.shields.io/badge/MySQL-5.7+-blue)
![License](https://img.shields.io/badge/license-MIT-green)

## 🎯 Features

### Admin Panel
- **Product Management**
  - Add, edit, delete products
  - Multiple product images with primary image selection
  - Product variations (size, color)
  - Stock management
  - Discount pricing
  - Product highlights (Best Seller, New Arrivals, Sale, Hot Items)
  - QR code generation per product
  - Bulk CSV upload

- **Order Management**
  - View all orders with statistics
  - Order details with customer information
  - Order status management (pending, processing, shipped, delivered, cancelled)
  - Payment status tracking
  - Print invoices
  - Order tracking system with logs
  - Generate tracking numbers

- **Category Management**
  - Create and manage product categories
  - Category images and descriptions

- **Review Moderation**
  - Approve/reject customer reviews
  - View ratings and feedback

- **Content Management**
  - Landing page customization
  - Banner management
  - Promotional sections
  - Contact information management

- **Settings**
  - Site settings configuration
  - Paystack payment integration
  - Email configuration

### Frontend Store
- **Shopping Experience**
  - Beautiful product catalog
  - Advanced product filtering (categories, price, size, color, tags, highlights)
  - Product search functionality
  - Product details with image gallery
  - Customer reviews and ratings
  - QR code display per product

- **Shopping Cart**
  - Add to cart functionality
  - Cart management (update quantity, remove items)
  - Real-time cart count updates
  - Offcanvas cart sidebar

- **Checkout & Payment**
  - Secure checkout process
  - Paystack payment integration
  - Order confirmation
  - Email notifications

- **Order Tracking**
  - Public order tracking page
  - Track by order number or tracking number
  - Visual timeline of order status
  - Real-time updates

- **Additional Pages**
  - About Us
  - Contact Form
  - Custom landing pages

## 🚀 Installation

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (optional)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/vheeki-krafts.git
   cd vheeki-krafts
   ```

2. **Configure Database**
   - Create a MySQL database named `vheeki_krafts`
   - Import the database schema:
     ```bash
     mysql -u root -p vheeki_krafts < database_schema.sql
     ```
   - Import order tracking logs table:
     ```bash
     mysql -u root -p vheeki_krafts < database/order_tracking_logs.sql
     ```

3. **Configure Application**
   - Copy `application/config/database.php` and update your database credentials:
     ```php
     'hostname' => 'localhost',
     'username' => 'your_username',
     'password' => 'your_password',
     'database' => 'vheeki_krafts',
     ```
   - Update `application/config/config.php`:
     ```php
     $config['base_url'] = 'http://localhost/vheeki-krafts/';
     ```

4. **Set Permissions**
   ```bash
   chmod -R 755 application/cache
   chmod -R 755 application/logs
   chmod -R 755 uploads
   ```

5. **Access the Application**
   - Frontend: `http://localhost/vheeki-krafts/`
   - Admin Panel: `http://localhost/vheeki-krafts/admin`
   - Default Admin Credentials:
     - Username: `admin`
     - Password: `admin123` (Change this immediately!)

## 📁 Project Structure

```
vheeki-krafts/
├── application/
│   ├── controllers/
│   │   ├── Admin.php          # Admin panel controller
│   │   ├── Auth.php            # Authentication
│   │   └── Landing.php         # Frontend controller
│   ├── models/
│   │   ├── Crud_model.php      # Main database operations
│   │   └── Email_model.php     # Email functionality
│   ├── views/
│   │   ├── Admin/              # Admin panel views
│   │   ├── Landing/            # Frontend views
│   │   └── Components/         # Reusable components
│   └── config/
│       ├── database.php        # Database configuration
│       ├── config.php          # App configuration
│       └── routes.php          # URL routing
├── assets/
│   ├── admin/                  # Admin panel assets
│   └── landing/                # Frontend assets
├── database/
│   ├── database_schema.sql     # Main database schema
│   ├── order_tracking_logs.sql # Tracking system schema
│   └── cart_orders_schema.sql  # Cart & orders schema
├── uploads/                    # Product images
├── .gitignore
└── README.md
```

## 🔧 Configuration

### Paystack Payment Setup
1. Go to Admin Panel → Settings
2. Add your Paystack keys:
   - `paystack_public_key`: Your Paystack public key
   - `paystack_secret_key`: Your Paystack secret key
3. Test mode keys start with `pk_test_` and `sk_test_`

### Email Configuration
Configure SMTP settings in `application/config/email.php` for order notifications.

## 📊 Database Tables

- `products` - Product information
- `product_images` - Product image gallery
- `categories` - Product categories
- `orders` - Customer orders
- `order_items` - Order line items
- `order_tracking_logs` - Order tracking history
- `cart_items` - Shopping cart items
- `reviews` - Product reviews
- `site_settings` - Application settings
- `contact_messages` - Contact form submissions

## 🎨 Key Features Explained

### Order Tracking System
- Unique tracking numbers (Format: `VK-TRACK-YYYYMMDD-XXXX`)
- Public tracking page at `/track-order`
- Admin can add custom tracking logs
- Automatic logging on status changes
- Visual timeline display

### Product Management
- Multiple images per product
- Primary image selection
- Product variations (size, color)
- Highlight toggles for featured products
- QR code generation for each product
- Bulk CSV import

### Shopping Cart
- Session-based cart for guests
- Real-time cart updates
- Quantity management
- Stock validation

## 🔐 Security Notes

**IMPORTANT:** Before deploying to production:

1. Change default admin credentials
2. Update database credentials
3. Set strong encryption keys in `config.php`
4. Enable CSRF protection
5. Use HTTPS for payment processing
6. Secure file upload directories
7. Keep CodeIgniter and dependencies updated

## 📱 Responsive Design

The platform is fully responsive and works on:
- Desktop browsers
- Tablets
- Mobile devices

## 🛠️ Technologies Used

- **Backend:** CodeIgniter 3 (PHP Framework)
- **Database:** MySQL
- **Frontend:** Bootstrap 5, jQuery
- **Payment:** Paystack API
- **Icons:** Tabler Icons, Font Awesome
- **Notifications:** Toastr

## 📝 API Endpoints

### Public APIs
- `GET /track-order` - Order tracking page
- `POST /cart/add` - Add to cart
- `POST /cart/update` - Update cart
- `POST /cart/remove` - Remove from cart
- `POST /checkout/process` - Process checkout

### Admin APIs (Authentication Required)
- `GET /admin/orders` - List orders
- `GET /admin/view_order/{id}` - View order details
- `POST /admin/update_order_status` - Update order status
- `POST /admin/add_tracking_log` - Add tracking log
- `POST /admin/generate_tracking_number` - Generate tracking number

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 👨‍💻 Author

**Vheeki Krafts Development Team**

## 🙏 Acknowledgments

- CodeIgniter Framework
- Bootstrap Team
- Paystack Payment Gateway
- All contributors and testers

## 📞 Support

For support, email support@vheekikrafts.com or create an issue in the repository.

## 🗺️ Roadmap

- [ ] Email notifications for order updates
- [ ] Customer accounts and order history
- [ ] Wishlist functionality
- [ ] Product comparison
- [ ] Advanced analytics dashboard
- [ ] Multi-language support
- [ ] Mobile app (React Native)

---

**Made with ❤️ for artisans and craft makers**
