<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'disk',
        'file_name',
        'path',
        'mime',
        'size',
    ];
}
