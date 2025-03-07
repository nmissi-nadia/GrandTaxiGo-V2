<?php

namespace App\Listeners;

use App\Notifications\ReservationUpdatedNotification;
use App\Events\ReservationUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendReservationUpdateNotification implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    public function handle(ReservationUpdated $event)
    {
        $event->reservation->passager->notify(new ReservationUpdatedNotification($event->reservation));
    }
}