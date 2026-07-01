<?php

namespace App\Repositories;

use App\Models\EmployeeCard;
use Illuminate\Database\Eloquent\Model;

class EmployeeCardRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new EmployeeCard;
    }
}
