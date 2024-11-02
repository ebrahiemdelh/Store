<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class, //related model, is enought to write the name of the class unless the class is in a different namespace
            'product_tag', // pivot table
            'product_id', // foreign key
            'tag_id', // related key
            'id', // local key
            'id' // related key
        );
    }
    protected function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('products.name', 'like', "%{$filter['name']}%");
        }
        if ($filter['store'] ?? null) {
            $builder->where('products.store_id', $filter['store']);
        }
        if ($filter['category'] ?? null) {
            $builder->where('product.category_id', $filter['category']);
        }
        if ($filter['status'] ?? null) {
            $builder->where('products.status', $filter['status']);
        }
    }
    public function scopeActive(Builder $builder)
    {
        return $builder->where('status', "active");
    }
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope()); // better for avoiding errors
        // static::addGlobalScope(StoreScope::class);
    }
    // Accessors
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return   asset('assets/images/products/default.jpeg');
        } else if (Str::startsWith($this->image, ['http', 'https'])) {
            return $this->image;
        }
        return asset('assets/images/products/' . $this->image);
    }
    public function getDiscountAttribute()
    {
        if ($this->compare_price) {
            return round((($this->compare_price - $this->price) / $this->compare_price) * 100);
        }
    }
    public function getNewAttribute()
    {
        return now()->subDays(30)->lt($this->created_at);
    }
}
