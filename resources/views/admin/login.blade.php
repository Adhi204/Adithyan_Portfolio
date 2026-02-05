@extends('layouts.app')

@section('content')
    <div class="max-w-md mx-auto mt-20 p-6 rounded-xl shadow-lg bg-white">
        <h1 class="text-2xl font-bold mb-6 text-center">Admin Login</h1>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm
           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password"
                    class="mt-2 block w-full rounded-lg border-gray-300 px-4 py-3 text-base shadow-sm
           focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
                Login
            </button>
        </form>
    </div>
@endsection
