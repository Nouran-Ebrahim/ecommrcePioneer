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

    protected $fillable = ['name', 'country_id'];
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function cities()
    {
        return $this->hasMany(City::class,'city_id');

    }
}
