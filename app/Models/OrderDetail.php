<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu tên bảng không phải là số nhiều của tên model (Laravel mặc định sẽ sử dụng tên số nhiều "order_details")
    protected $table = 'order_details';

    // Các thuộc tính có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    // Nếu bạn muốn liên kết với bảng products, bạn có thể thêm quan hệ
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}

