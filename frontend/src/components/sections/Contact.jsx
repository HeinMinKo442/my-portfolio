import { Github, Linkedin, Mail } from 'lucide-react';
import SectionHeading from '../ui/SectionHeading.jsx';

export default function Contact({ profile, contactInfo }) {
  const email = contactInfo.email || profile.email;
  const github = contactInfo.github || profile.github;
  const linkedin = contactInfo.linkedin || profile.linkedin;

  return (
    <section id="contact" className="container-shell section-padding scroll-mt-20">
      <SectionHeading eyebrow="Contact" title="Let’s build something useful." />

      <div className="card max-w-3xl p-6">
        <p className="text-lg leading-8 text-zinc-600 dark:text-zinc-300">
          I am open to junior Laravel developer opportunities, internships, and small
          freelance projects.
        </p>

        <div className="mt-6 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
          <a className="button button-primary" href={`mailto:${email}`}>
            <Mail size={18} />
            {email}
          </a>
          <a
            className="button button-secondary"
            href={github}
            target="_blank"
            rel="noreferrer"
          >
            <Github size={18} />
            GitHub
          </a>
          <a
            className="button button-secondary"
            href={linkedin}
            target="_blank"
            rel="noreferrer"
          >
            <Linkedin size={18} />
            LinkedIn
          </a>
        </div>
      </div>
    </section>
  );
}
