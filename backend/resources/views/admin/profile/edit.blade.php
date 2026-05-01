<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Profile</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.dashboard') }}">Back to Admin</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form class="space-y-4 bg-white p-6 shadow-sm sm:rounded-lg" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('admin.shared.status')
                @include('admin.shared.errors')

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" class="mt-1 block w-full" name="name" value="{{ old('name', $profile->name) }}" required />
                </div>

                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" class="mt-1 block w-full" name="title" value="{{ old('title', $profile->title) }}" required />
                </div>

                <div>
                    <x-input-label for="location" value="Location" />
                    <x-text-input id="location" class="mt-1 block w-full" name="location" value="{{ old('location', $profile->location) }}" />
                </div>

                <div>
                    <x-input-label for="intro" value="Short Intro" />
                    <textarea id="intro" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="intro" rows="3" required>{{ old('intro', $profile->intro) }}</textarea>
                </div>

                <div>
                    <x-input-label for="about" value="About" />
                    <textarea id="about" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="about" rows="6" required>{{ old('about', $profile->about) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Use new lines to separate paragraphs on the React frontend.</p>
                </div>

                <div>
                    <x-input-label for="profile_image" value="Profile Image" />
                    <input id="profile_image" class="mt-1 block w-full text-sm" type="file" name="profile_image" accept="image/*">
                    @if ($profile->profile_image)
                        <p class="mt-1 text-xs text-gray-500">Current file: {{ $profile->profile_image }}</p>
                    @endif
                </div>

                <x-primary-button>Save Profile</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
