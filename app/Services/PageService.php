<?php

namespace App\Services;

use App\DTOs\PageDTO;
use App\Models\Page;
use App\Repositories\PageRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PageService
{
    public function __construct(
        protected PageRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Page
    {
        return $this->repository->find($id, $relations);
    }

    public function create(PageDTO $dto): Page
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, PageDTO $dto): Page
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
