<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Stock name
            $table->integer('quantity')->unsigned(); // Quantity of stock
            $table->decimal('price', 10, 2)->nullable(); // Price of stock, now nullable
            $table->enum('status', ['In Stock', 'Out of Stock']); // Status of stock
            $table->timestamps(); // Created at and updated at timestamps
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks'); // Drop the stocks table if it exists
    }
}
