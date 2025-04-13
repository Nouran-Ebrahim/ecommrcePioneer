<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = ['note', 'file_name'];
    public $translatable = ['note'];
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:i A', strtotime($value));
    }

    public function getFileNameAttribute($file_name)
    {

        return 'uploads/sliders/' . $file_name;
    }
}
