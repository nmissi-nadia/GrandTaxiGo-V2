<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trajet>
 */
class TrajetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'chauffeur_id' => \App\Models\User::factory(), // Crée un chauffeur aléatoire
            'rue_depart' => $this->faker->streetAddress,
            'rue_arrivee' => $this->faker->streetAddress,
            'statut' => $this->faker->randomElement(['actif', 'terminé']),
            'heure_depart' => $this->faker->dateTimeBetween('now', '+1 week'),
            'prix' => $this->faker->numberBetween(100, 1000),
            'places_disponibles' => $this->faker->numberBetween(1,6),
        ];
    }
}
