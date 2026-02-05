@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto mt-10">

        @if ($errors->any())
            <div class="mb-4 rounded bg-red-50 p-3 text-sm text-red-600">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Admin Dashboard</h1>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition">
                    Logout
                </button>
            </form>
        </div>

        <div class="grid gap-6 md:grid-cols-2">

            <!-- Profile -->
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <h2 class="font-semibold text-xl mb-4">Profile</h2>

                <div class="space-y-2 text-sm text-slate-700">
                    <p><strong>Name:</strong> {{ $user->profile->name }}</p>
                    <p><strong>Designation:</strong> {{ $user->profile->designation }}</p>
                    <p><strong>About:</strong> {{ $user->profile->about }}</p>
                    <p><strong>Location:</strong> {{ $user->profile->location }}</p>

                    <p><strong>Phone:</strong> {{ $user->profile->phone }}</p>
                    <p><strong>Email:</strong> {{ $user->profile->email }}</p>

                    @if ($user->profile->linkedin_link)
                        <p>
                            <strong>LinkedIn:</strong>
                            <a href="{{ $user->profile->linkedin_link }}" target="_blank"
                                class="text-indigo-600 hover:underline">
                                View Profile
                            </a>
                        </p>
                    @endif

                    @if ($user->profile->github_link)
                        <p>
                            <strong>GitHub:</strong>
                            <a href="{{ $user->profile->github_link }}" target="_blank"
                                class="text-indigo-600 hover:underline">
                                View Profile
                            </a>
                        </p>
                    @endif
                </div>
                <div class="flex items-center justify-between mt-6">
                    <button onclick="document.getElementById('profile-modal').classList.remove('hidden')"
                        class="text-sm bg-indigo-600 text-white px-3 py-1.5 rounded-md hover:bg-indigo-700 transition">
                        Update
                    </button>
                </div>

            </div>

            <!-- Skills -->
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-xl">Skills</h2>

                    <!-- Add Skill Button -->
                    <label for="skill-modal-toggle"
                        class="cursor-pointer rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 text-xs">
                        + Add Skill
                    </label>

                </div>

                <ul class="space-y-2 text-sm">
                    @forelse ($user->skills as $skill)
                        <li class="flex items-center justify-between rounded-md border px-3 py-2">
                            <span>
                                {{ $skill->name }}
                                <span class="text-slate-500">({{ $skill->level }})</span>
                            </span>

                            <!-- Remove -->
                            <form method="POST" action="{{ route('admin.deleteSkill', $skill) }}">
                                @csrf

                                <button class="text-red-600 hover:text-red-800 text-sm">
                                    ✕
                                </button>
                            </form>
                        </li>
                    @empty
                        <p class="text-slate-500">No skills added yet.</p>
                    @endforelse
                </ul>
            </div>

            <!-- Projects -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="font-semibold text-xl">Projects</h2>

                    <!-- Add Project Button -->
                    <button onclick="document.getElementById('add-project-modal').classList.remove('hidden')"
                        class="px-3 py-1.5 rounded-md bg-indigo-600 text-white text-xs hover:bg-indigo-700 transition">
                        + Add Project
                    </button>
                </div>

                <div class="grid gap-4">
                    @foreach ($user->projects as $project)
                        <div class="flex justify-between items-center rounded-lg border p-4 hover:shadow-md transition">

                            <!-- Project Title -->
                            <span class="project-title" data-id="{{ $project->id }}" data-title="{{ $project->title }}"
                                data-description="{{ implode("\n", $project->description ?? []) }}"
                                data-github="{{ $project->github_url }}" data-live="{{ $project->live_url }}">
                                {{ $project->title }}
                            </span>

                            <!-- Remove Project -->
                            <form action="{{ route('admin.deleteProject', $project->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 text-lg"
                                    title="Remove Project"
                                    onclick="return confirm('Are you sure you want to delete this project?');">
                                    &times;
                                </button>

                            </form>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Services -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="font-semibold text-xl mb-4">Services</h2>

                <div class="grid gap-4 md:grid-cols-3">
                    @forelse ($user->services as $service)
                        <div class="rounded-lg border p-4 cursor-pointer service-card" data-id="{{ $service->id }}"
                            data-title="{{ $service->title }}" data-description="{{ $service->description }}">
                            <h3 class="font-semibold mb-1">{{ $service->title }}</h3>
                            <p class="text-sm text-slate-600">
                                {{ $service->description }}
                            </p>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500">No services added yet.</p>
                    @endforelse
                </div>
            </div>

            <!-- Resume -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="font-semibold text-xl mb-4">Resume</h2>

                @php
                    $resume = $user->resumes->first();
                @endphp

                @if ($resume)
                    <div class="flex items-center justify-between gap-4">
                        <!-- Title -->
                        <div>
                            <p class="font-medium text-slate-900">
                                {{ $resume->title }}
                            </p>

                            <p class="text-sm text-slate-500">
                                Last updated: {{ $resume->updated_at->format('d M Y') }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3">
                            <!-- View -->
                            <a href="{{ $resume->getResumeUrl() }}" target="_blank"
                                class="px-4 py-2 rounded-md border text-sm text-slate-700 hover:bg-slate-50">View</a>

                            <!-- Update -->
                            <button onclick="document.getElementById('resume-modal').classList.remove('hidden')"
                                class="px-4 py-2 rounded-md bg-indigo-600 text-sm text-white hover:bg-indigo-700">
                                Update
                            </button>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-slate-500">No resume uploaded.</p>

                    <button onclick="document.getElementById('resume-modal').classList.remove('hidden')"
                        class="mt-3 px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                        Upload Resume
                    </button>
                @endif
            </div>
        </div>
    </div>
@endsection

<!-- Model -->

<!-- Profile Update Modal -->
<div id="profile-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50 px-4">
    <div class="bg-white rounded-xl w-full max-w-lg shadow-lg
               max-h-[90vh] overflow-hidden">
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 border-b">
            <h3 class="text-xl font-semibold">Update Profile</h3>

            <button onclick="document.getElementById('profile-modal').classList.add('hidden')"
                class="text-slate-500 hover:text-slate-700 text-2xl leading-none">
                &times;
            </button>
        </div>

        <!-- Scrollable Body -->
        <div class="px-6 py-4 overflow-y-auto max-h-[calc(90vh-140px)]">
            <form method="POST" action="{{ route('admin.updateProfile') }}" enctype="multipart/form-data"
                class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium">Name</label>
                    <input type="text" name="name" value="{{ $user->profile->name }}"
                        class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium">Designation</label>
                    <input type="text" name="designation" value="{{ $user->profile->designation }}"
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">About</label>
                    <textarea name="about" rows="3" class="mt-1 w-full rounded-md border-gray-300">{{ $user->profile->about }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium">Location</label>
                    <input type="text" name="location" value="{{ $user->profile->location }}"
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">Phone</label>
                    <input type="text" name="phone" value="{{ $user->profile->phone }}"
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ $user->profile->email }}"
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">LinkedIn</label>
                    <input type="url" name="linkedin_link" value="{{ $user->profile->linkedin_link }}"
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">GitHub</label>
                    <input type="url" name="github_link" value="{{ $user->profile->github_link }}"
                        class="mt-1 w-full rounded-md border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">Avatar</label>
                    <input type="file" name="avatar" class="mt-1 w-full text-sm">
                </div>

                <!-- Footer -->
                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" onclick="document.getElementById('profile-modal').classList.add('hidden')"
                        class="px-4 py-2 rounded-md border text-slate-600 hover:bg-slate-50">
                        Cancel
                    </button>

                    <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<input type="checkbox" id="skill-modal-toggle" class="peer hidden">

<!-- Add Skill Modal -->
<div class="fixed inset-0 z-50 hidden peer-checked:flex
           items-center justify-center bg-black/50">

    <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg
                max-h-[80vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Add Skill</h3>

            <!-- Close -->
            <label for="skill-modal-toggle" class="cursor-pointer text-slate-500 hover:text-slate-700 text-xl">
                &times;
            </label>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.addSkill') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Name</label>
                <input type="text" name="name" required class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Level</label>
                <select name="level" required class="mt-1 w-full rounded-md border-gray-300">
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Expert</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <!-- Cancel -->
                <label for="skill-modal-toggle"
                    class="cursor-pointer px-4 py-2 rounded-md border text-slate-600 hover:bg-slate-50">
                    Cancel
                </label>

                <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Resume Modal -->
<div id="resume-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg max-h-[80vh] overflow-y-auto">

        <!-- Header -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Update Resume</h3>

            <button onclick="document.getElementById('resume-modal').classList.add('hidden')"
                class="text-slate-500 hover:text-slate-700 text-xl">&times;</button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.updateResume') }}" enctype="multipart/form-data"
            class="space-y-4">
            @csrf

            <!-- Title -->
            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" required value="{{ $resume->title ?? '' }}"
                    class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- File -->
            <div>
                <label class="block text-sm font-medium">Resume File (PDF)</label>
                <input type="file" name="file" accept="application/pdf" required class="mt-1 w-full text-sm">
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="document.getElementById('resume-modal').classList.add('hidden')"
                    class="px-4 py-2 rounded-md border text-slate-600 hover:bg-slate-50">
                    Cancel
                </button>

                <button type="submit" class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add Project Modal -->
<div id="add-project-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Add Project</h3>
            <button onclick="document.getElementById('add-project-modal').classList.add('hidden')"
                class="text-slate-500 hover:text-slate-700 text-xl">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.addProject') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" name="title" required
                    class="mt-1 w-full rounded-md border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-medium">Description (one point per line)</label>
                <textarea name="description" rows="5" required class="mt-1 w-full rounded-md border-gray-300"></textarea>
                <p class="text-xs text-slate-400">Each line will be saved as a point.</p>
            </div>

            <div>
                <label class="block text-sm font-medium">GitHub URL</label>
                <input type="url" name="github_url" class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Live URL</label>
                <input type="url" name="live_url" class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="document.getElementById('add-project-modal').classList.add('hidden')"
                    class="px-4 py-2 rounded-md border text-slate-600 hover:bg-slate-50">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Update Project Modal -->
<div id="update-project-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Update Project</h3>
            <button onclick="document.getElementById('update-project-modal').classList.add('hidden')"
                class="text-slate-500 hover:text-slate-700 text-xl">&times;</button>
        </div>

        <form id="update-project-form" method="POST" action="" class="space-y-4">
            @csrf

            <input type="hidden" name="project_id" id="update-project-id">

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" id="update-title" name="title" required
                    class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Description (one point per line)</label>
                <textarea id="update-description" name="description" rows="5" required></textarea>
                <p class="text-xs text-slate-400">Enter each point on a new line.
                </p>
            </div>

            <div>
                <label class="block text-sm font-medium">GitHub URL</label>
                <input type="url" id="update-github" name="github_url"
                    class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Live URL</label>
                <input type="url" id="update-live" name="live_url"
                    class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button"
                    onclick="document.getElementById('update-project-modal').classList.add('hidden')"
                    class="px-4 py-2 rounded-md border text-slate-600 hover:bg-slate-50">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
</div>

<!-- Update Service Modal -->
<div id="update-service-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50">
    <div class="bg-white w-full max-w-md rounded-xl p-6 shadow-lg max-h-[80vh] overflow-y-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Update Service</h3>
            <button onclick="document.getElementById('update-service-modal').classList.add('hidden')"
                class="text-slate-500 hover:text-slate-700 text-xl">&times;</button>
        </div>

        <form id="update-service-form" method="POST" action="">
            @csrf
            <input type="hidden" name="service_id" id="update-service-id">

            <div>
                <label class="block text-sm font-medium">Title</label>
                <input type="text" id="update-service-title" name="title" required
                    class="mt-1 w-full rounded-md border-gray-300">
            </div>

            <div>
                <label class="block text-sm font-medium">Description</label>
                <textarea id="update-service-description" name="description" rows="4" required
                    class="mt-1 w-full rounded-md border-gray-300"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button"
                    onclick="document.getElementById('update-service-modal').classList.add('hidden')"
                    class="px-4 py-2 rounded-md border text-slate-600 hover:bg-slate-50">Cancel</button>
                <button type="submit"
                    class="px-4 py-2 rounded-md bg-indigo-600 text-white hover:bg-indigo-700">Update</button>
            </div>
        </form>
    </div>
</div>
