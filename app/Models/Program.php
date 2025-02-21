<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = ['name', 'label', 'description', 'referral_required', 'status'];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function userDetail() {
        return $this->hasMany(UserDetail::class);
    }
}
