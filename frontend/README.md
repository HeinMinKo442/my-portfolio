# Portfolio Frontend

React + Tailwind frontend for the portfolio website.

It reads portfolio content from the Laravel backend API and falls back to local placeholder data when the API is unavailable.

## Setup

```bash
npm install
npm run dev
```

Frontend URL:

```text
http://localhost:5173
```

## API Config

Create `.env` from `.env.example` if needed:

```env
VITE_API_BASE_URL=http://localhost:8000/api
```

The main data hook calls:

```text
GET /api/portfolio
```

## Structure

```text
src/
  App.jsx
  main.jsx
  data/
    portfolio.js
  hooks/
    usePortfolioData.js
  services/
    api.js
    projectsApi.js
  components/
    layout/
    sections/
    projects/
    skills/
    ui/
    admin/
  pages/
    admin/
  styles/
    index.css
```

## Public Portfolio

The public portfolio includes:

- Hero
- About
- Skills
- Projects
- Contact
- Dark mode
- Responsive layout

## Admin Notes

A lightweight React admin page exists at:

```text
http://localhost:5173/admin
```

The primary admin dashboard is the Laravel backend dashboard:

```text
http://localhost:8000/admin/dashboard
```

## Build

```bash
npm run build
```
