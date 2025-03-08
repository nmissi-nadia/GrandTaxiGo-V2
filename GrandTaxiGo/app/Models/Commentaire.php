<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'user_id',
        'contenu',
    ];

    
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function trajet()
    {
        return $this->belongsTo(Trajet::class);
    }
}

