# Laravel Task Manager Application

A modern, readable, and robust Task Management Web Application built with **Laravel 13** and **PHP 8.3**. Designed and implemented following clean Laravel conventions, this application provides full task lifecycle management, dynamic drag-and-drop task reordering, project filtering, and custom input validation.

---

## Requirements & Features Compliance

* **Task Management (CRUD):** Create, edit, update, and delete tasks seamlessly with persistent storage in MySQL.
* **Drag-and-Drop Reordering:** Drag tasks in the browser using the local [`sortable.min.js`](https://cdn.jsdelivr.net/npm/sortablejs@1.15.6/Sortable.min.js) library (see also [SortableJS Live Demos](https://sortablejs.github.io/Sortable/)) to adjust priorities in real-time (#1 priority at the top, #2 next down, etc.) via asynchronous AJAX updates.
* **Smart Drag Guarding:** Built-in checks prevent unnecessary network requests and database updates if a task is clicked or dropped without a position change.
* **Bonus Feature — Project Functionality:** Filter tasks dynamically by selecting a project from the dropdown list. The interface highlights matching project tasks while maintaining real-time updates.
* **Input Validation:** Enforces clean input rules, requiring at least 6 alphabetic characters for task names (ignoring spaces and special characters).
* **Self-Contained Asset Delivery:** Bundled with local JS assets for offline support, coupled with Laravel Vite for development and production build workflows.

---

## Environment & Tech Stack

This project strictly meets and exceeds the system requirements:

* **Framework:** Laravel `13.37.0` (Min. v11 requirement met)
* **Language:** PHP `8.3.35` (Min. v8.3 requirement met)
* **Package Manager:** Composer `2.9.2`
* **Database:** MySQL
* **Frontend:** Blade Templating, Vanilla JavaScript (ES6+), SortableJS, Vite
* **Asset Bundling:** Vite / Local JavaScript Hosting

---

## Project Structure Overview

```
├── public/
│   ├── js/
│   │   └── Sortable.min.js              # Self-hosted SortableJS library
│   ├── .htaccess
│   ├── favicon.ico
│   ├── fonts-manifest.dev.json
│   └── index.php
├── resources/
│   ├── css/
│   │   └── app.css                      # Custom application styling
│   ├── js/
│   │   └── app.js                       # Drag & drop logic & project filtering
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php            # Main application layout template
│       └── tasks/
│           ├── edit_create.blade.php    # Shared task creation & edit form view
│           ├── index.blade.php          # Main task list & priority management view
│           └── welcome.blade.php        # Welcome/landing page view
└── routes/
    ├── console.php                      # Console commands configuration
    └── web.php                          # Web routes & AJAX endpoints

```

---

## Setup & Installation Guide

Follow these steps to set up and run the web application locally.

### Prerequisites

* **PHP:** `^8.3`
* **Composer:** `^2.x`
* **Node.js & NPM:** `^18.x` or `^20.x`
* **MySQL Database Server**

---

### Step-by-Step Setup

1. **Clone & Navigate to the Repository**
   ```bash
   git clone https://github.com/ErnestKekeke/laravel.git
   cd task_manager
   ```

2. **Install PHP Dependencies**
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   Duplicate `.env.example` to create your `.env` configuration file:
   ```bash
   cp .env.example .env
   ```

   Generate a new application encryption key:
   ```bash
   php artisan key:generate
   ```

5. **Database Configuration**
   Ensure your local MySQL server is running, create a database named `task_manager`, and configure your `.env` settings accordingly:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_manager
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Run Database Migrations**
   Execute database migrations to set up the necessary tables:
   ```bash
   php artisan migrate
   ```

7. **Compile Frontend Assets**
   * **Development Mode (with Hot Module Replacement):**
     ```bash
     npm run dev
     ```
   * **Production Build:**
     ```bash
     npm run build
     ```

8. **Serve the Application**
   Launch Laravel's development server:
   ```bash
   php artisan serve
   ```
   Open your browser and navigate to `http://127.0.0.1:8000`.

---

## License

This project is open-sourced under the [MIT License](LICENSE).

---

## Author

**Ernest Kekeke**  
*Senior Full-Stack Developer / DevOps Engineer*