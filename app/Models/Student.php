<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'admission_no',
        'roll',
        'name',
        'gender',
        'dob',
        'religion',
        'blood_group',
        'mobile',
        'email',
        'photo',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'dob' => 'date:Y-m-d',
        ];
    }

    public function guardian(): HasOne
    {
        return $this->hasOne(StudentGuardian::class, 'student_id');
    }

    public function academic(): HasOne
    {
        return $this->hasOne(StudentAcademic::class, 'student_id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }
}
