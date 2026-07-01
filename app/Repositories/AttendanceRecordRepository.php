<?php

namespace App\Repositories;

use App\Models\AttendanceRecord;

class AttendanceRecordRepository extends BaseRepository
{
    protected function resolveModel(): AttendanceRecord
    {
        return new AttendanceRecord;
    }
}
