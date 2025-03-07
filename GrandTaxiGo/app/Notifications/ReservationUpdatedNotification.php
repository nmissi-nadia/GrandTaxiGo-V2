<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ReservationUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function via($notifiable)
    {
        return ['broadcast', 'database']; // Utiliser Broadcast pour les notifications en temps réel
    }

    public function toDatabase($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'message' => 'Votre réservation a été mise à jour.',
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'reservation_id' => $this->reservation->id,
            'message' => 'Votre réservation a été mise à jour.',
        ]);
    }
}