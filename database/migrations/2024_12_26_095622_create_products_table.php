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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->boolean('status')->default(1);
            $table->text('description')->nullable();
            $table->string('short_description')->nullable();
            $table->string('price', 8, 2)->nullable();
            $table->string('image')->nullable();
        
            // Make category_id nullable, and brand_id nullable
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->foreignId('subcategory_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('child_category_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
