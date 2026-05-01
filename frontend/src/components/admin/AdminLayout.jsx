import { BriefcaseBusiness, ExternalLink } from 'lucide-react';

export default function AdminLayout({ children }) {
  return (
    <div className="min-h-screen bg-zinc-100 text-zinc-950 dark:bg-zinc-950 dark:text-stone-50">
      <header className="border-b border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
        <div className="container-shell flex min-h-16 items-center justify-between gap-4">
          <div className="flex items-center gap-3">
            <div className="grid h-10 w-10 place-items-center rounded-lg bg-emerald-700 text-white dark:bg-emerald-400 dark:text-zinc-950">
              <BriefcaseBusiness size={20} />
            </div>
            <div>
              <p className="text-sm font-black uppercase text-emerald-700 dark:text-emerald-300">
                Admin
              </p>
              <h1 className="font-black">Portfolio Dashboard</h1>
            </div>
          </div>

          <a className="button button-secondary" href="/">
            View Site
            <ExternalLink size={16} />
          </a>
        </div>
      </header>

      <main className="container-shell py-8">{children}</main>
    </div>
  );
}
