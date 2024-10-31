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
        if (!Schema::hasColumn('dons', 'date_preemption')) {
            Schema::table('dons', function (Blueprint $table) {
                $table->date('date_preemption')->nullable(); // Add the column if it doesn't exist
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dons', function (Blueprint $table) {
            $table->dropColumn('date_preemption'); // Remove the column if migration is rolled back
        });
    }
};
