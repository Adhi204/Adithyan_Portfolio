@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Welcome to My Profile</h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-1">
            <img src="https://via.placeholder.com/300" alt="Profile Picture" class="w-full h-auto rounded-full shadow-lg">
        </div>
        <div class="md:col-span-2">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">About Me</h2>
            <p class="text-gray-700 mb-4">Hi, I'm [Your Name], a [Your Profession, e.g., Web Developer] with [X years] of experience. Passionate about [brief interests].</p>
            <p class="text-gray-600">Contact: [email@example.com] | <a href="#" class="text-blue-600 hover:underline">LinkedIn</a> | <a href="#" class="text-blue-600 hover:underline">GitHub</a></p>
        </div>
    </div>
@endsection