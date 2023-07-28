<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingOrders extends Model
{
    use HasFactory;

    protected $with = ['consultation'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class, );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

}
