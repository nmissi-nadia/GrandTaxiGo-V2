<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table = 'reservations';
    protected $fillable = ['passager_id', 'trajet_id', 'statut'];
    public function passager()
    {
        return $this->belongsTo(User::class, 'passager_id');
    }
    public function trajet()
    {
        return $this->belongsTo(Trajet::class, 'trajet_id');
    }
}
