import ProjectCard from '../projects/ProjectCard.jsx';
import SectionHeading from '../ui/SectionHeading.jsx';

export default function Projects({ projects }) {
  return (
    <section id="projects" className="container-shell section-padding scroll-mt-20">
      <SectionHeading eyebrow="Projects" title="Selected Laravel-focused work." />

      <div className="grid gap-4 md:grid-cols-3">
        {projects.map((project) => (
          <ProjectCard key={project.title} project={project} />
        ))}
      </div>
    </section>
  );
}
