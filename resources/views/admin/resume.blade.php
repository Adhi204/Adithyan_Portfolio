@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Update Resume</h1>

<form action="{{ route('admin.update') }}" method="POST" class="bg-white p-8 rounded-2xl shadow space-y-6" enctype="multipart/form-data">
    @csrf

    <div>
        <label class="block text-sm font-medium text-slate-700">Upload Resume (PDF)</label>
        <input type="file" name="resume" accept=".pdf"
               class="mt-1 w-full text-slate-800">
    </div>

    <button type="submit"
            class="rounded-lg bg-indigo-600 py-2.5 px-6 text-white font-semibold hover:bg-indigo-700 transition">
        Update Resume
    </button>
</form>
@endsection
