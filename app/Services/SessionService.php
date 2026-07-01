<?php

namespace App\Services;

use App\DTOs\SessionDTO;
use App\Repositories\SessionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class SessionService
{
    public function __construct(
        protected SessionRepository $repository,
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

    public function create(SessionDTO $dto): Model
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, SessionDTO $dto): Model
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
