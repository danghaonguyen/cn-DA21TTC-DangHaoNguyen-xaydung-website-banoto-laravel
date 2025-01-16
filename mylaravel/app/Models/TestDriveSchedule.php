<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDriveSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_drive_id', 'date', 'time', 'location'
    ];

    // Mối quan hệ: Một lịch lái thử thuộc về một khách hàng
    public function testDrive()
    {
        return $this->belongsTo(TestDrive::class, 'test_drive_id');
    }
}

