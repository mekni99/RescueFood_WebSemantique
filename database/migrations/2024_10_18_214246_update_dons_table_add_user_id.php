<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDonsTableAddUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dons', function (Blueprint $table) {
            // Supprimer la colonne restaurant_id
            $table->dropForeign(['restaurant_id']); // Supprimer la clé étrangère
            $table->dropColumn('restaurant_id'); // Supprimer la colonne

            // Ajouter la nouvelle colonne user_id
            $table->unsignedBigInteger('user_id')->after('id'); // Après id, par exemple

            // Définir la clé étrangère pour user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dons', function (Blueprint $table) {
            // Supprimer la clé étrangère pour user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id'); // Supprimer la colonne user_id

            // Réajouter restaurant_id
            $table->unsignedBigInteger('restaurant_id')->after('id'); // ou où tu le souhaites
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }
}
