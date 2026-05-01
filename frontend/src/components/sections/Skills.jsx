import SkillGroup from '../skills/SkillGroup.jsx';
import SectionHeading from '../ui/SectionHeading.jsx';

export default function Skills({ skillGroups }) {
  return (
    <section
      id="skills"
      className="section-padding scroll-mt-20 bg-zinc-100 dark:bg-zinc-900/55"
    >
      <div className="container-shell">
        <SectionHeading eyebrow="Skills" title="Grouped by practical project work." />

        <div className="grid gap-4 md:grid-cols-3">
          {skillGroups.map((group) => (
            <SkillGroup key={group.title} group={group} />
          ))}
        </div>
      </div>
    </section>
  );
}
