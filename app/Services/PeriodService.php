<?php

namespace App\Services;

use App\DTOs\PeriodDTO;
use App\Models\Period;
use App\Repositories\PeriodRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PeriodService
{
    public function __construct(
        protected PeriodRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Period
    {
        return $this->repository->find($id, $relations);
    }

    public function create(PeriodDTO $dto): Period
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, PeriodDTO $dto): Period
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
