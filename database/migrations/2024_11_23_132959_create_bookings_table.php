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
            $table->string('client_name');
            $table->string('email');
            $table->string('phone');
            $table->date('event_date');
            $table->string('event_type');
            $table->string('location');
            $table->string('package_type');
            $table->text('special_requests')->nullable();
            $table->enum('status', ['pending', 'contacted', 'confirmed', 'completed'])->default('pending');
            $table->timestamps();
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
