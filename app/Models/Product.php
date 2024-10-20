<?php

namespace App\Models;

use App\Models\Scopes\StoreScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    protected static function booted()
    {
        static::addGlobalScope('store', new StoreScope()); // better for avoiding errors
        // static::addGlobalScope(StoreScope::class);
    }
}
