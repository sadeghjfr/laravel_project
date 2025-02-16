<?php

namespace App\Models\Admin\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'menus';

    protected $fillable = ['name', 'url', 'parent_id', 'status'];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($menu) {

            $menu->children()->each(function ($child) {
                $child->delete();
            });
        });

    }

}
