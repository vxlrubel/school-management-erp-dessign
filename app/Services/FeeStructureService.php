<?php

namespace App\Services;

use App\DTOs\FeeStructureDTO;
use App\Models\FeeStructure;
use App\Repositories\FeeStructureRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class FeeStructureService
{
    public function __construct(
        protected FeeStructureRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?FeeStructure
    {
        return $this->repository->find($id, $relations);
    }

    public function create(FeeStructureDTO $dto): FeeStructure
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, FeeStructureDTO $dto): FeeStructure
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
