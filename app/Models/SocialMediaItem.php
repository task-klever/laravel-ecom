<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialMediaItem extends Model
{
    protected $fillable = [
        'social_url',
        'social_icon',
        'social_order'
    ];

}
