<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notice extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'title',
        'description',
        'attachment',
        'publish_date',
    ];

    protected function casts(): array
    {
        return [
            'publish_date' => 'date:Y-m-d',
        ];
    }
}
