<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    // Các cột mà bạn muốn Laravel phép gán hàng loạt (mass assignment)
    protected $fillable = ['name'];

    // app/Models/Brand.php
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
