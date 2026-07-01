<?php

namespace App\Services;

use App\DTOs\ActivityLogDTO;
use App\Models\ActivityLog;
use App\Repositories\ActivityLogRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ActivityLogService
{
    public function __construct(
        protected ActivityLogRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?ActivityLog
    {
        return $this->repository->find($id, $relations);
    }

    public function create(ActivityLogDTO $dto): ActivityLog
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, ActivityLogDTO $dto): ActivityLog
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
