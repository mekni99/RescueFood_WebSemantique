<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersTable extends Migration
{
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('availability');
            $table->string('telephone_number');
            $table->foreignId('association_id')->constrained('users')->onDelete('cascade'); // Ensure it references users
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('volunteers');
    }
}
