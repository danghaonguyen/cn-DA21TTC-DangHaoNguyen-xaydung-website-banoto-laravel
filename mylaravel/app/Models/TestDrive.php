<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDrive extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'email', 'car_interest'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}