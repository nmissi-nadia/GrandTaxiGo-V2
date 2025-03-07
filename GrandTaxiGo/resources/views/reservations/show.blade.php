<x-app-layout>
    <div class="container mx-auto py-8 px-4">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-yellow-500 text-white px-6 py-4">
                <h3 class="text-xl font-bold">Détails de la réservation</h3>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Main Reservation Details (2/3 width) -->
                    <div class="lg:col-span-2">
                        <h4 class="text-lg font-bold">Réservation #{{ $reservation->id }}</h4>

                        <!-- Trip Details -->
                        <div class="mt-6">
                            <h5 class="text-gray-600 font-semibold mb-2">Détails du trajet</h5>
                            @if ($reservation->trajet)
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="mb-2"><span class="font-semibold">Départ:</span> {{ $reservation->trajet->rue_depart }}</p>
                                        <p><span class="font-semibold">Destination:</span> {{ $reservation->trajet->rue_arrivee }}</p>
                                    </div>
                                    <div>
                                        
                                        <p><span class="font-semibold">Heure:</span> {{ $reservation->trajet->heure_depart }}</p>
                                    </div>
                                </div>
                            @else
                                <p class="text-red-500">Détails du trajet indisponibles.</p>
                            @endif
                        </div>

                        <!-- Passenger Details -->
                        <div class="mt-6">
                            <h5 class="text-gray-600 font-semibold mb-2">Passager</h5>
                            @if ($reservation->passager)
                                <p class="mb-2"><span class="font-semibold">Nom:</span> {{ $reservation->passager->name }}</p>
                                <p class="mb-2"><span class="font-semibold">Email:</span> {{ $reservation->passager->email }}</p>
                                
                            @else
                                <p class="text-red-500">Informations sur le passager indisponibles.</p>
                            @endif
                        </div>

                        <!-- Reservation Status -->
                        <div class="mt-6">
                            <h5 class="text-gray-600 font-semibold mb-2">Statut de la réservation</h5>
                            <div class="bg-yellow-500 text-white px-3 py-1 rounded inline-block">
                                {{ ucfirst($reservation->statut) }}
                            </div>

                            @if($reservation->statut === 'Confirmé') <!-- Adjust this condition based on your actual status value -->
                                
                                    @csrf
                                    <a href="/payment" type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                                        Compléter le paiement
                                    </a>
                                
                            @endif
                        </div>
                    </div>

                    <!-- Driver Details (1/3 width) -->
                    <div>
                        <div class="bg-white border rounded-lg overflow-hidden">
                            <div class="bg-gray-600 text-white px-4 py-3">
                                <h5 class="font-semibold">Conducteur</h5>
                            </div>
                            <div class="p-4">
                                @if ($reservation->trajet && $reservation->trajet->chauffeur)
                                    <div class="flex justify-center mb-4">
                                        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center">
                                        <img class="text-xl font-bold" 
                                            src="{{ $reservation->trajet->chauffeur->photo_profil 
                                                        ? asset('storage/' . $reservation->trajet->chauffeur->photo_profil) 
                                                        : asset('images/default-profile.png') }}" 
                                            alt="Photo de profil">

                                        </div>
                                    </div>
                                    <h5 class="text-center font-semibold mb-4">{{ $reservation->trajet->chauffeur->name }}</h5>
                                    <h6 class="text-center font-semibold mb-4">{{ $reservation->trajet->chauffeur->email }}</h5>
                                    <div class="space-y-2">
                                        
                                        <p><i class="fas fa-star mr-2"></i> Note: 5/5</p>
                                    </div>
                                @else
                                    <p class="text-red-500">Informations sur le conducteur indisponibles.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t">
                <a href="{{ route('passager.mesreservation') }}" class="inline-flex items-center text-gray-700 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à mes réservations
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
