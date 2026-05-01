<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function edit()
    {
        return view('admin.contact-info.edit', [
            'contactInfo' => ContactInfo::query()->first() ?? new ContactInfo(),
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
        ]);

        $contactInfo = ContactInfo::query()->first() ?? new ContactInfo();
        $contactInfo->fill($data);
        $contactInfo->save();

        return redirect()->route('admin.contact-info.edit')->with('status', 'Contact info saved.');
    }
}
