@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Update Projects</h1>

<form action="{{ route('admin.update') }}" method="POST" class="bg-white p-8 rounded-2xl shadow space-y-6">
    @csrf

    <div id="projects-container" class="space-y-4">
        @foreach ($projects ?? [] as $index => $project)
            <div class="flex items-center space-x-2">
                <input type="text" name="projects[{{ $index }}][title]" value="{{ $project['title'] ?? '' }}"
                       placeholder="Project Title"
                       class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                <input type="text" name="projects[{{ $index }}][link]" value="{{ $project['link'] ?? '' }}"
                       placeholder="Project Link"
                       class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
                <button type="button" onclick="this.parentNode.remove()" class="text-red-600 font-bold">X</button>
            </div>
        @endforeach
    </div>

    <button type="button" id="add-project" class="rounded-lg bg-green-600 py-2 px-4 text-white hover:bg-green-700 transition">
        + Add Project
    </button>

    <button type="submit" class="rounded-lg bg-indigo-600 py-2.5 px-6 text-white font-semibold hover:bg-indigo-700 transition">
        Update Projects
    </button>
</form>

<script>
document.getElementById('add-project').addEventListener('click', function() {
    let container = document.getElementById('projects-container');
    let index = container.children.length;
    let div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" name="projects[${index}][title]" placeholder="Project Title"
               class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
        <input type="text" name="projects[${index}][link]" placeholder="Project Link"
               class="flex-1 rounded-lg border border-slate-300 px-4 py-2 focus:border-indigo-500 focus:ring-indigo-500">
        <button type="button" onclick="this.parentNode.remove()" class="text-red-600 font-bold">X</button>
    `;
    container.appendChild(div);
});
</script>
@endsection
