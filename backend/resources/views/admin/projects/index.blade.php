<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Projects</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.projects.create') }}">Add Project</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @include('admin.shared.status')
                <div class="space-y-4">
                    @forelse ($projects as $project)
                        <div class="flex items-start justify-between border-b pb-4">
                            <div>
                                <h3 class="font-bold">{{ $project->title }}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $project->description }}</p>
                                <p class="mt-2 text-xs font-semibold text-gray-500">{{ implode(', ', $project->tech_stack ?? []) }}</p>
                            </div>
                            <div class="flex gap-3">
                                <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-bold text-red-600" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-600">No projects yet. Create your first project.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
