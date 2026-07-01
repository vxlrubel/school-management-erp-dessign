<?php

namespace App\Services;

use App\DTOs\TabulationDTO;
use App\Models\Tabulation;
use App\Repositories\TabulationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class TabulationService
{
    public function __construct(
        protected TabulationRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Tabulation
    {
        return $this->repository->find($id, $relations);
    }

    public function create(TabulationDTO $dto): Tabulation
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, TabulationDTO $dto): Tabulation
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
