@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden p-8">
    <div class="text-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Forgot Password</h1>
        <p class="text-gray-600">Enter your email to reset your password</p>
    </div>

    <!-- Session Status -->
    {{-- <x-auth-session-status :status="session('status')" /> --}}

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Email Password Reset Link
            </button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
            Back to login
        </a>
    </div>
</div>
@endsection