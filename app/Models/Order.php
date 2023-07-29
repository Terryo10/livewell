<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['poll_url','transaction_id'];
    use HasFactory;

    public function order_items(){
        return $this->hasMany(OrderItems::class, 'orders_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delivery(){
        return $this->belongsTo(Deliveries::class, 'delivery_id');
    }
    public function order_transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
