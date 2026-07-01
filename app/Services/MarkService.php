<?php

namespace App\Services;

use App\DTOs\MarkDTO;
use App\Models\Mark;
use App\Repositories\MarkRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MarkService
{
    public function __construct(
        protected MarkRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Mark
    {
        return $this->repository->find($id, $relations);
    }

    public function create(MarkDTO $dto): Mark
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, MarkDTO $dto): Mark
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function findByField(string $field, mixed $value, array $relations = []): Collection
    {
        return $this->repository->findByField($field, $value, $relations);
    }
}
