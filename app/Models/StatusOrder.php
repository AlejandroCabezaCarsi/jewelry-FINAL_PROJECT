<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    use HasFactory;

    protected $table = 'statusOrders';

    protected $fillable = [
        'name'
    ];



    public function order() {
        return $this -> hasMany(Order::class);
    }
}
