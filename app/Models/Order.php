<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['name','email','public','product','secret_key'];


    public function scopeActive($query){
        return $query->where('public', 1);
    }
}
