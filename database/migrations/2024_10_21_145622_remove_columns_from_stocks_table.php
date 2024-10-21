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
            // Supprimer les colonnes 'name', 'type', 'price', et 'invoice_number'
            $table->dropColumn(['name', 'type', 'price', 'invoice_number']);
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
            // Ajouter à nouveau les colonnes en cas de rollback
            $table->string('name');
            $table->string('type');
            $table->decimal('price', 8, 2);
            $table->string('invoice_number');
        });
    }
};
