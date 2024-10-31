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
        if (!Schema::hasColumn('deliveries', 'start_address')) {
            Schema::table('deliveries', function (Blueprint $table) {
                $table->string('start_address')->after('id'); // Add start_address if it doesn't exist
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
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn('start_address'); // Remove the column if migration is rolled back
        });
    }
};
