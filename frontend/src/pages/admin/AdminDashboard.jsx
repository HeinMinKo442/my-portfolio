import { RefreshCw } from 'lucide-react';
import { useEffect, useState } from 'react';
import AdminLayout from '../../components/admin/AdminLayout.jsx';
import ProjectForm from '../../components/admin/ProjectForm.jsx';
import ProjectTable from '../../components/admin/ProjectTable.jsx';
import {
  createProject,
  deleteProject,
  getProjects,
  updateProject,
} from '../../services/projectsApi.js';

export default function AdminDashboard() {
  const [projects, setProjects] = useState([]);
  const [selectedProject, setSelectedProject] = useState(null);
  const [isLoading, setIsLoading] = useState(true);
  const [isSaving, setIsSaving] = useState(false);
  const [isDeletingId, setIsDeletingId] = useState(null);
  const [message, setMessage] = useState('');
  const [error, setError] = useState('');

  async function loadProjects() {
    setIsLoading(true);
    setError('');

    try {
      const projectData = await getProjects();
      setProjects(projectData);
    } catch (requestError) {
      setError('Could not load projects from the Laravel API.');
    } finally {
      setIsLoading(false);
    }
  }

  useEffect(() => {
    loadProjects();
  }, []);

  async function handleSubmit(projectPayload) {
    setIsSaving(true);
    setError('');
    setMessage('');

    try {
      if (selectedProject) {
        await updateProject(selectedProject.id, projectPayload);
        setMessage('Project updated.');
      } else {
        await createProject(projectPayload);
        setMessage('Project created.');
      }

      setSelectedProject(null);
      await loadProjects();
    } catch (requestError) {
      setError('Could not save the project. Check the form and API server.');
    } finally {
      setIsSaving(false);
    }
  }

  async function handleDelete(project) {
    const shouldDelete = window.confirm(`Delete "${project.title}"?`);

    if (!shouldDelete) {
      return;
    }

    setIsDeletingId(project.id);
    setError('');
    setMessage('');

    try {
      await deleteProject(project.id);
      setMessage('Project deleted.');
      await loadProjects();
    } catch (requestError) {
      setError('Could not delete the project.');
    } finally {
      setIsDeletingId(null);
    }
  }

  return (
    <AdminLayout>
      <div className="mb-6 flex flex-col justify-between gap-4 md:flex-row md:items-end">
        <div>
          <p className="text-sm font-black uppercase text-emerald-700 dark:text-emerald-300">
            Laravel API
          </p>
          <h2 className="mt-1 text-3xl font-black">Manage Portfolio Data</h2>
          <p className="mt-2 max-w-2xl text-zinc-600 dark:text-zinc-300">
            This dashboard reads and writes project data through axios calls to the
            Laravel REST API.
          </p>
        </div>

        <button className="button button-secondary" type="button" onClick={loadProjects}>
          <RefreshCw size={16} />
          Refresh
        </button>
      </div>

      {message ? (
        <div className="mb-4 rounded-lg border border-green-200 bg-green-50 p-3 text-sm font-bold text-green-700 dark:border-green-900 dark:bg-green-950 dark:text-green-200">
          {message}
        </div>
      ) : null}

      {error ? (
        <div className="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm font-bold text-red-700 dark:border-red-900 dark:bg-red-950 dark:text-red-200">
          {error}
        </div>
      ) : null}

      <div className="grid gap-5 xl:grid-cols-[420px_1fr]">
        <ProjectForm
          selectedProject={selectedProject}
          onSubmit={handleSubmit}
          onCancel={() => setSelectedProject(null)}
          isSaving={isSaving}
        />

        {isLoading ? (
          <div className="card p-5 text-sm font-bold text-zinc-600 dark:text-zinc-300">
            Loading projects...
          </div>
        ) : (
          <ProjectTable
            projects={projects}
            onEdit={setSelectedProject}
            onDelete={handleDelete}
            isDeletingId={isDeletingId}
          />
        )}
      </div>
    </AdminLayout>
  );
}
