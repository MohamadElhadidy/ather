<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'category_id',
        'brand_id',
        'price',
        'sale_price',
        'cost_price',
        'stock',
        'track_stock',
        'show_out_of_stock',
        'is_featured',
        'is_active',
    ];



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
}
