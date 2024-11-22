<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = [
        'job_title',
        'job_slug',
        'job_description_short',
        'job_responsibility',
        'job_education',
        'job_experience',
        'job_additional_requirement',
        'job_benefit',
        'job_deadline',
        'job_vacancy',
        'job_company_name',
        'job_location',
        'job_type',
        'job_salary',
        'job_order',
        'seo_title',
        'seo_meta_description'
    ];

}
