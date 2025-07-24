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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('airline_id');
            $table->string('flight_number', 10)->unique();
            $table->string('departure', 255); // Điểm đi
            $table->string('destination', 255);  // Điểm đến
            $table->datetime('departure_time');
            $table->datetime('arrival_time');
            $table->decimal('price', 10, 2);
            $table->integer('seats');   // Tổng số ghế
            $table->integer('available_seats'); // Số ghế còn trống
            $table->foreign('airline_id')->references('id')->on('airlines')->onDelete('cascade');
            $table->enum('status', ['chưa hoàn thành', 'hoàn thành', 'hủy bỏ']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
