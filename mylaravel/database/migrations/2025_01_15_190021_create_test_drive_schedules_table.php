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
        Schema::create('test_drive_schedules', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('test_drive_id')->unsigned(); // Khoá ngoại liên kết với bảng testdrives
            $table->date('date'); // Ngày lịch lái thử
            $table->time('time'); // Giờ lịch lái thử
            $table->string('location'); // Địa điểm lái thử
            $table->timestamps();

            // Thêm khóa ngoại để liên kết với bảng testdrives
            $table->foreign('test_drive_id')->references('id')->on('test_drives')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_drive_schedules');
    }
};
