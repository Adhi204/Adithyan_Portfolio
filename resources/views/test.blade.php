@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="mb-20">
    <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
        Hi! I’m Adithyan.
    </h1>

    <p class="text-lg md:text-xl text-gray-600 max-w-2xl">
        I’m a backend developer focused on Laravel, APIs, and cloud-ready systems.
    </p>
</section>

{{-- PROJECTS --}}
<section class="space-y-12">
    <h2 class="text-xl font-semibold">Selected Projects</h2>

    <div class="space-y-10">
        @foreach ($projects as $project)
            <div class="border-b pb-6">
                <h3 class="text-lg font-medium mb-1">
                    {{ $project['title'] }}
                </h3>

                <p class="text-gray-600 mb-2 max-w-3xl">
                    {{ $project['description'] }}
                </p>

                <a href="{{ $project['url'] }}"
                   class="text-sm font-medium underline underline-offset-4 hover:text-gray-700">
                    READ MORE
                </a>
            </div>
        @endforeach
    </div>
</section>

{{-- FOOTER --}}
<footer class="mt-24 text-sm text-gray-500">
    <p>© {{ date('Y') }} Adithyan</p>
</footer>

@endsection
