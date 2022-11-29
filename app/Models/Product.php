<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'slug',
        'description',
        'price',
        'quantity',
        'status',
        'meta_title',
        'meta_keyword',
        'meta_description'
    ];

    
    protected function status(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value == 'Active' ? 1 : 0,
        );
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::slug($value),
        );
    }

    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }

     public static function boot() {
        parent::boot();

        static::saving(function($product) { 
            $product->productImages()->delete();
        });
    }
}