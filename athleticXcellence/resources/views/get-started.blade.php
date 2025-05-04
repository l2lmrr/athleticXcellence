<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started | ATHLETICXCELLENCE</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .form-input {
            background: transparent;
            border: 1px solid #333;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            border-color: #fff;
            outline: none;
        }
    </style>
</head>
<body class="bg-black text-white">
    @include('partials.navbar')
    
    <main class="min-h-screen pt-24 pb-16">
        <!-- Hero Section -->
        <section class="relative h-64 flex items-center justify-center bg-cover bg-center" 
                 style="background-image: url('{{ asset('storage/HomePgae/bg-portfolio.jpg') }}');">
            <div class="absolute inset-0 bg-black/80"></div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-4xl font-bold mb-4">GET STARTED</h1>
                <p class="text-lg">Begin your journey with AthleticXcellence</p>
            </div>
        </section>

        <!-- Form Section -->
        <section class="max-w-3xl mx-auto px-8 py-16">
            <div class="bg-black border border-gray-800 rounded-xl p-8">
                <h2 class="text-2xl font-bold mb-8 text-center">Web Development Inquiry</h2>
                
                <form class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first-name" class="block mb-2">First Name</label>
                            <input type="text" id="first-name" class="form-input w-full px-4 py-3 rounded-lg">
                        </div>
                        <div>
                            <label for="last-name" class="block mb-2">Last Name</label>
                            <input type="text" id="last-name" class="form-input w-full px-4 py-3 rounded-lg">
                        </div>
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2">Email</label>
                        <input type="email" id="email" class="form-input w-full px-4 py-3 rounded-lg">
                    </div>
                    
                    <div>
                        <label for="phone" class="block mb-2">Phone Number</label>
                        <input type="tel" id="phone" class="form-input w-full px-4 py-3 rounded-lg">
                    </div>
                    
                    <div>
                        <label for="project-type" class="block mb-2">Project Type</label>
                        <select id="project-type" class="form-input w-full px-4 py-3 rounded-lg bg-black">
                            <option value="">Select project type</option>
                            <option value="team-website">Team/Club Website</option>
                            <option value="ecommerce">E-commerce Store</option>
                            <option value="athlete-portfolio">Athlete Portfolio</option>
                            <option value="event-system">Event Registration System</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="message" class="block mb-2">Project Details</label>
                        <textarea id="message" rows="5" class="form-input w-full px-4 py-3 rounded-lg"></textarea>
                    </div>
                    
                    <div>
                        <label for="budget" class="block mb-2">Estimated Budget</label>
                        <select id="budget" class="form-input w-full px-4 py-3 rounded-lg bg-black">
                            <option value="">Select budget range</option>
                            <option value="1k-3k">$1,000 - $3,000</option>
                            <option value="3k-5k">$3,000 - $5,000</option>
                            <option value="5k-10k">$5,000 - $10,000</option>
                            <option value="10k+">$10,000+</option>
                        </select>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full py-3 px-6 bg-white text-black font-bold rounded-lg hover:bg-gray-200 transition-colors">
                            Submit Inquiry
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>