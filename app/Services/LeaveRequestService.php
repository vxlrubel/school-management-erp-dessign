<?php

namespace App\Services;

use App\DTOs\LeaveRequestDTO;
use App\Models\LeaveRequest;
use App\Repositories\LeaveRequestRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LeaveRequestService
{
    public function __construct(
        protected LeaveRequestRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?LeaveRequest
    {
        return $this->repository->find($id, $relations);
    }

    public function create(LeaveRequestDTO $dto): LeaveRequest
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, LeaveRequestDTO $dto): LeaveRequest
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
