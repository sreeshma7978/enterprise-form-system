Enterprise Dynamic Form Management System

This project is a Laravel-based Enterprise Form Management System that allows admins to dynamically create forms, manage submissions, and expose user data through REST APIs. It includes authentication, role-based access control, dynamic form builder, and submission management.

🚀 Features
🔐 Authentication & Authorization
User Registration and Login using Laravel Breeze
Role-based access control (Admin / User)
Admin middleware protection for secure routes

🧑‍💼 Admin Panel
Admin Dashboard
Manage Forms
Manage Users
View Submissions

🧾 Dynamic Form Builder
Create dynamic forms with custom title and status
Support for multiple field types:
Text
Email
Number
Date
Dropdown
Checkbox
Dynamic field options builder
Store form structure as JSON in database

✅ Form Submission System
Users can submit dynamic forms
Dynamic validation based on form structure
Admin can view and delete submissions
Pagination support for large datasets

🔗 REST API Layer

Provides structured JSON APIs for external integrations.

Endpoints:
GET /api/users
GET /api/users?page=1
Response Format:
{
  "status": true,
  "message": "Users fetched successfully",
  "data": [],
  "pagination": {
    "current_page": 1,
    "total": 50
  }
}

🛠️ Tech Stack
PHP 8.3+
Laravel 13+
MySQL
Laravel Breeze (Authentication)
Blade + Tailwind CSS
JavaScript (Dynamic Form Builder)
REST API (JSON)

👤 User Roles
Role	Permissions
Admin	Full access to forms, users, submissions
User	Can submit forms only

⚙️ Installation
Step 1: Clone Repository
git clone https://github.com/sreeshma7978/enterprise-form-system.git
cd form-system
Step 2: Install Dependencies
composer install
npm install
Step 3: Environment Setup
cp .env.example .env
php artisan key:generate
Step 4: Configure Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=form_system
DB_USERNAME=root
DB_PASSWORD=
Step 5: Run Migrations
php artisan migrate --seed
Step 6: Start Application
php artisan serve
Step 7: Frontend Build
npm run dev

🔑 Admin Credentials
Email: admin@test.com  
Password: password123  
Role: admin

📂 Project Modules
1. Authentication Module
Login / Register / Logout
Role-based access control
2. Form Builder
Dynamic form creation
JSON-based field storage
3. Submission Module
Store user submissions
Admin view & delete

🔒 Security Features
Admin middleware protection
CSRF protection enabled
Input validation using FormRequest
Role-based access control

🚀 Future Enhancements
Laravel Policies for advanced authorization
Vue.js / React form builder UI
File upload fields in forms
API authentication using Sanctum
WordPress frontend integration
Email notifications for submissions
Import & Export Module
