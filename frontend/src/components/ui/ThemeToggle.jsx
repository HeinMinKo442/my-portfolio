import { Moon, Sun } from 'lucide-react';
import { useEffect, useState } from 'react';

function getInitialTheme() {
  const savedTheme = localStorage.getItem('theme');

  if (savedTheme) {
    return savedTheme === 'dark';
  }

  return window.matchMedia('(prefers-color-scheme: dark)').matches;
}

export default function ThemeToggle() {
  const [isDark, setIsDark] = useState(getInitialTheme);

  useEffect(() => {
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
  }, [isDark]);

  return (
    <button
      type="button"
      className="button button-secondary w-full px-3 md:w-11"
      aria-label={isDark ? 'Switch to light mode' : 'Switch to dark mode'}
      onClick={() => setIsDark((value) => !value)}
    >
      {isDark ? <Sun size={18} /> : <Moon size={18} />}
      <span className="md:sr-only">{isDark ? 'Light' : 'Dark'}</span>
    </button>
  );
}
