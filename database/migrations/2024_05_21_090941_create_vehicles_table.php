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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('make'); // Marque du véhicule
            $table->string('model'); // Modèle du véhicule
            $table->integer('year'); // Année de fabrication
            $table->decimal('price', 15, 2); // Prix avec précision de 2 décimales
            $table->integer('mileage'); // Kilométrage
            $table->string('color'); // Couleur
            $table->text('description'); // Description
            $table->string('image')->nullable(); // Image principale, nullable si non obligatoire
            $table->boolean('is_available')->default(true); // Indicateur de disponibilité
            $table->timestamps();
            $table->softDeletes(); // Pour gérer les suppressions logiques
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};