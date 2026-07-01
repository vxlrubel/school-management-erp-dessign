<?php

namespace App\Repositories;

use App\Models\OnlineClass;
use Illuminate\Database\Eloquent\Model;

class OnlineClassRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new OnlineClass;
    }
}
