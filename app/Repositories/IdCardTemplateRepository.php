<?php

namespace App\Repositories;

use App\Models\IdCardTemplate;
use Illuminate\Database\Eloquent\Model;

class IdCardTemplateRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new IdCardTemplate;
    }
}
