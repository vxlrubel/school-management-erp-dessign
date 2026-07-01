<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentCard extends Model
{
    use HasSchool;

    protected $fillable = [
        'school_id',
        'student_id',
        'template_id',
        'issue_date',
    ];

    protected function casts(): array
    {
        return [
            'issue_date' => 'date:Y-m-d',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(IdCardTemplate::class, 'template_id');
    }
}
