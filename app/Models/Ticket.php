<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['program_id', 'batch', 'unique_code'];

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function userDetails()
    {
        return $this->hasMany(UserDetail::class, 'tiket_id');
    }
}
