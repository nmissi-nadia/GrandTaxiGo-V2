<x-app-layout>
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
<div class="container mx-auto p-4">

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-taxi-gray to-taxi-dark pt-24 pb-16 md:pt-32 md:pb-24">
        <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
            <div class="md:w-1/2 text-white mb-8 md:mb-0">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Augmentez vos revenus avec <span class="text-yellow-500">GrandTaxiGo</span></h1>
                <p class="text-lg mb-8">Rejoignez notre plateforme de réservation de grands taxis et gérez facilement vos trajets interurbains. Plus de clients, moins d'attente.</p>
                
                <div class="flex flex-col md:flex-row space-y-4 md:space-y-0 md:space-x-4">
                    <a href="{{route(chauffeur.index)}}" class="bg-yellow-500 text-gray-900 font-bold py-3 px-8 rounded-lg hover:bg-yellow-400 transition duration-300 text-center">Votre Espace</a>
                    <a href="#fonctionnement" class="bg-transparent border border-white text-white font-bold py-3 px-8 rounded-lg hover:bg-white hover:text-gray-900 transition duration-300 text-center">En savoir plus</a>
                </div>
            </div>
            
            <div class="md:w-1/2 md:pl-12">
            <img src="{{ asset('storage/img/txi.jpg') }}" alt="Grand Taxi" class="rounded-lg shadow-xl w-full max-w-4xl">
            </div>
        </div>
    </header>

    <!-- Stats Section -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-gray-100 rounded-lg p-6 text-center shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">2500+</div>
                    <div class="text-gray-600">Chauffeurs actifs</div>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-6 text-center shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">15000+</div>
                    <div class="text-gray-600">Réservations par mois</div>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-6 text-center shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">40+</div>
                    <div class="text-gray-600">Villes desservies</div>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-6 text-center shadow-md">
                    <div class="text-3xl font-bold text-blue-600 mb-2">25%</div>
                    <div class="text-gray-600">Augmentation de revenus*</div>
                </div>
            </div>
            <div class="text-center text-xs text-gray-600 mt-4">*Moyenne constatée chez nos chauffeurs après 3 mois d'utilisation</div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="avantages" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Pourquoi rejoindre GrandTaxiGo?</h2>
                <p class="text-gray-600 mt-4 text-lg">Les avantages d'être chauffeur partenaire</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-100 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-yellow-500 text-4xl mb-4">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Revenus garantis</h3>
                    <p class="text-gray-600">Augmentez vos revenus avec un taux d'occupation optimal de votre véhicule et moins de trajets à vide.</p>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-yellow-500 text-4xl mb-4">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Flexibilité totale</h3>
                    <p class="text-gray-600">Vous restez maître de votre emploi du temps. Définissez vos propres horaires et trajets.</p>
                </div>
                
                <div class="bg-gray-100 rounded-lg p-6 shadow-md hover:shadow-lg transition duration-300">
                    <div class="text-yellow-500 text-4xl mb-4">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Plus de clients</h3>
                    <p class="text-gray-600">Accédez à une large base de clients qui recherchent des trajets interurbains sécurisés et fiables.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it works Section -->
    <section id="fonctionnement" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Comment ça fonctionne?</h2>
                <p class="text-gray-600 mt-4 text-lg">Devenir chauffeur partenaire en quelques étapes simples</p>
            </div>
            
            <div class="flex flex-col md:flex-row justify-between items-start">
                <div class="flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/4">
                    <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center text-gray-900 text-2xl font-bold mb-4">1</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Inscription</h3>
                    <p class="text-gray-600">Créez votre compte chauffeur en fournissant vos informations personnelles et professionnelles.</p>
                </div>
                <div class="flex flex-col items-center text-center mb-8 md:mb-0 md:w-1/4">
                    <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center text-gray-900 text-2xl font-bold mb-4">2</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Vérification</h3>
                    <p class="text-gray-600">Soumettez vos documents (permis, carte grise, assurance) pour la vérification.</p>
                </div>
            </div>
        </div>
    </section>
</div>
</x-app-layout>
