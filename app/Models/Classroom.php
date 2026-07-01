<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroom extends Model
{
    use HasSchool, SoftDeletes;

    protected $table = 'classes';

    protected $fillable = [
        'school_id',
        'name',
    ];
}
