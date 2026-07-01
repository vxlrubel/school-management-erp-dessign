<?php

namespace App\Models;

use App\Traits\HasSchool;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CertificateTemplate extends Model
{
    use HasSchool, SoftDeletes;

    protected $fillable = [
        'school_id',
        'name',
        'html',
    ];

    public function certificates(): HasMany
    {
        return $this->hasMany(Certificate::class, 'template_id');
    }
}
