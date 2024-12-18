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
        // Create the users table with an additional role, address, and phone_number columns
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('role')->default('user'); // Ensure role is required and has a default value of 'user'
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address')->nullable(); // Add address column, nullable if not all users have an address
            $table->string('phone_number')->nullable(); // Add phone_number column, nullable if not all users have a phone number
            $table->unsignedBigInteger('vendor_id')->nullable(); // Add vendor_id column, nullable by default
            $table->foreign('vendor_id')->references('id')->on('users')->onDelete('set null'); // Add phone_number column, nullable if not all users have a phone number
            $table->rememberToken();
            $table->timestamps();
        });
        

        // Create the password_reset_tokens table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Create the sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
