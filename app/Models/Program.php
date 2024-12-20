<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['name', 'code'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
