@extends('layouts.app')

@section('content')
    <!-- PROFILE -->
    <section
        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-slate-700 p-10 shadow-lg">

        <div class="flex flex-col md:flex-row items-center gap-10 text-slate-100">

            <!-- Avatar -->
            <div class="relative">
                <div class="h-36 w-36 rounded-full overflow-hidden ring-4 ring-slate-400/40 shadow-xl">
                    <img id="avatar" src="https://via.placeholder.com/150" alt="Profile Avatar"
                        class="h-full w-full object-cover">
                </div>
            </div>

            <!-- Info -->
            <div class="text-center md:text-left">
                <h1 id="name" class="text-2xl md:text-3xl font-extrabold tracking-tight">
                    Loading...
                </h1>

                <p id="designation" class="mt-2 text-base font-medium text-slate-300"></p>

                <p id="about" class="mt-6 max-w-2xl text-slate-200 leading-relaxed"></p>
            </div>
        </div>
    </section>


    <!-- PROJECTS -->
    <section id="projects" class="mt-20 scroll-mt-24">
        <h2 class="text-3xl font-bold text-slate-900 mb-8">
            Projects
        </h2>

        <div id="projects-list" class="grid gap-6 md:grid-cols-2">
            <!-- JS cards -->
        </div>
    </section>

    <!-- SKILLS -->
    <section id="skills" class="mt-20 scroll-mt-24">
        <h2 class="text-3xl font-bold text-slate-900 mb-8">
            Skills
        </h2>

        <div id="skills-list" class="flex flex-wrap gap-3">
            <!-- Skill pills -->
        </div>
    </section>

    <!-- RESUME -->
    <section id="resume" class="mt-20 scroll-mt-24">
        <h2 class="text-3xl font-bold text-slate-900 mb-8">
            Resume
        </h2>

        <div id="resume-box" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <!-- Resume injected -->
        </div>
    </section>

    <!-- CONTACT -->
    <section id="contact" class="mt-24 scroll-mt-24">
        <div class="rounded-3xl bg-slate-900 p-10 text-white shadow-xl">

            <div class="max-w-3xl">
                <h2 class="text-3xl font-bold mb-4">Let's Connect</h2>
                <p class="text-slate-300 leading-relaxed">
                    I'm always open to discussing new projects, creative ideas, or opportunities.
                </p>
            </div>

            <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

                <!-- Email -->
                <a href="mailto:youremail@example.com"
                    class="group flex gap-4 rounded-xl bg-slate-800 p-5 transition hover:bg-indigo-600">
                    <div class="text-2xl shrink-0">📧</div>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-400 group-hover:text-indigo-100">Email</p>
                        <p class="font-semibold break-all">youremail@example.com</p>
                    </div>
                </a>

                <!-- Phone -->
                <a href="tel:+919876543210"
                    class="group flex gap-4 rounded-xl bg-slate-800 p-5 transition hover:bg-indigo-600">
                    <div class="text-2xl shrink-0">📞</div>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-400 group-hover:text-indigo-100">Phone</p>
                        <p class="font-semibold">+91 98765 43210</p>
                    </div>
                </a>

                <!-- GitHub -->
                <a href="https://github.com/yourusername" target="_blank"
                    class="group flex gap-4 rounded-xl bg-slate-800 p-5 transition hover:bg-indigo-600">
                    <div class="text-2xl shrink-0">💻</div>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-400 group-hover:text-indigo-100">GitHub</p>
                        <p class="font-semibold break-all">github.com/yourusername</p>
                    </div>
                </a>

                <!-- LinkedIn -->
                <a href="https://linkedin.com/in/yourusername" target="_blank"
                    class="group flex gap-4 rounded-xl bg-slate-800 p-5 transition hover:bg-indigo-600">
                    <div class="text-2xl shrink-0">🔗</div>
                    <div class="min-w-0">
                        <p class="text-sm text-slate-400 group-hover:text-indigo-100">LinkedIn</p>
                        <p class="font-semibold break-all">linkedin.com/in/yourusername</p>
                    </div>
                </a>

            </div>
        </div>
    </section>
@endsection


<!-- PROJECT MODAL -->
<div id="project-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="relative w-full max-w-xl rounded-2xl bg-white p-8 shadow-2xl">

        <button id="modal-close"
            class="absolute right-4 top-4 rounded-full p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition">
            ✕
        </button>

        <h3 id="modal-title" class="text-2xl font-bold text-slate-900 mb-4"></h3>

        <p id="modal-description" class="text-slate-600 leading-relaxed"></p>
    </div>
</div>
