<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu tên bảng không phải là tên số nhiều của model
    protected $table = 'payments';

    // Các cột có thể gán hàng loạt
    protected $fillable = [
        'order_id',
        'payment_amount',
        'payment_method',
        'payment_status',
        'payment_date',
        'transaction_id',
        'payment_url',
    ];

    // Quan hệ với bảng Orders
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
