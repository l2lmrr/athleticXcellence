<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Design Consultation | ATHLETICXCELLENCE</title>
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
                 style="background-image: url('{{ asset('storage/Portfolio/design/design1.jpg') }}');">
            <div class="absolute inset-0 bg-black/80"></div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-4xl font-bold mb-4">DESIGN CONSULTATION</h1>
                <p class="text-lg">Create merchandise that represents your brand</p>
            </div>
        </section>

        <!-- Form Section -->
        <section class="max-w-3xl mx-auto px-8 py-16">
            <div class="bg-black border border-gray-800 rounded-xl p-8">
                <h2 class="text-2xl font-bold mb-8 text-center">Design Consultation Request</h2>
                
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
                        <label for="organization" class="block mb-2">Organization/Team</label>
                        <input type="text" id="organization" class="form-input w-full px-4 py-3 rounded-lg">
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
                        <label class="block mb-4">Products Needed</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                Jerseys
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                T-Shirts
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                Hoodies
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                Hats
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                Bags
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                Other
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label for="design-details" class="block mb-2">Design Details</label>
                        <textarea id="design-details" rows="5" class="form-input w-full px-4 py-3 rounded-lg" placeholder="Describe your design needs, colors, themes, etc."></textarea>
                    </div>
                    
                    <div>
                        <label for="quantity" class="block mb-2">Estimated Quantity</label>
                        <select id="quantity" class="form-input w-full px-4 py-3 rounded-lg bg-black">
                            <option value="">Select quantity range</option>
                            <option value="1-25">1-25 units</option>
                            <option value="26-50">26-50 units</option>
                            <option value="51-100">51-100 units</option>
                            <option value="101-250">101-250 units</option>
                            <option value="251+">251+ units</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="deadline" class="block mb-2">Project Deadline</label>
                        <input type="date" id="deadline" class="form-input w-full px-4 py-3 rounded-lg">
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full py-3 px-6 bg-white text-black font-bold rounded-lg hover:bg-gray-200 transition-colors">
                            Request Consultation
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    @include('partials.footer')
</body>
</html>