<?php

namespace App\Repositories;

use App\Models\FeeHead;

class FeeHeadRepository extends BaseRepository
{
    protected function resolveModel(): FeeHead
    {
        return new FeeHead;
    }
}
