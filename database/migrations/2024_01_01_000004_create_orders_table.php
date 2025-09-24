<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('table_id');
            $table->decimal('total_amount', 10, 2);
            $table->enum('status', ['pending', 'preparing', 'ready', 'served'])->default('pending')->index();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('table_id')->references('id')->on('tables')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};