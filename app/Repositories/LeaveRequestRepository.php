<?php

namespace App\Repositories;

use App\Models\LeaveRequest;

class LeaveRequestRepository extends BaseRepository
{
    protected function resolveModel(): LeaveRequest
    {
        return new LeaveRequest;
    }
}
