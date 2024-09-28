<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Car Rental</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .float { animation: float 3s ease-in-out infinite; }
        .bg-car-image {
            background-image: url('/images/bg-img.jpeg');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <header class="bg-blue-600 text-white p-4 sticky top-0 z-10">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">Car Rental</h1>
            <a href="{{route('home')}}" class="text-white hover:text-gray-300">Home</a>
            <nav>
                <a href="#about" class="mx-2 hover:underline">About</a>
                <a href="#team" class="mx-2 hover:underline">Team</a>
                <a href="#values" class="mx-2 hover:underline">Values</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-8 p-4">
        <section id="about" class="mb-16">
            <h2 class="text-4xl font-bold mb-4 text-center">About Us</h2>
            <div class="bg-white rounded-lg shadow-lg p-6 md:p-8 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-4 md:mb-0">
                    <div class="bg-car-image h-64 md:h-96 rounded-lg float"></div>
                </div>
                <div class="md:w-1/2 md:pl-8">
                    <p class="text-lg mb-4">At Car Rental, we're passionate about providing you with the perfect vehicle for your journey. With over 20 years of experience, we've become a trusted name in the car rental industry.</p>
                    <p class="text-lg">Our diverse fleet of vehicles, from compact cars to luxurious SUVs, ensures that we have the right car for every occasion and budget.</p>
                </div>
            </div>
        </section>

        <section id="team" class="mb-16">
            <h2 class="text-4xl font-bold mb-4 text-center">Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="/api/placeholder/150/150" alt="Team member 1" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Jane Doe</h3>
                    <p class="text-gray-600">CEO & Founder</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="/api/placeholder/150/150" alt="Team member 2" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">John Smith</h3>
                    <p class="text-gray-600">Head of Operations</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                    <img src="/api/placeholder/150/150" alt="Team member 3" class="rounded-full mx-auto mb-4">
                    <h3 class="text-xl font-semibold mb-2">Emily Brown</h3>
                    <p class="text-gray-600">Customer Experience Manager</p>
                </div>
            </div>
        </section>

        <section id="values" class="mb-16">
            <h2 class="text-4xl font-bold mb-4 text-center">Our Values</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-blue-100 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Quality</h3>
                    <p>We maintain our vehicles to the highest standards.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-blue-100 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Reliability</h3>
                    <p>Count on us for punctual and dependable service.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-blue-100 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Innovation</h3>
                    <p>We constantly evolve to meet changing customer needs.</p>
                </div>
                <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:bg-blue-100 transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold mb-2">Customer-Centric</h3>
                    <p>Your satisfaction is our top priority.</p>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-gray-800 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2023 Car Rental. All rights reserved.</p>
            <p class="mt-2">123 Rental Street, City, Country | Phone: +1 (555) 123-4567 | Email: info@carrentals.com</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>