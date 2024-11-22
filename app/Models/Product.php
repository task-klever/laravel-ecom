<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_slug',
        'product_old_price',
        'product_current_price',
        'product_stock',
        'product_content',
        'product_content_short',
        'product_return_policy',
        'product_featured_photo',
        'product_order',
        'product_status',
        'seo_title',
        'seo_meta_description'
    ];

}
