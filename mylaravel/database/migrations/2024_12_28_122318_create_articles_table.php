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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');  // Tiêu đề bài viết
            $table->text('content');  // Nội dung bài viết
            $table->string('image')->nullable();  // Ảnh đại diện
            $table->string('author')->nullable();  // Tác giả bài viết
            $table->timestamp('published_at')->nullable();  // Ngày đăng bài viết     
            $table->timestamps();  // Thêm các cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
