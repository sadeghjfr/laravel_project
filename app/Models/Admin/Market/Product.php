<?php

namespace App\Models\Admin\Market;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'name', 'introduction', 'slug', 'image', 'weight', 'length', 'width', 'height', 'price', 'frozen_number',
        'status', 'marketable', 'tags', 'brand_id ', 'published_at', 'category_id', 'sold_number', 'marketable_number'
    ];

    protected $casts = ['image' => 'array'];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function category(){

        return $this->belongsTo(ProductCategory::class);
    }

    public function brand(){

        return $this->belongsTo(Brand::class);
    }

    public function metas(){

        return $this->hasMany(ProductMeta::class);
    }

    public function colors(){

        return $this->hasMany(ProductColor::class);
    }

    public function images()
    {
        return $this->hasMany(Gallery::class);
    }

    public function values()
    {
        return $this->hasMany(CategoryAttributeValue::class);
    }

    /*public function comments(){

        return $this->morphMany(Comment::class, 'commentable');
    }*/

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {

            $product->metas()->each(function ($meta) {
                $meta->delete();
            });

            $product->colors()->each(function ($color) {
                $color->delete();
            });

            $product->images()->each(function ($image) {
                $image->delete();
            });

            $product->values()->each(function ($value) {
                $value->delete();
            });

            /*$product->comments()->each(function ($comment) {
                $comment->delete();
            });*/
        });

    }

}
