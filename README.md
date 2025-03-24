# Task Manager App

## 📌 Introduction

This is a **Task Manager Application** built with **Laravel 12** and uses **TailwindCSS** for frontend views. It includes authentication, task management with CRUD operations, role-based access, and a task activity log.

---

## 🚀 Getting Started

Follow these steps to set up and run the project on your local machine.

### **1️⃣ Clone the Repository**

```bash
# Using HTTPS
git clone https://github.com/your-username/task-manager-app.git

# OR Using SSH
git clone git@github.com:your-username/task-manager-app.git

cd task-manager-app
```

### **2️⃣ Install Dependencies**

```bash
composer install
```

### **3️⃣ Set Up Environment Variables**

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Now, update the following database credentials in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=sail
DB_PASSWORD=password
```

---

## 🐳 Running Laravel with Sail

This project uses **Laravel Sail** for containerized development.

### **4️⃣ Start Sail (Docker Containers)**

```bash
./vendor/bin/sail up -d
```

If this is your first time using Sail, ensure Docker is running before executing the command.

### **5️⃣ Run Database Migrations & Seeders**

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

This will **reset the database**, create tables, and seed initial data.

### **6️⃣ Generate Application Key**

```bash
./vendor/bin/sail artisan key:generate
```

### **7️⃣ Run the Application**

Now, you can serve the application:

```bash
./vendor/bin/sail artisan serve
```

Access the app in your browser at:\
👉 `http://localhost`

---

## ✉️ Setting Up MailPit for Email Testing

This project uses **MailPit** to catch and view emails sent by the application.

### **8️⃣ Start MailPit**

MailPit is already configured in `docker-compose.yml`. Run it using:

```bash
./vendor/bin/sail up -d mailpit
```

Then, access the MailPit UI at:\
👉 `http://localhost:8025`

### **9️⃣ Run the Queue Worker**

Laravel queues email jobs for sending. To process emails and see them in MailPit, run:

```bash
./vendor/bin/sail artisan queue:work
```

Now, when an email is triggered (e.g., user verification or password reset), it will appear in MailPit.

---

## 🔑 Authentication

- **Login Page**: `/login`
- **Admin Dashboard**: `/admin`
- **Task Management**: `/tasks`

---

## 🛠 Common Issues & Fixes

### **1. MySQL Access Denied**

If you see **"Access denied for user 'sail'@'%"**, reset the MySQL password:

```bash
./vendor/bin/sail shell
mysql -u root -p
```

Inside MySQL, run:

```sql
ALTER USER 'sail'@'%' IDENTIFIED WITH mysql_native_password BY 'password';
FLUSH PRIVILEGES;
EXIT;
```

Then restart Sail:

```bash
./vendor/bin/sail down && ./vendor/bin/sail up -d
```

### **2. Table Already Exists Error**

If you get `SQLSTATE[42S01]: Base table or view already exists`, drop and recreate the database:

```bash
./vendor/bin/sail mysql -u sail -p
```

Then run:

```sql
DROP DATABASE task_manager;
CREATE DATABASE task_manager;
EXIT;
```

And rerun migrations:

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

### **3. Laravel Testing (Fix 302 Redirects)**

Some tests may fail due to authentication redirects. To fix, ensure you’re logging in users properly within tests:

```php
$response = $this->actingAs($user)->get('/tasks');
$response->assertStatus(200);
```

Run tests:

```bash
./vendor/bin/sail artisan test
```

---

## 🛠 API Endpoints

This project includes a **REST API** for task management:

### **🔐 Authentication**

| Method | Endpoint    | Description |
| ------ | ----------- | ----------- |
| POST   | /api/login  | User Login  |
| POST   | /api/logout | Logout User |

### **📝 Task Management**

| Method | Endpoint        | Description         |
| ------ | --------------- | ------------------- |
| GET    | /api/tasks      | Get all tasks       |
| POST   | /api/tasks      | Create a new task   |
| PUT    | /api/tasks/{id} | Update task details |
| DELETE | /api/tasks/{id} | Delete a task       |

Use Postman or any API client to interact with the endpoints.

---

## 🎯 Conclusion

Your Laravel Task Manager is now set up and running! 🚀
For any issues, check the Laravel logs:

If you don't want to run artisan queue:work, check the laravel logs for the verify email link.

```bash
./vendor/bin/sail artisan logs
```

Happy coding! 🎉



I hope you have enjoyed the results! 🎉

