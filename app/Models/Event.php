<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'title',
        'start_date',
        'end_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date:Y-m-d',
            'end_date' => 'date:Y-m-d',
        ];
    }
}
