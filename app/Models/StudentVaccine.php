<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentVaccine extends Model
{
    protected $fillable = [
        'student_id',
        'vaccine_id',
        'date_given',
    ];

    protected function casts(): array
    {
        return [
            'date_given' => 'date:Y-m-d',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function vaccine(): BelongsTo
    {
        return $this->belongsTo(Vaccine::class);
    }
}
