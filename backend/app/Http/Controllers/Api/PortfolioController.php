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
                'skills' => Skill::query()
                    ->orderBy('category')
                    ->orderBy('sort_order')
                    ->get(),
                'contact_info' => ContactInfo::query()->first(),
            ],
        ]);
    }
}
