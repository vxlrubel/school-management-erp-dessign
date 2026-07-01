<?php

namespace App\Services;

use App\DTOs\StudentDTO;
use App\Repositories\StudentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentService
{
    public function __construct(
        protected StudentRepository $repository,
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

    public function create(StudentDTO $dto): Model
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, StudentDTO $dto): Model
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
