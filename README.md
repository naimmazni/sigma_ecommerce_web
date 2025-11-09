# Sigma Shop - E-commerce Website

A modern, full-featured e-commerce platform built with Laravel 12, featuring a responsive design, admin dashboard, and comprehensive shopping experience.

## 🚀 Features

### Customer Features

-   **User Authentication**: Registration, login, password reset
-   **Product Browsing**: Browse products with search and filtering
-   **Shopping Cart**: Add, update, and remove items
-   **Order Management**: Place orders and track order status
-   **User Profile**: Manage personal information and view order history
-   **Contact Form**: Send inquiries with clickable contact information

### Admin Features

-   **Dashboard**: Overview of sales, orders, and products
-   **Product Management**: Create, edit, and manage products with featured status
-   **Order Management**: View and update order statuses
-   **Contact Management**: Handle customer inquiries
-   **User Management**: Monitor customer accounts

### Technical Features

-   **Responsive Design**: Mobile-first approach with Tailwind CSS
-   **Real-time Updates**: Dynamic cart and order status updates
-   **File Upload**: Product image management
-   **Database Seeding**: Sample data for testing
-   **Security**: CSRF protection, input validation, and authentication

## 🛠️ Technology Stack

-   **Backend**: Laravel 12 (PHP 8.2+)
-   **Frontend**: Blade templates with Tailwind CSS
-   **Database**: MySQL
-   **Authentication**: Laravel's built-in authentication
-   **Icons**: Font Awesome
-   **Development**: XAMPP, Composer, Node.js

## 📋 Prerequisites

-   XAMPP installed and running (Apache & MySQL)
-   Composer installed
-   Node.js and npm installed
-   VS Code (recommended) or any code editor

## 🚀 Installation & Setup

### 1. Project Setup

```bash
# Download and extract the project
# Place sigma_ecommerce_web folder in C:\xampp\htdocs\dashboard
```

### 2. Database Configuration

```bash
# Open http://localhost/phpmyadmin
# Create a new database called 'sigma_ecommerce_web'
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Update .env file with your database settings:
APP_NAME='Sigma Shop'
DB_DATABASE=sigma_ecommerce_web
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 5. Application Setup

```bash
# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Create storage link for file uploads
php artisan storage:link
```

### 6. Build Frontend Assets

```bash
# Build for production
npm run build

# Or for development
npm run dev
```

### 7. Start the Application

```bash
# Start Laravel development server
php artisan serve
```

## 👤 Default Login Credentials

### Admin Account

-   **Email**: admin@sigma.com
-   **Password**: admin123

### Customer Account

-   **Email**: test@example.com
-   **Password**: password123

## 🔧 Key Features Explained

### Contact Page

-   Interactive contact form with validation
-   Clickable contact information (address, phone, email)
-   Address opens Google Maps
-   Phone number uses tel: protocol
-   Email uses mailto: protocol

### Shopping Cart

-   Persistent cart functionality
-   Real-time quantity updates
-   Remove items functionality
-   Checkout process

### Admin Dashboard

-   Product management with CRUD operations
-   Order tracking and status updates
-   Contact inquiry management
-   Featured product toggling

## 🎨 Customization

### Styling

-   Uses Tailwind CSS for styling
-   Custom CSS in `resources/css/app.css`
-   Responsive design for all screen sizes

### Database

-   Easy to modify database structure via migrations
-   Sample data provided via seeders
-   Easy to add new features

## 🐛 Troubleshooting

### Common Issues

1. **Composer install fails**: Ensure PHP 8.2+ is installed
2. **Database connection error**: Check XAMPP MySQL service is running
3. **Storage link error**: Run `php artisan storage:link` again
4. **Permission errors**: Ensure proper file permissions on storage directory

### Development Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Regenerate autoload files
composer dump-autoload

# Run tests
php artisan test
```

## 📝 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Commit your changes
4. Push to the branch
5. Create a Pull Request

## 📞 Support

For support and questions, please contact:

-   **Email**: info@sigmashop.com
-   **Phone**: +60 12-345 6789
-   **Address**: 123 Sigma Street, Kuala Lumpur, Malaysia

---

**Happy Coding! 🎉**
