<?php

namespace App\Repositories;

use App\Models\StudentFee;

class StudentFeeRepository extends BaseRepository
{
    protected function resolveModel(): StudentFee
    {
        return new StudentFee;
    }
}
