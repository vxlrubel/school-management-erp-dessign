<?php

namespace App\Repositories;

use App\Models\Attendance;

class AttendanceRepository extends BaseRepository
{
    protected function resolveModel(): Attendance
    {
        return new Attendance;
    }
}
