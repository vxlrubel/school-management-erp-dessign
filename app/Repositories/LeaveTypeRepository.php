<?php

namespace App\Repositories;

use App\Models\LeaveType;

class LeaveTypeRepository extends BaseRepository
{
    protected function resolveModel(): LeaveType
    {
        return new LeaveType;
    }
}
