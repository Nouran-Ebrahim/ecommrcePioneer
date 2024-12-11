<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory, HasTranslations, Sluggable;
    protected $guarded = [];
    public $translatable = ['name'];
    protected $appends = ['status_name'];
    public function sluggable(): array
    {

        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
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
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function childern()
    {
        return $this->hasMany(Category::class, 'parent');
    }
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }
    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}
