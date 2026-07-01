<?php

namespace App\Repositories;

use App\Models\StudentAcademic;
use Illuminate\Database\Eloquent\Model;

class StudentAcademicRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new StudentAcademic;
    }
}
