<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role_permission extends Model
{
    protected $fillable = [
        'role_id',
        'role_page_id',
        'access_status'
    ];

}
