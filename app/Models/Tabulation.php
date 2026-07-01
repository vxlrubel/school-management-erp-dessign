<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tabulation extends Model
{
    protected $fillable = [
        'exam_id',
        'student_id',
        'gpa',
        'position',
    ];

    protected function casts(): array
    {
        return [
            'gpa' => 'decimal:2',
            'position' => 'integer',
        ];
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
