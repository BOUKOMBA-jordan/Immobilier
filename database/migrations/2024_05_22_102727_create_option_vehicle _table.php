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
        Schema::create('option_vehicle', function (Blueprint $table) {
            $table->bigInteger('option_id')->unsigned();
            $table->bigInteger('vehicle_id')->unsigned();
            $table->primary(['option_id', 'vehicle_id']);
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_vehicle');
    }
};