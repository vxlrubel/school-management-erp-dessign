<?php

namespace App\Repositories;

use App\Models\StudentGuardian;
use Illuminate\Database\Eloquent\Model;

class StudentGuardianRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new StudentGuardian;
    }
}
