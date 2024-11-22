<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'coupon_code',
        'coupon_type',
        'coupon_discount',
        'coupon_maximum_use',
        'coupon_existing_use',
        'coupon_start_date',
        'coupon_end_date',
        'coupon_status'
    ];
}
