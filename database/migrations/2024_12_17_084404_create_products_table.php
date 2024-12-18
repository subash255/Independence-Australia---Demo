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
            $table->string('product_name');
            $table->string('image');
            $table->string('description');
            $table->string('price');
            $table->string('quantity');
            $table->string('brand');
            $table->string('remark')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('categories_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategories_id')->constrained()->onDelete('cascade');
            $table->foreignId('brands_id')->constrained()->onDelete('cascade');
            
            
            // Add the two toggle button columns
            $table->boolean('visibility')->default(true);  
            $table->boolean('is_flash')->default(false);  
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
