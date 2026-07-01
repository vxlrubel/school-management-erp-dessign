<?php

namespace App\Services;

use App\DTOs\OnlineClassDTO;
use App\Models\OnlineClass;
use App\Repositories\OnlineClassRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class OnlineClassService
{
    public function __construct(
        protected OnlineClassRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?OnlineClass
    {
        return $this->repository->find($id, $relations);
    }

    public function create(OnlineClassDTO $dto): OnlineClass
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, OnlineClassDTO $dto): OnlineClass
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
