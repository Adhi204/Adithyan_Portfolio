@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Projects</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="https://via.placeholder.com/300x200" alt="Project 1" class="w-full h-48 object-cover">
            <div class="p-4">
                <h5 class="text-xl font-semibold text-gray-800 mb-2">Project 1: [Name]</h5>
                <p class="text-gray-600 mb-4">[Brief description, tech stack, link to demo/repo].</p>
                <a href="#" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">View Project</a>
            </div>
        </div>
        <!-- Repeat for more projects -->
    </div>
@endsection