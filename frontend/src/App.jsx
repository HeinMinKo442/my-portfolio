import Header from './components/layout/Header.jsx';
import Hero from './components/sections/Hero.jsx';
import About from './components/sections/About.jsx';
import Skills from './components/sections/Skills.jsx';
import Projects from './components/sections/Projects.jsx';
import Contact from './components/sections/Contact.jsx';
import AdminDashboard from './pages/admin/AdminDashboard.jsx';
import { usePortfolioData } from './hooks/usePortfolioData.js';

export default function App() {
  const isAdminPage = window.location.pathname.startsWith('/admin');
  const { data, isLoading, error } = usePortfolioData();

  if (isAdminPage) {
    return <AdminDashboard />;
  }

  return (
    <>
      <Header profile={data.profile} />
      <main>
        {error ? (
          <div className="container-shell pt-4 text-sm font-semibold text-amber-700 dark:text-amber-300">
            Showing local portfolio data because the API is not reachable yet.
          </div>
        ) : null}
        <Hero profile={data.profile} isLoading={isLoading} />
        <About profile={data.profile} about={data.about} />
        <Skills skillGroups={data.skillGroups} />
        <Projects projects={data.projects} />
        <Contact profile={data.profile} contactInfo={data.contactInfo} />
      </main>
    </>
  );
}
