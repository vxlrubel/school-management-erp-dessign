<?php

namespace App\Services;

use App\DTOs\StudentGuardianDTO;
use App\Repositories\StudentGuardianRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentGuardianService
{
    public function __construct(
        protected StudentGuardianRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->repository->find($id, $relations);
    }

    public function create(StudentGuardianDTO $dto): Model
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, StudentGuardianDTO $dto): Model
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
