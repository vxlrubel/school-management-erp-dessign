<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\PermissionDTO;
use App\Repositories\PermissionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $permissionRepository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->permissionRepository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->permissionRepository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->permissionRepository->find($id, $relations);
    }

    public function create(PermissionDTO $dto): Model
    {
        return $this->permissionRepository->create($dto->toArray());
    }

    public function update(int $id, PermissionDTO $dto): Model
    {
        return $this->permissionRepository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->permissionRepository->delete($id);
    }
}
