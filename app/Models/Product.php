<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'img', 'quantity', 'category_id', 'detail'
    ];
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
    

}
