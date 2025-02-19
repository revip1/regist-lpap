<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    protected $fillable = ['program_id', 'name', 'limit', 'estimated_time', 'program_type'];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'batch_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(UserDetail::class, 'batch_id');
    }
}
