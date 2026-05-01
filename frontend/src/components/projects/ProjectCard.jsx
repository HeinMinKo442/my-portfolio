import { Github } from 'lucide-react';

export default function ProjectCard({ project }) {
  const techStack = project.techStack || project.tech_stack || [];
  const githubLink = project.github || project.github_link || '#';

  return (
    <article className="card flex min-h-72 flex-col justify-between gap-6 p-5">
      <div>
        <h3 className="text-xl font-black text-zinc-950 dark:text-stone-50">
          {project.title}
        </h3>
        <p className="mt-3 leading-7 text-zinc-600 dark:text-zinc-300">
          {project.description}
        </p>
      </div>

      <div>
        <ul className="flex flex-wrap gap-2" aria-label="Technology stack">
          {techStack.map((tech) => (
            <li
              key={tech}
              className="rounded-lg bg-zinc-100 px-3 py-1.5 text-sm font-bold text-zinc-700 dark:bg-zinc-800 dark:text-zinc-200"
            >
              {tech}
            </li>
          ))}
        </ul>

        <a
          href={githubLink}
          target="_blank"
          rel="noreferrer"
          className="mt-5 inline-flex items-center gap-2 text-sm font-black text-emerald-700 hover:text-emerald-900 dark:text-emerald-300 dark:hover:text-emerald-200"
        >
          <Github size={18} />
          GitHub Repository
        </a>
      </div>
    </article>
  );
}
