<?php

namespace App\Models\Admin\Market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guarantee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'product_id',
        'price_increase',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
