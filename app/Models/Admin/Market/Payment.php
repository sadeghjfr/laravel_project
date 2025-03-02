<?php

namespace App\Models\Admin\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function paymentable(){

        return $this->morphTo();
    }

    public function getTypeFaAttribute()
    {
        $types = [
            'online' => 'آنلاین',
            'cash' => 'نقدی',
            'offline' => 'کارت به کارت',
        ];

        return $types[$this->type] ?? 'نامشخص';
    }

    public function getStatusFaAttribute()
    {
        $statuses = [
            'paid' => 'پرداخت شده',
            'unpaid' => 'پرداخت نشده',
            'canceled' => 'باطل شده',
            'returned' => 'بازگشت وجه',
        ];

        return $statuses[$this->status] ?? 'نامشخص';
    }

}
