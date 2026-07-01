<?php

namespace App\Services;

use App\DTOs\SmsLogDTO;
use App\Models\SmsLog;
use App\Repositories\SmsLogRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SmsLogService
{
    public function __construct(
        protected SmsLogRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?SmsLog
    {
        return $this->repository->find($id, $relations);
    }

    public function create(SmsLogDTO $dto): SmsLog
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, SmsLogDTO $dto): SmsLog
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
