<?php

namespace App\Services;

use App\DTOs\NoticeDTO;
use App\Models\Notice;
use App\Repositories\NoticeRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NoticeService
{
    public function __construct(
        protected NoticeRepository $repository
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Notice
    {
        return $this->repository->find($id, $relations);
    }

    public function create(NoticeDTO $dto): Notice
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, NoticeDTO $dto): Notice
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
