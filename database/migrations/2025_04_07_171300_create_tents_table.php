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
        Schema::create('tents', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('subheading');
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
        
        // Migrate existing tent data from products table
        if (Schema::hasTable('products') && 
            Schema::hasColumn('products', 'tent_heading') && 
            Schema::hasColumn('products', 'tent_subheading')) {
            
            $product = DB::table('products')->first();
            if ($product && $product->tent_heading && $product->tent_subheading) {
                DB::table('tents')->insert([
                    'heading' => $product->tent_heading,
                    'subheading' => $product->tent_subheading,
                    'is_published' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tents');
    }
};
