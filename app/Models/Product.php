<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function material() {
        return $this -> belongsTo(Material::class);
    }
    public function type() {
        return $this -> belongsTo(Type::class);
    }

    public function orders(){
        return $this -> belongsToMany(Order::class);
    }
}
