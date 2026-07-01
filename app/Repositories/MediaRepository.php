<?php

namespace App\Repositories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;

class MediaRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Media;
    }
}
