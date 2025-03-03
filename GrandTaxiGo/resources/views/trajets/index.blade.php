<x-app-layout>
    <div class="container mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <a href="/passager/dashboard" class="text-lg font-semibold text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition">
            Home/
        </a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200 my-4">Trajets Disponibles</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($trajets as $trajet)
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-bold">{{ $trajet->rue_depart }} - {{ $trajet->rue_arrivee }}</h3>
                        <p><strong>Heure de Départ:</strong> {{ $trajet->heure_depart }}</p>
                        <p><strong>Prix:</strong> {{ $trajet->prix }} MAD</p>
                        <form action="" method="POST">
                            @csrf
                            <input type="hidden" name="trajet_id" value="{{ $trajet->id }}">
                            <button type="submit" class="bg-gray-500 hover:bg-yellow-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                                Réserver
                            </button>
                        </form>
                    </div>
                    @endforeach
                
        </div>
        <!-- Affichage de la pagination -->
        <div class="mt-4">
            {{ $trajets->links() }}
        </div>
    </div>
</x-app-layout>
