<?php

namespace App\Traits;

use App\Models\School;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasSchool
{
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function scopeBySchool($query, ?int $schoolId = null)
    {
        $schoolId = $schoolId ?? auth()->user()?->school_id;

        if ($schoolId) {
            return $query->where('school_id', $schoolId);
        }

        return $query;
    }
}
