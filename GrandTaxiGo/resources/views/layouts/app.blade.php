<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'taxi-yellow': '#f9d71c',
                        'taxi-dark': '#282c34',
                        'taxi-gray': '#4b5563',
                        'taxi-blue': '#4a77c5',
                        'taxi-light': '#e5e7de'
                    }
                }
            }
        }
    </script>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        <footer id="contact" class="bg-[#f9d71c] text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center mb-4">
                        <span class="text-taxi-yellow text-2xl font-bold mr-2">
                            <i class="fas fa-taxi"></i>
                        </span>
                        <span class="text-2xl font-bold">GrandTaxiGo</span>
                    </div>
                    <p class="text-gray-400">La solution innovante pour la réservation de grands taxis interurbains au Maroc.</p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Accueil</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Services</a></li>
                        <li><a href="#fonctionnement" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Comment ça marche</a></li>
                        <li><a href="#temoignages" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Témoignages</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">FAQ</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Légal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Conditions d'utilisation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Politique de confidentialité</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Mentions légales</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-taxi-yellow transition duration-300">Cookies</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-lg font-bold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-taxi-yellow"></i>
                            <span class="text-gray-400">123 Avenue Mohammed V, Casablanca</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2 text-taxi-yellow"></i>
                            <span class="text-gray-400">+212 522 123 456</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2 text-taxi-yellow"></i>
                            <span class="text-gray-400">contact@grandtaxigo.ma</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 GrandTaxiGo. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // For mobile menu links - close menu when a link is clicked
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.add('hidden');
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                if (this.getAttribute('href') !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        window.scrollTo({
                            top: target.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });
    </script>
    </body>
</html>
