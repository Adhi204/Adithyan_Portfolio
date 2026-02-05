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
                <h2 class="font-semibold text-xl mb-4">Skills</h2>

                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($user->skills as $skill)
                        <li>{{ $skill->name }} ({{ $skill->level }})</li>
                    @endforeach
                </ul>
            </div>

            <!-- Projects -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="font-semibold text-xl mb-4">Projects</h2>

                <ul class="list-disc list-inside space-y-1 text-sm">
                    @foreach ($user->projects as $project)
                        <li>
                            {{ $project->title }}

                            @if ($project->github_url)
                                —
                                <a href="{{ $project->github_url }}" target="_blank"
                                    class="text-indigo-600 hover:underline">
                                    GitHub
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Services -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="font-semibold text-xl mb-4">Services</h2>

                <div class="grid gap-4 md:grid-cols-3">
                    @forelse ($user->services as $service)
                        <div class="rounded-lg border p-4">
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
                    <a href="/storage/resumes/{{ $resume->file_name }}" target="_blank"
                        class="text-indigo-600 hover:underline">
                        {{ $resume->title }}
                    </a>
                @else
                    <p class="text-sm text-slate-500">No resume uploaded.</p>
                @endif
            </div>

        </div>
    </div>
@endsection

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
