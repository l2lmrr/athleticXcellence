<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        .floating {
            animation: float 6s ease-in-out infinite;
        }
        .floating-delay-1 {
            animation-delay: 1s;
        }
        .floating-delay-2 {
            animation-delay: 2s;
        }
        .input-focus-effect {
            transition: all 0.3s ease;
        }
        .input-focus-effect:focus {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .btn-hover-effect {
            transition: all 0.3s ease;
        }
        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')
    
    <main class="min-h-screen pt-16 flex items-center justify-center">
        <!-- Background elements -->
        <div class="fixed inset-0 overflow-hidden z-0">
            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-black rounded-full opacity-5 floating"></div>
            <div class="absolute top-1/3 right-1/4 w-40 h-40 bg-black rounded-full opacity-5 floating floating-delay-1"></div>
            <div class="absolute bottom-1/4 left-1/3 w-28 h-28 bg-black rounded-full opacity-5 floating floating-delay-2"></div>
            <div class="absolute bottom-1/3 right-1/3 w-36 h-36 bg-black rounded-full opacity-5 floating"></div>
        </div>

        <!-- Login card -->
        <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white rounded-xl shadow-2xl transform transition-all duration-500 hover:shadow-3xl">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h1>
                <p class="text-gray-600">Sign in to your account</p>
            </div>

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                           class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300"
                           placeholder="Enter your email">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input id="password" name="password" type="password" required
                           class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-black focus:ring-black border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>

                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-gray-700 hover:text-black transition-colors">
                            Forgot password?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                            class="btn-hover-effect w-full py-3 px-4 bg-black text-white font-medium rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition-all duration-300">
                        Sign In
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <p class="text-gray-600">Don't have an account? 
                    <a href="{{ route('register') }}" class="font-medium text-gray-900 hover:text-black transition-colors">
                        Sign up
                    </a>
                </p>
            </div>
        </div>
    </main>
</body>
</html>