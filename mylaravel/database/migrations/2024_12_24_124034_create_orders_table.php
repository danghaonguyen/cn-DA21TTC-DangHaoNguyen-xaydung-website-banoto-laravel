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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');
            $table->decimal('deposit_amount', 10, 2);
            $table->string('status')->default('pending');
            $table->string('order_url')->nullable();
            $table->unsignedBigInteger('user_id'); // ID của người dùng
            $table->string('user_name'); // Tên của người dùng
            $table->timestamps();
            
            // Thêm khóa ngoại cho bảng người dùng nếu cần
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
