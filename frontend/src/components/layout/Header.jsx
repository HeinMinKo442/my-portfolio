import { Menu, X } from 'lucide-react';
import { useState } from 'react';
import ThemeToggle from '../ui/ThemeToggle.jsx';

const navItems = [
  { label: 'About', href: '#about' },
  { label: 'Skills', href: '#skills' },
  { label: 'Projects', href: '#projects' },
  { label: 'Contact', href: '#contact' },
];

export default function Header({ profile }) {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <header className="sticky top-0 z-20 border-b border-zinc-200/70 bg-stone-50/86 backdrop-blur dark:border-zinc-800/80 dark:bg-zinc-950/86">
      <div className="container-shell flex min-h-16 items-center justify-between gap-4">
        <a
          href="#top"
          className="grid h-10 w-10 place-items-center rounded-lg border border-zinc-200 bg-white text-sm font-black text-emerald-800 dark:border-zinc-800 dark:bg-zinc-900 dark:text-emerald-300"
          aria-label="Go to hero section"
        >
          {profile.initials}
        </a>

        <button
          type="button"
          className="button button-secondary px-3 md:hidden"
          aria-expanded={isMenuOpen}
          aria-controls="main-navigation"
          onClick={() => setIsMenuOpen((value) => !value)}
        >
          {isMenuOpen ? <X size={18} /> : <Menu size={18} />}
          <span className="sr-only">Toggle menu</span>
        </button>

        <nav
          id="main-navigation"
          className={`absolute left-4 right-4 top-[72px] rounded-lg border border-zinc-200 bg-white p-2 shadow-soft dark:border-zinc-800 dark:bg-zinc-900 md:static md:flex md:items-center md:gap-1 md:border-0 md:bg-transparent md:p-0 md:shadow-none md:dark:bg-transparent ${
            isMenuOpen ? 'block' : 'hidden md:flex'
          }`}
          aria-label="Main navigation"
        >
          {navItems.map((item) => (
            <a
              key={item.href}
              href={item.href}
              className="block rounded-lg px-3 py-2 text-sm font-semibold text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-950 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white"
              onClick={() => setIsMenuOpen(false)}
            >
              {item.label}
            </a>
          ))}
          <div className="mt-2 md:ml-1 md:mt-0">
            <ThemeToggle />
          </div>
        </nav>
      </div>
    </header>
  );
}
