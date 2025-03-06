<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['trajet', 'passager'])
        ->where('passager_id', auth()->id()) // Filtre basé sur l'utilisateur connecté
        ;
        
        return view('passager.mesreservation', compact('reservations'));
    }

    public function show($id)
    {
        $reservation = Reservation::with(['trajet.chauffeur', 'passager'])
            ->findOrFail($id);

        return view('reservations.show', compact('reservation'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('passager.reservation.edit', compact('reservation'));
    }
    public function updateStatut(Request $request, $id)
        {
            $reservation = Reservation::findOrFail($id);

            // Changez le statut selon votre logique. Par exemple, vous pouvez alternativer entre 'actif' et 'terminé'.
            $reservation->statut = $reservation->statut === 'actif' ? 'terminé' : 'actif';
            $reservation->save();

            return redirect()->back()->with('success', 'Statut de la réservation mis à jour.');
        }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->back();
    }
            public function annuler($id)
        {
            $reservation = Reservation::findOrFail($id); 
            $reservation->statut = 'Annulé'; 
            $reservation->save();
            return redirect()->back(); 
        }
        public function generateQRCode(Reservation $reservation)
{
    // Générer un QR Code contenant les informations de la réservation
    $qrCode = QrCode::size(200)->generate(json_encode([
        'id' => $reservation->id,
        'user' => $reservation->user->name,
        'trajet' => $reservation->trajet->nom, // Remplacez par les champs appropriés
        'date' => $reservation->created_at->format('Y-m-d H:i:s'),
    ]));

    // Sauvegarder le QR Code dans le stockage
    $path = 'qrcodes/' . $reservation->id . '.png';
    Storage::put($path, $qrCode);

    return $path; // Retourne le chemin du fichier QR Code
}   
}
