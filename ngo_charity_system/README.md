# Author: ERNEST KEKEKE
The Author of this project is Ernest Kekeke.
more about the author visit: https://www.youtube.com/@ernestKekeke
github: https://github.com/ErnestKekeke/

# Online Charity Management System

A simple Laravel-based charity management system for Nigerian NGOs. This project demonstrates transparency, donor engagement, and project tracking capabilities.

## Project Overview

This system was developed as part of a research study on "Online Charity Management Systems: A case study of a Non-Governmental Organization in Nigeria."

### Key Features

- **Home Page**: Displays active projects, donation statistics, and impact metrics
- **Donation System**: Simulated donation processing (for development purposes only)
- **Dashboard**: Real-time view of donations, project progress, and beneficiary data
- **Transparency**: Clear tracking of funds and project outcomes

## Requirements

- PHP 8.1 or higher
- Composer
- MySQL 5.7 or higher
- Laravel 10.x

## Installation

### 1. Clone or Download the Project

```bash
cd charity-management
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Configure your database in the `.env` file:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=charity_management
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Create Database

Create a MySQL database named `charity_management` (or whatever you specified in `.env`).

### 6. Create Models and Migrations

```bash
php artisan make:model Donor -m
php artisan make:model Project -m
php artisan make:model Donation -m
php artisan make:model Beneficiary -m
```

Copy the provided model and migration code into the generated files.

### 7. Run Migrations

```bash
php artisan migrate
```

### 8. Create and Run Seeder

```bash
php artisan make:seeder CharitySeeder
```

Copy the provided seeder code, then run:

```bash
php artisan db:seed --class=CharitySeeder
```

### 9. Start the Development Server

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser.

## Project Structure

```
charity-management/
├── app/
│   ├── Http/Controllers/
│   │   └── CharityController.php
│   └── Models/
│       ├── Donor.php
│       ├── Project.php
│       ├── Donation.php
│       └── Beneficiary.php
├── database/
│   ├── migrations/
│   │   ├── create_donors_table.php
│   │   ├── create_projects_table.php
│   │   ├── create_donations_table.php
│   │   └── create_beneficiaries_table.php
│   └── seeders/
│       └── CharitySeeder.php
├── public/
│   └── css/
│       └── style.css
├── resources/
│   └── views/
│       ├── home.blade.php
│       ├── donate.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## Database Tables

### 1. Donors
Stores donor information (name, email, phone).

### 2. Projects
Manages charity projects with target and raised amounts.

### 3. Donations
Records all donations with payment details and status.

### 4. Beneficiaries
Tracks individuals or communities assisted by projects.

## Usage

### Navigation

- **Home**: View active projects and organization statistics
- **Donate**: Make simulated donations to projects
- **Dashboard**: Administrative view of all donations and project progress

### Making a Donation (Simulated)

1. Click "Donate" or "Make a Donation"
2. Fill in donor details
3. Select a project
4. Enter donation amount (minimum ₦100)
5. Choose payment method
6. Submit (payment is automatically marked as completed for development)

### Viewing Dashboard

Access the dashboard at `/dashboard` to see:
- Total donors, donations, and beneficiaries
- Recent donation history
- Project progress bars
- Financial transparency metrics

## Important Notes

⚠️ **This is a development system**:
- No actual payment processing is implemented
- All donations are automatically marked as "completed"
- Not intended for production use without proper payment gateway integration

## Research Context

This project addresses key challenges faced by Nigerian NGOs:
- Poor financial transparency
- Manual record-keeping vulnerabilities
- Limited donor engagement
- Weak accountability systems

The system demonstrates how digital solutions can improve:
- Donor trust through transparent reporting
- Operational efficiency via automated tracking
- Real-time project monitoring
- Stakeholder collaboration

## Future Enhancements

- Integration with real payment gateways (Paystack, Flutterwave)
- User authentication and role-based access
- Email notifications for donors
- Advanced reporting and analytics
- Mobile application
- Multi-currency support

## License

This project is developed for educational and research purposes.

## Author

Developed as part of a research study on NGO management systems in Nigeria.

## Support

For questions or issues related to this project, please refer to the research documentation or contact the project supervisor.