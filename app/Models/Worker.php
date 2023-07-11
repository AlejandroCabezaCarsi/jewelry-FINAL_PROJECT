<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    public function role() {
        return $this -> belongsTo(Role::class);
    }

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
