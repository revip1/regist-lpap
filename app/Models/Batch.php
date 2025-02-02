<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    protected $fillable = ['name', 'limit'];

    
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'batch_id');
    }
}
