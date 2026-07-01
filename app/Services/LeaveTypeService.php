<?php

namespace App\Services;

use App\DTOs\LeaveTypeDTO;
use App\Models\LeaveType;
use App\Repositories\LeaveTypeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class LeaveTypeService
{
    public function __construct(
        protected LeaveTypeRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?LeaveType
    {
        return $this->repository->find($id, $relations);
    }

    public function create(LeaveTypeDTO $dto): LeaveType
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, LeaveTypeDTO $dto): LeaveType
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
