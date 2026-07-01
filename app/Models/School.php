<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'eiin',
        'logo',
        'favicon',
        'address',
        'phone',
        'email',
        'website',
        'status',
    ];

    public function settings(): HasOne
    {
        return $this->hasOne(SchoolSetting::class);
    }

    protected function casts(): array
    {
        return [
            'status' => StatusType::class,
        ];
    }
}
