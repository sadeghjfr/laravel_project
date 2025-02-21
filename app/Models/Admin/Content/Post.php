<?php

namespace App\Models\Admin\Content;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = ['title', 'summary', 'body', 'slug', 'image', 'status', 'tags', 'user_id', 'published_at', 'category_id', 'commentable'];

    protected $casts = ['image' => 'array'];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function postCategory(){

        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function comments(){

        return $this->morphMany(Comment::class, 'commentable');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {

            $post->comments()->each(function ($comment) {
                $comment->delete();
            });
        });

    }
}
