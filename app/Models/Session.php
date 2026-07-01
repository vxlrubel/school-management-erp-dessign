<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Session extends Model
{
    use HasSchool, SoftDeletes;

    protected $table = 'academic_sessions';

    protected $fillable = [
        'school_id',
        'name',
        'current',
    ];

    protected function casts(): array
    {
        return [
            'current' => 'boolean',
        ];
    }

    public function studentAcademics(): HasMany
    {
        return $this->hasMany(StudentAcademic::class);
    }
}
