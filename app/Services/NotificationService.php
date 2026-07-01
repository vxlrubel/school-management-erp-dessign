<?php

namespace App\Services;

use App\DTOs\NotificationDTO;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationService
{
    public function __construct(
        protected NotificationRepository $repository,
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->repository->all($relations);
    }

    public function paginate(int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage, $relations);
    }

    public function find(int $id, array $relations = []): ?Notification
    {
        return $this->repository->find($id, $relations);
    }

    public function create(NotificationDTO $dto): Notification
    {
        return $this->repository->create($dto->toArray());
    }

    public function update(int $id, NotificationDTO $dto): Notification
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
