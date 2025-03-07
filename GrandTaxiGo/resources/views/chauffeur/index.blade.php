<x-app-layout>
<div class="container mx-auto p-4">
<!-- Dashboard Preview -->

<section class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
           
            
            <div class="bg-yellow-400 rounded-lg shadow-xl overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <div class="bg-taxi-dark text-white p-4 md:w-64">
                        <div class="flex items-center mb-8 p-2">
                        <img src="{{ asset('storage/' . Auth::user()->photo_profil) }}" alt="Photo de profil">
                        <div>
                                <div class="font-bold"> {{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-400">Chauffeur depuis 2024</div>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="bg-taxi-gray bg-opacity-30 p-2 rounded">
                                <i class="fas fa-tachometer-alt mr-2"></i> Tableau de bord
                            </div>
                            <div class="p-2 hover:bg-taxi-gray hover:bg-opacity-30 rounded transition">
                                <i class="fas fa-route mr-2"></i> Mes trajets
                            </div>
                            <div class="p-2 hover:bg-taxi-gray hover:bg-opacity-30 rounded transition">
                                <i class="fas fa-calendar-alt mr-2"></i> Disponibilités
                            </div>
                            
                            <div class="p-2 hover:bg-taxi-gray hover:bg-opacity-30 rounded transition">
                                <i class="fas fa-question-circle mr-2"></i> Aide
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-6 flex-1">
                        <div class="text-center mb-12">
                            <h2 class="text-3xl font-bold text-taxi-dark">Votre tableau de bord personnalisé</h2>
                            <p class="text-taxi-gray mt-4 text-lg">Gérez facilement vos trajets et maximisez vos revenus</p>
                        </div>
                        <div class="flex flex-col md:flex-row items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-taxi-dark mb-4 md:mb-0">Aperçu de l'activité</h3>
                            <div class="flex space-x-2">
                                <button class="bg-taxi-blue text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    <i class="fas fa-bell mr-2"></i> 3
                                </button>
                                <button class="bg-taxi-yellow text-taxi-dark px-4 py-2 rounded hover:bg-yellow-400 transition">
                                    Nouvelle disponibilité
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                            <div class="bg-gray-50 rounded p-4 border-l-4 border-taxi-yellow">
                                <div class="text-taxi-gray text-sm">Réservations aujourd'hui</div>
                                <div class="text-2xl font-bold text-taxi-dark">{{$nombreReservations
                                    
                                }}</div>
                            </div>
                            <div class="bg-gray-50 rounded p-4 border-l-4 border-taxi-blue">
                                <div class="text-taxi-gray text-sm">Revenus Total</div>
                                <div class="text-2xl font-bold text-taxi-dark">{{ $totalRevenue }} MAD</div>
                            </div>
                            <div class="bg-gray-50 rounded p-4 border-l-4 border-green-500">
                                <div class="text-taxi-gray text-sm">Trajets Actifs</div>
                                <div class="text-2xl font-bold text-taxi-dark">{{ $activeTrajets }}</div>
                            </div>
                        </div>
                        
                        <div id="trajet" class="container mx-auto px-4 rounded-[4rem] py-4">
                            <h2 class="text-2xl font-bold mb-4">Mes Trajets</h2>
                                    <div class="overflow-x-auto rounded-[2rem]">
                                        <table class="min-w-full bg-white rounded-[2rem]">
                                            <thead>
                                                <tr class="bg-gray-100 rounded-[8rem] text-gray-900">
                                                    <th class="py-2 px-4 text-left">ID</th>
                                                    <th class="py-2 px-4 text-left">Ville</th>
                                                    <th class="py-2 px-4 text-left">Départ</th>
                                                    <th class="py-2 px-4 text-left">Destination</th>
                                                    <th class="py-2 px-4 text-left">Heure de Départ</th>
                                                    <th class="py-2 px-4 text-left">Places Disponibles</th>
                                                    <th class="py-2 px-4 text-left">Prix</th>
                                                    <th class="py-2 px-4 text-left">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($trajets as $trajet)
                                                <tr class="border-b border-gray-300">
                                                    <td class="py-2 px-4">{{ $trajet->id }}</td>
                                                    <td class="py-2 px-4">{{ $trajet->ville_id }}</td>
                                                    <td class="py-2 px-4">{{ $trajet->rue_depart }}</td>
                                                    <td class="py-2 px-4">{{ $trajet->rue_arrivee }}</td>
                                                    <td class="py-2 px-4">{{ $trajet->heure_depart }}</td>
                                                    <td class="py-2 px-4">{{ $trajet->places_disponibles }}</td>
                                                    <td class="py-2 px-4">{{ $trajet->prix }} MAD</td>
                                                    <td class="py-2 px-4">
                                                        <a href="{{ route('trajets.edit', $trajet->id) }}" class="text-green-600 hover:underline">Modifier</a>
                                                        <form action="{{ route('trajets.destroy', $trajet->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                                        </form>
                                                        <a href="{{ route('trajets.show', $trajet->id) }}" class="bg-gray-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">Voir</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                        </div>
                        <div id="reservation" class="py-8 bg-white rounded-[2rem]">
                            <h2 class="text-2xl font-bold mb-4">Mes Réservations</h2>
                            <div class="overflow-x-auto rounded-[2rem]">
                                <table class="min-w-full bg-white">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-900">
                                            <th class="py-2 px-4 text-left">ID</th>
                                            <th class="py-2 px-4 text-left">Trajet</th>
                                            <th class="py-2 px-4 text-left">Date de Réservation</th>
                                            <th class="py-2 px-4 text-left">Statut</th>
                                            <th class="py-2 px-4 text-left">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reservations as $reservation)
                                        <tr class="border-b border-gray-300">
                                            <td class="py-2 px-4">{{ $reservation->id }}</td>
                                            <td class="py-2 px-4">{{ $reservation->trajet->rue_depart }} - {{ $reservation->trajet->rue_arrivee }}</td>
                                            <td class="py-2 px-4">{{ $reservation->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="py-2 px-4">{{ $reservation->statut }}</td>
                                            <td class="py-2 px-4">
                                                <form action="{{ route('reservations.destroy', ['id' => $reservation->id]) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                                                </form>
                                                <form action="{{ route('reservations.updateStatut', $reservation->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="text-green-600 hover:underline">Confirmer</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-bold text-taxi-dark mb-3">Disponibilités</h4>
                            <div class="bg-gray-50 p-4 rounded">
                                <div class="flex flex-wrap gap-2">
                                    

                                    <!-- Affichage de la disponibilité -->
                                    <div class="bg-gray-900 p-2 rounded border border-taxi-yellow">
                                        <div class="font-bold text-white">Statut de Disponibilité</div>
                                        <div class="text-white text-sm">
                                            {{ Auth::user()->disponible ? 'Disponible' : 'Non Disponible' }}
                                        </div>
                                        
                                    </div>

                                    <div class="bg-white p-2 rounded border border-taxi-yellow flex items-center justify-center">
                                    <form action="{{ route('users.updateDisponibilite', Auth::user()->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-taxi-blue">
                                                Changer Disponibilité
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
        </section>

            <!-- Bouton pour ouvrir le modal -->
                <div class="flex justify-end mb-4">
                    <button id="openModal" class="bg-gray-800 text-white rounded px-4 py-2 hover:bg-blue-700">
                        Ajouter un Trajet
                    </button>
                </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div id="addTripModal" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white w-full max-w-md p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Ajouter un trajet</h2>
                        <form id="addTripForm" method="POST" action="{{ route('trajets.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="ville" class="block text-sm font-medium text-gray-700">Ville de départ</label>
                    <select id="ville" name="ville" required class="mt-1 p-2 w-full border border-gray-300 rounded">
                        @foreach ($villes as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="rue_depart" class="block text-sm font-medium text-gray-700">Rue de départ</label>
                    <input type="text" id="rue_depart" name="rue_depart" required class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="rue_arrivee" class="block text-sm font-medium text-gray-700">Rue d'arrivée</label>
                    <input type="text" id="rue_arrivee" name="rue_arrivee" required class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="heure_depart" class="block text-sm font-medium text-gray-700">Heure de départ</label>
                    <input type="datetime-local" id="heure_depart" name="heure_depart" required class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="places_disponibles" class="block text-sm font-medium text-gray-700">Nombre de places disponibles</label>
                    <input type="number" id="places_disponibles" name="places_disponibles" required min="1" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                    <input type="number" id="prix" name="prix" required step="0.01" class="mt-1 p-2 w-full border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select id="statut" name="statut" required class="mt-1 p-2 w-full border border-gray-300 rounded">
                        <option value="actif">Actif</option>
                        <option value="terminé">Terminé</option>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="closeModal" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Ajouter</button>
                </div>
            </form>

        </div>
    </div>
    <script>
    document.getElementById('openModal').addEventListener('click', () => {
        document.getElementById('addTripModal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('addTripModal').classList.add('hidden');
    });

    // Fermer le modal en cliquant en dehors du contenu
    window.addEventListener('click', (e) => {
        const modal = document.getElementById('addTripModal');
        if (e.target === modal) {
            modal.classList.add('hidden');
        }
    });
</script>

</div>
</x-app-layout>