<?php

namespace App\Repositories;

use App\Models\Session;
use Illuminate\Database\Eloquent\Model;

class SessionRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Session;
    }
}
