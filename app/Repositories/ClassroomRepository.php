<?php

namespace App\Repositories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;

class ClassroomRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Classroom;
    }
}
