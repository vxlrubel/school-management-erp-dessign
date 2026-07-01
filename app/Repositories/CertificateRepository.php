<?php

namespace App\Repositories;

use App\Models\Certificate;
use Illuminate\Database\Eloquent\Model;

class CertificateRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new Certificate;
    }
}
