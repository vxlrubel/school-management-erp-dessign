<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\SchoolDTO;
use App\Repositories\SchoolRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class SchoolService
{
    public function __construct(
        protected SchoolRepository $schoolRepository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->schoolRepository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->schoolRepository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Model
    {
        return $this->schoolRepository->find($id, $relations);
    }

    public function create(SchoolDTO $dto): Model
    {
        return $this->schoolRepository->create($dto->toArray());
    }

    public function update(int $id, SchoolDTO $dto): Model
    {
        return $this->schoolRepository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->schoolRepository->delete($id);
    }
}
