<?php

namespace App\Repositories;

use App\Models\StudentVaccine;
use Illuminate\Database\Eloquent\Model;

class StudentVaccineRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new StudentVaccine;
    }
}
