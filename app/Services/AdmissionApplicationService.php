<?php

namespace App\Services;

use App\DTOs\AdmissionApplicationDTO;
use App\Models\AdmissionApplication;
use App\Repositories\AdmissionApplicationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AdmissionApplicationService
{
    public function __construct(
        protected AdmissionApplicationRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?AdmissionApplication
    {
        return $this->repository->find($id, $relations);
    }

    public function create(AdmissionApplicationDTO $dto): AdmissionApplication
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, AdmissionApplicationDTO $dto): AdmissionApplication
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
