<?php

namespace App\Repositories;

use App\Models\Period;

class PeriodRepository extends BaseRepository
{
    protected function resolveModel(): Period
    {
        return new Period;
    }
}
