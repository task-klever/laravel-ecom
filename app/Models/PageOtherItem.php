<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageOtherItem extends Model
{
    protected $fillable = [
        'seo_title',
        'seo_meta_description',
        'page_name'
    ];
}
