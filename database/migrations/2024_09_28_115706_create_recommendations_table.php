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
    public function up()
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre de la recommandation
            $table->text('description'); // Description
            $table->enum('type', ['Fruits', 'Légumes', 'Produits laitiers', 'Autre']); // Type de denrée
            $table->text('practical_tips'); // Conseils pratiques
            $table->string('shelf_life'); // Durée de conservation
            $table->enum('state', ['Frais', 'Congelé', 'Préparé']); // État de la denrée
            $table->date('creation_date'); // Date de création
            $table->enum('status', ['Actif', 'Obsolète', 'En révision']); // Statut
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
        Schema::dropIfExists('recommendations');
    }
};
