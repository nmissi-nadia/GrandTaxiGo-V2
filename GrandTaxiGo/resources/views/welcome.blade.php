<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GrandTaxiGo - Réservation de Grands Taxis Interurbains</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
</head>
<body class="bg-gray-100 font-sans">
    <!-- Navigation -->
    <nav class="bg-gradient-to-r from-gray-400 via-gray-900 to-taxi-dark text-white shadow-lg fixed w-full z-10">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <div class="flex items-center">
                <img src="{{ asset('storage/img/logotx.png') }}" alt="Logo" class="h-20 w-auto mx-auto object-contain" />
                </div>
                
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="hover:text-taxi-yellow transition duration-300">Accueil</a>
                    <a href="#services" class="hover:text-taxi-yellow transition duration-300">Services</a>
                    <a href="#fonctionnement" class="hover:text-taxi-yellow transition duration-300">Comment ça marche</a>
                    <a href="#temoignages" class="hover:text-taxi-yellow transition duration-300">Témoignages</a>
                    <a href="#contact" class="hover:text-taxi-yellow transition duration-300">Contact</a>
                </div>
                
                <div class="flex space-x-4">
                @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                            >
                                Dashboard
                            </a>
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                                <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 dark:bg-gray-800 dark:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-300 transition duration-150 ease-in-out">
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ml-1">
                                                <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <x-dropdown-link :href="route('profile.edit')" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                    onclick="event.preventDefault();
                                                                this.closest('form').submit();" class="hover:bg-red-100 dark:hover:bg-red-700">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                </x-dropdown>
                        </div>
                           <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="hover:bg-gray-100 dark:hover:bg-gray-700">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();" class="hover:bg-red-100 dark:hover:bg-red-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
                        @else
                    <a
                                href="{{ route('login') }}"
                                class="bg-transparent border border-taxi-yellow text-taxi-yellow px-4 py-2 rounded-lg hover:bg-taxi-yellow hover:text-taxi-dark transition duration-300"
                            >
                                Connexion
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="bg-taxi-yellow text-taxi-dark px-4 py-2 rounded-lg hover:bg-yellow-400 transition duration-300"
                                >
                                    Inscription
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
                
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-button" class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile menu -->
            <div id="mobile-menu" class="md:hidden hidden pb-4">
                <a href="#" class="block py-2 hover:text-taxi-yellow transition duration-300">Accueil</a>
                <a href="#services" class="block py-2 hover:text-taxi-yellow transition duration-300">Services</a>
                <a href="#fonctionnement" class="block py-2 hover:text-taxi-yellow transition duration-300">Comment ça marche</a>
                <a href="#temoignages" class="block py-2 hover:text-taxi-yellow transition duration-300">Témoignages</a>
                <a href="#contact" class="block py-2 hover:text-taxi-yellow transition duration-300">Contact</a>
                <div class="flex flex-col space-y-2 mt-4">
                    <a href="#" class="bg-transparent border border-taxi-yellow text-taxi-yellow px-4 py-2 rounded-lg hover:bg-taxi-yellow hover:text-taxi-dark transition duration-300 text-center">Connexion</a>
                    <a href="#" class="bg-taxi-yellow text-taxi-dark px-4 py-2 rounded-lg hover:bg-yellow-400 transition duration-300 text-center">Inscription</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-taxi-dark to-taxi-gray pt-24 pb-16 md:pt-32 md:pb-24">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-white mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Réservez votre Grand Taxi <span class="text-taxi-yellow">en quelques clics</span></h1>
                <p class="text-lg mb-8">La solution simple et efficace pour vos trajets interurbains. Trouvez un chauffeur disponible pour votre destination et voyagez sereinement.</p>
                
                
            </div>
            
            <div class="md:w-1/2 md:pl-12">
            <img src="{{ asset('storage/img/txi.jpg') }}" alt="Grand Taxi" class="rounded-lg shadow-xl w-full max-w-4xl">

            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="services" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-taxi-dark">Pourquoi choisir GrandTaxiGo?</h2>
                <p class="text-taxi-gray mt-4 text-lg">La meilleure façon de réserver vos trajets interurbains</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-taxi-yellow text-4xl mb-4">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Réservation Facile</h3>
                    <p class="text-taxi-gray">Réservez votre grand taxi en quelques clics depuis votre smartphone ou ordinateur.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-taxi-yellow text-4xl mb-4">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Trajets Interurbains</h3>
                    <p class="text-taxi-gray">Voyagez entre les villes du Maroc avec confort et sécurité.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-taxi-yellow text-4xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Sécurité</h3>
                    <p class="text-taxi-gray">Tous nos chauffeurs sont vérifiés et les véhicules sont régulièrement contrôlés.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-taxi-yellow text-4xl mb-4">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Prix Transparents</h3>
                    <p class="text-taxi-gray">Tarifs clairs et sans surprise pour tous vos trajets.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-taxi-yellow text-4xl mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Disponibilité</h3>
                    <p class="text-taxi-gray">Trouvez des chauffeurs disponibles à tout moment pour répondre à vos besoins.</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-taxi-yellow text-4xl mb-4">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Évaluations</h3>
                    <p class="text-taxi-gray">Évaluez vos chauffeurs et consultez les avis des autres utilisateurs.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works section -->
    <section id="fonctionnement" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-taxi-dark">Comment ça marche?</h2>
                <p class="text-taxi-gray mt-4 text-lg">Simple, rapide et efficace</p>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-start">
                <div class="step flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/4">
                    <div class="bg-taxi-yellow w-16 h-16 rounded-full flex items-center justify-center text-taxi-dark text-2xl font-bold mb-4">1</div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Inscrivez-vous</h3>
                    <p class="text-taxi-gray">Créez votre compte en quelques minutes avec une photo de profil et vos informations personnelles.</p>
                </div>
                
                <div class="step flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/4">
                    <div class="bg-taxi-yellow w-16 h-16 rounded-full flex items-center justify-center text-taxi-dark text-2xl font-bold mb-4">2</div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Réservez un trajet</h3>
                    <p class="text-taxi-gray">Indiquez votre lieu de départ, votre destination et votre date de voyage.</p>
                </div>
                
                <div class="step flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/4">
                    <div class="bg-taxi-yellow w-16 h-16 rounded-full flex items-center justify-center text-taxi-dark text-2xl font-bold mb-4">3</div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Choisissez un chauffeur</h3>
                    <p class="text-taxi-gray">Sélectionnez un chauffeur disponible pour votre trajet en fonction de ses évaluations.</p>
                </div>
                
                <div class="step flex flex-col items-center text-center md:w-1/4">
                    <div class="bg-taxi-yellow w-16 h-16 rounded-full flex items-center justify-center text-taxi-dark text-2xl font-bold mb-4">4</div>
                    <h3 class="text-xl font-bold text-taxi-dark mb-2">Voyagez sereinement</h3>
                    <p class="text-taxi-gray">Profitez de votre trajet et évaluez votre expérience après la course.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials section -->
    <section id="temoignages" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-taxi-dark">Ce que disent nos utilisateurs</h2>
                <p class="text-taxi-gray mt-4 text-lg">Des milliers de voyageurs satisfaits</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <img src="/api/placeholder/60/60" alt="Utilisateur" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="text-lg font-bold text-taxi-dark">Mohammed L.</h4>
                            <div class="text-taxi-yellow">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-taxi-gray">"Service exceptionnel ! J'ai pu réserver un taxi pour mon trajet Casablanca-Rabat très facilement. Le chauffeur était ponctuel et professionnel."</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <img src="/api/placeholder/60/60" alt="Utilisateur" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="text-lg font-bold text-taxi-dark">Fatima B.</h4>
                            <div class="text-taxi-yellow">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-taxi-gray">"Je voyage régulièrement entre Marrakech et Agadir pour mon travail, et GrandTaxiGo a vraiment simplifié mes déplacements. Application très intuitive !"</p>
                </div>
                
                <div class="bg-gray-50 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="flex items-center mb-4">
                        <img src="/api/placeholder/60/60" alt="Utilisateur" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="text-lg font-bold text-taxi-dark">Karim H.</h4>
                            <div class="text-taxi-yellow">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                    <p class="text-taxi-gray">"En tant que chauffeur, cette plateforme m'a permis d'optimiser mes trajets et de trouver des passagers facilement. Interface claire et paiements rapides !"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-taxi-blue text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Prêt à voyager avec GrandTaxiGo?</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">Rejoignez notre communauté et profitez d'un service de réservation de grands taxis moderne et efficace.</p>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
                <a href="#" class="bg-taxi-yellow text-taxi-dark font-bold py-3 px-8 rounded-lg hover:bg-yellow-400 transition duration-300">S'inscrire comme passager</a>
                <a href="#" class="bg-transparent border-2 border-white font-bold py-3 px-8 rounded-lg hover:bg-white hover:text-taxi-blue transition duration-300">Devenir chauffeur</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact" class="bg-taxi-dark text-white py-12">
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