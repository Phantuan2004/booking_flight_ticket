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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->string('payment_method');
            $table->enum('status', ['chưa giải quyết', 'thành công', 'hủy bỏ'])->default('chưa giải quyết');
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id')->nullable();   // Mã giao dịch từ cổng thanh toán
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
