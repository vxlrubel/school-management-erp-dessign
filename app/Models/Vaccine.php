<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vaccine extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
    ];

    public function studentVaccines(): HasMany
    {
        return $this->hasMany(StudentVaccine::class);
    }
}
