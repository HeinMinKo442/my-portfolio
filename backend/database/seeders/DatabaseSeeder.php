<?php

namespace Database\Seeders;

use App\Models\ContactInfo;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        Profile::query()->updateOrCreate(['id' => 1], [
            'name' => 'Your Name',
            'title' => 'Junior Laravel Developer',
            'intro' => 'I build clean, maintainable web applications with Laravel, React, and modern frontend tools.',
            'about' => "I am a junior Laravel developer focused on building practical web applications with clear structure, readable code, and thoughtful user experiences.\nMy current strengths are backend fundamentals, RESTful Laravel features, React components, responsive layouts, and learning from real project constraints.",
            'location' => 'Yangon, Myanmar',
        ]);

        ContactInfo::query()->updateOrCreate(['id' => 1], [
            'email' => 'hello@example.com',
            'github' => 'https://github.com/your-username',
            'linkedin' => 'https://www.linkedin.com/in/your-username/',
        ]);

        Project::query()->updateOrCreate(['id' => 1], [
            'title' => 'Task Management App',
            'description' => 'A Laravel and React app for creating projects, assigning tasks, and tracking completion status.',
            'tech_stack' => ['Laravel', 'React', 'MySQL', 'Tailwind CSS'],
            'github_link' => 'https://github.com/your-username/task-management-app',
            'sort_order' => 1,
        ]);

        Project::query()->updateOrCreate(['id' => 2], [
            'title' => 'Blog CMS',
            'description' => 'A simple content management system with authentication, post CRUD, categories, and image uploads.',
            'tech_stack' => ['Laravel', 'Blade', 'MySQL', 'Tailwind CSS'],
            'github_link' => 'https://github.com/your-username/blog-cms',
            'sort_order' => 2,
        ]);

        $skills = [
            ['Laravel', 'Backend', 1],
            ['PHP', 'Backend', 2],
            ['REST APIs', 'Backend', 3],
            ['MySQL', 'Backend', 4],
            ['React', 'Frontend', 1],
            ['JavaScript', 'Frontend', 2],
            ['Tailwind CSS', 'Frontend', 3],
            ['Git', 'Tools', 1],
            ['GitHub', 'Tools', 2],
            ['Postman', 'Tools', 3],
        ];

        foreach ($skills as [$name, $category, $sortOrder]) {
            Skill::query()->updateOrCreate(
                ['name' => $name, 'category' => $category],
                ['sort_order' => $sortOrder],
            );
        }
    }
}
