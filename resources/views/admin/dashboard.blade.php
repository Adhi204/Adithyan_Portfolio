@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto mt-10">

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
                <p><strong>Name:</strong> {{ $user->profile->name }}</p>
                <p><strong>Designation:</strong> {{ $user->profile->designation }}</p>
                <p><strong>About:</strong> {{ $user->profile->about }}</p>
                <p><strong>Location:</strong> {{ $user->profile->location }}</p>
            </div>

            <!-- Skills -->
            <div class="rounded-xl bg-white p-6 shadow-sm">
                <h2 class="font-semibold text-xl mb-4">Skills</h2>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($user->skills as $skill)
                        <li>{{ $skill->name }} ({{ $skill->level }})</li>
                    @endforeach
                </ul>
            </div>

            <!-- Projects -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="font-semibold text-xl mb-4">Projects</h2>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($user->projects as $project)
                        <li>
                            {{ $project->title }} -
                            <a href="{{ $project->github_url }}" target="_blank" class="text-indigo-600 hover:underline">
                                GitHub
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Resume -->
            <div class="rounded-xl bg-white p-6 shadow-sm md:col-span-2">
                <h2 class="font-semibold text-xl mb-4">Resume</h2>
                <a href="/storage/resumes/{{ $user->resumes->first()->file_name ?? '' }}" target="_blank"
                    class="text-indigo-600 hover:underline">
                    {{ $user->resumes->first()->title ?? 'Resume' }}
                </a>
            </div>
        </div>
    </div>
@endsection
