<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add extra options field to bookings table.
     * This field stores user interests in additional services like photobooth, lights, and foodtruck.
     */
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->json('extras')->nullable()->after('end_date')
                  ->comment('JSON array of extra options (photobooth, lights, foodtruck)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('extras');
        });
    }
};
