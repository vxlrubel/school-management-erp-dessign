<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'designation',
        'joining_date',
        'salary',
        'photo',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'joining_date' => 'date:Y-m-d',
            'salary' => 'decimal:2',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
