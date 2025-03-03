<x-app-layout>
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Modifier le Trajet</h2>
        <form method="POST" action="{{ route('trajets.update', $trajet->id) }}">
            @csrf
            @method('POST') <!-- Changez à 'PUT' si vous utilisez la méthode PUT pour la mise à jour -->
            <div class="mb-4">
                <label for="rue_depart" class="block text-sm font-medium text-gray-700">Rue de départ</label>
                <input type="text" id="rue_depart" name="rue_depart" value="{{ $trajet->rue_depart }}" required class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="rue_arrivee" class="block text-sm font-medium text-gray-700">Rue d'arrivée</label>
                <input type="text" id="rue_arrivee" name="rue_arrivee" value="{{ $trajet->rue_arrivee }}" required class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="heure_depart" class="block text-sm font-medium text-gray-700">Heure de départ</label>
                <input type="datetime-local" id="heure_depart" name="heure_depart" value="{{ $trajet->heure_depart }}" required class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="places_disponibles" class="block text-sm font-medium text-gray-700">Nombre de places disponibles</label>
                <input type="number" id="places_disponibles" name="places_disponibles" value="{{ $trajet->places_disponibles }}" required min="1" class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                <input type="number" id="prix" name="prix" value="{{ $trajet->prix }}" required step="0.01" class="mt-1 p-2 w-full border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
                <select id="statut" name="statut" required class="mt-1 p-2 w-full border border-gray-300 rounded">
                    <option value="actif" {{ $trajet->statut == 'actif' ? 'selected' : '' }}>Actif</option>
                    <option value="terminé" {{ $trajet->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white rounded px-4 py-2">Mettre à jour</button>
        </form>
    </div>
</x-app-layout>