<?php

namespace App\Models\Content;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['body', 'parent_id', 'user_id', 'commentable_id', 'commentable_type', 'status'];

    public function commentable(){

        return $this->morphTo();
    }

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
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

}
