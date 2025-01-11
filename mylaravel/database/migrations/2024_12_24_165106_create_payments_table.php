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
            $table->unsignedBigInteger('order_id');
            $table->decimal('payment_amount', 10, 2);
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->timestamp('payment_date')->useCurrent();
            $table->string('transaction_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamps();


            // Khóa ngoại
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
