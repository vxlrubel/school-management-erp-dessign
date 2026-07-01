<?php

namespace App\Repositories;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Model;

class ActivityLogRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new ActivityLog;
    }
}
