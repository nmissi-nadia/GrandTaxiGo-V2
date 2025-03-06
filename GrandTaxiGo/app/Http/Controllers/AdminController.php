<?php

namespace App\Http\Controllers;
use App\Models\Trajet;
use App\Models\Ville;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $villes = Ville::paginate(6);
        $trajets = Trajet::paginate(10);
        $reservations = Reservation::paginate(4);
        $userCount = User::count(); 
        $villeCount = Ville::count();
        $trajetCount = Trajet::count();
        $reservationCount = Reservation::count();
        return view('admin.dashboard', compact('users', 'trajets', 'villes','reservations','userCount','villeCount','trajetCount','reservationCount'));
    }

}
