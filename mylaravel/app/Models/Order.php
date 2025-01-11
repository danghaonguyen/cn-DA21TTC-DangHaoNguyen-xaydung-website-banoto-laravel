<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_id',
        'deposit_amount',
        'status',
        'order_url',
        'user_id',
        'user_name'
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // mối quan hệ giữa Order và User
    }
}
