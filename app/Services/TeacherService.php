<?php

namespace App\Services;

use App\DTOs\TeacherDTO;
use App\Repositories\TeacherRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class TeacherService
{
    public function __construct(
        protected TeacherRepository $repository,
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

    public function create(TeacherDTO $dto): Model
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, TeacherDTO $dto): Model
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
