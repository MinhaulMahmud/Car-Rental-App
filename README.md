# Car Rentals Platform

A multi-role car rental platform built with Laravel. This application allows customers to rent cars, car owners to list their vehicles, fleet providers to manage multiple cars, and admins to oversee the entire system.

---

## Table of Contents
- [Project Purpose](#project-purpose)
- [Features](#features)
- [User Roles & Permissions](#user-roles--permissions)
- [Key Workflows](#key-workflows)
- [Technical Stack](#technical-stack)
- [Project Structure](#project-structure)
- [Technical Skills Practiced](#technical-skills-practiced)
- [Setup & Installation](#setup--installation)
- [Usage](#usage)
- [Customization](#customization)
- [Security & Best Practices](#security--best-practices)
- [Extending the Project](#extending-the-project)
- [License](#license)

---

## Project Purpose
A robust, multi-role car rental web application:
- **Customers** can browse and book cars.
- **Car Owners** can list and manage a single car.
- **Fleet Providers** can manage multiple cars.
- **Admins** oversee all users, cars, and rentals.

---

## Features
- Role-based dashboards and permissions
- Car listing and management (CRUD, images, availability)
- Rental booking with date overlap prevention
- Automated rental cost calculation
- Email notifications for bookings
- Rental status tracking (upcoming, ongoing, completed)
- Revenue and statistics for owners, fleet providers, and admin
- Profile management (update info, password, delete account)
- Admin management of all users, cars, and rentals

---

## User Roles & Permissions
- **Customer:**
  - Register, browse cars, book rentals
  - View/manage bookings and rental history
- **Owner:**
  - Register, list one car, edit car details
  - View rental history and revenue
- **Fleet Provider:**
  - Register, list/manage multiple cars
  - Update car availability, view stats and revenue
- **Admin:**
  - Manage all users, cars, rentals
  - View platform-wide stats, earnings, and user activity

---

## Key Workflows
### Registration & Authentication
- Register as customer, owner, or fleet provider
- Role determines dashboard and permissions
- Admins can be seeded or promoted in DB

### Car Listing & Management
- Owners: Only one car per owner
- Fleet Providers: Multiple cars
- Car CRUD (create, read, update, delete) with image upload

### Booking & Rental Flow
- Customers select car, pick dates, and book
- System checks for availability (no overlapping rentals)
- Rental record created, cost calculated, email sent
- Customers can view/cancel upcoming rentals

### Admin Management
- View/manage all users, cars, rentals
- Edit/delete users and cars
- View rental history for any user
- Earnings breakdown by role (admin, owner, fleet provider)

---

## Technical Stack
- **Backend:** Laravel (PHP 8.1+)
- **Frontend:** Blade templates, Bootstrap 5
- **Database:** MySQL (configurable)
- **Email:** SMTP (configurable in .env)
- **Assets:** Vite, Tailwind, npm

---

## Project Structure
- `app/Models/` – Eloquent models: User, Car, Rental
- `app/Http/Controllers/` – Controllers for each role and feature
- `app/Mail/` – Mailable for booking confirmation
- `resources/views/` – Blade templates for all pages and dashboards
- `routes/web.php` – All web routes, grouped by role
- `database/migrations/` – DB schema for users, cars, rentals, etc.
- `database/seeders/` – Demo data and role seeding
- `public/` – Entry point, assets, car images

---

## Technical Skills Practiced
- Practiced REST API integration and route structuring (web.php, api.php)
- Implemented role-based access control using Laravel middleware
- Used Eloquent ORM for database relationships and queries
- Practiced file upload and storage management (car images)
- Built and customized Blade components and layouts
- Practiced form validation and error handling
- Implemented email notifications using Laravel Mailable
- Used Laravel seeders and factories for test/demo data
- Practiced pagination and data presentation in dashboards
- Used Laravel’s authentication scaffolding and password management
- Practiced database migrations and schema design
- Practiced MVC architecture and separation of concerns
- Used version control (git) and dependency management (composer, npm)

---

## Setup & Installation
### Prerequisites
- PHP >= 8.1
- Composer
- MySQL or compatible database
- Node.js & npm (for frontend assets)

### Installation Steps
1. **Clone repo & install dependencies:**
   ```bash
   git clone https://github.com/MinhaulMahmud/Car-Rental-App.git
   cd car-rentals
   composer install
   npm install && npm run build
   ```
2. **Configure .env:**
   ```bash
   cp .env.example .env
   # Edit .env for your DB, mail, and app settings
   ```
3. **Generate app key:**
   ```bash
   php artisan key:generate
   ```
4. **Run migrations & seeders:**
   ```bash
   php artisan migrate --seed
   ```
5. **Link storage for images:**
   ```bash
   php artisan storage:link
   ```
6. **Start server:**
   ```bash
   php artisan serve
   ```

---

## Usage
- `/` – Homepage, car listings
- `/register` – Register as any role
- `/admin/dashboard` – Admin panel
- `/owner/dashboard` – Owner dashboard
- `/fleet/dashboard` – Fleet provider dashboard
- `/rentals/dashboard` – Customer dashboard

---

## Customization
- **Roles/Permissions:** Update in User model and middleware
- **Commission/Earnings:** Logic in controllers (e.g., admin gets % of owner/fleet rentals)
- **UI:** Edit Blade templates in `resources/views/`
- **Mail:** Configure SMTP in `.env`

---

## Security & Best Practices
- Uses Laravel’s built-in authentication and CSRF protection
- Role-based middleware for route protection
- Input validation on all forms
- Passwords hashed using Laravel’s default

---

## Extending the Project
- Add APIs for mobile apps
- Add payment gateway integration
- Add more analytics/statistics for admins
- Enhance notifications (SMS, push)

---

## License
This project is open-sourced under the MIT license.
