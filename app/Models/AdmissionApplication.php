<?php

namespace App\Models;

use App\Enums\AdmissionStatus;
use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdmissionApplication extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'mobile',
        'email',
        'class_id',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'status' => AdmissionStatus::class,
        ];
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'class_id');
    }
}
