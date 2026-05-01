export default function SkillGroup({ group }) {
  return (
    <article className="card p-5">
      <h3 className="text-lg font-black text-zinc-950 dark:text-stone-50">{group.title}</h3>
      <ul className="mt-5 flex flex-wrap gap-2">
        {group.skills.map((skill) => (
          <li
            key={skill}
            className="rounded-lg bg-emerald-100 px-3 py-1.5 text-sm font-bold text-emerald-900 dark:bg-emerald-950 dark:text-emerald-200"
          >
            {skill}
          </li>
        ))}
      </ul>
    </article>
  );
}
