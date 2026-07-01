<?php

namespace App\Services;

use App\DTOs\StudentVaccineDTO;
use App\Models\StudentVaccine;
use App\Repositories\StudentVaccineRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentVaccineService
{
    public function __construct(
        protected StudentVaccineRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?StudentVaccine
    {
        return $this->repository->find($id, $relations);
    }

    public function create(StudentVaccineDTO $dto): StudentVaccine
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, StudentVaccineDTO $dto): StudentVaccine
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
