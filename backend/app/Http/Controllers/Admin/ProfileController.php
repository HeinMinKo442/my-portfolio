<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit', [
            'profile' => Profile::query()->first() ?? new Profile(),
        ]);
    }

    public function update(Request $request)
    {
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

        $profile = Profile::query()->first() ?? new Profile();
        $profile->fill($data);
        $profile->save();

        return redirect()->route('admin.profile.edit')->with('status', 'Profile saved.');
    }
}
