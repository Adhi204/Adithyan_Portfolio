@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
<p class="mb-8 text-slate-600">Welcome! You are logged in as the owner. Use the links below to update your portfolio.</p>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Update About -->
    <a href="{{ route('admin.about') }}" 
       class="flex flex-col items-center p-6 bg-white border border-slate-200 rounded-2xl shadow hover:shadow-md transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="font-semibold text-slate-700">Update About</span>
    </a>

    <!-- Update Skills -->
    <a href="{{ route('admin.skills') }}" 
       class="flex flex-col items-center p-6 bg-white border border-slate-200 rounded-2xl shadow hover:shadow-md transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        <span class="font-semibold text-slate-700">Update Skills</span>
    </a>

    <!-- Update Resume -->
    <a href="{{ route('admin.resume') }}" 
       class="flex flex-col items-center p-6 bg-white border border-slate-200 rounded-2xl shadow hover:shadow-md transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v12a2 2 0 01-2 2z" />
        </svg>
        <span class="font-semibold text-slate-700">Update Resume</span>
    </a>

    <!-- Update Projects -->
    <a href="{{ route('admin.projects') }}" 
       class="flex flex-col items-center p-6 bg-white border border-slate-200 rounded-2xl shadow hover:shadow-md transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h3m10 0h3a1 1 0 001-1V7m-16 4v10a1 1 0 001 1h14a1 1 0 001-1V11m-16 0h16" />
        </svg>
        <span class="font-semibold text-slate-700">Update Projects</span>
    </a>
</div>
@endsection
