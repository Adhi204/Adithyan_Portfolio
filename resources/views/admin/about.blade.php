@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Update About Section</h1>

<form action="{{ route('admin.update') }}" method="POST" class="bg-white p-8 rounded-2xl shadow space-y-6">
    @csrf

    <div>
        <label class="block text-sm font-medium text-slate-700">Title</label>
        <input type="text" name="title" value="{{ old('title', $about->title ?? '') }}"
               class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-800 focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Description</label>
        <textarea name="description" rows="6"
                  class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-800 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $about->description ?? '') }}</textarea>
    </div>

    <button type="submit"
            class="rounded-lg bg-indigo-600 py-2.5 px-6 text-white font-semibold hover:bg-indigo-700 transition">
        Update About
    </button>
</form>
@endsection
