<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    use HasSchool;

    protected $fillable = [
        'user_id',
        'school_id',
        'module',
        'action',
        'ip',
        'device',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
