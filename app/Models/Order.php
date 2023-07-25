<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'statusOrder_ID',
        'user_ID'
    ];

    public function user() {
        return $this -> belongsTo(User::class, 'user_ID');
    }
    public function statusOrders() {
        return $this -> belongsTo(StatusOrder::class, 'statusOrder_ID');
    }

    public function product(){
        return $this -> belongsToMany(Product::class, 'buys', 'order_ID', 'product_ID');
    }
}
