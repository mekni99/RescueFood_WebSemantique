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
        Schema::create('association_requests', function (Blueprint $table) {
            $table->id(); // ID de la demande
            $table->unsignedBigInteger('association_id')->nullable(); // Retirez "after `id`"
            $table->string('association_name'); // Nom de l'association
            $table->string('association_email'); // Email de l'association
            $table->string('product_requested'); // Produit demandé
            $table->integer('quantity'); // Quantité demandée
            $table->enum('status', ['Pending', 'Completed', 'Rejected']); // Statut de la demande
            $table->timestamps(); // Champs created_at et updated_at
        }); 
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('association_requests');
    }
};
