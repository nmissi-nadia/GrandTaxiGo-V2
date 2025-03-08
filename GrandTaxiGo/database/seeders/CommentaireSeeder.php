<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Supposons que vous ayez déjà des utilisateurs et des trajets dans votre base de données
        $users = User::all();
        $trajets = Trajet::all();

        foreach ($trajets as $trajet) {
            foreach ($users as $user) {
                Commentaire::create([
                    'trajet_id' => $trajet->id,
                    'user_id' => $user->id,
                    'contenu' => 'Commentaire de test pour le trajet ' . $trajet->id . ' par ' . $user->name,
                ]);
            }
        }
    }
}
