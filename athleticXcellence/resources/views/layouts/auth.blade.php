<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Auth' }} | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .auth-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .auth-card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
        .input-field {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
        }
        .input-field:focus {
            background: rgba(255, 255, 255, 0.2);
        }
        .btn-primary {
            transition: all 0.3s ease;
            background: linear-gradient(to right, #667eea, #764ba2);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 auth-bg">
        <div class="w-full sm:max-w-md px-6 py-8 auth-card rounded-xl overflow-hidden relative">
            <!-- Animated background elements -->
            <div class="absolute -top-20 -left-20 w-40 h-40 bg-purple-300 rounded-full filter blur-xl opacity-20 animate-float"></div>
            <div class="absolute -bottom-20 -right-20 w-40 h-40 bg-blue-300 rounded-full filter blur-xl opacity-20 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-pink-300 rounded-full filter blur-xl opacity-20 animate-float" style="animation-delay: 4s;"></div>
            
            <div class="relative z-10">
                <div class="flex justify-center mb-8">
                    <a href="/">
                        {{-- <x-application-logo class="w-20 h-20 fill-current text-white" /> --}}
                    </a>
                </div>

                {{ $slot }}
            </div>
        </div>
    </div>
</body>
</html>