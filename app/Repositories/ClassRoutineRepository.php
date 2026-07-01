<?php

namespace App\Repositories;

use App\Models\ClassRoutine;

class ClassRoutineRepository extends BaseRepository
{
    protected function resolveModel(): ClassRoutine
    {
        return new ClassRoutine;
    }
}
