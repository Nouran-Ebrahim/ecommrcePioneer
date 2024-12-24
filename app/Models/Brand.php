<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;
class Brand extends Model
{
    use HasFactory, HasTranslations, Sluggable;
    protected $fillable = ['name' , 'logo' , 'status' , 'slug'];
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
    public function products()
    {
        return $this->hasMany(Product::class , 'brand_id');
    }
    public function scopeActive($query)
    {
        return $query->where('status' , 1);
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
        return date('d/m/Y h:i A', strtotime($value));
    }

    public function getLogoAttribute($logo)
    {
        if (filter_var($logo, FILTER_VALIDATE_URL)) {
            return $logo; // Return the image URL if valid
        }
        return 'uploads/brands/' . $logo;
    }
}
