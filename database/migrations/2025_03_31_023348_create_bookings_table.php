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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('flight_id');
            $table->enum('status', ['chưa giải quyết', 'thành công', 'hủy bỏ'])->default('chưa giải quyết');
            $table->decimal('total_price', 10, 2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('flight_id')->references('id')->on('flights')->onDelete('cascade');
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
