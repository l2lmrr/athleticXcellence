<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .service-card {
            transition: all 0.3s ease;
            border: 1px solid #333;
        }
        .service-card:hover {
            transform: translateY(-5px);
            border-color: #fff;
            box-shadow: 0 10px 20px rgba(255,255,255,0.1);
        }
        .slider-container {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .slider-track {
            display: flex;
            transition: transform 0.7s ease-in-out;
        }
        .slider-slide {
            min-width: 100%;
        }
        .slider-nav {
            position: absolute;
            bottom: 1rem;
            left: 0;
            right: 0;
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
        .slider-dot {
            width: 0.75rem;
            height: 0.75rem;
            border-radius: 9999px;
            background-color: #555;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .slider-dot.active {
            background-color: #fff;
            transform: scale(1.2);
        }
        .process-step {
            border: 1px solid #333;
        }
        .process-step:hover {
            border-color: #fff;
        }
    </style>
</head>
<body class="bg-black text-white">
    @include('partials.navbar')
    
    <main class="min-h-screen pt-24 pb-16">
        <!-- Hero Section -->
        <section class="relative h-96 flex items-center justify-center bg-cover bg-center" 
                 style="background-image: url('{{ asset('storage/HomePgae/bg-portfolio.jpg') }}');">
            <div class="absolute inset-0 bg-black/90"></div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-5xl font-bold mb-6">SPORTS APPAREL & DIGITAL SOLUTIONS</h1>
                <p class="text-xl max-w-2xl mx-auto text-gray-300">
                    Premium sportswear production and custom web solutions for athletic brands
                </p>
            </div>
        </section>

        <!-- Services Grid -->
        <section class="max-w-7xl mx-auto px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Apparel Production -->
                <div class="service-card bg-black rounded-xl overflow-hidden">
                    <div class="slider-container h-64">
                        <div class="slider-track" id="slider-production">
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/Production/prod1.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/Production/prod2.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/Production/prod3.jpg') }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="slider-nav">
                            <button class="slider-dot active" data-slider="production" data-index="0"></button>
                            <button class="slider-dot" data-slider="production" data-index="1"></button>
                            <button class="slider-dot" data-slider="production" data-index="2"></button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Apparel Production</h3>
                        <p class="text-gray-400 mb-4">
                            Custom sportswear and team uniforms designed for performance and style
                        </p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Custom jersey design & production
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Team uniforms and athletic wear
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Performance fabric technology
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Sublimation printing
                            </li>
                        </ul>
                        <a href="{{ route('request-quote') }}" class="block w-full py-3 px-6 bg-white text-black font-bold text-center rounded-lg hover:bg-gray-200 transition-colors">
                            Request Quote
                        </a>
                    </div>
                </div>

                <!-- Merch Design -->
                <div class="service-card bg-black rounded-xl overflow-hidden">
                    <div class="slider-container h-64">
                        <div class="slider-track" id="slider-design">
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/design/design1.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/design/design2.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/design/design3.jpg') }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="slider-nav">
                            <button class="slider-dot active" data-slider="design" data-index="0"></button>
                            <button class="slider-dot" data-slider="design" data-index="1"></button>
                            <button class="slider-dot" data-slider="design" data-index="2"></button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Merchandise Design</h3>
                        <p class="text-gray-400 mb-4">
                            Custom athletic merchandise to build your brand and fan engagement
                        </p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Team logo and branding
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Custom t-shirts and hoodies
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Athletic accessories
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Limited edition collections
                            </li>
                        </ul>
                        <a href="{{ route('design-consultation') }}" class="block w-full py-3 px-6 bg-white text-black font-bold text-center rounded-lg hover:bg-gray-200 transition-colors">
                            Design Consultation
                        </a>
                    </div>
                </div>

                <!-- Website Services -->
                <div class="service-card bg-black rounded-xl overflow-hidden">
                    <div class="slider-container h-64">
                        <div class="slider-track" id="slider-website">
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/websites/web1.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/websites/web2.jpg') }}" class="w-full h-full object-cover">
                            </div>
                            <div class="slider-slide">
                                <img src="{{ asset('storage/Portfolio/websites/web3.jpg') }}" class="w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="slider-nav">
                            <button class="slider-dot active" data-slider="website" data-index="0"></button>
                            <button class="slider-dot" data-slider="website" data-index="1"></button>
                            <button class="slider-dot" data-slider="website" data-index="2"></button>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-3">Athletic Websites</h3>
                        <p class="text-gray-400 mb-4">
                            Professional websites for teams, athletes, and sports brands
                        </p>
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Team/Club websites
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                E-commerce for merchandise
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Athlete portfolio sites
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-check text-white mr-2"></i>
                                Mobile-responsive design
                            </li>
                        </ul>
                        <a href="{{ route('get-started') }}" class="block w-full py-3 px-6 bg-white text-black font-bold text-center rounded-lg hover:bg-gray-200 transition-colors">
                            Get Started
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Process Section -->
        <section class="py-16 bg-black border-t border-b border-gray-800">
            <div class="max-w-7xl mx-auto px-8">
                <h2 class="text-3xl font-bold text-center mb-12">Our Production Process</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="process-step text-center p-6 rounded-lg bg-black hover:bg-gray-900 transition-colors">
                        <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">
                            1
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Consultation</h3>
                        <p class="text-gray-400">Understand your team's needs and vision</p>
                    </div>
                    <div class="process-step text-center p-6 rounded-lg bg-black hover:bg-gray-900 transition-colors">
                        <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">
                            2
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Design</h3>
                        <p class="text-gray-400">Create custom apparel and digital concepts</p>
                    </div>
                    <div class="process-step text-center p-6 rounded-lg bg-black hover:bg-gray-900 transition-colors">
                        <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">
                            3
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Production</h3>
                        <p class="text-gray-400">High-quality manufacturing of your products</p>
                    </div>
                    <div class="process-step text-center p-6 rounded-lg bg-black hover:bg-gray-900 transition-colors">
                        <div class="w-16 h-16 bg-white text-black rounded-full flex items-center justify-center mx-auto mb-4 font-bold text-2xl">
                            4
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Delivery</h3>
                        <p class="text-gray-400">Timely shipping and digital deployment</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-16 bg-white text-black">
            <div class="max-w-4xl mx-auto text-center px-4">
                <h2 class="text-3xl font-bold mb-6">Ready to Elevate Your Brand?</h2>
                <p class="text-xl mb-8 max-w-2xl mx-auto text-gray-700">
                    Professional solutions for athletes and teams looking to stand out.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('get-started') }}" class="block px-8 py-3 bg-black text-white font-bold rounded-lg hover:bg-gray-800 transition-colors">
                        Get Started
                    </a>
                    <a href="tel:+1234567890" class="block px-8 py-3 border-2 border-black text-black font-bold rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-phone mr-2"></i> Call Now
                    </a>
                </div>
            </div>
        </section>
    </main>

    @include('partials.footer')

    <script>
        // Initialize all sliders
        document.addEventListener('DOMContentLoaded', function() {
            // Setup slider navigation
            document.querySelectorAll('[data-slider]').forEach(dot => {
                dot.addEventListener('click', function() {
                    const sliderId = this.getAttribute('data-slider');
                    const index = parseInt(this.getAttribute('data-index'));
                    moveSlider(sliderId, index);
                });
            });

            // Auto-rotate sliders
            const sliders = ['production', 'design', 'website'];
            sliders.forEach(sliderId => {
                let currentIndex = 0;
                setInterval(() => {
                    currentIndex = (currentIndex + 1) % 3;
                    moveSlider(sliderId, currentIndex);
                }, 5000);
            });
        });

        function moveSlider(sliderId, index) {
            const slider = document.getElementById(`slider-${sliderId}`);
            const translateValue = -index * 100;
            slider.style.transform = `translateX(${translateValue}%)`;
            
            // Update active dot
            document.querySelectorAll(`[data-slider="${sliderId}"]`).forEach((dot, i) => {
                if (i === index) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }
    </script>
</body>
</html>