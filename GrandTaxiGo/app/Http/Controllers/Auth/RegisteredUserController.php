<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:passager,chauffeur,admin'],
         // Limite de 2 Mo
    ]);

    $photoProfilPath=null;

    // Gestion du téléchargement de l'image
    if ($request->hasFile('photo_profil')) {
        $file = $request->file('photo_profil');
        \Log::info('Nom du fichier : ' . $file->getClientOriginalName());
        \Log::info('Chemin temporaire : ' . $file->getPathName());
    
        $photoProfilPath = $file->store('photos_profil', 'public'); // Stockage dans le disque public
    }
    

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'photo_profil' => $photoProfilPath, // Enregistrement du chemin de l'image
    ]);

    event(new Registered($user));

    Auth::login($user);

    return redirect(route('dashboard', absolute: false)); // Redirection simplifiée
}

}
