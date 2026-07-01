<?php

namespace App\Services;

use App\DTOs\StudentCardDTO;
use App\Models\StudentCard;
use App\Repositories\StudentCardRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentCardService
{
    public function __construct(
        protected StudentCardRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?StudentCard
    {
        return $this->repository->find($id, $relations);
    }

    public function create(StudentCardDTO $dto): StudentCard
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, StudentCardDTO $dto): StudentCard
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
