<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassagerController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\ReservationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/users/{id}/disponibilite', [ChauffeurController::class, 'updateDisponibilite'])->name('users.updateDisponibilite');
    Route::get('/trajets', [TrajetController::class, 'index']);
    Route::post('/trajets', [TrajetController::class, 'store']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.supprimer');
    Route::patch('/reservations/{id}/annuler', [ReservationController::class, 'annuler'])->name('reservations.annuler');
    Route::patch('/reservations/{id}/statut', [ReservationController::class, 'updateStatut'])->name('reservations.updateStatut');   
    Route::get('/chauffeur/dashboard', [ChauffeurController::class, 'index'])->name('chauffeur.index');
    Route::get('/passager/dashboard', [PassagerController::class, 'index'])->name('passager.dashboard');
    // route pour acceder au reservations d'une passager lui meme
    Route::get('/passager/reservations', [PassagerController::class, 'reservations'])->name('passager.mesreservation');
    Route::post('/passager/annuler-reservation', [PassagerController::class, 'annulerReservation'])->name('passager.annuler-reservation');
    Route::post('/trajets/store', [TrajetController::class, 'store'])->name('trajets.store');
    Route::get('/trajets/edit/{id}', [TrajetController::class, 'edit'])->name('trajets.edit');
    Route::post('/trajets/update/{id}', [TrajetController::class, 'update'])->name('trajets.update');
    Route::post('/trajets/delete/{id}', [TrajetController::class, 'destroy'])->name('trajets.destroy');
    Route::delete('/trajets/delete/{id}', [TrajetController::class, 'destroy'])->name('trajets.destroy');


});

require __DIR__.'/auth.php';
