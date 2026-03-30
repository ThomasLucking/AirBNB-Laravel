# AirBNB Laravel Clone

A full-featured Airbnb-inspired property rental web application built with Laravel 12 and Tailwind CSS. Users can list apartments, browse available properties, and make bookings — all with role-based access control and a clean, responsive UI.

## Features

- **Apartment Listings** — Create, edit, and delete property listings with multiple image uploads
- **Booking System** — Book apartments by date range with automatic conflict detection and price calculation
- **Browse & Search** — Filter apartments by ownership or booking history; sort by price or room count
- **Home Page** — Showcases the top 3 most-booked destinations with featured properties
- **User Profiles** — Users can update their name, email, and password
- **Admin Panel** — Admins can view all users, promote them to admin, or delete their accounts
- **Authorization** — Policy-based access control ensures users can only manage their own data

## Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP 8.2+, Laravel 12 |
| Frontend | Blade, Tailwind CSS 4, Flowbite |
| Build Tool | Vite 7 |
| Database | SQLite (configurable) |
| Auth | Session-based (database driver) |

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js & npm

### Installation

```bash
# Clone the repository
git clone <repo-url>
cd AirBNB-Laravel

# Install PHP dependencies
composer install

# Install JS dependencies
npm install

# Copy environment file and generate app key
cp .env.example .env
php artisan key:generate

# Run migrations and seed the database
php artisan migrate --seed

# Link storage for image uploads
php artisan storage:link

# Build frontend assets
npm run build
```

### Development
To run the project locally
```bash
composer run dev
```

The app will be available at `http://localhost:8000`.

## Database Seeder

Running `php artisan migrate --seed` creates:
- 10 sample users
- 10 sample apartment listings with images
- 20 sample bookings with realistic date ranges


