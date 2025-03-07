<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use Illuminate\Http\Request;
use App\Models\Ville;

class TrajetController extends Controller
{
    public function index(Request $request)
    {
        $trajets = Trajet::paginate(6);
        $villes = Ville::all();
       
        if($request->has('ville_id')) {
            $trajets = Trajet::where('ville_id', $request->ville_id)->paginate(6);
        }
        return view('trajets.index', compact('trajets', 'villes'));
    }
    public function store(Request $request)
{
    // Validation des données reçues
    $request->validate([
        'rue_depart' => 'required|string|max:255',
        'ville' => 'required|exists:App\Models\Ville,id',
        'rue_arrivee' => 'required|string|max:255',
        'heure_depart' => 'required|date|after:now',
        'places_disponibles' => 'required|integer|min:1',
        'statut' => 'required|in:actif,terminé',
        'prix' => 'required|numeric|min:0',
    ]);

    // Création du trajet
    Trajet::create([
        'chauffeur_id' => auth()->id(), // ID du chauffeur connecté
        'rue_depart' => $request->rue_depart,
        'ville' => $request->ville_id,
        'rue_arrivee' => $request->rue_arrivee,
        'heure_depart' => $request->heure_depart,
        'places_disponibles' => $request->places_disponibles,
        'statut' => $request->statut,
        'prix' => $request->prix,
    ]);

    // Redirection avec message de succès
    return redirect()->back()->with('success', 'Trajet ajouté avec succès !');
}
public function edit($id)
{
    $trajet = Trajet::findOrFail($id);
    return view('trajets.edit', compact('trajet'));

}
        public function update(Request $request, $id)
        {
            $request->validate([
                'ville' => 'required|exists:App\Models\Ville,id',
                'rue_depart' => 'required|string|max:255',
                'rue_arrivee' => 'required|string|max:255',
                'heure_depart' => 'required|date|after:now',
                'places_disponibles' => 'required|integer|min:1',
                'statut' => 'required|in:actif,terminé',
                'prix' => 'required|numeric|min:0',
            ]);

            $trajet = Trajet::findOrFail($id);
            $trajet->update($request->all());

            return redirect()->route('chauffeur.index')->with('success', 'Trajet mis à jour avec succès.');
        }
        public function show($id)
        {
            $trajet = Trajet::with(['chauffeur', 'commentaires.user'])->findOrFail($id);
            $avis = Avis::where('reservation_id', $trajet->id)->get(); // Récupérer les avis associés au trajet
            return view('trajets.show', compact('trajet', 'commentaires', 'avis'));
        }
        public function destroy($id)
        {
            $trajet = Trajet::findOrFail($id);
            $trajet->delete();
            return redirect()->route('chauffeur.index')->with('success', 'Trajet supprimé avec succès.');
        }
}