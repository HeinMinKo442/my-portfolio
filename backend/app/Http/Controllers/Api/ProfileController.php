<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Profile::query()->latest()->get()]);
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        return response()->json(['data' => Profile::create($data)], 201);
    }

    public function show(Profile $profile)
    {
        return response()->json(['data' => $profile]);
    }

    public function update(Request $request, Profile $profile)
    {
        $data = $this->validatedData($request);

        if ($request->hasFile('profile_image')) {
            $data['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
        }

        $profile->update($data);

        return response()->json(['data' => $profile]);
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'intro' => ['required', 'string'],
            'about' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'profile_image' => ['nullable', 'image', 'max:2048'],
        ]);
    }
}
