## SSBS

A simple API-based **Simple Service Booking System** built with Laravel 12 using Sanctum for authentication.

## 📦 Features

- User Registration & Login (Token-based)
- Role-based access (Admin vs Customer)
- Manage Services (Admin only)
- Book Services (Customers)
- View Bookings (Customer & Admin)
- Validation using FormRequest
- Clean code with Repository Pattern
- RESTful APIs

---

## ⚙️ Tech Stack

- Laravel 12
- Sanctum (API Auth)
- MySQL
- Postman (for testing)

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/dev-hasanmahmud/ssbs.git
cd ssbs
composer install
cp .env.example .env
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=booking_db
- DB_USERNAME=root
- DB_PASSWORD=your_mysql_password
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
### 2. Login
	- Email: admin@test.com   Password: password
	- Email: customer@test.com   Password: password


### Testing With Postman
API Endpoints	                   					   Method	Access
- http://localhost:8000/api/register					POST	Public
- http://localhost:8000/api/login						POST	Public
- http://localhost:8000/api/services					GET		Customer
- http://localhost:8000/api/bookings					POST	Customer
- http://localhost:8000/api/bookings					GET		Customer
- http://localhost:8000/api/services					POST	Admin only
- http://localhost:8000/api/services/{id}				PUT		Admin only
- http://localhost:8000/api/services/{id}				DELETE	Admin only
- http://localhost:8000/api/admin/bookings				GET		Admin only
