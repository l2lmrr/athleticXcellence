<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AthleticXcellence</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans relative">
  @include('partials.navbar')

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
     style="background-image: url('{{ asset('storage/HomePgae/white_background.jpg') }}');">
    
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

<section class="relative bg-cover bg-center min-h-screen flex flex-col items-center py-20 px-10" style="background-image: url('{{ asset('storage/HomePgae/bg-portfolio.jpg') }}');">
  
  <!-- Overlay (optional) -->
  <div class="absolute inset-0 bg-black/40"></div>

  <!-- Content -->
  <div class="relative z-10 flex flex-col items-center w-full">
    <!-- Title -->
    <h1 class="text-white text-5xl font-bold mb-16 animate-bounce">PORTFOLIO</h1>
  
    <!-- Top (Production + Design side by side) -->
    <div class="flex flex-wrap justify-center gap-10 w-full animate-fadeInUp">
      
      <!-- Production Slider -->
      <div class="w-[500px] h-auto overflow-hidden rounded-xl bg-black/40 backdrop-blur-sm p-4 relative flex flex-col items-center">
        <a href="/Production" class="text-white text-2xl font-bold mb-4 text-center hover:text-blue-400 transition">
          Production
        </a>
        <div class="relative w-full h-[300px] flex flex-col items-center">
          <div id="production" class="flex w-full h-full transition-transform duration-700 ease-in-out">
            <img src="{{ asset('storage/Portfolio/Production/prod1.jpg') }}" class="w-full h-full object-cover shrink-0 rounded-lg">
            <img src="{{ asset('storage/Portfolio/Production/prod2.jpg') }}" class="w-full h-full object-cover shrink-0 rounded-lg">
            <img src="{{ asset('storage/Portfolio/Production/prod3.jpg') }}" class="w-full h-full object-cover shrink-0 rounded-lg">
          </div>
          <!-- Buttons -->
          <div class="absolute bottom-4 flex justify-center gap-3">
            <button onclick="moveSlider('production', 0)" class="w-3 h-3 rounded-full bg-white"></button>
            <button onclick="moveSlider('production', 1)" class="w-3 h-3 rounded-full bg-gray-400"></button>
            <button onclick="moveSlider('production', 2)" class="w-3 h-3 rounded-full bg-gray-400"></button>
          </div>
        </div>
      </div>

      <!-- Design Slider -->
      <div class="w-[500px] h-auto overflow-hidden rounded-xl bg-black/40 backdrop-blur-sm p-4 relative flex flex-col items-center">
        <a href="/services" class="text-white text-2xl font-bold mb-4 text-center hover:text-blue-400 transition">
          Design
        </a>
        <div class="relative w-full h-[300px] flex flex-col items-center">
          <div id="design" class="flex w-full h-full transition-transform duration-700 ease-in-out">
            <img src="{{ asset('storage/Portfolio/design/design1.jpg') }}" class="w-full h-full object-cover shrink-0 rounded-lg">
            <img src="{{ asset('storage/Portfolio/design/design2.jpg') }}" class="w-full h-full object-cover shrink-0 rounded-lg">
            <img src="{{ asset('storage/Portfolio/design/design3.jpg') }}" class="w-full h-full object-cover shrink-0 rounded-lg">
          </div>
          <!-- Buttons -->
          <div class="absolute bottom-4 flex justify-center gap-3">
            <button onclick="moveSlider('design', 0)" class="w-3 h-3 rounded-full bg-white"></button>
            <button onclick="moveSlider('design', 1)" class="w-3 h-3 rounded-full bg-gray-400"></button>
            <button onclick="moveSlider('design', 2)" class="w-3 h-3 rounded-full bg-gray-400"></button>
          </div>
        </div>
      </div>

    </div>

    <!-- Bottom (Websites centered) -->
    <div class="w-[500px] h-[350px] overflow-hidden rounded-xl bg-black/40 backdrop-blur-sm p-4 relative mt-16 animate-fadeInUp delay-200 flex flex-col items-center">
      <div class="flex justify-center w-full">
        <a href="/services" class="text-white text-2xl font-bold mb-4 text-center hover:text-blue-400 transition">
          Websites
        </a>
      </div>
      <div id="website" class="flex transition-transform duration-700 ease-in-out">
        <img src="{{ asset('storage/Portfolio/websites/web1.jpg') }}" class="w-full shrink-0 rounded-lg">
        <img src="{{ asset('storage/Portfolio/websites/web2.jpg') }}" class="w-full shrink-0 rounded-lg">
        <img src="{{ asset('storage/Portfolio/websites/web3.jpg') }}" class="w-full shrink-0 rounded-lg">
      </div>
      <div class="flex justify-center gap-3 mt-4">
        <button onclick="moveSlider('website', 0)" class="w-3 h-3 rounded-full bg-white"></button>
        <button onclick="moveSlider('website', 1)" class="w-3 h-3 rounded-full bg-gray-400"></button>
        <button onclick="moveSlider('website', 2)" class="w-3 h-3 rounded-full bg-gray-400"></button>
      </div>
    </div>

  </div> <!-- /z-10 content -->

</section>

<section class="relative">

  <!-- Logos Section (White background) -->
  <div class="py-20 px-5 bg-cover bg-center" style="background-image: url('{{ asset('storage/HomePgae/white_background.jpg') }}');">
    <div class="flex flex-col items-center justify-center">
      
      <!-- Title -->
      <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-black">They Trusted US</h2>

      <!-- Logos grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-10 items-center justify-center">
        <img src="{{ asset('storage/Clients/infernal_void.png') }}" alt="Infernal Void" class="w-24 md:w-32 mx-auto transform hover:scale-110 transition duration-500">
        <img src="{{ asset('storage/Clients/logo2.png') }}" alt="Logo 2" class="w-24 md:w-32 mx-auto transform hover:scale-110 transition duration-500">
        <img src="{{ asset('storage/Clients/logo3.png') }}" alt="Logo 3" class="w-24 md:w-32 mx-auto transform hover:scale-110 transition duration-500">
        <img src="{{ asset('storage/Clients/logo4.png') }}" alt="Logo 4" class="w-24 md:w-32 mx-auto transform hover:scale-110 transition duration-500">
        <img src="{{ asset('storage/Clients/logo5.png') }}" alt="Logo 5" class="w-24 md:w-32 mx-auto transform hover:scale-110 transition duration-500">
        <img src="{{ asset('storage/Clients/logo6.png') }}" alt="Logo 6" class="w-24 md:w-32 mx-auto transform hover:scale-110 transition duration-500">
      </div>

    </div>
  </div>
  <footer class="bg-cover bg-center text-white" style="background-image: url('{{ asset('storage/HomePgae/bg-portfolio.jpg') }}');">
    <div class="max-w-7xl mx-auto px-8 py-12 flex flex-col md:flex-row justify-center md:justify-between items-center md:items-start gap-12">
  
      <!-- Left Side -->
      <div class="flex flex-col gap-4 items-center md:items-start text-center md:text-left">
        <h3 class="text-2xl font-bold mb-4 animate-fadeIn">ATHLETICXCELLENCE</h3>
        <ul class="flex flex-col gap-2">
          <li><a href="/home" class="hover:underline transition duration-300">Home</a></li>
          <li><a href="/services" class="hover:underline transition duration-300">Services</a></li>
          <li><a href="/portfolio" class="hover:underline transition duration-300">Portfolio</a></li>
          <li><a href="/prices" class="hover:underline transition duration-300">Prices</a></li>
        </ul>
      </div>
  
      <!-- Right Side -->
      <div class="flex flex-col gap-6 items-center md:items-start text-center md:text-left">
  
        <!-- Adresse 1 -->
        <div class="flex items-center gap-3 animate-fadeInUp">
          <img src="{{ asset('storage/HomePgae/icons/Location.png') }}" alt="Location" class="w-6 h-6">
          <p class="hover:text-blue-400 transition duration-300">Adresse 1</p>
        </div>
  
        <!-- Adresse 2 -->
        <div class="flex items-center gap-3 animate-fadeInUp delay-100">
          <img src="{{ asset('storage/HomePgae/Icons/Location.png') }}" alt="Location" class="w-6 h-6">
          <p class="hover:text-blue-400 transition duration-300">Adresse 2</p>
        </div>
  
        <!-- Email (clickable) -->
        <div class="flex items-center gap-3 animate-fadeInUp delay-200">
          <img src="{{ asset('storage/HomePgae/icons/Email.png') }}" alt="Email" class="w-6 h-6">
          <a href="mailto:exmp@gmail.com" class="hover:underline hover:text-blue-400 transition duration-300">exmp@gmail.com</a>
        </div>
  
        <!-- Phone (clickable) -->
        <div class="flex items-center gap-3 animate-fadeInUp delay-300">
          <img src="{{ asset('storage/HomePgae/icons/Call.png') }}" alt="Phone" class="w-6 h-6">
          <a href="tel:0600000000" class="hover:text-blue-400 transition duration-300">0600000000</a>
        </div>
  
      </div>
  
    </div>
  </footer>
  
</section>



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

        // Port
        function moveSlider(id, index) {
    const slider = document.getElementById(id);
    slider.style.transform = `translateX(-${index * 500}px)`;
  }

  function startAutoSlider(id, slides) {
    let index = 0;
    setInterval(() => {
      index = (index + 1) % slides;
      moveSlider(id, index);
    }, 4000);
  }

  startAutoSlider('production', 3);
  startAutoSlider('design', 3);
  startAutoSlider('website', 3);

  //Cart 
    
    </script>

<style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 1s ease forwards;
    }
    .delay-200 {
      animation-delay: 0.2s;
    }
    </style>
    
</body>
</html>
