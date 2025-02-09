<?php

namespace App\Models\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = ['name', 'description', 'slug', 'image', 'status', 'tags', 'parent_id'];

    protected $casts = ['image' => 'array'];

    public function parent(){

        return $this->belongsTo(PostCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(PostCategory::class, 'parent_id');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {

            $category->children()->each(function ($child) {
                $child->delete();
            });
        });


    }

    public function sluggable(): array
    {
        return [
          'slug' => [
              'source' => 'name'
          ]
        ];
    }
}
