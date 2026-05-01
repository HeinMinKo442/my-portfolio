<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Contact Info</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.dashboard') }}">Back to Admin</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form class="space-y-4 bg-white p-6 shadow-sm sm:rounded-lg" method="POST" action="{{ route('admin.contact-info.update') }}">
                @csrf
                @method('PUT')
                @include('admin.shared.status')
                @include('admin.shared.errors')

                <div>
                    <x-input-label for="email" value="Email" />
                    <x-text-input id="email" class="mt-1 block w-full" name="email" type="email" value="{{ old('email', $contactInfo->email) }}" required />
                </div>

                <div>
                    <x-input-label for="github" value="GitHub URL" />
                    <x-text-input id="github" class="mt-1 block w-full" name="github" placeholder="https://github.com/username" value="{{ old('github', $contactInfo->github) }}" />
                </div>

                <div>
                    <x-input-label for="linkedin" value="LinkedIn URL" />
                    <x-text-input id="linkedin" class="mt-1 block w-full" name="linkedin" placeholder="https://linkedin.com/in/username" value="{{ old('linkedin', $contactInfo->linkedin) }}" />
                </div>

                <x-primary-button>Save Contact Info</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
