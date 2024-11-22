<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    protected $fillable = [
        'job_id',
        'applicant_first_name',
        'applicant_last_name',
        'applicant_email',
        'applicant_phone',
        'applicant_country',
        'applicant_state',
        'applicant_street',
        'applicant_city',
        'applicant_zip_code',
        'applicant_expected_salary',
        'applicant_cover_letter',
        'applicant_cv'
    ];

    public function job()
    {
        return $this->belongsTo('App\Models\Admin\Job');
    }

}
