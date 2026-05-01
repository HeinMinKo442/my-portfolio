<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $project->exists ? 'Edit Project' : 'Create Project' }}</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.projects.index') }}">Back to Projects</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form class="space-y-4 bg-white p-6 shadow-sm sm:rounded-lg" method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}">
                @csrf
                @if ($project->exists)
                    @method('PUT')
                @endif
                @include('admin.shared.errors')

                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" class="mt-1 block w-full" name="title" value="{{ old('title', $project->title) }}" required />
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" name="description" rows="4" required>{{ old('description', $project->description) }}</textarea>
                </div>

                <div>
                    <x-input-label for="tech_stack" value="Tech Stack" />
                    <x-text-input id="tech_stack" class="mt-1 block w-full" name="tech_stack" placeholder="Laravel, React, MySQL" value="{{ old('tech_stack', implode(', ', $project->tech_stack ?? [])) }}" required />
                    <p class="mt-1 text-xs text-gray-500">Separate technologies with commas.</p>
                </div>

                <div>
                    <x-input-label for="github_link" value="GitHub Link" />
                    <x-text-input id="github_link" class="mt-1 block w-full" name="github_link" placeholder="https://github.com/username/project" value="{{ old('github_link', $project->github_link) }}" />
                </div>

                <div>
                    <x-input-label for="sort_order" value="Sort Order" />
                    <x-text-input id="sort_order" class="mt-1 block w-full" type="number" min="0" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" />
                </div>

                <x-primary-button>Save Project</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
