<?php

namespace App\Http\Controllers;

use App\Models\Avis;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request, $reservationId)
    {
        $request->validate([
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string|max:500',
        ]);

        $reservation = Reservation::findOrFail($reservationId);

        Avis::create([
            'reservation_id' => $reservation->id,
            'user_id' => Auth::id(),
            'note' => $request->input('note'),
            'commentaire' => $request->input('commentaire'),
        ]);

        return redirect()->back()->with('success', 'Avis ajouté avec succès.');
    }
}
