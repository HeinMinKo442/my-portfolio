import { Edit, Github, Trash2 } from 'lucide-react';

export default function ProjectTable({ projects, onEdit, onDelete, isDeletingId }) {
  return (
    <section className="card overflow-hidden">
      <div className="border-b border-zinc-200 p-5 dark:border-zinc-800">
        <h2 className="text-xl font-black">Projects</h2>
        <p className="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
          View, edit, and delete portfolio projects from the Laravel API.
        </p>
      </div>

      <div className="divide-y divide-zinc-200 dark:divide-zinc-800">
        {projects.length === 0 ? (
          <p className="p-5 text-sm text-zinc-600 dark:text-zinc-300">No projects found.</p>
        ) : null}

        {projects.map((project) => (
          <article key={project.id} className="grid gap-4 p-5 lg:grid-cols-[1fr_auto]">
            <div>
              <div className="flex flex-wrap items-center gap-2">
                <h3 className="font-black">{project.title}</h3>
                <span className="rounded-lg bg-zinc-100 px-2 py-1 text-xs font-bold text-zinc-600 dark:bg-zinc-800 dark:text-zinc-300">
                  #{project.sort_order}
                </span>
              </div>
              <p className="mt-2 leading-7 text-zinc-600 dark:text-zinc-300">
                {project.description}
              </p>
              <div className="mt-3 flex flex-wrap gap-2">
                {(project.tech_stack || []).map((tech) => (
                  <span
                    key={tech}
                    className="rounded-lg bg-emerald-100 px-2.5 py-1 text-xs font-bold text-emerald-900 dark:bg-emerald-950 dark:text-emerald-200"
                  >
                    {tech}
                  </span>
                ))}
              </div>
            </div>

            <div className="flex flex-wrap items-center gap-2 lg:justify-end">
              {project.github_link ? (
                <a
                  className="button button-secondary px-3"
                  href={project.github_link}
                  target="_blank"
                  rel="noreferrer"
                  aria-label={`Open ${project.title} GitHub repository`}
                >
                  <Github size={16} />
                </a>
              ) : null}
              <button className="button button-secondary px-3" type="button" onClick={() => onEdit(project)}>
                <Edit size={16} />
                Edit
              </button>
              <button
                className="button border border-red-200 bg-red-50 px-3 text-red-700 hover:bg-red-100 dark:border-red-900 dark:bg-red-950 dark:text-red-200"
                type="button"
                onClick={() => onDelete(project)}
                disabled={isDeletingId === project.id}
              >
                <Trash2 size={16} />
                {isDeletingId === project.id ? 'Deleting...' : 'Delete'}
              </button>
            </div>
          </article>
        ))}
      </div>
    </section>
  );
}
