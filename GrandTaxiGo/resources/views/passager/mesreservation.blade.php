<x-app-layout>
    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <a href="/passager/dashboard" class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Home/</a><h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Mes Réservations</h1>
        

        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <table class="w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-medium">ID</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-medium">Nom du Passager</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-medium">Date de Réservation</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-medium">Statut</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-medium">Trajet</th>
                        <th class="px-4 py-2 text-left text-gray-800 dark:text-gray-200 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservations as $reservation)
                    <tr class="border-b border-gray-300 dark:border-gray-700">
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $reservation->id }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $reservation->passager->name }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $reservation->trajet->heure_depart }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $reservation->statut }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300">{{ $reservation->trajet->rue_depart }}---  >{{ $reservation->trajet->rue_arrivee }}</td>
                        <td class="px-4 py-2 text-gray-700 dark:text-gray-300 flex items-center space-x-2">
                            <a href="/reservations/{{ $reservation->id }}" 
                               class="bg-blue-500 hover:bg-blue-600 text-white font-medium py-1 px-3 rounded-md shadow transition">
                               Voir
                            </a>
                            <a href="{{ route('reservations.annuler', $reservation->id) }}" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-1 px-3 rounded-md shadow transition"
                            onclick="event.preventDefault(); document.getElementById('annuler-form-{{ $reservation->id }}').submit();">
                            Annuler
                            </a>
                            <form id="annuler-form-{{ $reservation->id }}" action="{{ route('reservations.annuler', $reservation->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('PATCH')
                            </form>
                            <form action="{{ route('reservations.destroy', ['id' => $reservation->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white font-medium py-1 px-3 rounded-md shadow transition">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
    </div>
</x-app-layout>
