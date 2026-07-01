<?php

namespace App\Services;

use App\DTOs\StudentAcademicDTO;
use App\Repositories\StudentAcademicRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentAcademicService
{
    public function __construct(
        protected StudentAcademicRepository $repository,
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

    public function create(StudentAcademicDTO $dto): Model
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, StudentAcademicDTO $dto): Model
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
