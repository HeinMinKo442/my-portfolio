<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        // retrieve in controller
        $data = Project::query()->orderBy('sort_order')->get();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // create in controller
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
