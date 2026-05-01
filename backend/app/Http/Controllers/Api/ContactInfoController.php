<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    public function index()
    {
        return response()->json(['data' => ContactInfo::query()->latest()->get()]);
    }

    public function store(Request $request)
    {
        $contactInfo = ContactInfo::create($this->validatedData($request));

        return response()->json(['data' => $contactInfo], 201);
    }

    public function show(ContactInfo $contactInfo)
    {
        return response()->json(['data' => $contactInfo]);
    }

    public function update(Request $request, ContactInfo $contactInfo)
    {
        $contactInfo->update($this->validatedData($request));

        return response()->json(['data' => $contactInfo]);
    }

    public function destroy(ContactInfo $contactInfo)
    {
        $contactInfo->delete();

        return response()->noContent();
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
        ]);
    }
}
