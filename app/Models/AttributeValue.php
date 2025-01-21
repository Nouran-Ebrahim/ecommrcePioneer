<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class AttributeValue extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['value','attribute_id'];
    public $timestamps = false;

    public $translatable = ['value'];

    public function attribute(){
        return $this->belongsTo(Attribute::class);
    }
}
