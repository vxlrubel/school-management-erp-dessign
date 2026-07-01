<?php

namespace App\Services;

use App\DTOs\VaccineDTO;
use App\Models\Vaccine;
use App\Repositories\VaccineRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VaccineService
{
    public function __construct(
        protected VaccineRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Vaccine
    {
        return $this->repository->find($id, $relations);
    }

    public function create(VaccineDTO $dto): Vaccine
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, VaccineDTO $dto): Vaccine
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
