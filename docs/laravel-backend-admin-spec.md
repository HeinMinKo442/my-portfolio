# Laravel Backend And Admin Dashboard Spec

## Current Architecture

Laravel is the API and primary admin dashboard application. The React portfolio stays separate and reads public portfolio data from Laravel through `/api/portfolio`.

Laravel Breeze is installed for admin authentication.

```bash
cd backend
composer install
npm install
php artisan migrate
php artisan db:seed
npm run build
php artisan serve
```

## MySQL

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password
```

## Database Design

### `profiles`

| Field | Type | Notes |
| --- | --- | --- |
| `id` | big integer | Primary key |
| `name` | string | Developer name |
| `title` | string | Example: Junior Laravel Developer |
| `intro` | text | Short hero intro |
| `about` | text | About section body |
| `location` | string nullable | Optional location |
| `profile_image` | string nullable | Stored image path |
| `timestamps` | timestamps | Created and updated dates |

### `projects`

| Field | Type | Notes |
| --- | --- | --- |
| `id` | big integer | Primary key |
| `title` | string | Project title |
| `description` | text | Project summary |
| `tech_stack` | json | Array of technologies |
| `github_link` | string nullable | GitHub URL |
| `sort_order` | unsigned integer | Manual display order |
| `timestamps` | timestamps | Created and updated dates |

### `skills`

| Field | Type | Notes |
| --- | --- | --- |
| `id` | big integer | Primary key |
| `name` | string | Skill name |
| `category` | string | Backend, Frontend, Tools, etc. |
| `sort_order` | unsigned integer | Manual display order |
| `timestamps` | timestamps | Created and updated dates |

### `contact_infos`

| Field | Type | Notes |
| --- | --- | --- |
| `id` | big integer | Primary key |
| `email` | string | Contact email |
| `github` | string nullable | GitHub URL |
| `linkedin` | string nullable | LinkedIn URL |
| `timestamps` | timestamps | Created and updated dates |

## Migration Files

### `database/migrations/xxxx_xx_xx_create_profiles_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title');
            $table->text('intro');
            $table->text('about');
            $table->string('location')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
```

### `database/migrations/xxxx_xx_xx_create_projects_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->json('tech_stack');
            $table->string('github_link')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
```

### `database/migrations/xxxx_xx_xx_create_skills_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
```

### `database/migrations/xxxx_xx_xx_create_contact_infos_table.php`

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
```

## Model Examples

### `app/Models/Project.php`

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
        'tech_stack',
        'github_link',
        'sort_order',
    ];

    protected $casts = [
        'tech_stack' => 'array',
    ];
}
```

Use the same pattern for `Profile`, `Skill`, and `ContactInfo` with their own `$fillable` fields.

## API Routes

### `routes/api.php`

```php
<?php

use App\Http\Controllers\Api\ContactInfoController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

Route::get('/portfolio', [PortfolioController::class, 'show']);

Route::apiResource('profiles', ProfileController::class)->only(['index', 'show']);
Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
Route::apiResource('skills', SkillController::class)->only(['index', 'show']);
Route::apiResource('contact-info', ContactInfoController::class)->only(['index', 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('profiles', ProfileController::class)->except(['index', 'show']);
    Route::apiResource('projects', ProjectController::class)->except(['index', 'show']);
    Route::apiResource('skills', SkillController::class)->except(['index', 'show']);
    Route::apiResource('contact-info', ContactInfoController::class)->except(['index', 'show']);
});
```

If the admin dashboard is served by Laravel Blade, use session auth for dashboard routes and Sanctum only if the React app also needs protected admin API calls.

## Controller Examples

### `app/Http/Controllers/Api/PortfolioController.php`

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class PortfolioController extends Controller
{
    public function show()
    {
        return response()->json([
            'data' => [
                'profile' => Profile::query()->first(),
                'projects' => Project::query()->orderBy('sort_order')->get(),
                'skills' => Skill::query()->orderBy('category')->orderBy('sort_order')->get(),
                'contact_info' => ContactInfo::query()->first(),
            ],
        ]);
    }
}
```

### `app/Http/Controllers/Api/ProjectController.php`

```php
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::query()->orderBy('sort_order')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tech_stack' => ['required', 'array'],
            'tech_stack.*' => ['string', 'max:80'],
            'github_link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $project = Project::create($data);

        return response()->json(['data' => $project], 201);
    }

    public function show(Project $project)
    {
        return response()->json(['data' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tech_stack' => ['required', 'array'],
            'tech_stack.*' => ['string', 'max:80'],
            'github_link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $project->update($data);

        return response()->json(['data' => $project]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->noContent();
    }
}
```

### Profile Image Upload In `ProfileController`

```php
$data = $request->validate([
    'name' => ['required', 'string', 'max:255'],
    'title' => ['required', 'string', 'max:255'],
    'intro' => ['required', 'string'],
    'about' => ['required', 'string'],
    'location' => ['nullable', 'string', 'max:255'],
    'profile_image' => ['nullable', 'image', 'max:2048'],
]);

if ($request->hasFile('profile_image')) {
    $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
}
```

Run this once for public image URLs:

```bash
php artisan storage:link
```

## Dashboard Routes

### `routes/web.php`

```php
<?php

use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('profile', ProfileController::class)->except(['show']);
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::resource('contact-info', ContactInfoController::class)->except(['show']);
});
```

## Implemented Admin Dashboard

The backend dashboard is available at:

```text
http://localhost:8000/admin/dashboard
```

Seeded login:

```text
email: admin@example.com
password: password
```

The dashboard manages:

- Profile content for Hero and About
- Project cards for Projects
- Skill categories for Skills
- Contact links for Contact

## Dashboard UI

Use simple Blade views first:

```text
resources/views/admin/
  dashboard.blade.php
  profiles/
    edit.blade.php
  projects/
    index.blade.php
    create.blade.php
    edit.blade.php
  skills/
    index.blade.php
    create.blade.php
    edit.blade.php
  contact-info/
    edit.blade.php
```

Each index view should have:

- Create button
- Table of records
- Edit button
- Delete form with `@method('DELETE')`

Each form should use standard Laravel validation errors and old input values.

## Example JSON Responses

### `GET /api/portfolio`

```json
{
  "data": {
    "profile": {
      "id": 1,
      "name": "Aung Min",
      "title": "Junior Laravel Developer",
      "intro": "I build clean Laravel and React web applications.",
      "about": "I enjoy building practical web apps.\nI focus on clear code and maintainable features.",
      "location": "Yangon, Myanmar",
      "profile_image": "profiles/avatar.jpg"
    },
    "projects": [
      {
        "id": 1,
        "title": "Task Management App",
        "description": "A Laravel and React task management app.",
        "tech_stack": ["Laravel", "React", "MySQL", "Tailwind CSS"],
        "github_link": "https://github.com/username/task-app",
        "sort_order": 1
      }
    ],
    "skills": [
      {
        "id": 1,
        "name": "Laravel",
        "category": "Backend",
        "sort_order": 1
      }
    ],
    "contact_info": {
      "id": 1,
      "email": "hello@example.com",
      "github": "https://github.com/username",
      "linkedin": "https://linkedin.com/in/username"
    }
  }
}
```

### `POST /api/projects`

```json
{
  "data": {
    "id": 2,
    "title": "Blog CMS",
    "description": "A Laravel CMS with authentication and post management.",
    "tech_stack": ["Laravel", "Blade", "MySQL"],
    "github_link": "https://github.com/username/blog-cms",
    "sort_order": 2,
    "created_at": "2026-05-01T16:45:00.000000Z",
    "updated_at": "2026-05-01T16:45:00.000000Z"
  }
}
```

## Connect React To The API

1. Install axios in the React project.

```bash
npm install axios
```

2. Add `.env` from `.env.example`.

```bash
VITE_API_BASE_URL=http://localhost:8000/api
```

3. Create an axios client in `src/services/api.js`.

4. Fetch `GET /api/portfolio` in `src/hooks/usePortfolioData.js`.

5. Pass the fetched data into each section from `src/App.jsx`.

6. In Laravel, allow the React dev server origin in CORS. For local Vite, that is usually:

```text
http://localhost:5173
```

7. Run both servers.

```bash
# Laravel
php artisan serve

# React
npm run dev
```

## Suggested Build Order

1. Create migrations and models.
2. Seed one profile, one contact info row, skills, and projects.
3. Build public `GET /api/portfolio`.
4. Connect React to `/api/portfolio`.
5. Add Breeze admin login.
6. Add Blade CRUD screens under `/admin`.
7. Protect write API routes only if you need external API-based admin editing.

## Follow-Up Suggestions

Consider these decisions before building the final backend:

- Use Blade dashboard for simplicity, or React dashboard for a richer admin UI.
- Store profile image locally in `storage/app/public`, or use cloud storage.
- Keep one profile/contact row, or support multiple portfolio owners.
