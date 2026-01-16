<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'My Portfolio' }}</title>

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-slate-50 text-slate-800 antialiased">

    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex h-16 items-center justify-between">

                <!-- Logo -->
                <a href="/" class="flex items-center">
                    <span class="text-2xl font-extrabold bg-gradient-to-r from-indigo-600 to-blue-500 bg-clip-text text-transparent">
                        My Portfolio
                    </span>
                </a>

                <!-- Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    @php
                        $link = 'relative text-sm font-medium transition';
                        $active = 'text-indigo-600 after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-full after:bg-indigo-600';
                        $inactive = 'text-slate-600 hover:text-slate-900';
                    @endphp

                    @if (!request()->routeIs('login'))

                     <a href="/" class="{{ request()->is('/') ? $active : $inactive }} {{ $link }}">Home</a>
                    <a href="/portfolio" class="{{ request()->is('portfolio') ? $active : $inactive }} {{ $link }}">Portfolio</a>
                    <a href="/skills" class="{{ request()->is('skills') ? $active : $inactive }} {{ $link }}">Skills</a>
                    <a href="/resume" class="{{ request()->is('resume') ? $active : $inactive }} {{ $link }}">Resume</a>
                        @endif
                </div>

                <!-- CTA -->
                <a href="/contact"
                   class="hidden md:inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition">
                    Contact Me
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 w-full max-w-7xl mx-auto px-6 py-12">
        <div class="rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-200 bg-white">
        <div class="max-w-7xl mx-auto px-6 py-8 text-center text-sm text-slate-500">
            © {{ date('Y') }} My Portfolio. Built with Laravel & Tailwind.
        </div>
    </footer>

</body>
</html>
