<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestProgram extends Model
{
    protected $fillable = [
        'name',
        'place',
        'message',
        'phone_number',
        'estimated_date',
    ];
}
