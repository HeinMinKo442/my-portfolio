# Frontend Portfolio Spec

## Goal

Build a clean, modern, minimal portfolio website for a junior Laravel developer using React and Tailwind CSS.

The frontend is separated from the Laravel backend:

```text
frontend/  React application
backend/   Laravel API and admin dashboard
```

## Data Source

The frontend fetches content from:

```text
GET http://localhost:8000/api/portfolio
```

The axios base URL is configured by:

```env
VITE_API_BASE_URL=http://localhost:8000/api
```

If the API is unavailable, the app renders fallback data from `src/data/portfolio.js`.

## Pages And Sections

1. Hero
   - Name
   - Developer title
   - Short intro
   - Links to projects and contact

2. About
   - Short personal summary
   - Supporting facts such as location, focus, and availability

3. Skills
   - Grouped skill cards
   - Backend, frontend, and tools groups

4. Projects
   - Reusable project cards
   - Title, description, tech stack, and GitHub repository link

5. Contact
   - Email call to action
   - GitHub and LinkedIn links

## Design Requirements

- Clean, modern, minimal interface
- Responsive layout for mobile and desktop
- Dark mode support with saved preference
- Smooth scrolling between sections
- Reusable components
- Data-driven content for easy editing

## Folder Structure

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
  styles/
    index.css
  components/
    layout/
      Header.jsx
    projects/
      ProjectCard.jsx
    sections/
      About.jsx
      Contact.jsx
      Hero.jsx
      Projects.jsx
      Skills.jsx
    skills/
      SkillGroup.jsx
    ui/
      SectionHeading.jsx
      ThemeToggle.jsx
    admin/
      AdminLayout.jsx
      ProjectForm.jsx
      ProjectTable.jsx
  pages/
    admin/
      AdminDashboard.jsx
```

## Step-By-Step Structure

1. `src/main.jsx` mounts the React app into `index.html`.
2. `src/App.jsx` composes the page from section components.
3. `src/hooks/usePortfolioData.js` fetches portfolio data from the Laravel API.
4. `src/components/layout/Header.jsx` handles navigation and mobile menu behavior.
5. `src/components/ui/ThemeToggle.jsx` controls dark mode and saves the choice in `localStorage`.
6. `src/components/ui/SectionHeading.jsx` keeps section headings consistent.
7. `src/components/sections/*` contains the main page sections.
8. `src/components/projects/ProjectCard.jsx` renders each project card.
9. `src/components/skills/SkillGroup.jsx` renders each grouped skill card.
10. `src/styles/index.css` imports Tailwind and defines small reusable component classes.

## Primary Admin

The primary content management dashboard is in Laravel:

```text
http://localhost:8000/admin/dashboard
```

The React `/admin` page is a lightweight project-management view and is secondary to the backend dashboard.

## Customization

Update `src/data/portfolio.js` with the real developer name, email, social links, skill groups, and project repositories.

## Run Locally

```bash
npm install
npm run dev
```

## Follow-Up Questions

- What is the developer's real name and preferred title?
- Do you want a resume download button?
- Should the contact section include a working form or just contact links?
