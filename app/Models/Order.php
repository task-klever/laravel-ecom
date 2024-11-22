<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_name',
        'customer_email',
        'customer_type',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_country',
        'billing_address',
        'billing_state',
        'billing_city',
        'billing_zip',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_country',
        'shipping_address',
        'shipping_state',
        'shipping_city',
        'shipping_zip',
        'order_note',
        'txnid',
        'shipping_cost',
        'coupon_code',
        'coupon_discount',
        'paid_amount',
        'card_last4',
        'card_exp_month',
        'card_exp_year',
        'payment_method',
        'payment_status',
        'order_no'
    ];
}
