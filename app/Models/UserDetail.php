<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDetail extends Model
{
    protected $fillable = [
        'ticket_id', 'full_name', 'whatsapp_number', 'email', 
        'address', 'occupation', 'institution', 
        'reason_to_join', 'information_source', 'referral'
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

}
