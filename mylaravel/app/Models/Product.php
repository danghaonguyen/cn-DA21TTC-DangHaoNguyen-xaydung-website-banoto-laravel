<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'brand_id',
        'interior_images',
        'exterior_images',
        'specs_images',
        'color_images',
    ];

    // Quan hệ với bảng 'brands'
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }
    
    public function installments()
    {
        return $this->hasMany(Installment::class);
    }

    public function testDrives()
    {
        return $this->hasMany(TestDrive::class, 'product_id');
    }
    

}
