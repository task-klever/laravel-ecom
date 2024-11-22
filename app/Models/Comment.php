<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'blog_id',
        'person_name',
        'person_email',
        'person_message',
        'comment_status'
    ];

}
