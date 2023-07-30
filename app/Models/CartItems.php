<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    protected $fillable = [
        'quantity',
    ];

    use HasFactory;

    public function product(){
        return $this->belongsTo(Products::class,'product_id');
    }
}
