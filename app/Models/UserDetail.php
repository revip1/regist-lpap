<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $fillable = [
        'name',
        'gender',
        'last_education',
        'position',
        'program_id',
        'batch_id',
        'place',
        'number_of_participants',
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

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
