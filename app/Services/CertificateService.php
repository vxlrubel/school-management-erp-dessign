<?php

namespace App\Services;

use App\DTOs\CertificateDTO;
use App\Models\Certificate;
use App\Repositories\CertificateRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CertificateService
{
    public function __construct(
        protected CertificateRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Certificate
    {
        return $this->repository->find($id, $relations);
    }

    public function create(CertificateDTO $dto): Certificate
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, CertificateDTO $dto): Certificate
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
