@extends('layouts.auth')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 pt-16">
    <div class="w-full max-w-md p-8 space-y-8 bg-white rounded-xl shadow-lg border border-gray-200">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Create Account</h2>
            <p class="mt-2 text-gray-600">Join our community today</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                @foreach ($errors->all() as $error)
                    <p class="text-red-700">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input id="name" name="name" type="text" required autofocus value="{{ old('name') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent transition-all">
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input id="email" name="email" type="email" required value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent transition-all">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent transition-all pr-10">
                    <button type="button" onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <div class="relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent transition-all pr-10">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div>
                <button type="submit" class="w-full py-3 px-4 bg-black text-white font-medium rounded-lg hover:bg-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Register
                </button>
            </div>
        </form>

        <div class="text-center text-sm">
            <p class="text-gray-600">Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-black hover:text-gray-800">Sign in</a>
            </p>
        </div>
    </div>
</div>

<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
@endsection