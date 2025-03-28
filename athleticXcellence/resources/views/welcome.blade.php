<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AthleticXcellence</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .fade-in { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body class="bg-black text-white font-sans relative">
    <nav class="absolute top-0 left-0 w-full flex items-center justify-between px-10 py-4 bg-transparent z-10">
        <div class="text-xl font-bold">ATHLETICXCELLENCE</div>
        <div class="flex space-x-6 text-lg">
            <a href="#" class="hover:text-gray-400 transition-colors">Home</a>
            <a href="#" class="hover:text-gray-400 transition-colors">Services</a>
            <a href="#" class="hover:text-gray-400 transition-colors">About</a>
            <a href="#" class="hover:text-gray-400 transition-colors">Prices</a>
        </div>
        <div class="flex items-center space-x-4">
            <div class="relative">
                <input type="text" class="bg-transparent border border-white rounded-full px-4 py-1 text-sm focus:outline-none focus:border-gray-400" placeholder="Search">
            </div>
            <button class="text-xl">
                <img src="{{ asset('storage/Icons/login.png') }}" alt="Login" class="h-6 w-6">
            </button>
        </div>
    </nav>

    <div class="relative w-full h-screen overflow-hidden">
        <div id="carousel" class="absolute inset-0 w-full h-full">
            <img id="carousel-image" src="{{ asset('storage/HomePgae/image.jpg') }}" alt="Slide" class="w-full h-full object-cover fade-in">
            <div class="absolute inset-0 bg-black opacity-50"></div> 
        </div>
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <button class="dot w-4 h-1 bg-white opacity-50" onclick="changeImage(0)"></button>
            <button class="dot w-4 h-1 bg-white opacity-50" onclick="changeImage(1)"></button>
            <button class="dot w-4 h-1 bg-white opacity-50" onclick="changeImage(2)"></button>
        </div>
    </div>

    <div class="relative w-full h-screen flex items-center px-20 bg-cover bg-center"
     style="background-image: url('{{ asset('storage/HomePgae/Wbackground.png') }}');">
    
    <!-- Text Content -->
    <div class="w-1/2">
        <h2 class="text-6xl font-extrabold text-black leading-tight">
            ELEVATE <br> YOUR GAME <br> TO EXCELLENCE
        </h2>
        <p class="mt-6 text-lg text-black leading-relaxed w-4/5">
            AthleticXcellence is a Moroccan sportswear design and production brand dedicated to 
            creating high-performance, stylish, and sustainable athletic apparel. Inspired by 
            Morocco’s rich culture and landscapes, we blend modern innovation with traditional 
            craftsmanship to deliver durable, functional, and eco-friendly sportswear. Our mission 
            is to empower athletes and fitness enthusiasts while promoting sustainability through 
            ethical practices.
        </p>
    </div>

    <!-- Jersey Image -->
    <div class="absolute right-20 top-1/2 transform -translate-y-1/2 w-1/2 flex justify-end">
        <img src="{{ asset('storage/HomePgae/Jer.png') }}" alt="Jerseys" class="w-[550px]">
    </div>

</div>


    <script>
        const images = [
            "{{ asset('storage/HomePgae/image1.jpg') }}", 
            "{{ asset('storage/HomePgae/image2.jpg') }}", 
            "{{ asset('storage/HomePgae/image3.jpg') }}"
        ];
        let currentIndex = 0;

        function changeImage(index) {
            currentIndex = index;
            document.getElementById("carousel-image").src = images[currentIndex];
            updateDots();
        }

        function updateDots() {
            document.querySelectorAll(".dot").forEach((dot, i) => {
                dot.classList.toggle("opacity-100", i === currentIndex);
            });
        }

        setInterval(() => {
            currentIndex = (currentIndex + 1) % images.length;
            changeImage(currentIndex);
        }, 5000);
    </script>
</body>
</html>
