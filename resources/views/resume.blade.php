@extends('layouts.app')
@section('content')
    <h1 class="text-3xl font-bold text-gray-900 mb-6">My Resume</h1>
    <div class="bg-white rounded-lg shadow-md p-4">
        <embed src="{{ asset('resume.pdf') }}" width="100%" height="600px" type="application/pdf" class="rounded">
        <p class="mt-4"><a href="{{ asset('resume.pdf') }}" download class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Download Resume</a></p>
    </div>
@endsection