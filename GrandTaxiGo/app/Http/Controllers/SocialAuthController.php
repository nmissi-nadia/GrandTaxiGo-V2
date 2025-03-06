<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // Assurez-vous d'avoir importé votre modèle User

class SocialAuthController extends Controller
{
    /**
     * Redirige l'utilisateur vers le fournisseur (Google ou Facebook).
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Traite la réponse du fournisseur après redirection.
     *
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
       
            // Récupérez les informations de l'utilisateur depuis le fournisseur
            $user = Socialite::driver($provider)->user();

            // Vérifiez si l'utilisateur existe déjà dans la base de données
            $existingUser = User::where('provider', $provider)
                ->where('provider_id', $user->id)
                ->first();

            if ($existingUser) {
                // Connectez l'utilisateur existant
                Auth::login($existingUser);
            } else {
                // Créez un nouvel utilisateur
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'provider' => $provider,
                    'provider_id' => $user->id,
                ]);

                Auth::login($newUser);
            }

            // Redirigez l'utilisateur vers le tableau de bord ou une autre page
            return redirect()->to('/dashboard');
      
    }

}