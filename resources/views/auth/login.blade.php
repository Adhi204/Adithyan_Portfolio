@extends('layouts.app')

@section('content')
<div class="flex justify-center">
    <div class="w-full max-w-md">

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800">Owner Login</h1>
            <p class="text-slate-500 mt-2">
                Authorized access only
            </p>
        </div>

        <!-- Login Card -->
        <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8">

            <!-- Errors -->
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-50 p-4 text-sm text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">
                        Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-800 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">
                        Password
                    </label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        class="mt-1 w-full rounded-lg border border-slate-300 px-4 py-2 text-slate-800 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center space-x-2 text-sm text-slate-600">
                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500"
                        >
                        <span>Remember me</span>
                    </label>
                </div>

                <!-- Submit -->
                <button
                    type="submit"
                    class="w-full rounded-lg bg-indigo-600 py-2.5 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition"
                >
                    Log in
                </button>
            </form>
        </div>

        <!-- Hint -->
        <p class="mt-6 text-center text-xs text-slate-400">
            This area is restricted to the site owner.
        </p>

    </div>
</div>
@endsection
