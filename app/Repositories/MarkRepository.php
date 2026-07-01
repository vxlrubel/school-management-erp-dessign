<?php

namespace App\Repositories;

use App\Models\Mark;

class MarkRepository extends BaseRepository
{
    protected function resolveModel(): Mark
    {
        return new Mark;
    }
}
