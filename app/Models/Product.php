<?php

namespace App\Models;
use Illuminate\Support\Facades\Config;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, HasTranslations, Sluggable;

    public $fillable = ['name', 'slug', 'desc', 'small_desc', 'status', 'sku', 'available_for', 'views', 'has_variants', 'price', 'has_discount', 'discount', 'start_discount', 'end_discount', 'manage_stock', 'quantity', 'available_in_stock', 'category_id', 'brand_id'];
    public $translatable = ['name', 'desc', 'small_desc'];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
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
    public function priceAttribute()
    {
        return $this->has_variants == 0 ? number_format($this->price, 2) : __("dashboard.has_variants");
    }
    public function quantityAttribute()
    {
        return $this->has_variants == 0 ? $this->quantity : __("dashboard.has_variants");
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

    public function getPriceAfterDiscount()
    {
        if ($this->has_discount) {
            return $this->price - $this->discount;
        }
        return $this->price;
    }
    public function discountPercentage()
    {
        // Skip if product has variants or discount is null/zero
        if ($this->variants()->exists() || !$this->discount || $this->price == 0) {
            return '🔥';
        }

        // Calculate percentage
        return round(($this->discount / $this->price) * 100, 2).'%';
    }


}
