<?php

namespace App\Repositories;

use App\Models\DigitalContent;
use Illuminate\Database\Eloquent\Model;

class DigitalContentRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new DigitalContent;
    }
}
