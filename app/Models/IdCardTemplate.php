<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdCardTemplate extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'html',
    ];
}
