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
    Schema::table('stocks', function (Blueprint $table) {
        $table->string('sub_category')->nullable();  // Ajoute la colonne 'sub_category'
    });
}
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('sub_category');  // Supprime la colonne 'sub_category' si on revient en arrière
        });
    }
};
