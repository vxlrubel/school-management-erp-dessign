<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\School;

class SchoolRepository extends BaseRepository
{
    protected function resolveModel(): School
    {
        return new School;
    }
}
