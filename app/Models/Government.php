<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Government extends Model
{
    use HasFactory, HasTranslations;
    public $timestamps = false;
    public $translatable = ['name'];

    protected $fillable = ['name', 'country_id','status'];
    protected $appends = ['status_name'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class);

    }
    public function getStatusNameAttribute($value)
    {//$value is status_name
        if ($this->status == 1) {
            return trans('dashboard.active');
        } else {
            return trans('dashboard.unactive');
        }

    }
    public function users()
    {
        return $this->hasMany(User::class , 'country_id');
    }
    public function shippingPrice()
    {
        return $this->hasOne(ShippingGovernment::class );
    }
}
