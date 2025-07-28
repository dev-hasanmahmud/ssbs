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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->date('booking_date')->index();
            $table->enum('status', ['pending', 'completed', 'cancelled'])
                  ->default('pending')
                  ->index();
            $table->timestamps();
            $table->unique(['user_id', 'service_id', 'booking_date'], 'unique_user_service_date'); // User cannot book the same service on the same date more than once.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
