<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
class Page extends Model
{
    use HasFactory, HasTranslations;
    protected $fillable = [
        "title",
        "slug",
        'content',
        'image'
    ];
    public $translatable = ['title', 'content'];
    // public function sluggable(): array
    // {
    //     return [
    //         'slug' => [
    //             'source' => function ($model) {
    //                 // Always use English title for slug
    //                 return $model->getTranslation('title', 'en');
    //             }
    //         ]
    //     ];
    // }
    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y h:i A', strtotime($value));
    }

    // public function getImageAttribute($image)
    // {

    //     return asset('uploads/pages/' . $image);
    // }

}
