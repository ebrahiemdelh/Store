<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder as Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id', 'id')->withDefault([
            'name' => '-'
        ]);
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    protected function scopeStatus(Builder $builder, $status)
    {
        return $builder->where('status', $status);
    }
    protected function scopeName(Builder $builder, $name)
    {
        return $builder->where('name', 'like', "%{$name}%");
    }
    protected function scopeFilter(Builder $builder, $filter)
    {
        if ($filter['name'] ?? null) {
            $builder->where('categories.name', 'like', "%{$filter['name']}%"); //use tablename.columnname to avoid ambiguous columns in join queries
        }
        if ($filter['status'] ?? null) {
            $builder->where('categories.status', $filter['status']); //use tablename.columnname to avoid ambiguous columns in join queries
        }
    }
    protected $fillable = [
        'name',
        'description',
        'slug',
        'image',
        'status',
        'parent_id'
    ];
}
