<?php

namespace App\Repositories;

use App\Models\Teacher;
use Illuminate\Database\Eloquent\Model;

class TeacherRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Teacher;
    }
}
