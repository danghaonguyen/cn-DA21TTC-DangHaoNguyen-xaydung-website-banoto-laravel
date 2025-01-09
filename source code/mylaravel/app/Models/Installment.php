<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Installment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'phone', 'email', 'product_id', 'status',];

    // Quan hệ với bảng sản phẩm (Product)

    // Chỉ định tên bảng (nếu không theo chuẩn Laravel)
    protected $table = 'installments';


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
