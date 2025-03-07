<?php
namespace App\Mail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;
class UserInfoQRMail extends Mailable
{
        use Queueable, SerializesModels;
        public $user;
        /**
        * Cr´ee une nouvelle instance de message.
        *
        * @param User $user
        */
        public function __construct(User $user)
        {
        $this->user = $user;
        }
        /**
        * Construire le message.
        *
        * @return $this
        */
        public function build()
        {
        // Données pour générer le QR code
        $qrData = "Nom: {$this->user->name}\nEmail: {$this->user->email}\n ";
        // Créer une nouvelle instance de QR Code
        $qrCode = new QrCode($qrData);
        // Utiliser PngWriter pour générer l'image du QR code
        $writer = new PngWriter();
        // Définir le chemin ou enregistrer l'image QR code
        $qrFilePath = storage_path('app/public/qrcodes/user_' . $this->user->id . '_qr.png');
        // Créer le r´epertoire s’il n’existe pas
        $directory = storage_path('app/public/qrcodes');
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }
        // G´en´erer et enregistrer l’image du QR code
        $qrImageData = $writer->write($qrCode);
        file_put_contents($qrFilePath, $qrImageData->getString());
        // Construire l’email avec le QR code en pi`ece jointe
        return $this->subject('QR Code avec les informations de l\'utilisateur')
        ->view('emails.userInfoQR') // Assurez-vous que cette vue existe
        ->attach($qrFilePath, [
                'as' => 'user_info_qr.png',
                'mime' => 'image/png',
        ]);
        }
}