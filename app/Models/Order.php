<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id" , "user_name" , "user_phone" , "user_email" ,
        "price" , "shapping_price" , "total_price" , "note" ,
        "status" , "country" , "governorate" , "city" , "street" ,"coupon_discount","coupon"
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return date('d-m-Y', strtotime($value));
    }

    public function getTotalAttribute($value)
    {
        return number_format($value, 2, '.', ',');
    }

    // scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
    PUblic function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }
    public function scopeCanceled($query)
    {
        return $query->where('status', 'cancelled');
    }
    public function scopeDelivered($query)
    {
        return $query->where('status', 'delivered');
    }
}
