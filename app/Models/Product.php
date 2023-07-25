<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function material() {
        return $this -> belongsTo(Material::class, 'material_ID');
    }
    public function type() {
        return $this -> belongsTo(Type::class, 'type_ID');
    }

    public function orders(){
        return $this -> belongsToMany(Order::class, 'buys', 'product_ID', 'order_ID');
    }
}
