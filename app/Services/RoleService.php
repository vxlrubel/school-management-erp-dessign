<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\RoleDTO;
use App\Repositories\RoleRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class RoleService
{
    public function __construct(
        protected RoleRepository $roleRepository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->roleRepository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->roleRepository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->roleRepository->find($id, $relations);
    }

    public function create(RoleDTO $dto): Model
    {
        return $this->roleRepository->create($dto->toArray());
    }

    public function update(int $id, RoleDTO $dto): Model
    {
        return $this->roleRepository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->roleRepository->delete($id);
    }
}
