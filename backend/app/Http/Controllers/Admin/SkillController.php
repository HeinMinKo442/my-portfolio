<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index()
    {
        return view('admin.skills.index', [
            'skills' => Skill::query()->orderBy('category')->orderBy('sort_order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.skills.form', ['skill' => new Skill()]);
    }

    public function store(Request $request)
    {
        Skill::create($this->validatedData($request));

        return redirect()->route('admin.skills.index')->with('status', 'Skill created.');
    }

    public function edit(Skill $skill)
    {
        return view('admin.skills.form', ['skill' => $skill]);
    }

    public function update(Request $request, Skill $skill)
    {
        $skill->update($this->validatedData($request));

        return redirect()->route('admin.skills.index')->with('status', 'Skill updated.');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->route('admin.skills.index')->with('status', 'Skill deleted.');
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
