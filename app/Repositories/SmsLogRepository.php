<?php

namespace App\Repositories;

use App\Models\SmsLog;

class SmsLogRepository extends BaseRepository
{
    protected function resolveModel(): SmsLog
    {
        return new SmsLog;
    }
}
