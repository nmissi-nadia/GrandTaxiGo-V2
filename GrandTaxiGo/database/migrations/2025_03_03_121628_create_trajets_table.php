<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trajets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chauffeur_id')->constrained('users');
            $table->foreignId('ville_id')->nullable()->constrained('villes')->onDelete('cascade');
            $table->string('rue_depart');
            $table->string('rue_arrivee');
            $table->enum('statut', ['actif', 'en attente', 'annulé', 'terminé'])->default('en attente');
            $table->dateTime('heure_depart');
            $table->integer('places_disponibles');
            $table->decimal('prix', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trajets');
    }
};
