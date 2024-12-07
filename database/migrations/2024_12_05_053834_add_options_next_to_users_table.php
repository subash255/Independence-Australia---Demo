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
        Schema::table('users', function (Blueprint $table) {

            $table->string('last_name')->nullable(); 
            $table->string('address')->nullable();  
            $table->string('phone_number')->default('N/A');
            $table->boolean('is_business_account')->default(false);
            $table->boolean('subscribed_to_newsletter')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('last_name');
            $table->dropColumn('address');
            $table->dropColumn('phone_number');
            $table->dropColumn('is_business_account');
            $table->dropColumn('subscribed_to_newsletter');
        });
    }
};
