<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurant_id'); // Clé étrangère vers les restaurants
            $table->string('category'); // Catégorie sous forme de texte
            $table->integer('quantity'); // Quantité de nourriture
            $table->date('date_preemption')->nullable(); // Date de préemption
            $table->timestamps();

            // Clé étrangère vers la table restaurants
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dons');
    }
};

