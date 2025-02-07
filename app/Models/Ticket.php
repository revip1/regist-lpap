<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ticket extends Model
{
    protected $fillable = ['program_id', 'batch_id', 'year', 'unique_code'];

    public function program() : BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    // public function userDetails(): HasMany
    // {
    //     return $this->hasMany(UserDetail::class, 'ticket_id');
    // }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }
}
