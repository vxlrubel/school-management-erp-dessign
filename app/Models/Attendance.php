<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasSchool, SoftDeletes;

    protected $table = 'attendance';

    protected $fillable = [
        'school_id',
        'attendance_date',
        'type',
    ];

    protected function casts(): array
    {
        return [
            'attendance_date' => 'date:Y-m-d',
        ];
    }

    public function attendanceRecords(): HasMany
    {
        return $this->hasMany(AttendanceRecord::class);
    }
}
