<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'cookie_id',
        'user_id',
        'product_id',
        'quantity',
        'options',
    ];


    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
