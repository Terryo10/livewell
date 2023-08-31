<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
    'is_used','id', 'poll_url', 'order_id', 'status'
    ];
    use HasFactory;
}
