<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'slug', 'image', 'status', 'tags', 'parent_id'];

    public function parent(){

        return $this->belongsTo('App\Models\Content\PostCategory', 'parent_id', 'id');
    }
}
