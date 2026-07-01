<?php

namespace App\Services;

use App\DTOs\GalleryDTO;
use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryService
{
    public function __construct(
        protected GalleryRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Gallery
    {
        return $this->repository->find($id, $relations);
    }

    public function create(GalleryDTO $dto): Gallery
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, GalleryDTO $dto): Gallery
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
