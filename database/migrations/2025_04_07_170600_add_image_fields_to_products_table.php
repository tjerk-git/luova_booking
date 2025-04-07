<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('silent_disco_image')->nullable();
            $table->string('photobooth_image')->nullable();
            $table->string('foodtruck_image')->nullable();
            $table->string('name')->nullable()->after('id');
            $table->boolean('is_published')->default(true)->after('name');
            $table->integer('order_column')->default(0)->after('is_published');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'silent_disco_image',
                'photobooth_image',
                'foodtruck_image',
                'name',
                'is_published',
                'order_column'
            ]);
        });
    }
};
