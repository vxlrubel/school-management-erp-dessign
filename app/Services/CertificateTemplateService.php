<?php

namespace App\Services;

use App\DTOs\CertificateTemplateDTO;
use App\Models\CertificateTemplate;
use App\Repositories\CertificateTemplateRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CertificateTemplateService
{
    public function __construct(
        protected CertificateTemplateRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?CertificateTemplate
    {
        return $this->repository->find($id, $relations);
    }

    public function create(CertificateTemplateDTO $dto): CertificateTemplate
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, CertificateTemplateDTO $dto): CertificateTemplate
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
