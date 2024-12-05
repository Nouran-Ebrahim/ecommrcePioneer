<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Country extends Model
{
    use HasFactory, HasTranslations;
    public $timestamps = false;
    public $translatable = ['name'];

    protected $fillable = ['name', 'status', 'phone_code', 'flag_code'];
    protected $appends = ['status_name'];

    public function govrnorates()
    {
        return $this->hasMany(Government::class, 'country_id');

    }
    public function users()
    {
        return $this->hasMany(User::class , 'country_id');
    }
    public function getStatusNameAttribute($value)
    {//$value is status_name
        if ($this->status == 1) {
            return trans('dashboard.active');
        } else {
            return trans('dashboard.unactive');
        }

    }
}
