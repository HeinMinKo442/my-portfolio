<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class DashboardController extends Controller
{
    public function __invoke()
    {
        return view('admin.dashboard', [
            'profile' => Profile::query()->first(),
            'contactInfo' => ContactInfo::query()->first(),
            'projects' => Project::query()->orderBy('sort_order')->get(),
            'skillsByCategory' => Skill::query()
                ->orderBy('category')
                ->orderBy('sort_order')
                ->get()
                ->groupBy('category'),
            'projectCount' => Project::query()->count(),
            'skillCount' => Skill::query()->count(),
        ]);
    }
}
