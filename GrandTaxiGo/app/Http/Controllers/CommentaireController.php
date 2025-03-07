<?php

namespace App\Http\Controllers;

use App\Models\Commentaire;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentaireController extends Controller
{
    // Ajouter un commentaire
    public function store(Request $request, $reservationId)
    {
        $request->validate([
            'contenu' => 'required|string|max:500',
        ]);

        $reservation = Reservation::findOrFail($reservationId);

        Commentaire::create([
            'reservation_id' => $reservation->id,
            'user_id' => Auth::id(),
            'contenu' => $request->input('contenu'),
        ]);

        return redirect()->back()->with('success', 'Commentaire ajouté avec succès.');
    }

    // Récupérer les commentaires pour une réservation
    public function index($reservationId)
    {
        $reservation = Reservation::with('commentaires.user')->findOrFail($reservationId);
        return view('commentaires.index', compact('reservation'));
    }
}
