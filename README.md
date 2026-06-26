# Portfolio Monorepo update

This repository is split into two separate applications:

```text
backend/   Laravel API, MySQL database, Breeze auth, Blade admin dashboard
frontend/  React + Tailwind portfolio website
docs/      Architecture and implementation specs
```

## Current Features

- Public React portfolio website
- Laravel REST API for portfolio content
- MySQL database
- Laravel Breeze admin login
- Backend Blade admin dashboard for managing portfolio data
- React frontend fetches portfolio data from Laravel with axios

## Database

Create the MySQL database:

```sql
CREATE DATABASE portfolio CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Configured credentials in `backend/.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password
```

## Backend Setup

```bash
cd backend
composer install
npm install
php artisan migrate
php artisan db:seed
php artisan storage:link
npm run build
php artisan serve
```

Backend URL:

```text
http://localhost:8000
```

Admin dashboard:

```text
http://localhost:8000/admin/dashboard
```

Seeded admin login:

```text
email: admin@example.com
password: password
```

## Frontend Setup

```bash
cd frontend
npm install
npm run dev
```

Frontend URL:

```text
http://localhost:5173
```

Frontend API config:

```env
VITE_API_BASE_URL=http://localhost:8000/api
```

## API Endpoints

Main public endpoint used by React:

```text
GET /api/portfolio
```

CRUD endpoints:

```text
/api/profiles
/api/projects
/api/skills
/api/contact-info
```

## Admin Dashboard Sections

The Laravel dashboard manages the content needed by the React portfolio:

- Profile: name, title, intro, about, location, profile image
- Projects: title, description, tech stack, GitHub link, display order
- Skills: name, category, display order
- Contact info: email, GitHub, LinkedIn

## Docs

- [Frontend Spec](docs/portfolio-spec.md)
- [Backend/Admin Spec](docs/laravel-backend-admin-spec.md)
