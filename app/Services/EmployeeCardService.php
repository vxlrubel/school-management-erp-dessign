<?php

namespace App\Services;

use App\DTOs\EmployeeCardDTO;
use App\Models\EmployeeCard;
use App\Repositories\EmployeeCardRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class EmployeeCardService
{
    public function __construct(
        protected EmployeeCardRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?EmployeeCard
    {
        return $this->repository->find($id, $relations);
    }

    public function create(EmployeeCardDTO $dto): EmployeeCard
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, EmployeeCardDTO $dto): EmployeeCard
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
