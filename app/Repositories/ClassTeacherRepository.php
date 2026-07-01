<?php

namespace App\Repositories;

use App\Models\ClassTeacher;
use Illuminate\Database\Eloquent\Model;

class ClassTeacherRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new ClassTeacher;
    }
}
