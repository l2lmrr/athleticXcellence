<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | ATHLETICXCELLENCE</title>
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

        <!-- Forgot Password card -->
        <div class="relative z-10 w-full max-w-md px-8 py-12 bg-white rounded-xl shadow-2xl transform transition-all duration-500 hover:shadow-3xl">
            <div class="text-center mb-10">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Forgot Password?</h1>
                <p class="text-gray-600">Enter your email to reset your password</p>
            </div>

            @if (session('status'))
                <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" required
                           class="input-focus-effect w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-black focus:border-transparent transition-all duration-300"
                           placeholder="your@email.com">
                </div>

                <div>
                    <button type="submit" 
                            class="btn-hover-effect w-full py-3 px-4 bg-black text-white font-medium rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition-all duration-300">
                        Send Password Reset Link
                    </button>
                </div>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="font-medium text-gray-900 hover:text-black transition-colors">
                    Back to login
                </a>
            </div>
        </div>
    </main>
</body>
</html>