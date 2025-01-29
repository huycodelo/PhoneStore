<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany(OrderDetail::class, 'order_id'); // 'order_id' là khóa ngoại trong bảng order_details
    }
    protected $fillable = [
        'user_id',
        'payment',
        'shipping',
        'status',
        'notes',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function getTotalAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
