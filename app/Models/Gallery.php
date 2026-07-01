<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'title',
        'image',
        'category',
    ];
}
