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

```bash
# Run all dev servers concurrently (Laravel + Vite)
npm run dev

# In a separate terminal
php artisan serve
```

The app will be available at `http://localhost:8000`.

## Database Seeder

Running `php artisan migrate --seed` creates:
- 10 sample users
- 10 sample apartment listings with images
- 20 sample bookings with realistic date ranges

## Project Structure

```
app/
  Http/
    Controllers/     # HomeController, ApartmentController, BookingController,
                     # UserController, AdminController, LoginController
    Middleware/      # Admin role middleware
    Requests/        # Form request validation
  Models/            # User, Apartment, Booking, Image
  Policies/          # ApartmentPolicy, BookingPolicy, UserPolicy
database/
  migrations/        # 7 migration files
  factories/         # Model factories for seeding
resources/
  views/
    components/      # Reusable Blade components (navbar, property card, filters, etc.)
routes/
  web.php            # All application routes
```

## Roles & Permissions

| Action | Guest | User | Admin |
|---|---|---|---|
| Browse apartments | Yes | Yes | Yes |
| Create listing | No | Yes | Yes |
| Edit/delete own listing | No | Yes | Yes |
| Book apartments | No | Yes | Yes |
| Cancel own bookings | No | Yes | Yes |
| Edit own profile | No | Yes | Yes |
| Admin panel | No | No | Yes |
| Promote/delete users | No | No | Yes |

To create an admin, seed the database and then manually set `role = 'admin'` on a user record, or use `php artisan tinker`:

```php
User::find(1)->update(['role' => 'admin']);
```

## License

This project is open-source and available under the [MIT license](https://opensource.org/licenses/MIT).
