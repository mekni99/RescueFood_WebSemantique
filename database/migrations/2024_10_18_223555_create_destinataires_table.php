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
        Schema::create('destinataires', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('contact');
            $table->string('address');
            $table->text('specific_needs')->nullable();
            $table->unsignedBigInteger('request_id'); // Assurez-vous que c'est le même type que la clé primaire de 'requests'
            $table->timestamps();
            $table->foreign('request_id')->references('id')->on('association_requests')->onDelete('cascade');

        });
    }
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('destinataires');
    }
};
