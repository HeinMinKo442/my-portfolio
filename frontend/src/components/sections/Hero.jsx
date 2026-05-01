import { ArrowRight, Mail } from 'lucide-react';

export default function Hero({ profile, isLoading }) {
  return (
    <section id="top" className="container-shell grid min-h-[calc(100svh-65px)] items-center py-20">
      <div className="max-w-3xl">
        {isLoading ? (
          <p className="mb-4 text-sm font-bold text-zinc-500 dark:text-zinc-400">
            Loading portfolio...
          </p>
        ) : null}
        <p className="mb-4 text-sm font-black uppercase text-emerald-700 dark:text-emerald-300">
          {profile.title}
        </p>
        <h1 className="max-w-[9ch] text-6xl font-black leading-[0.92] text-zinc-950 dark:text-stone-50 md:text-8xl">
          {profile.name}
        </h1>
        <p className="mt-6 max-w-2xl text-lg leading-8 text-zinc-600 dark:text-zinc-300 md:text-xl">
          {profile.intro}
        </p>

        <div className="mt-8 flex flex-col gap-3 sm:flex-row">
          <a className="button button-primary" href="#projects">
            View Projects
            <ArrowRight size={18} />
          </a>
          <a className="button button-secondary" href={`mailto:${profile.email}`}>
            <Mail size={18} />
            Contact Me
          </a>
        </div>
      </div>
    </section>
  );
}
