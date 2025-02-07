<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['name', 'place', 'label', 'description'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function userDetail() {
        return $this->hasMany(UserDetail::class);
    }
}
