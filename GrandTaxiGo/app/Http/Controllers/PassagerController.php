<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;

class PassagerController extends Controller
{
    // Afficher la liste des trajets disponibles
    public function index()
    {

        $trajets = Trajet::where('statut', 'actif')->where('places_disponibles', '>', 0)->get();
        return view('passager.dashboard');
    }

    // Réserver un trajet
    public function reserver(Request $request, $idTrajet)
    {
        $trajet = Trajet::findOrFail($idTrajet);

        

        Reservation::create([
            'passager_id' => auth()->id(),
            'trajet_id' => $idTrajet,
            'statut' => 'en attente',
        ]);

        $trajet->update([
            'places_disponibles' => $trajet->places_disponibles - 1,
        ]);

        return redirect()->back();
    }

    // Afficher les réservations du passager
    public function reservations()
    {
        $reservations = Reservation::with('passager','trajet')->where('passager_id', auth()->id())->get();
        return view('passager.mesreservation', compact('reservations'));
    }

    // Annuler une réservation
    public function annulerReservation($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->statut !== 'confirmée') {
            return back()->with('error', 'Cette réservation ne peut pas être annulée.');
        }

        $trajet = $reservation->trajet;
        $trajet->update([
            'places_disponibles' => $trajet->places_disponibles + $reservation->places_reservees,
        ]);

        $reservation->update(['statut' => 'annulée']);

        return back()->with('success', 'Réservation annulée avec succès.');
    }
}
