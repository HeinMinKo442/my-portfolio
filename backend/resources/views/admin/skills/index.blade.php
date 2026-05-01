<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Skills</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.skills.create') }}">Add Skill</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                @include('admin.shared.status')
                <div class="space-y-3">
                    @forelse ($skills as $skill)
                        <div class="flex items-center justify-between border-b pb-3">
                            <p><strong>{{ $skill->name }}</strong> <span class="text-sm text-gray-500">{{ $skill->category }}</span></p>
                            <div class="flex gap-3">
                                <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.skills.edit', $skill) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Delete this skill?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm font-bold text-red-600" type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-gray-600">No skills yet. Create your first skill.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
