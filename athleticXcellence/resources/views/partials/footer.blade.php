<footer class="bg-cover bg-center text-white relative" style="background-image: url('{{ asset('storage/HomePgae/bg-portfolio.jpg') }}');">
    <div class="absolute inset-0 bg-black/70"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Brand & Links Section -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left">
                <h3 class="text-3xl font-bold mb-6">ATHLETIC<span class="text-blue-400">XCELLENCE</span></h3>
                <ul class="flex flex-col gap-3">
                    <li>
                        <a href="/home" class="text-lg hover:text-blue-400 transition duration-300 flex items-center justify-center md:justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="/services" class="text-lg hover:text-blue-400 transition duration-300 flex items-center justify-center md:justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Services
                        </a>
                    </li>
                    <li>
                        <a href="/portfolio" class="text-lg hover:text-blue-400 transition duration-300 flex items-center justify-center md:justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                            </svg>
                            Portfolio
                        </a>
                    </li>
                    <li>
                        <a href="/prices" class="text-lg hover:text-blue-400 transition duration-300 flex items-center justify-center md:justify-start">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Prices
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info Section -->
            <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-6">
                <!-- Address 1 -->
                <div class="flex items-center group">
                    <div class="w-10 h-10 bg-blue-600/30 group-hover:bg-blue-600/50 rounded-full flex items-center justify-center mr-4 transition-all duration-300">
                        <img src="{{ asset('storage/HomePgae/icons/Location.png') }}" alt="Location" class="w-6 h-6">
                    </div>
                    <p class="text-lg group-hover:text-blue-400 transition duration-300">Adresse 1</p>
                </div>

                <!-- Address 2 -->
                <div class="flex items-center group">
                    <div class="w-10 h-10 bg-blue-600/30 group-hover:bg-blue-600/50 rounded-full flex items-center justify-center mr-4 transition-all duration-300">
                        <img src="{{ asset('storage/HomePgae/icons/Location.png') }}" alt="Location" class="w-6 h-6">
                    </div>
                    <p class="text-lg group-hover:text-blue-400 transition duration-300">Adresse 2</p>
                </div>

                <!-- Email -->
                <div class="flex items-center group">
                    <div class="w-10 h-10 bg-blue-600/30 group-hover:bg-blue-600/50 rounded-full flex items-center justify-center mr-4 transition-all duration-300">
                        <img src="{{ asset('storage/HomePgae/icons/Email.png') }}" alt="Email" class="w-6 h-6">
                    </div>
                    <a href="mailto:exmp@gmail.com" class="text-lg group-hover:text-blue-400 transition duration-300">exmp@gmail.com</a>
                </div>

                <!-- Phone -->
                <div class="flex items-center group">
                    <div class="w-10 h-10 bg-blue-600/30 group-hover:bg-blue-600/50 rounded-full flex items-center justify-center mr-4 transition-all duration-300">
                        <img src="{{ asset('storage/HomePgae/icons/Call.png') }}" alt="Phone" class="w-6 h-6">
                    </div>
                    <a href="tel:0600000000" class="text-lg group-hover:text-blue-400 transition duration-300">0600000000</a>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 mt-12 pt-8 text-center">
            <p>&copy; {{ date('Y') }} ATHLETICXCELLENCE. All rights reserved.</p>
        </div>
    </div>
</footer>