# 📘 Laravel Role-Based Permission API

A powerful and scalable Laravel REST API for managing **Users**, **Roles**, **Modules**, and **Permissions**. Designed with best practices for Role-Based Access Control (RBAC), this system supports dynamic permission assignment, modular structure, and clean API formatting using Laravel Resources and Form Requests.

---

## 🔧 Key Features

- ✅ Full CRUD for **Users**, **Roles**, **Modules**, **Posts**, and **Accounts**
- 🔐 Role-based permission system with `create`, `read`, `update`, `delete` actions per module
- 🧠 Dynamic permission checks using `hasPermission(module, action)`
- 🧾 Laravel Form Requests for validation and authorization
- 📦 API Resource classes for consistent, clean response formatting
- 👤 Admin and self-access logic (e.g. users can edit/delete their own profiles)
- 🗂 Modular, scalable project structure

---

## 📁 Folder Structure Overview

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── UserController.php
│   │   ├── RoleController.php
│   │   ├── ModuleController.php
│   │   └── ...
│   ├── Requests/
│   │   ├── User/
│   │   ├── Role/
│   │   ├── Module/
│   │   └── ...
│   └── Resources/
│       ├── User/
│       ├── Role/
│       ├── Module/
│       └── ...
```

---

## 🚀 Getting Started

```bash
# Clone the repository
git clone https://github.com/your-username/laravel-role-based-api.git
cd laravel-role-based-api

# Install dependencies
composer install

# Copy and configure environment
cp .env.example .env
php artisan key:generate

# Run migrations and seed initial data
php artisan migrate --seed

# Start the development server
php artisan serve
```

---

## 🛡️ Role & Permission Logic

- Every **User** is assigned one or more **Roles**
- Each **Role** holds **Permissions** for specific **Modules**
- Permissions support fine-grained control: `create`, `read`, `update`, `delete`
- Permission checks use this helper:
```php
auth()->user()->hasPermission('module_name', 'action');
```

---

## 🔄 Sample API Endpoints

| Method | URI                              | Access Level           | Description                            |
|--------|----------------------------------|------------------------|----------------------------------------|
| GET    | `/api/users`                     | Admin only             | List all users                         |
| GET    | `/api/users/{id}`                | Admin / Self           | Get user details                       |
| POST   | `/api/users`                     | Admin only             | Create a new user                      |
| PUT    | `/api/users/{id}`                | Admin / Self + Perm    | Update user info                       |
| DELETE | `/api/users/{id}`                | Admin / Self           | Delete a user                          |
| GET    | `/api/modules`                   | All roles              | List all modules                       |
| POST   | `/api/users/{user}/assign-role`  | Admin only             | Assign role(s) to a user               |

---

## 🛠 Authorization with FormRequest

```php
public function authorize(): bool
{
    return auth()->user()->hasPermission('account', 'update');
}
```

This ensures centralized, reusable, and testable permission checks.

---

## 📦 Tech Stack

- **PHP** 8.1+
- **Laravel** 10+
- **MySQL** / **SQLite**
- **Laravel Sanctum** or **Passport** (optional for authentication)
- RESTful API architecture
- API Resources + Form Requests for clean design
