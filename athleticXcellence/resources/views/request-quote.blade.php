<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Quote | ATHLETICXCELLENCE</title>
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
                 style="background-image: url('{{ asset('storage/Portfolio/Production/prod1.jpg') }}');">
            <div class="absolute inset-0 bg-black/80"></div>
            <div class="relative z-10 text-center px-4">
                <h1 class="text-4xl font-bold mb-4">REQUEST A QUOTE</h1>
                <p class="text-lg">Get pricing for your custom apparel needs</p>
            </div>
        </section>

        <!-- Form Section -->
        <section class="max-w-3xl mx-auto px-8 py-16">
            <div class="bg-black border border-gray-800 rounded-xl p-8">
                <h2 class="text-2xl font-bold mb-8 text-center">Apparel Production Quote Request</h2>
                
                <form method="POST" action="{{ route('store.request-quote') }}" class="space-y-6" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="first-name" class="block mb-2">First Name</label>
                            <input type="text" id="first-name" name="first_name" class="form-input w-full px-4 py-3 rounded-lg" required>
                        </div>
                        <div>
                            <label for="last-name" class="block mb-2">Last Name</label>
                            <input type="text" id="last-name" name="last_name" class="form-input w-full px-4 py-3 rounded-lg" required>
                        </div>
                    </div>
                    
                    <div>
                        <label for="organization" class="block mb-2">Organization/Team</label>
                        <input type="text" id="organization" name="organization" class="form-input w-full px-4 py-3 rounded-lg">
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2">Email</label>
                        <input type="email" id="email" name="email" class="form-input w-full px-4 py-3 rounded-lg" required>
                    </div>
                    
                    <div>
                        <label for="phone" class="block mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="form-input w-full px-4 py-3 rounded-lg" required>
                    </div>
                    
                    <div>
                        <label class="block mb-4">Apparel Type</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="apparel_types[]" value="Jerseys" class="mr-2">
                                Jerseys
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="apparel_types[]" value="Shorts" class="mr-2">
                                Shorts
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="apparel_types[]" value="T-Shirts" class="mr-2">
                                T-Shirts
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="apparel_types[]" value="Hoodies" class="mr-2">
                                Hoodies
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="apparel_types[]" value="Jackets" class="mr-2">
                                Jackets
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" name="apparel_types[]" value="Other" class="mr-2">
                                Other
                            </label>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="quantity" class="block mb-2">Quantity Needed</label>
                            <input type="number" id="quantity" name="quantity" class="form-input w-full px-4 py-3 rounded-lg" required>
                        </div>
                        div>
                        <label for="deadline" class="block mb-2">Delivery Deadline</label>
                        <input type="date" 
                               id="deadline" 
                               name="deadline" 
                               class="form-input w-full px-4 py-3 rounded-lg"
                               min="{{ date('Y-m-d') }}"
                               onchange="validateDate(this)">
                    </div>
                    </div>
                    
                    <div>
                        <label for="design-files" class="block mb-2">Design Files (if available)</label>
                        <input type="file" id="design-files" name="design_files" class="form-input w-full px-4 py-3 rounded-lg border-dashed">
                    </div>
                    
                    <div>
                        <label for="additional-notes" class="block mb-2">Additional Notes</label>
                        <textarea id="additional-notes" name="additional_notes" rows="3" class="form-input w-full px-4 py-3 rounded-lg"></textarea>
                    </div>
                    
                    <div class="pt-4">
                        <button type="submit" class="w-full py-3 px-6 bg-white text-black font-bold rounded-lg hover:bg-gray-200 transition-colors">
                            Request Quote
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    @include('partials.footer')


    <script>
        function validateDate(input) {
            const selectedDate = new Date(input.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (selectedDate < today) {
                alert('Please select a date today or in the future');
                input.value = '';
            }
        }
        </script>
</body>
</html>