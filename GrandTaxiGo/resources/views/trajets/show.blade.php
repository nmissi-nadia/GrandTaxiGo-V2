<!-- page pour afficher les details d'une trajets avec les commentaires concernant cette trajets -->
<x-app-layout>
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold mb-4">Détails du Trajet</h2>
    
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h3 class="text-xl font-semibold">Trajet : {{ $trajet->ville->nom }}</h3>
        <p><strong>Départ :</strong> {{ $trajet->rue_depart }}</p>
        <p><strong>Arrivée :</strong> {{ $trajet->rue_arrivee }}</p>
        <p><strong>Date et Heure :</strong> {{ $trajet->date_heure_depart }}</p>
        <p><strong>Chauffeur :</strong> {{ $trajet->chauffeur->name }}</p>
    </div>

    <h3 class="text-xl font-semibold mb-2">Commentaires</h3>
    <div class="bg-gray-100 rounded-lg p-4 mb-6">
        @if($commentaires->isNotEmpty())
            @foreach ($commentaires as $commentaire)
                <div class="mb-4">
                    <p class="font-semibold">{{ $commentaire->user->name }} :</p>
                    <p>{{ $commentaire->contenu }}</p>
                </div>
            @endforeach
        @else
            <p>Aucun commentaire disponible.</p>
        @endif
    </div>

    <h3 class="text-xl font-semibold mb-2">Avis</h3>
    <div class="bg-gray-100 rounded-lg p-4 mb-6">
        @if($avis->isNotEmpty())
            @foreach ($avis as $avisItem)
                <div class="mb-4">
                    <p class="font-semibold">{{ $avisItem->user->name }} (Note : {{ $avisItem->note }}) :</p>
                    <p>{{ $avisItem->commentaire }}</p>
                </div>
            @endforeach
        @else
            <p>Aucun avis disponible.</p>
        @endif
    </div>

    <h3 class="text-xl font-semibold mb-2">Ajouter un Avis</h3>
    <form method="POST" action="{{ route('avis.store', $trajet->id) }}">
        @csrf
        <div class="mb-4">
            <label for="note" class="block font-semibold mb-2">Note :</label>
            <select name="note" id="note" required class="border rounded-lg px-3 py-2">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="commentaire" class="block font-semibold mb-2">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" class="border rounded-lg px-3 py-2" placeholder="Votre commentaire"></textarea>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">Soumettre</button>
    </form>
</div>
</x-app-layout>