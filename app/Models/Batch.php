<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    protected $fillable = ['program_id', 'name', 'limit'];

    protected static function boot()
    {
        parent::boot();

        // Observer untuk event "updated"
        static::updated(function ($batch) {
            if ($batch->wasChanged('name')) {
                // Update semua tiket yang terkait
                $tickets = $batch->tickets;
                foreach ($tickets as $ticket) {
                    $program = $ticket->program;
                    $participantNumber = substr($ticket->unique_code, -3); // Mengambil 3 digit terakhir
                    
                    // Membuat kode unik baru dengan format yang sama
                    $newUniqueCode = sprintf(
                        "LPAP-%sG%s%s-%s",
                        $program->code,
                        $batch->name,
                        $ticket->year,
                        $participantNumber
                    );

                    // Update kode unik tiket
                    $ticket->update([
                        'unique_code' => $newUniqueCode
                    ]);
                }
            }
        });
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'batch_id');
    }
}
