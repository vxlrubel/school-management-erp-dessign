<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository extends BaseRepository
{
    protected function resolveModel(): Page
    {
        return new Page;
    }
}
