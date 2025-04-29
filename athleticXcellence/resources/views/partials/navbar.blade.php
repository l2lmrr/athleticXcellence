<nav class="fixed top-0 left-0 w-full flex items-center justify-between px-6 py-4 bg-black/80 backdrop-blur-sm z-50 border-b border-gray-800">
    <!-- Logo -->
    <a href="{{ route('welcome') }}" class="text-2xl font-bold text-white">
        ATHLETIC<span class="text-gray-400">XCELLENCE</span>
    </a>
    
    <!-- Navigation Links -->
    <div class="hidden md:flex space-x-8">
        <a href="{{ route('welcome') }}" class="text-white hover:text-gray-300 transition-colors">Home</a>
        <a href="#" class="text-white hover:text-gray-300 transition-colors">Services</a>
        <a href="#" class="text-white hover:text-gray-300 transition-colors">About</a>
        <a href="#" class="text-white hover:text-gray-300 transition-colors">Pricing</a>
    </div>
    
    <!-- Auth Links -->
    <div class="flex items-center space-x-4">
        @auth
            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                    <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <svg class="w-4 h-4 text-white" :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div x-show="open" @click.away="open = false" 
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20 border border-gray-200">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        @else
            <!-- Auth Buttons -->
            <a href="{{ route('login') }}" class="px-4 py-2 text-white hover:text-gray-300 transition-colors">
                Sign In
            </a>
            <a href="{{ route('register') }}" class="px-4 py-2 bg-white text-black rounded-md hover:bg-gray-100 transition-colors">
                Register
            </a>
        @endauth
    </div>
</nav>