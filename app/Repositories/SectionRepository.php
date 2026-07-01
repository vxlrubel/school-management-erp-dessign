<?php

namespace App\Repositories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class SectionRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Section;
    }
}
