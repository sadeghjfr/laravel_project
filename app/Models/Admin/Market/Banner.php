<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'image', 'url', 'position', 'status'];

    protected $casts = ['image' => 'array'];

    public static $positions = [
        '0' => 'اسلایدشو (صفحه اصلی)',
        '1' => 'کنار اسلایدشو (صفحه اصلی)',
        '2' => 'دو بنر تبلیغی بین دو اسلایدر (صفحه اصلی)',
        '3' => 'بنر تبلیغی بزرگ پایین دو اسلایدر (صفحه اصلی)',
    ];
}
