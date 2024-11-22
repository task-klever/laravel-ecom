<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $fillable = [
        'shipping_name',
        'shipping_text',
        'shipping_cost',
        'shipping_order',
        'shipping_status'
    ];

}
