<?php

namespace App\Repositories;

use App\Models\Tabulation;

class TabulationRepository extends BaseRepository
{
    protected function resolveModel(): Tabulation
    {
        return new Tabulation;
    }
}
