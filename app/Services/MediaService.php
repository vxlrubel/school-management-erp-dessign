<?php

namespace App\Services;

use App\DTOs\MediaDTO;
use App\Models\Media;
use App\Repositories\MediaRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class MediaService
{
    public function __construct(
        protected MediaRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Media
    {
        return $this->repository->find($id, $relations);
    }

    public function create(MediaDTO $dto): Media
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, MediaDTO $dto): Media
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
