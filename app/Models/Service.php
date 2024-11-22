<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'photo',
        'seo_title',
        'seo_meta_description'
    ];

}
