Author:
The Author of this project is Ernest Kekeke.
more about the author visit: https://www.youtube.com/@ernestKekeke
github: https://github.com/ErnestKekeke/

# Hepatitis B Patient Management System

A comprehensive web-based system for managing Hepatitis B patient data, designed to help clinics track, monitor, and manage patient records efficiently.

## 📋 Overview

This system addresses the critical need for digitized patient management in regions where Hepatitis B is endemic. It provides clinics with tools to register patients, track laboratory results, monitor treatment progress, and manage vaccination records.

## ✨ Key Features

### For Clinics
- **Secure Authentication** - Clinic ID and registration number-based login
- **Patient Registration** - Comprehensive patient intake with photo upload
- **Patient Management** - View, edit, and manage patient records
- **Laboratory Tracking** - Record and monitor HBV test results (HBsAg, Anti-HBs, viral load, ALT/AST levels)
- **Treatment Monitoring** - Track diagnosis type, treatment status, and vaccination records
- **Appointment Scheduling** - Manage follow-up appointments

### For Patients (Public Site)
- **HBV Awareness** - Educational content about Hepatitis B
- **Testing Information** - Guidance on symptoms, risk factors, and testing
- **Prevention Resources** - Vaccination and prevention information
- **Clinic Finder** - Locate registered testing centers

## 🛠️ Technology Stack

- **Backend:** Laravel 11 (PHP)
- **Frontend:** Blade Templates, CSS3, JavaScript
- **Database:** MySQL
- **Authentication:** Laravel Auth (Custom Clinic Guard)
- **File Storage:** Laravel Storage (patient photos, clinic logos)

## 📁 Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── PatientController.php
│   │   └── ClinicAuthController.php
│   └── Models/
│       ├── Patient.php
│       └── Clinic.php
├── database/migrations/
│   ├── create_clinics_table.php
│   └── create_patients_table.php
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── clinic/
│   │   │   ├── login.blade.php
│   │   │   └── register.blade.php
│   │   └── patients/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       ├── show.blade.php
│   │       └── edit.blade.php
│   ├── css/
│   │   ├── home.css
│   │   ├── clinic/
│   │   └── patients/
│   └── js/
│       ├── patient-form.js
│       └── clinic/
└── public/
    └── images/
        └── default-avatar.png
```

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd hbv-management-system
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database configuration**
   - Update `.env` with your database credentials
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=hbv
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Run migrations**
   ```bash
   php artisan migrate
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Start development server**
   ```bash
   php artisan serve
   npm run dev
   ```

## 📊 Database Schema

### Clinics Table
- Unique 4-character clinic ID
- Clinic details (name, type, registration number)
- Contact information (email, phone, address, location)
- License and accreditation status
- Secure password authentication

### Patients Table
- Auto-generated patient ID (format: CLINIC-YEAR-0001)
- Personal information (name, DOB, gender, photo)
- Contact details (phone, email, address, location)
- Laboratory results (HBsAg, viral load, ALT/AST levels)
- Treatment information (diagnosis, status, medication)
- Vaccination records
- Appointment tracking

## 🔐 Security Features

- Password hashing (bcrypt)
- CSRF protection
- Input validation and sanitization
- Clinic-specific data access (clinics only see their own patients)
- Soft delete for data recovery
- File upload validation (type and size restrictions)

## 🎨 Design Highlights

- **Responsive Design** - Mobile-friendly interface
- **Color-Coded Badges** - Visual status indicators for quick recognition
- **Professional Theme** - Medical-appropriate color schemes
- **Accessible Forms** - Clear labels and error messages
- **Image Fallbacks** - Default avatars when photos unavailable

## 📝 Usage

### Clinic Registration
1. Navigate to `/clinic/register`
2. Upload clinic logo (PNG format)
3. Fill in clinic details and contact information
4. Create secure password
5. Submit registration

### Patient Management
1. Login with clinic credentials
2. Add new patient with comprehensive form
3. View patient list with filtering options
4. Access individual patient details
5. Update laboratory and treatment information
6. Schedule follow-up appointments

## 🌍 Global Coverage

- Country/State/City selection with API integration
- Pre-configured data for Nigeria, Ghana, Kenya, South Africa
- Easily expandable to additional regions

## 📈 Future Enhancements

- [ ] Dashboard with statistics and charts
- [ ] Export patient data (PDF/Excel)
- [ ] SMS/Email appointment reminders
- [ ] Multi-language support
- [ ] Mobile application
- [ ] Advanced reporting and analytics
- [ ] Integration with laboratory systems

## 👥 Target Users

- Healthcare clinics and medical centers
- Diagnostic laboratories
- Public health departments
- Research institutions studying HBV prevalence
- Community health workers

## 📄 License

This project is developed for healthcare management purposes.

## 🤝 Contributing

Contributions are welcome! Please ensure:
- Code follows Laravel best practices
- All forms include proper validation
- Responsive design is maintained
- Patient data privacy is respected

## 📞 Support

For issues or questions, please contact the development team.

---

**Built with ❤️ for better Hepatitis B patient care**