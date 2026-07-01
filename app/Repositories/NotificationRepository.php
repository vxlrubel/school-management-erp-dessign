<?php

namespace App\Repositories;

use App\Models\Notification as NotificationModel;
use Illuminate\Database\Eloquent\Model;

class NotificationRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new NotificationModel;
    }
}
