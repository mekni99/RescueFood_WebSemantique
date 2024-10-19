<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('dons', function (Blueprint $table) {
            $table->string('sub_category')->after('category'); // Ajouter la colonne sub_category
        });
    }
    
    public function down()
    {
        Schema::table('dons', function (Blueprint $table) {
            $table->dropColumn('sub_category'); // Supprimer la colonne si besoin
        });
    }
};
