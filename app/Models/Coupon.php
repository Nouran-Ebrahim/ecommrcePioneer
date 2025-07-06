<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'coupons';
    protected $appends = ['status_name'];
    public function getStatusNameAttribute($value)
    {//$value is status_name
        if ($this->status == 1) {
            return trans('dashboard.active');
        } else {
            return trans('dashboard.unactive');
        }

    }
    public function getCreatedAtAttribute($value)
    {
        //$value is created_at
        return date('Y-m-d h:i A', strtotime($value));
    }
    public function scopeValid($q)
    {
        return $q->where('status', 1)
            ->whereColumn('time_used', '<', 'limit')
            ->where('end_date', '>', now())
            ->where('start_date', '<=', now());
    }
    public function scopeNotValid($q)
    {
        return $q->where('status', 0)
            ->orWhere('time_used', '>=', 'limit')
            ->orWhere('end_date', '<', now());
    }
    public function couponIsValid()
    {

        return $this->status = 1  && $this->time_used < $this->limit && $this->end_date > now() && $this->start_date <= now(); //strat date greater than now;

    }
}
