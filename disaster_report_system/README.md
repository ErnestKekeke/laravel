# Author: ERNEST KEKEKE
The Author of this project is Ernest Kekeke.
more about the author visit: https://www.youtube.com/@ernestKekeke
github: https://github.com/ErnestKekeke/

# Edo State Disaster Management System

A web-based disaster reporting and management system designed to facilitate efficient disaster reporting, management, and response coordination in Edo State, Nigeria.

## Overview

This system enables citizens to report disasters and emergencies in real-time while providing administrators with tools to manage, track, and respond to these reports effectively.

## Features

### Public Features
- **Disaster Report Submission** - Citizens can report emergencies with detailed information
- **Multiple Disaster Types** - Support for Floods, Fires, Accidents, Building Collapse, Erosion, and Medical Emergencies
- **Severity Levels** - Reports can be classified as Low, Medium, High, or Critical
- **Emergency Contacts** - Quick access to emergency service numbers

### Admin Features
- **Dashboard Statistics** - Overview of total, pending, resolved, and critical reports
- **Report Management** - View all disaster reports in detail
- **Status Updates** - Change report status (Pending, In Progress, Resolved)
- **Real-time Tracking** - Monitor all disaster reports with timestamps

## Technology Stack

- **Backend:** PHP (Laravel Framework)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript
- **Architecture:** MVC (Model-View-Controller)

## System Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Laravel 10.x
- Web Server (Apache/Nginx)

## Installation

### 1. Clone or Create Project

```bash
composer create-project laravel/laravel disaster_report_system
cd disaster_report_system
```

### 2. Configure Environment

Copy `.env.example` to `.env` and update database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=disaster_report_system
DB_USERNAME=root
DB_PASSWORD=your_password

CACHE_DRIVER=file
SESSION_DRIVER=file
```

### 3. Create Database

```sql
CREATE DATABASE disaster_report_system;
```

### 4. Install Dependencies

```bash
composer install
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Seed Database

```bash
php artisan db:seed
```

This creates:
- Admin and test user accounts
- Default disaster types (Flood, Fire, Accident, etc.)

### 7. Start Development Server

```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Project Structure

```
disaster_report_system/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php
│   │   └── AdminController.php
│   └── Models/
│       ├── User.php
│       ├── DisasterType.php
│       └── DisasterReport.php
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_users_table.php
│   │   ├── xxxx_create_disaster_types_table.php
│   │   └── xxxx_create_disaster_reports_table.php
│   └── seeders/
│       ├── UserSeeder.php
│       ├── DisasterTypeSeeder.php
│       └── DatabaseSeeder.php
├── public/
│   └── css/
│       ├── home.css
│       └── admin.css
├── resources/
│   └── views/
│       ├── home.blade.php
│       └── admin/
│           └── dashboard.blade.php
└── routes/
    └── web.php
```

## Database Schema

### Users Table
- id, name, email, password, role, timestamps

### Disaster Types Table
- id, name, description, timestamps

### Disaster Reports Table
- id, disaster_type_id, reporter_name, reporter_phone, location, description, severity, status, timestamps

## Routes

| Method | URL | Description |
|--------|-----|-------------|
| GET | / | Home page with report form |
| POST | /report | Submit disaster report |
| GET | /admin/dashboard | Admin dashboard |
| POST | /admin/report/{id}/update-status | Update report status |

## Usage

### Reporting a Disaster

1. Visit the home page
2. Select disaster type
3. Enter your name and phone number
4. Provide location details
5. Select severity level
6. Describe the disaster
7. Submit the report

### Managing Reports (Admin)

1. Visit `/admin/dashboard`
2. View all submitted reports
3. Review report details
4. Update status using dropdown menu
5. Track statistics on dashboard

## Default Accounts

The system includes seeded user accounts for testing:

**Admin Account:**
- Email: admin@edodisaster.gov.ng
- Password: password123

**Regular User:**
- Email: user@example.com
- Password: password123

*Note: Authentication is not currently implemented. These accounts are for future use.*

## Future Enhancements

- [ ] User authentication and authorization
- [ ] Email/SMS notifications
- [ ] Image upload for disaster reports
- [ ] Google Maps integration
- [ ] Advanced search and filtering
- [ ] PDF/Excel report export
- [ ] Mobile application
- [ ] Multi-language support

## Contributing

This project is part of an academic case study for Edo State, Nigeria.

## License

This project is open-source and available for educational purposes.

## Contact

For questions or support regarding this system, please contact the development team.

## Acknowledgments

- Edo State Government
- National Emergency Management Agency (NEMA)
- All emergency response teams in Edo State

---

**Project Status:** Development Complete  
**Version:** 1.0.0  
**Last Updated:** January 2026