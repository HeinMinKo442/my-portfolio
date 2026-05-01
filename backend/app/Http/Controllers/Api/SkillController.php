<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Skill::query()->orderBy('category')->orderBy('sort_order')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $skill = Skill::create($this->validatedData($request));

        return response()->json(['data' => $skill], 201);
    }

    public function show(Skill $skill)
    {
        return response()->json(['data' => $skill]);
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validatedData($request));

        return response()->json(['data' => $skill]);
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'category' => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
