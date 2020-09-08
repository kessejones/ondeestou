<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'id_user',
        'id_social_network',
        'link',
        'status',
        'created_at',
        'updated_at',
    ];
}