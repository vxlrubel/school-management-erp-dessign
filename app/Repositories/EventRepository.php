<?php

namespace App\Repositories;

use App\Models\Event;

class EventRepository extends BaseRepository
{
    protected function resolveModel(): Event
    {
        return new Event;
    }
}
