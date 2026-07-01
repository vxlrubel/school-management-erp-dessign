<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AlumniEventRegistration extends Model
{
    protected $fillable = [
        'alumni_event_id',
        'alumni_id',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(AlumniEvent::class, 'alumni_event_id');
    }

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }
}
