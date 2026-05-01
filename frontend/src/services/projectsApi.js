import { api } from './api.js';

export async function getProjects() {
  const response = await api.get('/projects');
  return response.data.data || response.data;
}

export async function createProject(project) {
  const response = await api.post('/projects', project);
  return response.data.data || response.data;
}

export async function updateProject(id, project) {
  const response = await api.put(`/projects/${id}`, project);
  return response.data.data || response.data;
}

export async function deleteProject(id) {
  await api.delete(`/projects/${id}`);
}
