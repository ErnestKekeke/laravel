# Author: ERNEST KEKEKE
The Author of this project is Ernest Kekeke.
more about the author visit: https://www.youtube.com/@ernestKekeke
github: https://github.com/ErnestKekeke/

# Hospital Location System

A web-based hospital location and management system built with Laravel and Google Maps API.

## Features

- 📍 Interactive map showing hospital locations
- 🏥 Hospital registration and management
- 🔍 Search and filter hospitals
- 📱 Responsive design for all devices
- 📊 View detailed hospital information

## Requirements

- PHP 8.1+
- Laravel 10+
- MySQL 8.0+
- Composer
- Node.js & NPM
- Google Maps API Key

## Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd hospital-location-system
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

4. **Configure database in `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hospital_system
DB_USERNAME=root
DB_PASSWORD=
```

5. **Add Google Maps API Key in `.env`**
```env
GOOGLE_MAPS_API_KEY=your_api_key_here
```

6. **Add to `config/services.php`**
```php
'google_maps' => [
    'api_key' => env('GOOGLE_MAPS_API_KEY'),
],
```

7. **Run migrations**
```bash
php artisan migrate
```

8. **Build assets**
```bash
npm run dev
```

9. **Start the server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Google Maps API Setup

1. Go to [Google Cloud Console](https://console.cloud.google.com)
2. Create a new project
3. Enable **Maps JavaScript API**
4. Create API credentials
5. Copy the API key to your `.env` file

## Usage

- **Home Page**: View hospitals on map and search by name
- **Register Hospital**: Fill out the registration form with hospital details
- **Hospital Details**: Click on a hospital to view full information

## Project Structure

```
├── app/
│   ├── Http/Controllers/
│   │   ├── HospitalController.php
│   │   └── LocationController.php
│   └── Models/
│       └── Hospital.php
├── resources/
│   ├── views/
│   │   ├── home.blade.php
│   │   ├── hospital.blade.php
│   │   └── hospital_register.blade.php
│   ├── css/
│   │   ├── home.css
│   │   ├── hospital.css
│   │   └── hospital_register.css
│   └── js/
│       ├── home.js
│       └── hospital_register.js
├── routes/
│   └── web.php
└── database/
    └── migrations/
```

## License

MIT License

## Support

For issues or questions, please open an issue on the repository.