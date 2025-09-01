<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'BoarSync') }} - Your No 1 Free Piggery Management System</title>

    <!-- Preload Images -->
    <link rel="preload" as="image" href="{{ asset('images/main.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('images/ppg.png') }}">
    <link rel="preload" as="image" href="{{ asset('images/money.png') }}">
    <link rel="preload" as="image" href="{{ asset('images/sales.png') }}">
    <link rel="preload" as="image" href="{{ asset('images/pigg.jpg') }}">

    <link rel="preload" as="image" href="https://images.pexels.com/photos/590022/pexels-photo-590022.jpeg">
    <link rel="preload" as="image" href="https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg">
    <link rel="preload" as="image" href="https://images.pexels.com/photos/590041/pexels-photo-590041.jpeg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Header with Laravel Auth -->
    <header class="fixed w-full bg-white shadow-sm z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="text-2xl font-bold text-blue-600">BoarSync</div>
                <div class="hidden md:flex space-x-6 items-center">
                    <a href="#features" class="text-gray-600 hover:text-blue-600">Features</a>
                    <a href="#about" class="text-gray-600 hover:text-blue-600">About</a>
                    @if (Route::has('filament.boar-sync.auth.login'))
                        @auth
                            <a href="{{ url('/dashboard') }}"
                                class="inline-block px-5 py-1.5 text-blue-600 border border-blue-600 hover:bg-blue-600 hover:text-white rounded-sm text-sm leading-normal transition duration-300">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('filament.boar-sync.auth.login') }}"
                                class="inline-block px-5 py-1.5 text-gray-600 border border-transparent hover:border-blue-600 rounded-sm text-sm leading-normal transition duration-300">
                                Log in
                            </a>

                            @if (Route::has('filament.boar-sync.auth.register'))
                                <a href="{{ route('filament.boar-sync.auth.register') }}"
                                    class="inline-block bg-blue-600 text-white px-6 py-2 rounded-sm hover:bg-blue-700 transition duration-300 text-sm">
                                    Start Now
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-24 pb-12 md:pt-32 bg-gradient-to-b from-blue-50 to-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                        Your No 1 Free Piggery Management System
                    </h1>
                    <h2 class="text-xl md:text-2xl text-gray-600 mb-6">
                        The only Piggery Farm Manager App you Need!
                    </h2>
                    <h3 class="text-lg md:text-xl text-gray-700 mb-8">
                        Increase the Efficiency & Profitability of your Pig Farm
                    </h3>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block bg-blue-600 text-white px-8 py-3 rounded-full text-lg font-semibold hover:bg-blue-700 transition duration-300">
                            Start Now
                        </a>
                    @endif
                </div>
                <div class="md:w-1/2 mt-12 md:mt-0">
                    <img src="{{ asset('images/main.jpg') }}" alt="Pig Farm Management Dashboard"
                        class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Introduction -->
    <section class="py-16 bg-white" id="features">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Use BoarSync Free Piggery Farm Manager Today!</h2>
            <p class="text-xl text-gray-600 mb-12 max-w-3xl mx-auto">
                BoarSync helps small and medium-sized pig farmers manage their pigs from start to finish. It also
                provides them with insight into their profit and helps them monitor their losses.
            </p>

            <div class="grid md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.pexels.com/photos/590022/pexels-photo-590022.jpeg" alt="Collect data"
                        class="w-16 h-16 mx-auto mb-6 rounded-full object-cover">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Collect & Manage Data</h3>
                    <p class="text-gray-600">
                        We translate registered farm activities and data into usable information for your business.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg" alt="Analyse data"
                        class="w-16 h-16 mx-auto mb-6 rounded-full object-cover">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Analyse</h3>
                    <p class="text-gray-600">
                        Quick and accurate insight into your current farm situation in an easy and user-friendly
                        interface.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                    <img src="https://images.pexels.com/photos/590041/pexels-photo-590041.jpeg" alt="Optimize data"
                        class="w-16 h-16 mx-auto mb-6 rounded-full object-cover">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Optimize</h3>
                    <p class="text-gray-600">
                        Optimize and prioritise your workflow in order to increase production and performance targets.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Features -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <!-- Feature 1 Detail -->
            <div class="flex flex-col md:flex-row items-center mb-20">
                <div class="md:w-1/2 pr-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Work smarter with powerful features</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>A tool that brings all the data of your entire pig farm operation together.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>A software built with small and medium scale Pig farmers in mind.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Highly intuitive and easy to use. Start collecting your Pig data no matter the size of
                                your business.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Monitor your farm activities and tasks from anywhere.</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <img src="{{ asset('images/ppg.png') }}" alt="Farm Management Features"
                        class="rounded-lg shadow-xl">
                </div>
            </div>

            <!-- Feature 2 Detail -->
            <div class="flex flex-col md:flex-row-reverse items-center mb-20">
                <div class="md:w-1/2 pl-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">More productivity with less effort</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Monitor and prioritize production targets easily and efficiently.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Work with multiple production branches under a single management account.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Analyse hog production performance from weaning to sale.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Track pig mortality and document report to keep the mortality rate in check.</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <img src="{{ asset('images/money.png') }}" alt="Productivity Features"
                        class="rounded-lg shadow-xl">
                </div>
            </div>

            <!-- Feature 3 Detail -->
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 pr-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Increase profit</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Consolidate performance result over time to track overall growth.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Use collected data and performance results to boost production management.</span>
                        </li>
                        <li class="flex items-start">
                            <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
                            <span>Track or process the removing of undesirable hogs from a group using stored
                                data.</span>
                        </li>
                    </ul>
                </div>
                <div class="md:w-1/2 mt-8 md:mt-0">
                    <img src="{{ asset('images/sales.png') }}" alt="Profit Optimization"
                        class="rounded-lg shadow-xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-blue-600">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-white mb-8">Start using BoarSync?</h2>
            <p class="text-xl text-white mb-8">Start managing your Pig farm today with BoarSync</p>
            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full text-lg font-semibold hover:bg-gray-100 transition duration-300">
                    Get Started Now
                </a>
            @endif
            <div class="mt-12">
                <img src="{{ asset('images/pigg.jpg') }}" alt="Pig Farm Management"
                    class="mx-auto rounded-lg shadow-xl max-w-2xl">
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <a href="#" class="text-blue-600 hover:text-blue-700">
                <i class="fas fa-arrow-up mr-2"></i>Back to top
            </a>
        </div>
    </footer>
</body>

</html>
