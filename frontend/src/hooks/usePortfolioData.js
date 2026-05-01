import { useEffect, useState } from 'react';
import { fallbackPortfolio } from '../data/portfolio.js';
import { api } from '../services/api.js';

function getInitials(name = '') {
  return name
    .split(' ')
    .filter(Boolean)
    .slice(0, 2)
    .map((part) => part[0])
    .join('')
    .toUpperCase();
}

function groupSkills(skills = []) {
  const groups = skills.reduce((grouped, skill) => {
    const category = skill.category || 'Other';

    if (!grouped[category]) {
      grouped[category] = [];
    }

    grouped[category].push(skill.name);
    return grouped;
  }, {});

  return Object.entries(groups).map(([title, groupSkills]) => ({
    title,
    skills: groupSkills,
  }));
}

function normalizePortfolioData(payload) {
  const profile = payload.profile || fallbackPortfolio.profile;
  const contactInfo = payload.contact_info || payload.contactInfo || fallbackPortfolio.contactInfo;

  return {
    profile: {
      ...fallbackPortfolio.profile,
      ...profile,
      initials: profile.initials || getInitials(profile.name) || fallbackPortfolio.profile.initials,
      email: contactInfo.email || fallbackPortfolio.profile.email,
      github: contactInfo.github || fallbackPortfolio.profile.github,
      linkedin: contactInfo.linkedin || fallbackPortfolio.profile.linkedin,
    },
    about: profile.about
      ? profile.about.split('\n').filter(Boolean)
      : fallbackPortfolio.about,
    skillGroups: payload.skill_groups || payload.skillGroups || groupSkills(payload.skills),
    projects: (payload.projects || fallbackPortfolio.projects).map((project) => ({
      ...project,
      techStack: project.tech_stack || project.techStack || [],
      github: project.github_link || project.github || '#',
    })),
    contactInfo,
  };
}

export function usePortfolioData() {
  const [data, setData] = useState(fallbackPortfolio);
  const [isLoading, setIsLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    let isMounted = true;

    async function loadPortfolio() {
      try {
        const response = await api.get('/portfolio');

        if (isMounted) {
          setData(normalizePortfolioData(response.data.data || response.data));
          setError(null);
        }
      } catch (requestError) {
        if (isMounted) {
          setData(fallbackPortfolio);
          setError(requestError);
        }
      } finally {
        if (isMounted) {
          setIsLoading(false);
        }
      }
    }

    loadPortfolio();

    return () => {
      isMounted = false;
    };
  }, []);

  return { data, isLoading, error };
}
