import SectionHeading from '../ui/SectionHeading.jsx';

export default function About({ profile, about }) {
  const facts = [
    { label: 'Location', value: profile.location },
    { label: 'Focus', value: 'Laravel applications and React interfaces' },
    { label: 'Available for', value: 'Junior developer roles and freelance projects' },
  ];

  return (
    <section id="about" className="container-shell section-padding scroll-mt-20">
      <SectionHeading eyebrow="About" title="A developer who values clear code." />

      <div className="grid gap-8 md:grid-cols-[1.35fr_0.65fr]">
        <div className="space-y-5 text-lg leading-8 text-zinc-600 dark:text-zinc-300">
          {about.map((paragraph) => (
            <p key={paragraph}>{paragraph}</p>
          ))}
        </div>

        <dl className="card p-5">
          {facts.map((fact) => (
            <div
              key={fact.label}
              className="border-b border-zinc-200 py-4 first:pt-0 last:border-b-0 last:pb-0 dark:border-zinc-800"
            >
              <dt className="text-sm font-bold text-zinc-500 dark:text-zinc-400">
                {fact.label}
              </dt>
              <dd className="mt-1 font-black text-zinc-950 dark:text-stone-50">
                {fact.value}
              </dd>
            </div>
          ))}
        </dl>
      </div>
    </section>
  );
}
