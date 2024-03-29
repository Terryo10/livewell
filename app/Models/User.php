<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $with = [ 'cart','temporaryAddress','orders'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function subscribed()
    {
        return $this->hasOne(Subscriptions::class, 'user_id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id')->latest();
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function temporaryAddress()
    {
        return $this->hasOne(TemporaryAddress::class);

    }

    public function  bookings(){
        return $this->hasMany(BookingOrders::class, 'user_id');
    }

}
