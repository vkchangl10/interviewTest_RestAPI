# Laravel 11 Secure API - interviewTest_RestAPI

This project is a RESTful API built using Laravel 11 with authentication powered by Laravel Sanctum. It includes user registration, login, and secure transaction management.

## 🚀 Features

- ✅ User authentication (Register & Login)
- 🔑 API token authentication using Laravel Sanctum
- 💰 Transaction management (CRUD operations)
- 🔒 Authorization to restrict users to their own transactions
- 🛡️ Secure API with middleware protection

---

## 📌 Requirements

Ensure your system has the following installed:

- 🖥️ **PHP** 8.1 or higher  
- 📦 **Composer**  
- 🗄️ **MySQL** or **PostgreSQL** database  
- 🚀 **Laravel 11**  
- 🛠️ **Postman** or **cURL** (for API testing)  

---

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository

```sh
git clone https://github.com/your-repo/interviewTest_RestAPI.git
cd interviewTest_RestAPI
```

### 2️⃣ Install Dependencies

```sh
composer install
```

### 3️⃣ Create `.env` File

```sh
cp .env.example .env
```

Open `.env` and update database credentials:

```ini
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4️⃣ Generate Application Key

```sh
php artisan key:generate
```

### 5️⃣ Run Migrations

```sh
php artisan migrate
```

### 6️⃣ Install & Configure Laravel Sanctum

```sh
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Add Sanctum middleware in `app/Http/Kernel.php` (if not already present):

```php
'api' => [
    \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
    \Illuminate\Routing\Middleware\SubstituteBindings::class,
],
```

### 7️⃣ Run the Application

```sh
php artisan serve
```

Your API will be available at:

```sh
http://127.0.0.1:8000
```

---

## 🔐 API Endpoints

Use Postman or cURL to test these endpoints.

### 🔸 User Authentication

| Method | Endpoint       | Description            |
|--------|--------------|------------------------|
| `POST` | `/api/register` | Register a new user   |
| `POST` | `/api/login`    | Login & get API token |

### 🔸 Transaction Management

| Method  | Endpoint                 | Description                          |
|---------|--------------------------|--------------------------------------|
| `POST`  | `/api/user/transactions/store`      | Create a new transaction            |
| `GET`   | `/api/user/transactions/list`      | Get all transactions (for logged-in user) |
| `GET`   | `/api/user/details/{id}` | Get a single transaction            |

> **🔒 Note:** All transaction routes require authentication.

---


## 💬 Support

For any issues or questions, feel free to open an issue or reach out +91-7733844020!
