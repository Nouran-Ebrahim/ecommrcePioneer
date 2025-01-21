<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Attribute extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['name'];
    public $translatable = ['name'];

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }
}
