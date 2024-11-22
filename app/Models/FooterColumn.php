<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterColumn extends Model
{
    protected $fillable = [
        'column_item_text',
        'column_item_url',
        'column_item_order',
        'column_name'
    ];

}
