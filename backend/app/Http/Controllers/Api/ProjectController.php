<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Project::query()->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $project = Project::create($this->validatedData($request));

        return response()->json(['data' => $project], 201);
    }

    public function show(Project $project)
    {
        return response()->json(['data' => $project]);
    }

    public function update(Request $request, Project $project)
    {
        $project->update($this->validatedData($request));

        return response()->json(['data' => $project]);
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'tech_stack' => ['required', 'array'],
            'tech_stack.*' => ['string', 'max:80'],
            'github_link' => ['nullable', 'url', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
