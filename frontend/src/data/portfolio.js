export const profile = {
  name: 'Your Name',
  initials: 'YN',
  title: 'Junior Laravel Developer',
  intro:
    'I build clean, maintainable web applications with Laravel, React, and modern frontend tools.',
  location: 'Yangon, Myanmar',
  email: 'hello@example.com',
  github: 'https://github.com/your-username',
  linkedin: 'https://www.linkedin.com/in/your-username/',
};

export const about = [
  'I am a junior Laravel developer focused on building practical web applications with clear structure, readable code, and thoughtful user experiences.',
  'My current strengths are backend fundamentals, RESTful Laravel features, React components, responsive layouts, and learning from real project constraints.',
];

export const skillGroups = [
  {
    title: 'Backend',
    skills: ['Laravel', 'PHP', 'REST APIs', 'MVC', 'Authentication', 'MySQL'],
  },
  {
    title: 'Frontend',
    skills: ['React', 'JavaScript', 'HTML', 'Tailwind CSS', 'Responsive UI', 'Vite'],
  },
  {
    title: 'Tools',
    skills: ['Git', 'GitHub', 'Composer', 'npm', 'Postman', 'VS Code'],
  },
];

export const projects = [
  {
    title: 'Task Management App',
    description:
      'A Laravel and React app for creating projects, assigning tasks, and tracking completion status.',
    techStack: ['Laravel', 'React', 'MySQL', 'Tailwind CSS'],
    github: 'https://github.com/your-username/task-management-app',
  },
  {
    title: 'Blog CMS',
    description:
      'A simple content management system with authentication, post CRUD, categories, and image uploads.',
    techStack: ['Laravel', 'Blade', 'MySQL', 'Tailwind CSS'],
    github: 'https://github.com/your-username/blog-cms',
  },
  {
    title: 'Portfolio API',
    description:
      'A small REST API for managing profile, skills, projects, and contact form submissions.',
    techStack: ['Laravel', 'REST API', 'Sanctum', 'MySQL'],
    github: 'https://github.com/your-username/portfolio-api',
  },
];

export const contactInfo = {
  email: profile.email,
  github: profile.github,
  linkedin: profile.linkedin,
};

export const fallbackPortfolio = {
  profile,
  about,
  skillGroups,
  projects,
  contactInfo,
};
