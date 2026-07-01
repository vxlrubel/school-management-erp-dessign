<?php

namespace App\Repositories;

use App\Models\FeeStructure;

class FeeStructureRepository extends BaseRepository
{
    protected function resolveModel(): FeeStructure
    {
        return new FeeStructure;
    }
}
