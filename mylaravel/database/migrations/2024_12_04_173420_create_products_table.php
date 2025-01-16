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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Tự động tăng
            $table->string('name')->unique(); // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả sản phẩm (có thể để trống)
            $table->decimal('price', 10, 0); // Giá sản phẩm
            $table->string('image')->nullable(); // Đường dẫn ảnh sản phẩm
            $table->unsignedBigInteger('brand_id');  // Khóa ngoại đến bảng brands
            $table->text('image_exterior')->nullable(); // Hình ảnh ngoại thất của xe
            $table->text('image_interior')->nullable(); // Hình ảnh nội thất của xe
            $table->text('image_specs')->nullable(); // Hình ảnh nội thất của xe
            $table->text('image_color')->nullable(); // Hình ảnh màu sắc của xe
            $table->timestamps();
        
            // Định nghĩa khóa ngoại
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
