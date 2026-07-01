<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Student;
    }
}
