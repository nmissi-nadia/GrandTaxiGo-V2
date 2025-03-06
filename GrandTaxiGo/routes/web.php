<?php
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassagerController;
use App\Http\Controllers\ChauffeurController;
use App\Http\Controllers\TrajetController;
use App\Http\Controllers\ReservationController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VilleController;

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

    Route::get('/trajets', [TrajetController::class, 'index']);
    Route::post('/trajets', [TrajetController::class, 'store']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::get('/reservations/{id}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.supprimer');
    Route::patch('/reservations/{id}/annuler', [ReservationController::class, 'annuler'])->name('reservations.annuler');
    Route::patch('/reservations/{id}/statut', [ReservationController::class, 'updateStatut'])->name('reservations.updateStatut');   
    Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');



});
Route::middleware(['auth'])->group(function () {
    Route::get('/chauffeur/dashboard', [ChauffeurController::class, 'index'])->name('chauffeur.index');
    Route::patch('/users/{id}/disponibilite', [ChauffeurController::class, 'updateDisponibilite'])->name('users.updateDisponibilite');
    Route::post('/trajets/store', [TrajetController::class, 'store'])->name('trajets.store');
    Route::get('/trajets/edit/{id}', [TrajetController::class, 'edit'])->name('trajets.edit');
    Route::post('/trajets/update/{id}', [TrajetController::class, 'update'])->name('trajets.update');
    Route::post('/trajets/delete/{id}', [TrajetController::class, 'destroy'])->name('trajets.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/passager/dashboard', [PassagerController::class, 'index'])->name('passager.dashboard');
    // route pour acceder au reservations d'une passager lui meme
    Route::get('/passager/reservations', [PassagerController::class, 'reservations'])->name('passager.mesreservation');
    Route::post('/passager/annuler-reservation', [PassagerController::class, 'annulerReservation'])->name('passager.annuler-reservation');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/villes', [VilleController::class, 'index'])->name('villes.index');
    Route::post('/villes/store', [VilleController::class, 'store'])->name('villes.store');
    Route::get('/villes/edit/{id}', [VilleController::class, 'edit'])->name('villes.edit');
    Route::post('/villes/update/{id}', [VilleController::class, 'update'])->name('villes.update');
    Route::delete('/villes/delete/{id}', [VilleController::class, 'destroy'])->name('villes.destroy');
});

// Route pour rediriger vers le fournisseur (Google ou Facebook)
Route::get('/login/{provider}', [SocialAuthController::class, 'redirectToProvider'])
    ->name('login.provider')
    ->where('provider', 'google|facebook'); // Limitez les valeurs autorisées pour $provider

// Route pour gérer la réponse du fournisseur après redirection
Route::get('/login/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])
    ->where('provider', 'google|facebook'); // Limitez les valeurs autorisées pour $provider

Route::get('/payment', [PaymentController::class, 'paymentForm'])->name('payment.form');
Route::post('/create-checkout-session', [PaymentController::class, 'createCheckoutSession'])->name('create.checkout.session');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'cancel'])->name('payment.cancel');

require __DIR__.'/auth.php';
