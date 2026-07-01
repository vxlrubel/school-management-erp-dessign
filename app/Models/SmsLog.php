<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasSchool;

    protected $fillable = [
        'school_id',
        'mobile',
        'message',
        'status',
        'response',
    ];
}
