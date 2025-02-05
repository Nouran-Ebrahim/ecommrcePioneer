<?php

namespace App\Models;
use Illuminate\Support\Facades\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, HasTranslations;

    public $fillable = ['name', 'desc', 'small_desc', 'status', 'sku', 'available_for', 'views', 'has_variants', 'price', 'has_discount', 'discount', 'start_discount', 'end_discount', 'manage_stock', 'quantity', 'available_in_stock', 'category_id', 'brand_id'];
    public $translatable = ['name', 'desc', 'small_desc'];

    // relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function productPreviews()
    {
        return $this->hasMany(ProductPreview::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    // functions
    public function getStatusTranslated()
    {

        return $this->status == 1 ? __('dashboard.active') : __('dashboard.unactive');

    }
    public function hasVariantsTranslated()
    {

            return $this->has_variants == 1 ? __('dashboard.yes') : __('dashboard.no');

    }
    public function isSimple()
    {
        return !$this->has_variants;
    }

    // accessores

    public function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i a', strtotime($value));
    }
    public function getPriceAttribute($value)
    {
        return $this->has_variants == 0 ? number_format($value, 2) : __("dashboard.has_variants");
    }
    public function getQuantityAttribute($value)
    {
        return $this->has_variants == 0 ? $value : __("dashboard.has_variants");
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }





}
