<?php

namespace App\Models\Admin\Market;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function payment(){
        return $this->belongsTo(Payment::class);
    }

    public function delivery(){
        return $this->belongsTo(Delivery::class);
    }

    public function address(){
        return $this->belongsTo(Address::class);
    }

    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }

    public function commonDiscount(){
        return $this->belongsTo(CommonDiscount::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($order) {

            $order->orderItems()->each(function ($item) {
                $item->delete();
            });

        });

    }

    public function getStatusFaAttribute()
    {
        $statuses = [
            'new' => 'جدید',
            'waiting' => 'در انتظار',
            'sent' => 'ارسال شده',
            'delivered' => 'تحویل شده',
            'canceled' => 'باطل شده',
            'returned' => 'مرجوع شده',
        ];

        return $statuses[$this->status] ?? 'نامشخص';
    }
}
