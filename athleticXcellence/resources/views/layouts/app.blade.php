<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen">
    @include('partials.navbar')
    
    <main class="pt-20 pb-10 px-4 sm:px-6 lg:px-8">
        {{ $slot }}
    </main>
</body>
</html>