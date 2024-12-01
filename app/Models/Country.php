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

    protected $fillable = ['name', 'status', 'phone_code'];

    public function govrnorates()
    {
        return $this->hasMany(Government::class,'country_id');

    }
}
