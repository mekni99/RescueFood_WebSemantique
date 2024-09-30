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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Stock item name
            $table->string('type');          // Type of stock item (e.g., food, drink, etc.)
            $table->integer('quantity');     // Quantity of the item
            $table->decimal('price', 8, 2); 
            $table->string('invoice_number'); // Invoice number for the stock item
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
