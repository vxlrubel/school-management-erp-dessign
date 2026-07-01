<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends BaseRepository
{
    protected function resolveModel(): Permission
    {
        return new Permission;
    }
}
