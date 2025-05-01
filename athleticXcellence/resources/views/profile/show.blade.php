<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    @include('partials.navbar')

    <div class="min-h-screen pt-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-6">My Profile</h1>
                
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-900 transition-colors">
                            Update Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>