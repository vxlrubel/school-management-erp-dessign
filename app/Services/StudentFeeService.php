<?php

namespace App\Services;

use App\DTOs\StudentFeeDTO;
use App\Models\StudentFee;
use App\Repositories\StudentFeeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentFeeService
{
    public function __construct(
        protected StudentFeeRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?StudentFee
    {
        return $this->repository->find($id, $relations);
    }

    public function create(StudentFeeDTO $dto): StudentFee
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, StudentFeeDTO $dto): StudentFee
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
