<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdmissionLottery extends Model
{
    protected $fillable = [
        'application_id',
        'result',
    ];

    protected function casts(): array
    {
        return [
            'result' => 'string',
        ];
    }

    public function application(): BelongsTo
    {
        return $this->belongsTo(AdmissionApplication::class);
    }
}
