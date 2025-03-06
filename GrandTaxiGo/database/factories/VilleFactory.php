<?php

namespace Database\Factories;

use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\Factory;

class VilleFactory extends Factory
{
    protected $model = Ville::class;

    public function definition()
    {
        // Liste des villes marocaines
        $villesMarocaines = [
            'Casablanca', 'Marrakech', 'Fès', 'Tanger', 'Salé', 'Meknès', 
            'Oujda', 'Kenitra', 'Agadir', 'Tétouan', 'Safi', 'Mohammedia', 
            'Khouribga', 'Rabat', 'Beni Mellal', 'Laâyoune', 'Nador', 'El Jadida', 
            'Taza', 'Guelmim', 'Settat', 'Khémisset', 'Ouarzazate', 'Assilah', 
            'Essaouira', 'Dakhla', 'Tan-Tan', 'Berkane', 'Fquih Ben Salah'
        ];

        return [
            'nom' => $this->faker->randomElement($villesMarocaines), // Sélectionne une ville aléatoire
        ];
    }
}