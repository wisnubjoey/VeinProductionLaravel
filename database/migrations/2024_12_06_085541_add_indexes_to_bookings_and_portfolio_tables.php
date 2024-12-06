<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->index(['created_at', 'status']);
    });

    Schema::table('portfolio', function (Blueprint $table) {
        $table->index(['created_at', 'type']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings_and_portfolio_tables', function (Blueprint $table) {
            //
        });
    }
};
