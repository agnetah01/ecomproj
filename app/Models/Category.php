<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ]; 


    public function products(){
        return $this->hasMany(Product::class);
    }


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

    public static function boot() {
        parent::boot();

        static::created(function ($category) {
            $category->slug = $category->createSlug($category->name);
            $category->save();
        });
    }

    

    private function createSlug($name)
    {   //create a unique slug
        if (static::whereSlug($slug = Str::slug($name))->exists()) {
            $max = static::whereTitle($name)->latest('id')->skip(1)->value('slug');

            if (is_numeric($max[-1])) {
                return preg_replace_callback('/(\d+)$/', function ($mathces) {
                    return $mathces[1] + 1;
                }, $max);
            }

            return "{$slug}-2";
        }

        return $slug;
    }
}
