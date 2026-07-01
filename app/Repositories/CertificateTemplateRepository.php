<?php

namespace App\Repositories;

use App\Models\CertificateTemplate;
use Illuminate\Database\Eloquent\Model;

class CertificateTemplateRepository extends BaseRepository
{
    protected function resolveModel(): Model
    {
        return new CertificateTemplate;
    }
}
