<?php

namespace App\Services;

use App\DTOs\AlumniEventRegistrationDTO;
use App\Models\AlumniEventRegistration;
use App\Repositories\AlumniEventRegistrationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AlumniEventRegistrationService
{
    public function __construct(
        protected AlumniEventRegistrationRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?AlumniEventRegistration
    {
        return $this->repository->find($id, $relations);
    }

    public function create(AlumniEventRegistrationDTO $dto): AlumniEventRegistration
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, AlumniEventRegistrationDTO $dto): AlumniEventRegistration
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
