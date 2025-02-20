<?php

namespace App\Models\Admin\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    public function sluggable(): array
    {
        return[
            'slug' =>[
                'source' => 'name'
            ]
        ];
    }

    protected $casts = ['image' => 'array'];

    protected $fillable = ['name', 'description', 'slug', 'image', 'status', 'tags', 'show_in_menu', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }

    public function products(){

        return $this->hasMany(Product::class, 'category_id');
    }

    public function attributes(){

        return $this->hasMany(CategoryAttribute::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {

            $category->children()->each(function ($child) {
                $child->delete();
            });

            $category->products()->each(function ($product) {
                $product->delete();
            });

            $category->attributes()->each(function ($attribute) {
                $attribute->delete();
            });
        });

    }

}
