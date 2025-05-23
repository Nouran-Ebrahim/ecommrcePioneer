<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasFactory, HasTranslations;
    public $timestamps = false;
    public $translatable = ['name'];

    protected $fillable = ['name', 'government_id'];
    public function govrnorate()
    {
        return $this->belongsTo(Government::class);
    }
}
