<?php

namespace App\Repositories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Employee;
    }
}
