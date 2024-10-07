<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'slug',
        'sku',
        'description',
        'category_id',
        'brand_id',
        'price',
        'discount',
        'discount_type',
        'purchase_price',
        'quantity',
        'expire_date',
        'status',
    ];
    protected $appends = ['discounted_price'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        if (!$this->exists || empty($this->attributes['slug'])) {
            $this->attributes['slug'] = $this->generateSlug($value);
        }
    }

    /**
     * Generate a unique slug for the category.
     *
     * @param string $name
     * @return string
     */
    protected function generateSlug($name)
    {
        $slug = Str::slug($name);
        $count = static::where('slug', 'like', "$slug%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function getDiscountedPriceAttribute()
    {
        if ($this->discount_type == 'fixed') {
            return number_format($this->price - $this->discount_value, 2);
        } elseif ($this->discount_type == 'percentage') {
            return number_format($this->price - ($this->price * $this->discount_value / 100), 2);
        } else {
            return $this->price;
        }
    }
}
