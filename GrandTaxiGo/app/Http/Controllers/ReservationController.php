<?php

namespace App\Http\Controllers;
use App\Models\Reservation;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use App\Mail\ReservationAcceptedMail;
use Illuminate\Support\Facades\Mail;
use App\Events\ReservationUpdated;
use App\Models\Commentaire;
class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['trajet', 'passager'])
        ->where('passager_id', auth()->id()) // Filtre basé sur l'utilisateur connecté
        ;
        $commentaires = Commentaire::where('reservation_id')->get();
        return view('passager.mesreservation', compact('reservations','commentaires'));
    }

    public function show($id)
    {
        $reservation = Reservation::with(['trajet.chauffeur', 'passager'])
            ->findOrFail($id);
        $commentaires = Commentaire::where('reservation_id', $id)->get();
        return view('reservations.show', compact('reservation','commentaires'));
    }

    public function edit($id)
    {
        $reservation = Reservation::findOrFail($id);
        return view('passager.reservation.edit', compact('reservation'));
    }
    public function updateStatut(Request $request, $id)
        {
            $reservation = Reservation::findOrFail($id);
            $user = auth()->user();
            // Changez le statut selon votre logique. Par exemple, vous pouvez alternativer entre 'actif' et 'terminé'.
            $reservation->statut = $reservation->statut === 'en attente' ? 'Confirmé' : 'Annulé';
            $reservation->save();
        
                

                // Envoyer l'email
                Mail::to($reservation->user->email)->send(new ReservationAcceptedMail($reservation));                // Déclencher l'événement
                event(new ReservationUpdated($reservation));
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
                'user' => $reservation->passager->name,
                'trajet' => $reservation->trajet->id, // Remplacez par les champs appropriés
                'date' => $reservation->created_at->format('Y-m-d H:i:s'),
            ]));

            // Sauvegarder le QR Code dans le stockage
            $path = 'qrcodes/' . $reservation->id . '.png';
            Storage::put($path, $qrCode);

            return $path; // Retourne le chemin du fichier QR Code
        }   
}
