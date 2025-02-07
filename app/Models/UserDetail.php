<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $fillable = [
        'name',
        'program_id',
        'instance',
        'email',
        'address',
        'identity_type',
        'identity_number',
        'reason_to_join',
        'phone_number',
        'information_source',
        'referral',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
