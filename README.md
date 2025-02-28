# Tohoney - Laravel E-Commerce Platform

## Overview

Tohoney is a feature-rich e-commerce platform built with Laravel, offering a seamless online shopping experience. It includes user authentication, product management, order processing, and a dynamic shopping cart.

## Core Functionalities:

### Secure User Login and Registration with Password Hashing:

Users can securely log in and register with encrypted passwords.

### Role-Based Access Control:

Two roles: ADMIN and NON-ADMIN. Different access levels for each role.

### Admin User Management:

Admins can view the list of users.

### Product Management:

Admins can add, edit, delete, and categorize products.

### Shopping Cart & Checkout:

Customers can add items to the cart and proceed to checkout.

### Order Management:

Admins can view, update, and process orders.

### Payment Gateway Integration:

Supports online transactions.

### Dashboard & Analytics:

Admin dashboard with sales and order tracking.

### Email Notifications:

Sends order confirmation and status updates.

## Installation

### Prerequisites

Ensure you have the following installed:

- PHP 8+
- MySQL
- Laravel 9+
- Composer
- Web Server (Apache)

### Steps to Setup

1. **Clone the Repository:**

    ```bash
    git clone https://github.com/your-repository/tohoney.git
    cd tohoney
    ```

2. **Install Dependencies:**

    ```bash
    composer install
    ```

3. **Create a .env File:**

    ```bash
    cp .env.example .env
    ```

4. **Configure database credentials in .env:**

    ```env
    DB_DATABASE=tohoney_db
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Generate Application Key:**

    ```bash
    php artisan key:generate
    ```

6. **Run Database Migrations & Seeders:**

    ```bash
    php artisan migrate --seed
    ```

7. **Run the Development Server:**

    ```bash
    php artisan serve
    ```

### Access the Application:
Open your browser and go to `http://127.0.0.1:8000/`

## Project Structure

Tohoney/ │-- app/ # Controllers, Models, Middleware │-- bootstrap/ # Laravel bootstrapping files │-- config/ # Configuration files │-- database/ # Migrations, Seeders, and Factories │-- public/ # Frontend assets (CSS, JS, Images) │-- resources/ # Views, Blade templates │-- routes/ # Web and API routes │-- storage/ # Logs, Cache, and Uploaded Files │-- tests/ # PHPUnit Test Cases │-- .env.example # Example environment configuration │-- composer.json # PHP dependencies │-- README.md # Project 

