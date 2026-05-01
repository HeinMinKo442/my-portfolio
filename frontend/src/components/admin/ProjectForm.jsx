import { Save, X } from 'lucide-react';
import { useEffect, useState } from 'react';

const emptyForm = {
  title: '',
  description: '',
  tech_stack: '',
  github_link: '',
  sort_order: 0,
};

function projectToForm(project) {
  if (!project) {
    return emptyForm;
  }

  return {
    title: project.title || '',
    description: project.description || '',
    tech_stack: (project.tech_stack || project.techStack || []).join(', '),
    github_link: project.github_link || project.github || '',
    sort_order: project.sort_order || 0,
  };
}

export default function ProjectForm({ selectedProject, onSubmit, onCancel, isSaving }) {
  const [form, setForm] = useState(projectToForm(selectedProject));
  const [errors, setErrors] = useState({});

  useEffect(() => {
    setForm(projectToForm(selectedProject));
    setErrors({});
  }, [selectedProject]);

  function updateField(event) {
    const { name, value } = event.target;

    setForm((currentForm) => ({
      ...currentForm,
      [name]: value,
    }));
  }

  function validate() {
    const nextErrors = {};

    if (!form.title.trim()) {
      nextErrors.title = 'Project title is required.';
    }

    if (!form.description.trim()) {
      nextErrors.description = 'Description is required.';
    }

    if (!form.tech_stack.trim()) {
      nextErrors.tech_stack = 'Add at least one technology.';
    }

    if (form.github_link && !form.github_link.startsWith('http')) {
      nextErrors.github_link = 'GitHub link must start with http or https.';
    }

    setErrors(nextErrors);
    return Object.keys(nextErrors).length === 0;
  }

  function handleSubmit(event) {
    event.preventDefault();

    if (!validate()) {
      return;
    }

    onSubmit({
      title: form.title.trim(),
      description: form.description.trim(),
      tech_stack: form.tech_stack
        .split(',')
        .map((tech) => tech.trim())
        .filter(Boolean),
      github_link: form.github_link.trim() || null,
      sort_order: Number(form.sort_order) || 0,
    });
  }

  return (
    <form className="card p-5" onSubmit={handleSubmit}>
      <div className="mb-5 flex items-start justify-between gap-4">
        <div>
          <h2 className="text-xl font-black">
            {selectedProject ? 'Update Project' : 'Create Project'}
          </h2>
          <p className="mt-1 text-sm text-zinc-600 dark:text-zinc-300">
            Manage the project cards shown on the portfolio.
          </p>
        </div>

        {selectedProject ? (
          <button className="button button-secondary px-3" type="button" onClick={onCancel}>
            <X size={16} />
            Clear
          </button>
        ) : null}
      </div>

      <div className="grid gap-4">
        <label className="grid gap-1">
          <span className="text-sm font-bold">Title</span>
          <input
            className="rounded-lg border border-zinc-200 bg-white px-3 py-2 dark:border-zinc-800 dark:bg-zinc-950"
            name="title"
            value={form.title}
            onChange={updateField}
            placeholder="Task Management App"
          />
          {errors.title ? <span className="text-sm text-red-600">{errors.title}</span> : null}
        </label>

        <label className="grid gap-1">
          <span className="text-sm font-bold">Description</span>
          <textarea
            className="min-h-28 rounded-lg border border-zinc-200 bg-white px-3 py-2 dark:border-zinc-800 dark:bg-zinc-950"
            name="description"
            value={form.description}
            onChange={updateField}
            placeholder="Short project summary"
          />
          {errors.description ? (
            <span className="text-sm text-red-600">{errors.description}</span>
          ) : null}
        </label>

        <label className="grid gap-1">
          <span className="text-sm font-bold">Tech Stack</span>
          <input
            className="rounded-lg border border-zinc-200 bg-white px-3 py-2 dark:border-zinc-800 dark:bg-zinc-950"
            name="tech_stack"
            value={form.tech_stack}
            onChange={updateField}
            placeholder="Laravel, React, MySQL"
          />
          {errors.tech_stack ? (
            <span className="text-sm text-red-600">{errors.tech_stack}</span>
          ) : null}
        </label>

        <div className="grid gap-4 md:grid-cols-[1fr_140px]">
          <label className="grid gap-1">
            <span className="text-sm font-bold">GitHub Link</span>
            <input
              className="rounded-lg border border-zinc-200 bg-white px-3 py-2 dark:border-zinc-800 dark:bg-zinc-950"
              name="github_link"
              value={form.github_link}
              onChange={updateField}
              placeholder="https://github.com/username/project"
            />
            {errors.github_link ? (
              <span className="text-sm text-red-600">{errors.github_link}</span>
            ) : null}
          </label>

          <label className="grid gap-1">
            <span className="text-sm font-bold">Order</span>
            <input
              className="rounded-lg border border-zinc-200 bg-white px-3 py-2 dark:border-zinc-800 dark:bg-zinc-950"
              name="sort_order"
              type="number"
              value={form.sort_order}
              onChange={updateField}
              min="0"
            />
          </label>
        </div>
      </div>

      <button className="button button-primary mt-5 w-full sm:w-auto" type="submit" disabled={isSaving}>
        <Save size={16} />
        {isSaving ? 'Saving...' : selectedProject ? 'Update Project' : 'Create Project'}
      </button>
    </form>
  );
}
