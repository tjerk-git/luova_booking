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
            // Add new generic fields
            $table->string('title')->nullable()->after('name');
            $table->string('image')->nullable()->after('title');
            $table->longText('content')->nullable()->after('image');
            
            // Keep tent fields separate since they're used elsewhere
            // We'll handle the data migration in a seeder
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['title', 'image', 'content']);
        });
    }
};
