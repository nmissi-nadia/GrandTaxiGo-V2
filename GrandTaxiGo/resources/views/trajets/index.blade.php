<x-app-layout>
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <a href="/passager/dashboard" class="text-lg font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
            Home/
        </a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 my-4">Trajets Disponibles</h1>
        <form method="GET" action="/trajets" class="mx-auto my-6 bg-white shadow-md rounded-lg p-8 space-y-4">
            <label for="ville_id" class="block text-sm font-medium text-gray-700">Filtrer par ville :</label>
            <div class="flex-row">
                <select name="ville_id" id="ville_id" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                    <option value="" selected>Sélectionnez une ville</option>
                    @foreach($villes as $ville)
                        <option value="{{ $ville->id }}" {{ request('ville_id') == $ville->id ? 'selected' : '' }}>
                            {{ $ville->nom }}
                        </option>
                    @endforeach
                </select>
                <!-- Icône pour styliser le select -->
                <div class="absolute inset-y-0 right-0 flex items-center pointer-events-none pr-3">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <button type="submit" class="w-full bg-yellow-500 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Filtrer
            </button>
        </form>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($trajets as $trajet)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h2 class="text-lg font-bold">Chauffeur :{{ $trajet->chauffeur->name }} </h2>
                        <h3 class="text-lg font-bold">Trajet : {{ $trajet->rue_depart }} -- > {{ $trajet->rue_arrivee }}</h3>
                        <p><strong>Heure de Départ:</strong> {{ $trajet->heure_depart }}</p>
                        <p><strong>Prix:</strong> {{ $trajet->prix }} MAD</p>
                        <form action="{{ route('passager.reserver', ['id' => $trajet->id]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="trajet_id" value="{{ $trajet->id }}">
                            <button type="submit" class="bg-gray-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                                Réserver
                            </button>
                        </form>
                        <a href="{{ route('trajets.show', $trajet->id) }}" class="bg-gray-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                            Voir le trajet
                        </a>
                    </div>
                    @endforeach
                
        </div>
        <!-- Affichage de la pagination -->
        <div class="mt-4">
            {{ $trajets->links() }}
        </div>
    </div>
</x-app-layout>
