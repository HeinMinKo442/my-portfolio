<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $skill->exists ? 'Edit Skill' : 'Create Skill' }}</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.skills.index') }}">Back to Skills</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form class="space-y-4 bg-white p-6 shadow-sm sm:rounded-lg" method="POST" action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
                @csrf
                @if ($skill->exists)
                    @method('PUT')
                @endif
                @include('admin.shared.errors')

                <div>
                    <x-input-label for="name" value="Skill Name" />
                    <x-text-input id="name" class="mt-1 block w-full" name="name" value="{{ old('name', $skill->name) }}" required />
                </div>

                <div>
                    <x-input-label for="category" value="Category" />
                    <x-text-input id="category" class="mt-1 block w-full" name="category" placeholder="Backend, Frontend, Tools" value="{{ old('category', $skill->category) }}" required />
                </div>

                <div>
                    <x-input-label for="sort_order" value="Sort Order" />
                    <x-text-input id="sort_order" class="mt-1 block w-full" type="number" min="0" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" />
                </div>

                <x-primary-button>Save Skill</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
