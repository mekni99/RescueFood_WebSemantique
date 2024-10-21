<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   // database/migrations/xxxx_xx_xx_create_transports_table.php
public function up()
{
    Schema::create('transports', function (Blueprint $table) {
        $table->id();
        $table->string('vehicle_type'); // Type de véhicule (Camion, Fourgon, etc.)
        $table->string('license_plate'); // Plaque d'immatriculation
        $table->string('driver_name'); // Nom du conducteur
        $table->string('status')->default('Available'); // Disponibilité
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transports');
    }
};
