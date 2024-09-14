<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('surface');
            $table->integer('rooms');
            $table->integer('bedrooms');
            $table->integer('floor');
            // Définir la précision et l'échelle pour la colonne price
            $table->decimal('price', 15, 2); // 15 chiffres au total, avec 2 chiffres après la virgule
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
            $table->boolean('sold')->default(false);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};