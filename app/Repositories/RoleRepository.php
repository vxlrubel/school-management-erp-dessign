<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends BaseRepository
{
    protected function resolveModel(): Role
    {
        return new Role;
    }
}
