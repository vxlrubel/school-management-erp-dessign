<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alumni extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'student_id',
        'profession',
        'company',
        'batch',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function eventRegistrations(): HasMany
    {
        return $this->hasMany(AlumniEventRegistration::class, 'alumni_id');
    }
}
