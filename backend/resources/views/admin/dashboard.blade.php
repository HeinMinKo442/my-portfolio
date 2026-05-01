<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Portfolio Admin</h2>
            <a class="text-sm font-bold text-indigo-600" href="{{ url('/api/portfolio') }}" target="_blank">
                View API JSON
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto space-y-6 sm:px-6 lg:px-8">
            <div class="grid gap-4 md:grid-cols-4">
                <a class="p-6 bg-white shadow-sm sm:rounded-lg" href="{{ route('admin.profile.edit') }}">
                    <h3 class="font-bold">Profile</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $profile?->name ?? 'No profile yet' }}</p>
                </a>
                <a class="p-6 bg-white shadow-sm sm:rounded-lg" href="{{ route('admin.projects.index') }}">
                    <h3 class="font-bold">Projects</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $projectCount }} projects</p>
                </a>
                <a class="p-6 bg-white shadow-sm sm:rounded-lg" href="{{ route('admin.skills.index') }}">
                    <h3 class="font-bold">Skills</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $skillCount }} skills</p>
                </a>
                <a class="p-6 bg-white shadow-sm sm:rounded-lg" href="{{ route('admin.contact-info.edit') }}">
                    <h3 class="font-bold">Contact</h3>
                    <p class="mt-1 text-sm text-gray-600">{{ $contactInfo?->email ?? 'No contact info yet' }}</p>
                </a>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1fr_380px]">
                <section class="bg-white shadow-sm sm:rounded-lg">
                    <div class="flex items-center justify-between border-b p-6">
                        <div>
                            <h3 class="font-bold text-gray-900">Projects</h3>
                            <p class="text-sm text-gray-600">Data used by the frontend Projects section.</p>
                        </div>
                        <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.projects.create') }}">Add Project</a>
                    </div>

                    <div class="divide-y">
                        @forelse ($projects as $project)
                            <div class="p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h4 class="font-bold text-gray-900">{{ $project->title }}</h4>
                                        <p class="mt-1 text-sm text-gray-600">{{ $project->description }}</p>
                                        <div class="mt-3 flex flex-wrap gap-2">
                                            @foreach (($project->tech_stack ?? []) as $tech)
                                                <span class="rounded bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700">{{ $tech }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                    <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.projects.edit', $project) }}">Edit</a>
                                </div>
                            </div>
                        @empty
                            <p class="p-6 text-sm text-gray-600">No projects created yet.</p>
                        @endforelse
                    </div>
                </section>

                <div class="space-y-6">
                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">Profile</h3>
                            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.profile.edit') }}">Edit</a>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-gray-900">{{ $profile?->title ?? 'No title yet' }}</p>
                        <p class="mt-2 text-sm text-gray-600">{{ $profile?->intro ?? 'Add profile content for the hero section.' }}</p>
                    </section>

                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">Contact</h3>
                            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.contact-info.edit') }}">Edit</a>
                        </div>
                        <dl class="mt-3 space-y-2 text-sm">
                            <div>
                                <dt class="font-semibold text-gray-500">Email</dt>
                                <dd class="text-gray-900">{{ $contactInfo?->email ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-500">GitHub</dt>
                                <dd class="break-all text-gray-900">{{ $contactInfo?->github ?? '-' }}</dd>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-500">LinkedIn</dt>
                                <dd class="break-all text-gray-900">{{ $contactInfo?->linkedin ?? '-' }}</dd>
                            </div>
                        </dl>
                    </section>

                    <section class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-gray-900">Skills</h3>
                            <a class="text-sm font-bold text-indigo-600" href="{{ route('admin.skills.create') }}">Add Skill</a>
                        </div>
                        <div class="mt-4 space-y-4">
                            @forelse ($skillsByCategory as $category => $skills)
                                <div>
                                    <h4 class="text-sm font-bold text-gray-900">{{ $category }}</h4>
                                    <div class="mt-2 flex flex-wrap gap-2">
                                        @foreach ($skills as $skill)
                                            <a class="rounded bg-gray-100 px-2 py-1 text-xs font-semibold text-gray-700" href="{{ route('admin.skills.edit', $skill) }}">
                                                {{ $skill->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-600">No skills created yet.</p>
                            @endforelse
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
