<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'subs_email',
        'subs_token',
        'subs_active'
    ];

}
