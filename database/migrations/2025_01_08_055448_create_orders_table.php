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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Foreign key to the user table
            $table->json('billing'); // Store billing details as JSON
            $table->json('shipping'); // Store shipping details as JSON
            $table->json('line_items'); // Store line items as JSON
            $table->json('meta_data')->nullable(); // Store meta data as JSON
            $table->string('status')->default('pending'); // Order status (e.g., pending, completed)
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
