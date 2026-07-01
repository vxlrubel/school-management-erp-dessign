<?php

namespace App\Services;

use App\DTOs\IdCardTemplateDTO;
use App\Models\IdCardTemplate;
use App\Repositories\IdCardTemplateRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class IdCardTemplateService
{
    public function __construct(
        protected IdCardTemplateRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?IdCardTemplate
    {
        return $this->repository->find($id, $relations);
    }

    public function create(IdCardTemplateDTO $dto): IdCardTemplate
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, IdCardTemplateDTO $dto): IdCardTemplate
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
