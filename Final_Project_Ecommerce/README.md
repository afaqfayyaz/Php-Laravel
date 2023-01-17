## Laravel Ecommerce 
# Introduction 
It’s a REST API-based small eCommerce system that has categories, products, and orders. Each of them is implemented with proper relation it also has complete Authentification like email verification, password forgot, and reset using email. It also has Admin and user roles; users can only see and read the thing. user is unable to perform create delete and update. Unlike the user, the admin can do anything.
# Features
    User 
    Admin
    Factories & Seeder.
    Email Verification for user and admin.
    Login & Sign Up using Passport(Auth2.0).
    Forgot & reset password using email.
    Product, Order & Category with Proper Relations.
    User can order the any product.
    Each category has different product.

# Requirements

    PHP = 8.0
    laravel = 9.0

# Installation
    Make sure you already install the composer
    composer create-project rahulvijayam/ecommerce 
    Create database for your project with the name as ecommerce
    You also need to install the passport library 
    Now Run php artisan migrate command for creating all the tables
    Every time you run Migrate you need to instal passport as php artisan passport:install
    Add your email credentials in .env file
    
    Start yor project using php artisan serve

## License

>Copyright (C) 2023 AfaqChohan.

    
