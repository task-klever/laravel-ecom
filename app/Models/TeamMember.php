<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'designation',
        'degree',
        'detail',
        'facebook',
        'twitter',
        'linkedin',
        'youtube',
        'instagram',
        'email',
        'phone',
        'website',
        'address',
        'video_youtube',
        'photo',
        'seo_title',
        'seo_meta_description'
    ];

}
