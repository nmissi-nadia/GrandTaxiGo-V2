<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trajet extends Model
{
    use HasFactory;
    protected $fillable = [
        'chauffeur_id',
        'rue_depart',
        'rue_arrivee',
        'statut',
        'heure_depart',
        'places_disponibles',
        'prix',
    ];

    public function chauffeur()
    {
        return $this->belongsTo(User::class, 'chauffeur_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
