<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    protected function resolveModel(): User
    {
        return new User;
    }
}
