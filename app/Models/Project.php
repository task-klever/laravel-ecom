<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name',
        'project_slug',
        'project_content',
        'project_content_short',
        'project_start_date',
        'project_end_date',
        'project_client_name',
        'project_client_company',
        'project_client_comment',
        'project_video',
        'project_featured_photo',
        'seo_title',
        'seo_meta_description'
    ];

}
