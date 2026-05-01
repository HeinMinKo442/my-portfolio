export default function SectionHeading({ eyebrow, title }) {
  return (
    <div className="mb-8 max-w-2xl">
      <p className="mb-3 text-xs font-black uppercase text-emerald-700 dark:text-emerald-300">
        {eyebrow}
      </p>
      <h2 className="text-3xl font-black leading-tight text-zinc-950 dark:text-stone-50 md:text-5xl">
        {title}
      </h2>
    </div>
  );
}
