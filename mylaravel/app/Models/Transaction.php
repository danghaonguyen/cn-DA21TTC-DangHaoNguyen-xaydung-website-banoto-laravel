<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Đặt tên bảng (nếu tên bảng không theo quy tắc của Laravel)
    protected $table = 'transactions';

    // Các cột có thể gán đại trà (mass assignable)
    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
        'status',
        'payment_method',
        'payment_response',
        'user_id',
    ];

    // Quan hệ với bảng Product (một giao dịch chỉ liên quan đến một sản phẩm)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ với bảng User (một giao dịch liên kết với một người dùng)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
