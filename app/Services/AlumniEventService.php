<?php

namespace App\Services;

use App\DTOs\AlumniEventDTO;
use App\Models\AlumniEvent;
use App\Repositories\AlumniEventRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AlumniEventService
{
    public function __construct(
        protected AlumniEventRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?AlumniEvent
    {
        return $this->repository->find($id, $relations);
    }

    public function create(AlumniEventDTO $dto): AlumniEvent
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, AlumniEventDTO $dto): AlumniEvent
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
