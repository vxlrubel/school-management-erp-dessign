<?php

namespace App\Services;

use App\DTOs\AlumniDTO;
use App\Models\Alumni;
use App\Repositories\AlumniRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AlumniService
{
    public function __construct(
        protected AlumniRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Alumni
    {
        return $this->repository->find($id, $relations);
    }

    public function create(AlumniDTO $dto): Alumni
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, AlumniDTO $dto): Alumni
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
