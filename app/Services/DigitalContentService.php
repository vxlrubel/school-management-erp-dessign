<?php

namespace App\Services;

use App\DTOs\DigitalContentDTO;
use App\Models\DigitalContent;
use App\Repositories\DigitalContentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DigitalContentService
{
    public function __construct(
        protected DigitalContentRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?DigitalContent
    {
        return $this->repository->find($id, $relations);
    }

    public function create(DigitalContentDTO $dto): DigitalContent
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, DigitalContentDTO $dto): DigitalContent
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
