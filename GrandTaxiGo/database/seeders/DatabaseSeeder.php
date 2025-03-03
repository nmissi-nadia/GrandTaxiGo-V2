<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Trajet;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
            
        // ]);

        Trajet::factory()->count(10)->create();
        Reservation::factory()->count(10)->create();
    }
}
