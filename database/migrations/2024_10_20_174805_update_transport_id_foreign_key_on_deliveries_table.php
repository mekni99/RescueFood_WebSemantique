<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransportIdForeignKeyOnDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            // Supprimez la contrainte de clé étrangère existante
            $table->dropForeign(['transport_id']);
            // Ajoutez une nouvelle contrainte de clé étrangère sans suppression en cascade
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            // Supprimez la contrainte de clé étrangère
            $table->dropForeign(['transport_id']);
            // Restaurez la contrainte de suppression en cascade
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade');
        });
    }
}
