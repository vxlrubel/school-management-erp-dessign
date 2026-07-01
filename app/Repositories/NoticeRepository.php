<?php

namespace App\Repositories;

use App\Models\Notice;

class NoticeRepository extends BaseRepository
{
    protected function resolveModel(): Notice
    {
        return new Notice;
    }
}
