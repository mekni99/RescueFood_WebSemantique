<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTransportIdToDeliveriesTable extends Migration
{
    public function up()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            // Ajout de la colonne transport_id et de la clé étrangère
            $table->unsignedBigInteger('transport_id')->nullable();
            $table->foreign('transport_id')->references('id')->on('transports')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('deliveries', function (Blueprint $table) {
            // Suppression de la clé étrangère et de la colonne transport_id
            $table->dropForeign(['transport_id']);
            $table->dropColumn('transport_id');
        });
    }
}
