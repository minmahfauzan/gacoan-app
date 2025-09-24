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
        Schema::table('orders', function (Blueprint $table) {
            // Modify the enum to include 'cancelled'
            $table->enum('status', ['pending', 'preparing', 'ready', 'served', 'cancelled'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert to the old enum definition
            $table->enum('status', ['pending', 'preparing', 'ready', 'served'])->default('pending')->change();
        });
    }
};